<?php

namespace Modules\UserModule\Http\Requests;


class ChattingRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'chat_id' => 'required|exists:chattings,id',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
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
