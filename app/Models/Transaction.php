<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class);
    }

    function getFormatedTransactionDate() {
        return Carbon::parse($this->transaction_date)->locale('id')->translatedFormat('l, j F Y');
    }

    function getFormatedTransactionDateWithTime() {
        return Carbon::parse($this->transaction_date)->locale('id')->translatedFormat('l, j F Y h:i');
    }
}
