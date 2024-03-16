<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "brand",
        "name",
        "year",
        "machine_number",
        "frame_number",
        "price",
        "image"
    ];

    public function transactionDetail() {
        return $this->hasOne(TransactionDetail::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
