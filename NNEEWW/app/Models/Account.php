<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'account_id', 
        'label',
        'routingNumber', 
        'accountNumber',
        'status', 
        'type',
        'programId', 
        'isVerified',
        'verifiedAt', 
        'acceptedTerms',
        'interest', 
        'fees',
        'currency',
        'businessId', 
        'full_response',
        'availableBalance',
        'sponsorBankName',
        'createdAt', 
        'modifiedAt',
        'pendingDebit',
        'pendingCredit', 
        'createdPersonId',
        'accountInterestFrequency',
        'metadata',
        'config', 
    ];

    protected $hidden = [
        'full_response',
    ];

  
    public function business()
    {
        return $this->belongsTo(Business::class ,'businessId' ,'business_id' );
    }

    public function person()
    {
        return $this->belongsTo(Person::class ,'createdPersonId' ,'person_id' );
    }

    public function crypto_response(){
        return $this->hasMany(CryptoResponse::class,'accountId', 'account_id');
    } 
    
    public function send_transactions(){
        return $this->hasMany(MoneyTransfer::class,'accountId', 'account_id');
    }
    
    public function receive_transactions(){
        return $this->hasMany(MoneyTransfer::class,'accountNumber', 'accountNumber');
    }
}
