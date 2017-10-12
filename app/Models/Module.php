<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['status', 'title', 'name', 'listfields', 'issearch', 'issystem', 'postgroup', 'description'];
}
