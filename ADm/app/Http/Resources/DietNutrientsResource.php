<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DietNutrientsResource extends JsonResource
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
            'polyunsaturated_fat' => ($this->quantity == null) ? $this->polyunsaturated_fat :  round($this->polyunsaturated_fat * $this->quantity, 3),
            'monounsaturated_fat' => ($this->quantity == null) ? $this->monounsaturated_fat :  round($this->monounsaturated_fat * $this->quantity, 3),
            'total_carbohydrate' => ($this->quantity == null) ? $this->total_carbohydrate :  round($this->total_carbohydrate * $this->quantity, 3),
            'saturated_fat' => ($this->quantity == null) ? $this->saturated_fat :  round($this->saturated_fat * $this->quantity, 3),
            'vitamin_b_12' => ($this->quantity == null) ? $this->vitamin_b_12 :  round($this->vitamin_b_12 * $this->quantity, 3),
            'vitamin_b_6' => ($this->quantity == null) ? $this->vitamin_b_6 :  round($this->vitamin_b_6 * $this->quantity, 3),
            'cholesterol' => ($this->quantity == null) ? $this->cholesterol :  round($this->cholesterol * $this->quantity, 3),
            'added_sugar' => ($this->quantity == null) ? $this->added_sugar :  round($this->added_sugar * $this->quantity, 3),
            'total_fat' => ($this->quantity == null) ? $this->total_fat :  round($this->total_fat * $this->quantity, 3),
            'trans_fat' => ($this->quantity == null) ? $this->trans_fat :  round($this->trans_fat * $this->quantity, 3),
            'potassium' => ($this->quantity == null) ? $this->potassium :  round($this->potassium * $this->quantity, 3),
            'vitamin_a' => ($this->quantity == null) ? $this->vitamin_a :  round($this->vitamin_a * $this->quantity, 3),
            'vitamin_c' => ($this->quantity == null) ? $this->vitamin_c :  round($this->vitamin_c * $this->quantity, 3),
            'vitamin_d' => ($this->quantity == null) ? $this->vitamin_d :  round($this->vitamin_d * $this->quantity, 3),
            'calories' => ($this->quantity == null) ? $this->calories :  round($this->calories * $this->quantity, 3),
            'protein' => ($this->quantity == null) ? $this->protein :  round($this->protein * $this->quantity, 3),
            'calcium' => ($this->quantity == null) ? $this->calcium :  round($this->calcium * $this->quantity, 3),
            'sodium' => ($this->quantity == null) ? $this->sodium :  round($this->sodium * $this->quantity, 3),
            'sugar' => ($this->quantity == null) ? $this->sugar :  round($this->sugar * $this->quantity, 3),
            'iron' => ($this->quantity == null) ? $this->iron :  round($this->iron * $this->quantity, 3),
        ];
    }

    public function foodQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
}
