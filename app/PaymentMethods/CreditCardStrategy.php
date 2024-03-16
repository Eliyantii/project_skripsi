<?php

namespace App\PaymentMethods;

use App\Utils\CommonUtil;

class CreditCardStrategy implements PaymentMethod
{
    function saveTransactionToDB($transaction, $snapCallbackJSON)
    {
        $transaction->fraud_status = $snapCallbackJSON->fraud_status;
        $transaction->bank = $snapCallbackJSON->bank;
        $transaction->masked_card = $snapCallbackJSON->masked_card;
        $transaction->card_type = $snapCallbackJSON->card_type;

        $transaction->save();
        return $transaction;
    }

    function isTransactionSuccess($snapCallbackJSON)
    {
        return CommonUtil::isTransactionSuccessWithCreditCard($snapCallbackJSON);
    }
}