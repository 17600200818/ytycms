<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfigsController extends Controller
{
    public function index()
    {
        $configs = Config::getAllConfig();
//        $configs = $configs;
//dd($configs);
        return view('admin/configs/index', compact('configs'));
    }

    public function setConfig(Request $request) {
        $result = ['status' => 1];

        $this->validate($request,[
            'varname' => 'required'
        ]);
        $config = DB::table('configs')->where('varname', $request->varname)->update(['value' => $request->value]);
        if ($config) {
            $result = ['status' => 0];
        }else {
            $result = ['status' => 1, 'msg' => '更新失败'];
        }

        return json_encode($result);
    }
}
