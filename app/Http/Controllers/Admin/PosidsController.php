<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PosidsController extends Controller
{
    public function index() {
        $posids = DB::table('posids')->get();

        return view('admin.posids.index', compact('posids'));
    }

    public function edit($id) {
        $posid = DB::table('posids')->where('id', $id)->first();

        return view('admin.posids.edit', compact('posid'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $posid = DB::table('posids')->where('id', $id)->update(['name' => $request->name]);

        return redirect()->route('admin.posids');
    }

    public function delete(Request $request) {
        $result = ['status' => 1];
        $this->validate($request, [
            'id' => 'required'
        ]);

        $posid = DB::table('posids')->where('id', $request->id)->delete();

        if ($posid) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else{
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function create() {
        return view('admin.posids.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $posid = DB::table('posids')->insert(['name' => $request->name]);

        session()->flash('success', '删除成功');
        return redirect()->route('admin.posids.index');
    }
}
