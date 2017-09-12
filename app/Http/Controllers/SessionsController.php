<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            session()->flash('success', '欢迎回来');
            $groupid = Auth::user()->groupid;
            if (in_array($groupid, [1,2])) {
                return redirect()->route('admin.users.create');
            }else{
                return redirect()->route('index');
            }

        }else{
            session()->flash('error', '登录失败');
            return redirect()->back();
        }
    }
}
