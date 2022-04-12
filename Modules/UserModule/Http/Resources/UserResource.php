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
            "name" => $this->getTranslations('name'),
            "email" => $this->email,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "role" => RoleResource::collection($this->whenLoaded('roles')),
            'profile_image_url' => optional(optional($this->getMedia('profile_image'))->first())->getFullUrl(),
        ];
    }
}
