<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'catid', 'title', 'keywords', 'description', 'thumb', 'content', 'start_at', 'stop_at', 'copyfrom', 'fromlink', 'readgroup', 'posid', 'template', 'listorder'
    ];
}
