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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.feedbacks.update', $feedback->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" value="{{ $feedback->title }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">姓名</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="username" value="{{ $feedback->username }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">邮箱</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email" value="{{ $feedback->email }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">电话</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="telephone" value="{{ $feedback->telephone }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="content" id="" cols="30" rows="10"description>{{ $feedback->content }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">回复</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="reply" id="" cols="30" rows="10"description>{{ $feedback->reply }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">IP</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="ip" value="{{ $feedback->ip }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">提交时间</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="create_at" value="{{ $feedback->create_at }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">状态</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="status">
                                    <option value="0" @if($feedback->status == 0)selected @endif>审核通过</option>
                                    <option value="1" @if($feedback->status == 1)selected @endif>审核不通过</option>
                                    <option value="2" @if($feedback->status == 2)selected @endif>待审核</option>
                                </select>
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