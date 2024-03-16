<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory;

    protected $guarded = ['image_id'];
    protected $primaryKey = 'image_id';

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
