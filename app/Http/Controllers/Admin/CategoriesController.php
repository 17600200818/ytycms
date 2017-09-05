<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::getList(0);

        return view('admin.categories.index', compact('categories'));
    }

    public function create($parentid)
    {
        $categories = Category::getList(0);
        $modules = Module::get();

        return view('admin.categories.create', compact('categories', 'parentid', 'modules'));
    }


    public function setListOrder(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'listorder' => 'integer'
        ]);

        $id = $request->id;
        $listorder = $request->listorder;

        $category = DB::table('categories')->where('id', $id)->update(['listorder' => $listorder]);
        if ($category) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else {
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'catname' => 'required',
        ]);

        $readgroup = '';
        if (!empty($request->readgroup)) {
            $readgroup = implode(',', $request->readgroup);
        }

        $postgroup = '';
        if (!empty($request->postgroup)) {
            $postgroup = implode(',', $request->postgroup);
        }

        $module = Module::where('id',  $request->moduleid)->first();
        $moduleName = $module->name;

        DB::table('categories')->insert([
            'moduleid' => $request->moduleid,
            'module' => $moduleName,
            'parentid' => $request->parentid,
            'catname' => $request->catname,
            'catdir' => $request->catdir ?: '',
            'ismenu' => $request->ismenu,
            'title' => $request->title ?: '',
            'keywords' => $request->keywords ?: '',
            'description' => $request->description ?: '',
            'readgroup' => $readgroup,
            'postgroup' => $postgroup
        ]);

        Session::flash('success', '添加成功');
        return redirect()->route('admin.categories.index');
    }

    public function delete(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'id' => 'required'
        ]);

        $category = DB::table('categories')->where('id', $request->id)->delete();

        if ($category) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else{
            $result = ['status' => 1];
        }

        return json_encode($result);
    }
}
