<?php

namespace App\Exports;

use App\Models\BranchLocality;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BranchExport implements FromCollection,WithHeadings
{
    public $id;
   public function __construct($branch_id)
   { 
         $this->id=$branch_id;
   }
    public function headings():array{
        return[
              'city Name',
              'Branch Name',
              'Delivery Fee',
              'Minimum Order Amount',
              'Delivery Time',
              'created date' 
        ];
    } 
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $data=BranchLocality::with('branch:id,title_en','city:id,city')->where('branch_id',$this->id)->get();

         $ex=[];
         foreach($data as $d)
         {
            $ex[]=['city'=>$d->city->city,'branch'=>$d->branch->title_en,'delivery_fee'=>$d->delivery_fee,'minimum_order_amount'=>$d->minimum_order_amount,'delivery_time'=>$d->delivery_time,'created_at'=>date('d/m/Y',strtotime($d->created_at))];

         }
         return collect($ex);
      
    }
}
