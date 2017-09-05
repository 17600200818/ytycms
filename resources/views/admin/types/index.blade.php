@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>typeid</th>
            <th>名称</th>
            <th>简介</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(type, index) in types">
            <td><input type="text" v-bind:value="type.listorder"></td>
            <td>@{{ type.typeid }}</td>
            <td>@{{ type.name }}</td>
            <td>@{{ type.description }}</td>
            <td>@{{ type.status }}</td>
            <td>
                <a :href="'/admin/types/'+type.typeid+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    管理子分类
                </a>

                <a :href="'/admin/types/'+type.typeid+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    添加子分类
                </a>

                <a :href="'/admin/types/'+type.typeid+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a href="#" @click='sub(type.listorder, index)' class="btn btn-danger btn-sm btn-icon icon-left">
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
                types: [
                    @foreach($types as $type)
                    {
                        'typeid': '{{ $type->typeid }}',
                        'name': '{{ $type->name }}',
                        'description': '{{ $type->description }}',
                        'status': '{{ $type->status }}',
                        'listorder': '{{ $type->listorder }}'
                    },
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