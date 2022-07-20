<?php

namespace Modules\UserModule\Http\Requests;


class UpdateStatusRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'status'=>"required|in:Cancelled,Requested,Accepted,Pending",
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
