<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::get();
        return view('admin.articles.index', compact('articles'));
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

        return view('admin.articles.create', compact('catid', 'posids', 'today', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'editorValue' => 'required',
        ]);

        $data = [
            'catid' => $request->catid,
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'title' => $request->title,
            'keywords' => $request->input('keywords', ''),
            'description' => $request->input('description', ''),
            'content' => $request->input('editorValue', ''),
            'copyfrom' => $request->input('copyfrom', ''),
            'fromlink' => $request->input('fromlink', ''),
            'posid' => $request->input('posid'),
            'template' => $request->input('template'),
        ];

        if ($request->readgroup) {
            $data['readgroup'] = implode(',', $request->readgroup);
        }
        if ($request->hasFile('thumb') && $request->file('thumb')->isValid()) {
            $thumb = $request->thumb->store('/public/images/thumbs');
            $data['thumb'] = $thumb;
        }

        $startAt = date('Y-m-d H:i:s', strtotime($request->start_at1.' '.$request->start_at2));
        $data['start_at'] = $startAt;

        if ($request->input('stop_at1')) {
            $stopAt = date('Y-m-d H:i:s', strtotime($request->stop_at1.' '.$request->stop_at2));
            $data['stop_at'] = $stopAt;
        }

        $article = Article::insert($data);

        if ($article) {
            session()->flash('success', '添加成功');
            return redirect()->route('admin.articles.index');
        }else {
            session()->flash('error', '添加失败');
            return redirect()->back();
        }
    }

    public function edit(Article $article)
    {
        $categories = Category::getList(0);
        foreach ($categories as $k => $v) {
            if ($v->moduleid != 2) {
                unset($categories[$k]);
            }
        }
        $readgroup = explode(',', $article->readgroup);
        $posidsArr = explode(',', $article->posid);
        $posids = DB::table('posids')->get();

        $startAt1 = '';
        $startAt2 = '';
        $stopAt1 = '';
        $stopAt2 = '';
        if ($article->start_at) {
            $startAt = explode(' ',$article->start_at);
            $startAt1 = $startAt[0];
            $startAt2 = $startAt[1];
        }
        if ($article->stop_at) {
            $stopAt = explode(' ',$article->stop_at);
            $stopAt1 = $stopAt[0];
            $stopAt2 = $stopAt[1];
        }

        return view('admin.articles.edit', compact('article', 'readgroup', 'posidsArr', 'posids', 'categories', 'startAt1', 'startAt2', 'stopAt1', 'stopAt2'));
    }

    public function delete(Request $request)
    {
        $result = ['status' => 1];
        $this->validate($request, [
            'id' => 'required'
        ]);

        $article = DB::table('articles')->where('id', $request->id)->delete();

        if ($article) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else{
            $result = ['status' => 1];
        }

        return json_encode($result);
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => 'required',
            'editorValue' => 'required',
        ]);

        $data = [
            'catid' => $request->catid,
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'title' => $request->title,
            'keywords' => $request->input('keywords', ''),
            'description' => $request->input('description', ''),
            'content' => $request->input('editorValue', ''),
            'copyfrom' => $request->input('copyfrom', ''),
            'fromlink' => $request->input('fromlink', ''),
            'posid' => $request->input('posid'),
            'template' => $request->input('template'),
        ];

        if ($request->readgroup) {
            $data['readgroup'] = implode(',', $request->readgroup);
        }
        if ($request->hasFile('thumb') && $request->file('thumb')->isValid()) {
            $thumb = $request->thumb->store('/public/images/thumbs');
            Storage::delete($article->thumb);
            $data['thumb'] = $thumb;
        }

        $startAt = date('Y-m-d H:i:s', strtotime($request->start_at1.' '.$request->start_at2));
        $data['start_at'] = $startAt;

        if ($request->input('stop_at1')) {
            $stopAt = date('Y-m-d H:i:s', strtotime($request->stop_at1.' '.$request->stop_at2));
            $data['stop_at'] = $stopAt;
        }

        $result = $article->update($data);

        if ($result) {
            session()->flash('success', '修改成功');
            return redirect()->route('admin.articles.index');
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

        $article = Article::findOrFail($id);
        $bool = $article->update(['listorder' => $listorder]);
        if ($bool) {
            $result = ['status' => 0, 'msg' => '修改成功'];
        }else {
            $result = ['status' => 1];
        }

        return json_encode($result);
    }
}
