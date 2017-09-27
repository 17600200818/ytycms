@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>ID</th>
            <th>标题</th>
            <th>状态</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(v, key) in list">
            <td><input type="text" v-model="v.listorder" @change="setListOrder(key)"></td>
            <td>@{{ v.id }}</td>
            <td>@{{ v.title }}</td>
            <td>@{{ v.status }}</td>
            <td>@{{ v.username }}</td>
            <td>
                <a :href="'/admin/feedbacks/'+v.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
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
                        'title': '{{ $v["title"] }}',
                        'status': '{{ $v["status"] }}',
                        'hits': '{{ $v["hits"] }}',
                        'username': '{{ $v["username"] }}',
                    },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.feedbacks.delete') }}',
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
                    this.$http.post('{{ route('admin.feedbacks.setListOrder') }}',
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