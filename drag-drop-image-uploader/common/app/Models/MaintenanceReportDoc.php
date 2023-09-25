<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceReportDoc extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "maintenance_reports_doc";

    protected $guarded = [];

    public function maintenance()
    {
        return $this->belongsTo(MaintenanceReport::class, 'maintenance_report_id', 'id');
    }

    public static function checkmaintenanceattachment($maintenance_id)
    {

        $attachment = MaintenanceReportDoc::where(['maintenance_report_id' => $maintenance_id, 'deleted_at' => null])->first();

        if ($attachment) {
            return "Yes";
        } else {
            return "No";
        }

    }

}
