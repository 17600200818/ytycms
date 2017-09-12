@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        会员信息
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.users.store') }}" method="post">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">角色</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="groupid">
                                    @foreach($roles as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">邮箱</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">密码</label>

                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" />
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