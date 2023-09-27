<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MultipleTestLaboratoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $counter = 1;
        $labIds = [];
        foreach ($this->resource as $key => $item) {

            $counter++;
            foreach ($item->laboratories as $k => $lab) {
                $counter++;

                if ($lab->lab != null) {

                    if (!in_array($lab->lab->id, $labIds)) {
    
                        $labIds[] = $lab->lab->id;
    
                        $laboratories[$counter]['lab_id'] = $lab->lab->id;
                        $laboratories[$counter]['lab_name'] = $lab->lab->lab_name;
                        $laboratories[$counter]['lab_description'] = $lab->lab->description;
                        $laboratories[$counter]['lab_charges'] = ($lab->lab->metadata) ? $lab->lab->metadata->charges : null;
                        $laboratories[$counter]['lab_city'] = ($lab->lab->metadata) ? $lab->lab->metadata->city : null;
                        $laboratories[$counter]['lab_state'] = ($lab->lab->metadata) ? $lab->lab->metadata->state : null;
                        $laboratories[$counter]['lab_open_time'] = ($lab->lab->metadata) ? $lab->lab->metadata->open_time : null;
                        $laboratories[$counter]['lab_close_time'] = ($lab->lab->metadata) ? $lab->lab->metadata->close_time : null;
    
                        $startDate = now()->createFromFormat('H:i', $lab->lab->metadata->open_time);
                        $endDate = now()->createFromFormat('H:i', $lab->lab->metadata->close_time);
    
                        $laboratories[$counter]['lab_open'] = now()->between($startDate, $endDate, true);
                    }
                }
            }
        }

        return [
            'laboratories' => (isset($laboratories)) ? $laboratories : [],
        ];
    }
}
