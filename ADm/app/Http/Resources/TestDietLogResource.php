<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestDietLogResource extends JsonResource
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
            'body_fat_percentage' => (string) $this->body_fat_percentage,
            'fasting_blood_sugar' => (string) $this->fasting_blood_sugar,
            'random_blood_sugar' => (string) $this->random_blood_sugar,
            'serum_creatinine' => (string) $this->serum_creatinine,
            'triglycerides' => (string) $this->triglycerides,
            'haemoglobin' => (string) $this->haemoglobin,
            'cholesterol' => (string) $this->cholesterol,
            'phosphorous' => (string) $this->phosphorous,
            'body_fat' => (string) $this->body_fat,
            'albumin' => (string) $this->albumin,
            'calcium' => (string) $this->calcium,
            'hba1c' => (string) $this->hba1c,
            'bmi' => (string) $this->bmi,
            'hdl' => (string) $this->hdl,
            'ldl' => (string) $this->ldl,
        ];
    }
}
