<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    public function index($id) {
        $types = Type::getChilds($id);

        return view('admin.types.index', compact('types'));
    }
}
