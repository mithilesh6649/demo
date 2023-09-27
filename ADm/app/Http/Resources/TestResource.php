<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $laboratory = [];

        if ($this->resource->relationLoaded('laboratories')) {

            foreach ($this->resource->laboratories as $key => $labs) {

                if ($labs->lab !== null && $labs->lab->metadata !== null) {

                    $laboratory[$key]['lab_id'] = $labs->lab->id;
                    $laboratory[$key]['lab_name'] = $labs->lab->lab_name;
                    $laboratory[$key]['lab_description'] = $labs->lab->description;
                    $laboratory[$key]['lab_charges'] = ($labs->lab->metadata) ? $labs->lab->metadata->charges : null;
                    $laboratory[$key]['lab_city'] = ($labs->lab->metadata) ? $labs->lab->metadata->city : null;
                    $laboratory[$key]['lab_state'] = ($labs->lab->metadata) ? $labs->lab->metadata->state : null;
                    $laboratory[$key]['lab_open_time'] = ($labs->lab->metadata) ? $labs->lab->metadata->open_time : null;
                    $laboratory[$key]['lab_close_time'] = ($labs->lab->metadata) ? $labs->lab->metadata->close_time : null;

                    $startDate = now()->createFromFormat('H:i', $labs->lab->metadata->open_time);
                    $endDate = now()->createFromFormat('H:i', $labs->lab->metadata->close_time);

                    $laboratory[$key]['lab_open'] = now()->between($startDate, $endDate, true);
                }
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'charges' => $this->amount,
            'test_type' => $this->type,
            'image' => $this->image,
            'laboratory' => $laboratory,
            'document_url' => $this->document_url ?? null,
            'additional_information'=>$this->add_info,
        ];
    }
}
