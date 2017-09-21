<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['catid', 'userid', 'username', 'title', 'xinghao', 'price', 'keywords', 'description', 'content', 'posid', 'template', 'start_at', 'stop_at', 'pics', 'listorder'];
}
