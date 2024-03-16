<?php

namespace App\PaymentMethods;

use App\Utils\CommonUtil;

class BankTransferStrategy implements PaymentMethod
{
    function saveTransactionToDB($transaction, $snapCallbackJSON)
    {
        if (isset($snapCallbackJSON->permata_va_number)) {
            $vaNumber = $snapCallbackJSON->permata_va_number;
            $bank = 'Permata';
        } else {
            $vaNumber = $snapCallbackJSON->va_numbers[0]->va_number;
            $bank = $snapCallbackJSON->va_numbers[0]->bank;
        }

        $transaction->fraud_status = $snapCallbackJSON->fraud_status;
        $transaction->va_number = $vaNumber;
        $transaction->bank = $bank;

        $transaction->save();
        return $transaction;
    }

    function isTransactionSuccess($snapCallbackJSON)
    {
        return CommonUtil::isTransactionSuccess($snapCallbackJSON);
    }
}
