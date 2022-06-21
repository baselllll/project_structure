<?php

namespace Modules\UserModule\Http\Requests;


class VechileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model' => 'required',
            'type' => 'required',
            'number' => 'required',
            'color' => 'required',
            'YearOfReg' => 'required',
            'notes' => 'required',
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
