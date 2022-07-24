<?php

namespace Modules\UserModule\Http\Resources;



class ChattingResource extends BaseResource
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
            "chat_id" => $this->chat_id,
            "sender_id" => $this->whenLoaded('user_sender'),
            "receiver_id" => $this->whenLoaded('user_receiver'),
            "message" => $this->message,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
