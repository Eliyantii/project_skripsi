<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $cascadeDeletes = ['carts', 'headerTransactions'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'password',
    // ];
    protected $guarded = ['id']; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public static function increaseOwnerBalance($userId, $grossAmount, $applicationFee, $administrationFee) {
        $owner = User::find($userId);
        $owner->balance += $grossAmount - ($applicationFee + $administrationFee);
        $owner->save();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function headerTransactions() {
        return $this->hasMany(Transaction::class);
    }

    public function productHistory() {
        return $this->hasMany(HistoryProduct::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
