<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function create($catid)
    {
        $posids = DB::table('posids')->get();
        return view('admin.articles.create', compact('catid', 'posids'));
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
