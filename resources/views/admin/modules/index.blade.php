@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>ID</th>
            <th>模型名称</th>
            <th>模型表名</th>
            <th>模型简介</th>
            <th>管理操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(v, key) in list">
            <td>@{{ v.id }}</td>
            <td>@{{ v.title }}</td>
            <td>@{{ v.name }}</td>
            <td>@{{ v.description }}</td>
            <td>
                {{--<a :href="'/admin/modules/'+v.name+'/colums'" class="btn btn-default btn-sm btn-icon icon-left">--}}
                    {{--<i class="entypo-pencil"></i>--}}
                    {{--模型字段--}}
                {{--</a>--}}

                <a :href="'/admin/guestbooks/'+v.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a v-show="v.status == 1" href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                    <i class="entypo-minus-circled"></i>
                    禁用
                </a>
                <a v-show="v.status == 0" href="#" class="btn btn-info btn-sm btn-icon icon-left">
                    <i class="entypo-check"></i>
                    正常
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
                        'id': '{{ $v["id"] }}',
                        'title': '{{ $v["title"] }}',
                        'name': '{{ $v["name"] }}',
                        'description': '{{ $v["description"] }}',
                        'status': '{{ $v["status"] }}',
                    },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.guestbooks.delete') }}',
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
                    this.$http.post('{{ route('admin.guestbooks.setListOrder') }}',
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