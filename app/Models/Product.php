<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['imageUser', 'user', 'cartDetails'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('brand', 'like', '%'. $search .'%')
                         ->orWhere('name', 'like', '%'. $search .'%')
                         ->orWhere('cc', 'like', '%'. $search .'%');
        });
    }

    public static function decreaseProductStock($productId, $unit) {
        $product = Product::where('id', $productId)->first();
        $product->stock -= $unit;
        $product->save();
    }

    public static function getProductStock($productId)
    {
        $product = self::find($productId);

        // Cek jika produk ada
        if ($product) {
            return $product->stock;
        }
        return null;
    }

    public static function deleteProduct($productId)
    {
        $product = self::find($productId);

        if ($product) {
            $product->delete();

            return true;
        }

        return false;
    }

    public function imageUser()
    {
        return $this->hasOne(Image::class);
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartDetails() {
        return $this->hasMany(CartDetail::class);
    }

    public function cashTempos() {
        return $this->hasMany(CashTempo::class);
    }

    public function historyPurchase() {
        return $this->hasMany(HistoryProduct::class);
    }

    function getFormatedTransactionDateWithTime() {
        return Carbon::parse($this->transaction_date)->locale('id')->translatedFormat('l, j F Y h:i');
    }
}
