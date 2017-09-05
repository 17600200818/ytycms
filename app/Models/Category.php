<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    static function getList($parentid, $i = '')
    {
        $categoriesArr = self::where('parentid', $parentid)->orderBy('listorder')->get();
        $categories = [];

        foreach ($categoriesArr as $v) {

            $v['catname'] = $i.$v['catname'];
            $categories[] = $v;

            $pid = $v['id'];
            $children = self::getList($pid, '——'.$i);
            $categories = array_merge($categories, $children);
        }

        return $categories;
    }
}
