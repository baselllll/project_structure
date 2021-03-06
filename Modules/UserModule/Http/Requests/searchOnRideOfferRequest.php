<?php

namespace Modules\UserModule\Http\Requests;


class searchOnRideOfferRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'location_to' => 'sometimes',
            'location_from' => 'sometimes',
            'filter' => 'required|in:price,date_offer_ride,time_offer_ride,distance',
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
