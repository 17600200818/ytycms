@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>ID</th>
            <th>栏目名称</th>
            <th>所属模型</th>
            <th>导航</th>
            <th>访问</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(category, key) in categories">
            <td><input type="text" v-model="category.listorder" @change="setListOrder(key)"></td>
            <td>@{{ category.id }}</td>
            <td>@{{ category.catname }}</td>
            <td>@{{ category.module }}</td>
            <td>@{{ category.ismenu }}</td>
            <td>@{{ category.ismenu }}</td>
            <td>
                <a :href="'/admin/articles/create/'+category.id" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    添加内容
                </a>

                <a :href="'/admin/categories/create/'+category.id" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    添加子栏目
                </a>

                <a :href="'/admin/categories/'+category.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a href="#" @click='sub(category.id, key)' class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                删除
                </a>
            </td>
        </tr>
        </tbody>

    </table>

    <a href="{{ route('admin.categories.create', 0) }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加栏目
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                categories: [
                    @foreach($categories as $category)
                    {
                        'listorder': '{{ $category["listorder"] }}',
                        'id': '{{ $category["id"] }}',
                        'catname': '{{ $category["catname"] }}',
                        'module': '{{ $category["module"] }}',
                        'ismenu': '{{ $category["ismenu"] }}',
                    },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.categories.delete') }}',
                            {_token:'{{csrf_token()}}', id: id},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }else {
                                    this.categories.splice(index, 1);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                },
                'setListOrder': function (index) {
                    var category = this.categories[index];
                    var id = category.id;
                    var listorder = category.listorder;
                    this.$http.post('{{ route('admin.categories.setListOrder') }}',
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