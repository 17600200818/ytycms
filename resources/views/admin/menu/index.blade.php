@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>ID</th>
            <th>名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(m, key) in menu">
            <td><input type="text" v-model="m.listorder" @change="setListOrder(key)"></td>
            <td>@{{ m.id }}</td>
            <td>@{{ m.name }}</td>
            <td>@{{ m.status }}</td>
            <td>
                <a :href="'/admin/menu/create/'+m.id" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    添加子分类
                </a>

                <a :href="'/admin/menu/'+m.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a href="#" @click='sub(m.id, key)' class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                删除
                </a>
            </td>
        </tr>
        </tbody>

    </table>

    <a href="{{ route('admin.posids.create') }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加一级菜单
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                menu: [
                    @foreach($menus as $menu)
                    {
                        'listorder': '{{ $menu["listorder"] }}',
                        'id': '{{ $menu["id"] }}',
                        'name': '{{ $menu["name"] }}',
                        'status': '{{ $menu["status"] }}',
                        'parentid': '{{ $menu["parentid"] }}',
                    },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.menu.delete') }}',
                            {_token:'{{csrf_token()}}', id: id},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }else {
                                    this.menu.splice(index, 1);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                },
                'setListOrder': function (index) {
                    var menu = this.menu[index];
                    var id = menu.id;
                    var listorder = menu.listorder;
                    this.$http.post('{{ route('admin.menu.setListOrder') }}',
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