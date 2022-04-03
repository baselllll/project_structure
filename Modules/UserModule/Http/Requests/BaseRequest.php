<?php

namespace Modules\UserModule\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{

    /**
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $mappedErrors = collect($errors)->map(function ($error, $key) {
            return [
                "key" => $key,
                "error" => Arr::first($error),
            ];
        })->values();

        throw new HttpResponseException(
            response()->json([
                'message' => $mappedErrors->first()['error'],
                'errors' => $mappedErrors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
