<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WaterReminderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource->cron_time != null) {

            switch ($this->resource->reminder_type) {

                case 'once':
                    $time = $this->resource->cron_time->format('H:i');
                    break;

                case 'repetition':
                    $time = $this->resource->actual_repetition_count;
                    break;

                case 'interval':
                    $time = $this->resource->interval_time;
                    break;

            }
        }

        return [
            'notification' => $this->resource->status,
            'start_time' => $this->resource->start_time->format('H:i'),
            'end_time' => $this->resource->end_time->format('H:i'),
            'reminder_type' => $this->resource->reminder_type,
            'time_interval_or_repetition' => (isset($time)) ? $time : null
        ];
    }
}
