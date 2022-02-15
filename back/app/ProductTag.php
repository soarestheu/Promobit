<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    //

    protected $table = 'product_tag';
    
    public $fillable = [
        'product_id',
        'tag_id',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
