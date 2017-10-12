@extends('admin.layouts.app')
@section('content')
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.modules.update', $module->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">模型名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" value="{{ $module->title }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">模型表名</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="{{ $module->name }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">列表调用字段</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="listfields" value="{{ $module->listfields }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">前台搜索模型</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="issearch">
                                    <option value="0" @if($module->issearch == 0)selected @endif>是</option>
                                    <option value="1" @if($module->issearch == 1)selected @endif>否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">允许前台投稿</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="issystem">
                                    <option value="0" @if($module->issystem == 0)selected @endif>是</option>
                                    <option value="1" @if($module->issystem == 1)selected @endif>否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">允许投稿会员组</label>

                            <div class="col-sm-5">
                                @foreach($roles as $role)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="postgroup[]" value="{{ $role->id }}" @if(in_array($role->id, $postgroupArr)) checked @endif >{{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">模型简介</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"description>{{ $module->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">修改</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@stop