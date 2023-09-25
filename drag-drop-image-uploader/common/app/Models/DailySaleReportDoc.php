<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySaleReportDoc extends Model
{
    use HasFactory;
      protected $table = 'daily_sales_report_doc';
    protected $fillable = ['branch_id','user_id','daily_sales_report_id','invoice_domain' , 'doc'];
}
