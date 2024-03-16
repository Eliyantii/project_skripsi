<?php 

namespace App\Utils;

class CommonUtil
{
    public static $transactionStatus = [
        "settlement" => "Berhasil",
        "capture" => "Berhasil",
        "pending" => "Tertunda",
        "deny" => "Dibatalkan",
        "cancel" => "Dibatalkan",
        "expire" => "Dibatalkan",
        "refund" => "Dibatalkan",
        "failure" => "Dibatalkan"
    ];

    public static $withdrawStatus = [
        'UPLOADING' => 'Tertunda',
        'DELETED' => 'Gagal',
        'COMPLETED' => 'Berhasil',
        'FAILED' => 'Gagal'
    ];

    // check success or not transaction with qris or virtual account
    public static function isTransactionSuccess($snapCallbackJSON)
    {
        return $snapCallbackJSON->transaction_status == "settlement"
                && $snapCallbackJSON->fraud_status == "accept";
    }
    
    // check success or not transaction with credit card
    public static function isTransactionSuccessWithCreditCard($snapCallbackJSON)
    {
        return $snapCallbackJSON->transaction_status == "capture"
                && $snapCallbackJSON->fraud_status == "accept";
    }
}

?>