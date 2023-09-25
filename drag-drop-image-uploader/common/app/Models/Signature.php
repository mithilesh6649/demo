<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const DAILY_PETTY_REPORT = 'daily_petty_report';
    public const DAILY_SALE_REPORT = 'daily_sale_report';
    public const MAINTENANCE_REPORT = 'maintenance_report';

    public const RECEIVER = 'receiver';
    public const VERIFIED_BY = 'verified_by';
    public const APPROVED_BY = 'approved_by';
    public const REPORT = 'report';

    public function addSignature($request, $parent_id, $parent_type)
    {

        if ($request->get('receiver') != '' && $request->get('receiver') != null) {
            Self::saveSignature($request->get('receiver'), Self::RECEIVER, $parent_id, $parent_type);
        }
        if ($request->get('verified_by') != '' && $request->get('verified_by') != null) {
            Self::saveSignature($request->get('verified_by'), Self::VERIFIED_BY, $parent_id, $parent_type);
        }
        if ($request->get('approved_by') != '' && $request->get('approved_by') != null) {
            Self::saveSignature($request->get('approved_by'), Self::APPROVED_BY, $parent_id, $parent_type);
        }
    }

    public function saveSignature($file, $type, $parent_id, $parent_type)
    {

        //$folderPath = public_path('signatures/');
        $folderPath = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . '.' . $image_type;
        $file = $folderPath . $file_name;
        file_put_contents($file, $image_base64);

        Signature::create([
            'branch_id' => \Session::get('branch_id'),
            'signature' => $file_name,
            'parent_id' => $parent_id,
            'parent_type' => $parent_type,
            'signature_type' => $type,
        ]);
    }

    public function reportSignature($request, $report_type)
    {
        if ($request->get('verified_by') != '' && $request->get('verified_by') != null) {
            Self::addReportSignature($request->get('verified_by'), $report_type, Self::VERIFIED_BY, $request);
        }
        if ($request->get('approved_by') != '' && $request->get('approved_by') != null) {
            Self::addReportSignature($request->get('approved_by'), $report_type, Self::APPROVED_BY, $request);
        }
    }

    public function addReportSignature($file, $report_type, $signature_type, $request)
    {

        $folderPath = public_path('signatures/');

        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . '.' . $image_type;
        $file = $folderPath . $file_name;
        file_put_contents($file, $image_base64);

        Signature::create([
            'branch_id' => \Session::get('branch_id'),
            'signature' => $file_name,
            'parent_type' => $report_type,
            'signature_type' => $signature_type,
            'report_date' => $request->report_date,
        ]);
    }

    public function getVerifiedSignatureByDate($report_date, $type)
    {

        $base_path = url('/') . '/signatures/';
        $signature = Signature::where([
            'branch_id' => \Session::get('branch_id'),
            'parent_type' => $type,
            'signature_type' => Self::VERIFIED_BY,
            'report_date' => $report_date,
        ])->whereNotNull('report_date')->first();

        if ($signature) {
            return $base_path . '/' . $signature['signature'];
        } else {
            return null;
        }
    }

    public function getApprovedSignatureByDate($report_date, $type)
    {

        $base_path = url('/') . '/signatures/';
        $signature = Signature::where([
            'branch_id' => \Session::get('branch_id'),
            'parent_type' => $type,
            'signature_type' => Self::APPROVED_BY,
            'report_date' => $report_date,
        ])->whereNotNull('report_date')->first();

        if ($signature) {
            return $base_path . '/' . $signature['signature'];
        } else {
            return null;
        }
    }

    public function updateSignatures()
    {
        $signatures = Signature::all();
        foreach ($signatures as $signature) {
            if ($signature->parent_type == Self::DAILY_PETTY_REPORT) {
                $expense = DailyPettyExpense::find($signature->parent_id);
            } elseif ($signature->parent_type == Self::DAILY_SALE_REPORT) {
                $expense = DailySaleReport::find($signature->parent_id);
            } elseif ($signature->parent_type == Self::MAINTENANCE_REPORT) {
                $expense = MaintenanceReport::find($signature->parent_id);
            }
            if ($expense) {
                $signature->update(['branch_id' => $expense->branch_id]);
            }
        }
    }
}
