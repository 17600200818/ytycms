@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>ID</th>
            <th>名称</th>
            <th>TYPE</th>
            <th>SKIN</th>
            <th>CODE</th>
            <th>管理操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(v, key) in list">
            <td><input type="text" v-model="v.listorder" @change="setListOrder(key)"></td>
            <td>@{{ v.id }}</td>
            <td>@{{ v.name }}</td>
            <td>@{{ v.type }}</td>
            <td>@{{ v.skin }}</td>
            <td>@{{ v.code }}</td>
            <td>
                <a :href="'/admin/links/'+v.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a href="#" @click='sub(v.id, key)' class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                删除
                </a>
            </td>
        </tr>
        </tbody>

    </table>
    <a href="{{ route('admin.kefu.create') }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加客服
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                list: [
                    @foreach($list as $v)
                    {
                        'listorder': '{{ $v["listorder"] }}',
                        'id': '{{ $v["id"] }}',
                        'name': '{{ $v["name"] }}',
                        'type': '{{ $v["type"] }}',
                        'skin': '{{ $v["skin"] }}',
                        'code': '{{ $v["code"] }}',
                    },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.links.delete') }}',
                            {_token:'{{csrf_token()}}', id: id},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }else {
                                    this.list.splice(index, 1);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                },
                'setListOrder': function (index) {
                    var download = this.list[index];
                    var id = download.id;
                    var listorder = download.listorder;
                    this.$http.post('{{ route('admin.links.setListOrder') }}',
                            {_token:'{{csrf_token()}}', id: id, listorder: listorder},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status == 0) {
                                    alert(result.data.msg);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                }
            }
        });
    </script>
@stop