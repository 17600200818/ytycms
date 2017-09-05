<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    static function getChilds($id) {
        $types = self::where('parentid', $id)->get();

        return $types;
    }
}
