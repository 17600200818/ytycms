<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GetMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public $menu;

    public function __construct()
    {
        $menuArr = DB::table('menu')->orderBy('listorder', 'asc')->get();
        $menuArr = json_decode(json_encode($menuArr), true);

        $menu = array();
        foreach ($menuArr as $k => $v) {
            $menu[$v['id']] = $v;
        }

        $this->menu = $menu;
    }

    public function handle($request, Closure $next)
    {
        $menu = $this->getChild(0);

        Session::put('menu', $menu);

        return $next($request);
    }

    public function getChild($parentid)
    {
        $data = [];
        foreach ($this->menu as $k => $v) {
            if ($v['parentid'] == $parentid) {
                $children = $this->getChild($v['id']);
                $v['children'] = $children;
                $data[] = $v;
            }
        }

        return $data;
    }
}
