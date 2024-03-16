<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = [
        'cart_id',
        'product_id',
        'name',
        'address',
        'phone',
        'guarantor_phone',
        'work',
        'income',
        'unit',
        'date_taken',
        'user_card',
        'user_family_card'
    ];

    function getFormatedDateTaken() {
        return Carbon::parse($this->date_taken)->translatedFormat('l, j F Y');
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
