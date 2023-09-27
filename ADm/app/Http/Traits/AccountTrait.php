<?php

namespace App\Http\Traits;

trait AccountTrait {

    public function getMessage($statusType)
    {
        switch ($statusType) {

            case 'account_deleted':
                $message = "Your account is deleted, please contact Support";
                break;

            case 'account_status':
                $message = "Your account is inactive, please contact Support";
                break;

            default:
                $message = "Your account in temporary locked";
                break;
        }

        return $message;
    }
}
