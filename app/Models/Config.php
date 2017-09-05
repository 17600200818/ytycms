<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    static function getAllConfig() {
        $configs = self::all();

        $result = [];
        foreach ($configs as $v) {
            $result[$v['varname']] = $v['value'];
        }

        return $result;
    }
}
