<?php

namespace Modules\UserModule\Http\Requests;


class searchOnRideOfferRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'location_to' => 'sometimes',
            'location_from' => 'sometimes',
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
