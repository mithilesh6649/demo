<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdaValue extends Model
{
    use HasFactory;

    protected $fillable = [
      'category',
      'particulars',
      'energy_ear',
      'protein_ear',
      'protein_rda',
      'dietary_fibre',
      'calcium_ear',
      'calcium_rda',
      'calcium_tul',
      'magnesium_ear',
      'magnesium_rda',
      'magnesium_tul',
      'iron_ear',
      'iron_rda',
      'iron_tul',
      'zinc_ear',
      'zinc_rda',
      'zinc_tul',
      'iodine_ear',
      'iodine_rda',
      'iodine_tul',
      'thiamine_ear',
      'thiamine_rda',
      'riboflavin_ear',
      'riboflavin_rda',
      'niacin_ear',
      'niacin_rda',
      'niacin_tul',
      'vitamin_b_6_ear',
      'vitamin_b_6_rda',
      'vitamin_b_6_tul',
      'folate_ear',
      'folate_rda',
      'folate_tul',
      'vitamin_b_12_ear',
      'vitamin_b_12_rda',
      'vitamin_c_ear',
      'vitamin_c_rda',
      'vitamin_c_tul',
      'vitamin_a_ear',
      'vitamin_a_rda',
      'vitamin_a_tul',
      'vitamin_d_ear',
      'vitamin_d_rda',
      'vitamin_d_tul',
      'selenuim',

  ];
}
