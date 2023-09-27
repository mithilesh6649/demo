<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\GroupChat;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $groupChat = new GroupChat();

        return [
            'ticket_id' => $this->resource->id,
            'ticket_unique_id' => $this->resource->unique_ticket_id,
            'ticket_category' => $this->resource->category,
            'ticket_type' => $this->resource->ticket_type,
            'ticket_created_at' => $this->resource->created_at,
            'messages' => $this->resource->relationLoaded('ticketmessages') ? MessageResource::collection($this->ticketmessages->messages) : [],
        ];
    }
}
