<?php

namespace App\Imports;

use App\Models\MenuItem;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMenu implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MenuItem([
            'item_name_en' => $row[0],
        ]);
    }
}
