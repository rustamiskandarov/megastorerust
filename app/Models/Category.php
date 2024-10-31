<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'id',
        'slug',
        'title',
    ];

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function (Category $category) {
//            $category->slug = $category->slug ?? str($category->title)->slug();
//        });
//    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
