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
            'first_name'=>'required',
            'last_name'=>'required',
            "email"=>"required|unique:users",
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'image' => 'required',
            'location'=>'required',
            'profile_type'=>'required|in:user,driver',
            'phone_number'=>'required|string',
            'Id_Front'=>'required',
            'Id_Back'=>'required',
            'work_company'=>'required',
            'company_offer_letter'=>'required',
            'address'=>'required',
            'gender'=>'required|in:male,female',
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
