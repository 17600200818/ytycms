@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.menu.update', $menu->id) }}" method="post">

                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">上级</label>

                    <div class="col-sm-5">
                        <select class="form-control" name="parentid">
                            <option value="0">无上级</option>
                            @foreach($menus as $v)
                                @if($v['id'] == $menu->parentid)
                                    <option value="{{$v['id']}}" selected>{{$v['name']}}</option>
                                @else
                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">名称</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="{{ $menu->name }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">图标</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="icon" value="{{ $menu->icon }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">路由</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="route" value="{{ $menu->route }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">参数</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="data" value="{{ $menu->data }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">备注</label>

                    <div class="col-sm-5">
                        <textarea class="form-control" name="remark">{{ $menu->remark }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">状态</label>

                    <div class="col-sm-5">
                        <select class="form-control" name="status">
                            <option value="1"
                                @if($menu->status==1)
                                selected
                                @endif
                            >启用</option>
                            <option value="0"
                                @if($menu->status==0)
                                selected
                                @endif
                            >禁用</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">类型</label>

                    <div class="col-sm-5">
                        <select class="form-control" name="type">
                            <option value="1"
                                @if($menu->type==1)
                                    selected
                                @endif
                            >管理后台</option>
                            <option value="0"
                                @if($menu->type==0)
                                selected
                                @endif
                            >会员中心</option>
                        </select>
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

@stop