<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.products.index', compact('products'));
    }

    public function create($catid)
    {
        $posids = DB::table('posids')->get();
        $today = date('Y-m-d');
        $categories = Category::getList(0);
        foreach ($categories as $k => $v) {
            if ($v->moduleid != 2) {
                unset($categories[$k]);
            }
        }

        return view('admin.products.create', compact('catid', 'posids', 'today', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'xinghao' => 'required',
            'price' => 'int',
        ]);

        61f20acdcf42e7f7fb4c11c7b78f1c27.jpg

    /qiye/Uploads/201709/59c22a83b5c43.jpg|61f20acdcf42e7f7fb4c11c7b78f1c27.jpg:::/qiye/Uploads/201709/59c22a8522926.jpg|61f20acdcf42e7f7fb4c11c7b78f1c27.jpg










        foreach ($request->images as $k=>$v) {
            $fileName = storage_path().'/app/public/images/products/';

            $base64_image_content = $v;
//匹配出图片的格式
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
                $type = $result[2];
                $new_file = $fileName;
                if(!file_exists($new_file))
                {
                    mkdir($new_file, 0700);
                }
                $new_file = $new_file.time().".{$type}";
                if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                    $pathArr = explode('app/', $new_file);
                    $path = $pathArr[1];
                    dd($path);
                }else{
                    echo '新文件保存失败';
                }
            }
        }
    }
}
