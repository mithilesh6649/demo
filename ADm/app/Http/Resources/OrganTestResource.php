<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganTestResource extends JsonResource
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
            'report_id' => $this->resource->report_id,
            'name' => $this->resource->name,
            'document_url' => $this->resource->document_url,
            'document_uploaded_at' => $this->resource->document_uploaded_at,
        ];
    }
}
