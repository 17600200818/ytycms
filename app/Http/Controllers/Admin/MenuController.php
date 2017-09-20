<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function getMenus() {
        $menu = Session::get('menu');

        $menus = array();
        foreach ($menu as $k => $v) {
            $menus[] = $v;
            if (!empty($v['children'])) {
                foreach ($v['children'] as $kk => $vv) {
                    $vv['name'] = '——'.$vv['name'];
                    $menus[] = $vv;
                }
            }
        }

        return $menus;
    }

    public function index()
    {
        $menus = $this->getMenus();

        return view('admin.menu.index', compact('menus'));
    }

    public function setListOrder(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'listorder' => 'integer'
        ]);

        $id = $request->id;
        $listorder = $request->listorder;

        $menu = DB::table('menu')->where('id', $id)->update(['listorder' => $listorder]);
        if ($menu) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else {
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function create($parentid)
    {
        $menus = $this->getMenus();

        return view('admin.menu.create', compact('parentid', 'menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        DB::table('menu')->insert([
            'parentid' => $request->parentid,
            'name' => $request->name,
            'icon' => $request->icon ?: 'entypo-gauge',
            'route' => $request->route ?: '',
            'data' => $request->data ?: '',
            'remark' => $request->remark ?: '',
            'status' => $request->status,
            'type' => $request->type,
        ]);

        Session::flash('success', '添加菜单成功');
        return redirect()->route('admin.menu.index');
    }

    public function delete(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'id' => 'required'
        ]);

        $menuid = DB::table('menu')->where('id', $request->id)->delete();

        if ($menuid) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else{
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function edit($id)
    {
        $menu = DB::table('menu')->where('id', $id)->first();
        $menus = $this->getMenus();

        return view('admin.menu.edit', compact('menu', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        DB::table('menu')->where('id', $id)->update([
            'parentid' => $request->parentid,
            'name' => $request->name,
            'icon' => $request->icon ?: 'entypo-gauge',
            'route' => $request->route ?: '',
            'data' => $request->data ?: '',
            'remark' => $request->remark ?: '',
            'status' => $request->status,
            'type' => $request->type,
        ]);

        Session::flash('success', '修改菜单成功');
        return redirect()->route('admin.menu.index');
    }
}
