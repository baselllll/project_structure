<?php

namespace Modules\UserModule\Http\Resources;



class UserResource extends BaseResource
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
            "name" => $this->name,
            "email" => $this->email,
            "profile_type" => $this->profile_type,
            "phone_number" => $this->phone_number,
            "gender" => $this->gender,
            "address" => $this->address,
            "city" => $this->location,
            "work_company" => $this->work_company,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            'profile_image_url' => optional(optional($this->getMedia('profile_image'))->first())->getFullUrl(),
            'Id_Front' => optional(optional($this->getMedia('Id_Front'))->first())->getFullUrl(),
            'Id_Back' => optional(optional($this->getMedia('Id_Back'))->first())->getFullUrl(),
            'company_offer_letter' => optional(optional($this->getMedia('company_offer_letter'))->first())->getFullUrl(),
        ];
    }
}
