<?php

namespace Modules\UserModule\Http\Requests;


class UpdateCheckVechileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('vechile')]);
    }
    public function rules()
    {
        return [
            'id' => 'required|exists:vechiles,id',
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
