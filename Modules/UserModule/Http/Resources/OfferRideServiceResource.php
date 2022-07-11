<?php

namespace Modules\UserModule\Http\Resources;



class OfferRideServiceResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user" => $this->whenLoaded('user'),
            "vechile" => $this->whenLoaded('vechile'),
            "location_from" => $this->location_from,
            "location_to" => $this->location_to,
            "WhenToGo" => $this->WhenToGo,
            "offering_seats" => $this->offering_seats,
            "Max_Speed" => $this->Max_Speed,
            "occupied_Seat" => $this->occupied_Seat,
            "needs_desciption" => $this->needs_desciption,
            "Accept_Offer" => $this->Accept_Offer,
            "date_offer_ride" => $this->date_offer_ride,
            "time_offer_ride" => $this->time_offer_ride,
            "In_Between_Date" => $this->In_Between_Date,
            "distance" => $this->distance,
        ];
    }
}
