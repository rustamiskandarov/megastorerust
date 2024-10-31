<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'id',
        'slug',
        'title',
        'thumbnail'
    ];

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function (Brand $brand) {
//            $brand->slug = $brand->slug ?? str($brand->title)->slug();
//        });
//    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
