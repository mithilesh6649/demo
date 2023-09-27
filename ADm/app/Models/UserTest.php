<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_transaction_id', 'test_id', 'test_done', 'expired_on'];

    public function setUserTest($paymentTxn)
    {
        for ($i = 0; $i < count(request()->test_id); $i++) {

            UserTest::updateOrCreate([
                'user_id' => auth()->id(),
                'payment_transaction_id' => $paymentTxn,
                'test_id' => request()->test_id[$i],
            ],[
                'test_done' => 0
            ]);
        }
    }

    protected static function boot()
    {
        parent::boot();

        UserTest::observe(new \App\Observers\UserTestObserver);
    }
}
