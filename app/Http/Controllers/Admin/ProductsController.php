<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            if ($v->moduleid != 3) {
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
            'price' => 'numeric',
        ]);

        $data = [
            'catid' => $request->catid,
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'title' => $request->title,
            'xinghao' => $request->input('xinghao', ''),
            'price' => $request->input('price', ''),
            'keywords' => $request->input('keywords', ''),
            'description' => $request->input('description', ''),
            'content' => $request->input('editorValue', ''),
            'posid' => $request->input('posid'),
            'template' => $request->input('template'),
        ];

        $startAt = date('Y-m-d H:i:s', strtotime($request->start_at1.' '.$request->start_at2));
        $data['start_at'] = $startAt;

        if ($request->input('stop_at1')) {
            $stopAt = date('Y-m-d H:i:s', strtotime($request->stop_at1.' '.$request->stop_at2));
            $data['stop_at'] = $stopAt;
        }

        $pics = '';
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
                $new_file = $new_file.time().random_int(1, 999).".{$type}";
                if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                    $pathArr = explode('app/', $new_file);
                    $path = $pathArr[1];
                    if ( $pics == '' ) {
                        $pics .= $path;
                    }else {
                        $pics .= ','.$path;
                    }
                }else{
                    session()->flash('error', '添加失败');
                    return redirect()->back();
                }
            }
        }
        $data['pics'] = $pics;

        $product = Product::insert($data);

        if ($product) {
            session()->flash('success', '添加成功');
            return redirect()->route('admin.products.index');
        }else {
            session()->flash('error', '添加失败');
            return redirect()->back();
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::getList(0);
        foreach ($categories as $k => $v) {
            if ($v->moduleid != 3) {
                unset($categories[$k]);
            }
        }

        $posids = DB::table('posids')->get();

        $startAt1 = '';
        $startAt2 = '';
        $stopAt1 = '';
        $stopAt2 = '';
        if ($product->start_at) {
            $startAt = explode(' ',$product->start_at);
            $startAt1 = $startAt[0];
            $startAt2 = $startAt[1];
        }
        if ($product->stop_at) {
            $stopAt = explode(' ',$product->stop_at);
            $stopAt1 = $stopAt[0];
            $stopAt2 = $stopAt[1];
        }

        if ($product->pics) {
            $pics = explode(',',  $product->pics);
        }else {
            $pics = [];
        }

        return view('admin.products.edit', compact('product', 'posids', 'categories', 'startAt1', 'startAt2', 'stopAt1', 'stopAt2', 'pics'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required',
            'xinghao' => 'required',
            'price' => 'numeric',
        ]);

        $data = [
            'catid' => (int)$request->catid,
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'title' => $request->title,
            'xinghao' => $request->input('xinghao', ''),
            'price' => $request->input('price', ''),
            'keywords' => $request->input('keywords', ''),
            'description' => $request->input('description', ''),
            'content' => $request->input('editorValue', ''),
            'posid' => $request->input('posid'),
            'template' => $request->input('template'),
        ];

        $startAt = date('Y-m-d H:i:s', strtotime($request->start_at1.' '.$request->start_at2));
        $data['start_at'] = $startAt;

        if ($request->input('stop_at1')) {
            $stopAt = date('Y-m-d H:i:s', strtotime($request->stop_at1.' '.$request->stop_at2));
            $data['stop_at'] = $stopAt;
        }

        if(!$request->images) {
            $request->images = [];
        }
        $picsArr = explode(',', $product->pics);
        $picsRequest = [];
        foreach ($request->images as $v) {
            if (strstr($v, 'storage')) {
                $picsRequest[] = str_replace('/storage', 'public', $v);
                continue;
            }
            $picsRequest[] = $v;
        }
        $oldPics = array_intersect($picsArr, $picsRequest);
        $delPics = array_diff($picsArr, $picsRequest);
        $newPics = array_diff($picsRequest, $picsArr);

        $pics = implode(',', $oldPics);

        foreach ($newPics as $k=>$v) {
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
                $new_file = $new_file.time().random_int(1, 999).".{$type}";
                if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                    $pathArr = explode('app/', $new_file);
                    $path = $pathArr[1];
                    if ( $pics == '' ) {
                        $pics .= $path;
                    }else {
                        $pics .= ','.$path;
                    }
                }else{
                    session()->flash('error', '添加失败');
                    return redirect()->back();
                }
            }
        }

        foreach ($delPics as $v) {
            Storage::delete($v);
        }
        $data['pics'] = $pics;

        $bool = $product->update($data);

        if ($bool) {
            session()->flash('success', '修改成功');
            return redirect()->route('admin.products.index');
        }else {
            session()->flash('error', '修改失败');
            return redirect()->back();
        }
    }

    public function setListOrder(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'listorder' => 'integer'
        ]);

        $id = $request->id;
        $listorder = $request->listorder;
        $product = Product::findOrFail($id);
        $bool = $product->update(['listorder' => $listorder]);

        if ($bool) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else {
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function delete(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'id' => 'required'
        ]);

        $aproduct = DB::table('products')->where('id', $request->id)->delete();

        if ($aproduct) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else{
            $result = ['status' => 1];
        }

        return json_encode($result);
    }
}
