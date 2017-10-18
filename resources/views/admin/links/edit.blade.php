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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.links.update', $link->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">友情推荐分类</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="typeid">
                                    @foreach($linkTypes as $linkType)
                                        @if($linkType->typeid == $link->typeid)
                                            <option value='{{ $linkType->typeid }}' selected>{{ $linkType->name }}</option>
                                        @else
                                            <option value='{{ $linkType->typeid }}'>{{ $linkType->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">链接类型</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        @if($link->linktype == 1)
                                            <input type="radio" checked name="linktype" value="1"> 文字
                                        @else
                                            <input type="radio" name="linktype" value="1"> 文字
                                        @endif
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        @if($link->linktype == 2)
                                            <input type="radio" name="linktype" value="2" checked> 图片
                                        @else
                                            <input type="radio" name="linktype" value="2"> 图片
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">网站名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="{{ $link->name }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站logo</label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="{{ '/storage'.substr($link->logo, 6) }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="thumb" accept="/image/*">
											</span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">网站地址</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="siteurl" value="{{ $link->siteurl }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">站点简介</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="siteinfo" id="" cols="30" rows="10"description>{{ $link->siteinfo }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">状态</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        @if($link->status == 0)
                                            <input type="radio" name="status" checked value="0"> 已审核
                                        @else
                                            <input type="radio" name="status" value="0"> 已审核
                                        @endif

                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        @if($link->status == 1)
                                            <input type="radio" name="status" checked value="1"> 未审核
                                        @else
                                            <input type="radio" name="status" value="1"> 未审核
                                        @endif
                                    </label>
                                </div>
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

@section('script')
    <script src="/assets/js/fileinput.js"></script>

    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/js/daterangepicker/moment.min.js"></script>
    <script src="/assets/js/daterangepicker/daterangepicker.js"></script>
@stop