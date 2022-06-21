<?php

namespace Modules\UserModule\Http\Resources;



class VechileResource extends BaseResource
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
            "model" => $this->model,
            "type" => $this->type,
            "number" => $this->number,
            "color" => $this->color,
            "YearOfReg" => $this->YearOfReg,
            "notes" => $this->notes,
            'profile_image_url' => optional(optional($this->getMedia('profile_image'))->first())->getFullUrl(),

        ];
    }
}
