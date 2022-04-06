<?php

namespace Modules\UserModule\Http\Resources;



class RoleResource extends BaseResource
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
            "email" => $this->guard_name,
            "model_type" => $this->pivot->model_type,
        ];
    }
}
