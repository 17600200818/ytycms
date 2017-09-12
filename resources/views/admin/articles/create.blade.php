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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.categories.store') }}" method="post">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">栏目</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="moduleid">
                                    @foreach($modules as $v)
                                        <option value="{{$v['id']}}">{{$v['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO简介</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <input type="checkbox" name="description" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">内容</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ismenu" value="1" checked>是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ismenu" value="0">否
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
                                            <input type="checkbox" name="readgroup[]" value="{{ $v->id }}"> {{ $v->name }}
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
                                            <input type="checkbox" name="postgroup[]" value="{{ $v->id }}"> {{ $v->name }}
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
                                <input type="text" class="form-control input-lg" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO栏目关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">SEO栏目简介</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control input-sm" name="description">
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