<?php

namespace Modules\UserModule\Http\Requests;


class OfferRideRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function prepareForValidation()
    {

    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'vechile_id' => 'required|exists:vechiles,id',
            'location_from' => 'required',
            'location_to' => 'required',
            'WhenToGo' => 'required',
            'offering_seats' => 'required',
            'Max_Speed' => 'required',
            'needs_desciption' => 'required',
            'Accept_Offer' => 'required',
            'date_offer_ride' => 'sometimes|date',
            'time_offer_rde' => 'sometimes|date_format:H:i',
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
