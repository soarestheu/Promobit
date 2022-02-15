<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";

    public $fillable = [
        'name'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
