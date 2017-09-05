@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.posids.update', $posid->id) }}" method="post">

                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">名称</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="{{ $posid->name }}" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default">提交</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop