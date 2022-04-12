<?php

namespace Modules\UserModule\Http\Requests;


class RegisterUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "ar_name"=>"required",
            "en_name"=>"required",
            "email"=>"required|unique:users",
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role_name' => 'required|exists:roles,name',
            'image' => 'required',
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
