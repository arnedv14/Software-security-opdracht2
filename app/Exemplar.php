<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Exemplar extends Model
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->GUID = (string) Uuid::generate(4);
        });
    }

    protected $fillable = [
        'GUID','itemID','is_loaned','remarks'
    ];
}
