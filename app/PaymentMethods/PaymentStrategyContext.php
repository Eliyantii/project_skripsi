<?php 

namespace App\PaymentMethods;

class PaymentStrategyContext 
{
    private PaymentMethod $strategy;

    function __construct($paymentMethod)
    {
        $this->strategy = match ($paymentMethod){
            'credit_card' => new CreditCardStrategy(),
            'bank_transfer' => new BankTransferStrategy(),
            default => throw new \InvalidArgumentException('Your payment method is: '. $paymentMethod . 
                        '. You must pass in either qris, credit card, or virtual account')
        };
    }

    function saveTransactionToDB($transactionHeader, $snapCallbackJSON)
    {
        return $this->strategy->saveTransactionToDB($transactionHeader, $snapCallbackJSON);
    }

    function isTransactionSuccess($snapCallbackJSON)
    {
        return $this->strategy->isTransactionSuccess($snapCallbackJSON);
    }
}


?>