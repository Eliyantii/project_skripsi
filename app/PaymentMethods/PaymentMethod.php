<?php 

namespace App\PaymentMethods;

interface PaymentMethod
{
    /**
     * save callback object to transaction db
     */
    function saveTransactionToDB($transactionHeader, $snapCallbackJSON);

    /**
     * is transaction success or not
     */
    function isTransactionSuccess($snapCallbackJSON);
}

?>