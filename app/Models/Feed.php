<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'feed_id',
        'property_id',
        'language',
        'title',
        'content',
        'image',
        'link',
        'created_at',
        'updated_at'
    ];
}
