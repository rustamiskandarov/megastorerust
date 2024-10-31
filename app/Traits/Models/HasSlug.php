<?php

declare(strict_types=1);

namespace App\Traits\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->slug = $model->slug ?? (str($model->title)->slug()).'-'.$model->price;
        });
    }
}
