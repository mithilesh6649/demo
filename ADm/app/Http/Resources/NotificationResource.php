<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'image' => $this->resource->notificationTemplate->notification_image,
            'title' => $this->resource->notificationTemplate->title,
            'body' => $this->resource->notificationTemplate->body,
            'notification_type' => $this->resource->notificationTemplate->slug,
            'is_read' => $this->resource->read,
            'notification_time' => $this->created_at
        ];
    }
}
