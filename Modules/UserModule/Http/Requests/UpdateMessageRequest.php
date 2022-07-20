<?php

namespace Modules\UserModule\Http\Requests;


class UpdateMessageRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'message' => 'required',
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
