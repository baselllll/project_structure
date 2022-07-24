<?php

namespace Modules\UserModule\Http\Requests;


class getChatRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'chat_id' => 'required|exists:messages,chat_id',
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
