<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    protected $table = 'page_meta';

    protected $fillable = [
        'page_key',
        'meta_title',
        'meta_description',
    ];
}
