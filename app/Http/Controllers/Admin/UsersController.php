<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $role = Role::findOrFail($request->groupid);
        $platform = $role->platform;

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'groupid' => $request->groupid,
            'platform' => $platform
        ]);

        session()->flash('success', '创建成功');
        return redirect()->route('admin.users.create');
    }
}
