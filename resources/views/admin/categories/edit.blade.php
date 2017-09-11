@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Input Sizes
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.categories.update', $category->id) }}" method="post">

                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">请选择模型</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="moduleid">
                                    @foreach($modules as $v)
                                        @if($category->moduleid == $v['id'])
                                            <option value="{{$v['id']}}" selected>{{$v['title']}}</option>
                                        @else
                                            <option value="{{$v['id']}}" >{{$v['title']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">上级栏目</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="parentid">
                                    <option value="0">作为一级</option>
                                    @foreach($categories as $v)
                                        @if($v['id'] == $category->parentid)
                                            <option value="{{$v['id']}}" selected>{{$v['catname']}}</option>
                                        @else
                                            <option value="{{$v['id']}}">{{$v['catname']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">栏目名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="catname" value="{{ $category->catname }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">栏目目录</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="catdir" value="catdir"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">多栏目设置</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <input type="checkbox" name="more" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">导航</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ismenu" value="1" @if($category->ismenu) checked @endif>是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ismenu" value="0" @if(!$category->ismenu) checked @endif>否
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">访问权限</label>

                            <div class="col-sm-5">
                                @foreach(\App\Models\Role::get() as $v)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="readgroup[]" value="{{ $v->id }}" @if(in_array($v->id, $readGroup)) checked @endif> {{ $v->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">允许投稿会员组</label>

                            <div class="col-sm-5">
                                @foreach(\App\Models\Role::get() as $v)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="postgroup[]" value="{{ $v->id }}" @if(in_array($v->id, $postGroup)) checked @endif> {{ $v->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-1 control-label">SEO设置</label>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO栏目标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control input-lg" name="title" value="{{ $category->title }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO栏目关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords" value="{{ $category->keywords }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO栏目简介</label>

                            <div class="col-sm-5">
                                <textarea name="description" id="" cols="30" rows="10">{{ $category->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">添加</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@stop