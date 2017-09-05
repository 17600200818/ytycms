@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            <tr v-for="(posid, index) in posids">
                <td>@{{ posid.id }}</td>
                <td>@{{ posid.name }}</td>
                <td>
                    <a :href="'/admin/posids/'+posid.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        修改
                    </a>

                    <a href="#" @click='sub(posid.id, index)' class="btn btn-danger btn-sm btn-icon icon-left">
                        <i class="entypo-cancel"></i>
                        删除
                    </a>
                </td>
            </tr>
        </tbody>

    </table>

    <a href="{{ route('admin.posids.create') }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加推荐位
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                posids: [
                    @foreach($posids as $posid)
                        { 'name': '{{ $posid->name }}', 'id': {{ $posid->id }} },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.posids.delete') }}',
                            {_token:'{{csrf_token()}}', id: id},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }else {
                                    this.posids.splice(index, 1);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                }
            }
        });
    </script>
@stop