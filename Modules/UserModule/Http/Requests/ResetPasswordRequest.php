<?php

namespace Modules\UserModule\Http\Requests;


class ResetPasswordRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'phone_number' => 'required|string|exists:users,phone_number',
            'password' => 'required|string',
            'email' => 'required|exists:users,email',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
