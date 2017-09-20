@extends('admin.layouts.app')
@section('content')
    <table class="table table-bordered table-striped datatable" id="Table">
        <thead>
        <tr>
            <th>排序</th>
            <th>ID</th>
            <th>标题</th>
            <th>状态</th>
            <th>点击</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(v, key) in products">
            <td><input type="text" v-model="v.listorder" @change="setListOrder(key)"></td>
            <td>@{{ v.id }}</td>
            <td>@{{ v.title }}</td>
            <td>@{{ v.status }}</td>
            <td>@{{ v.hits }}</td>
            <td>@{{ v.username }}</td>
            <td>
                <a :href="'/admin/articles/'+v.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
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

    <a href="{{ route('admin.products.create', 0) }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加内容
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                products: [
                        @foreach($products as $v)
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
                {{--'sub': function (id, index) {--}}

                    {{--if (!confirm('确定删除么')) {--}}
                        {{--return false;--}}
                    {{--}--}}

                    {{--this.$http.post('{{ route('admin.articles.delete') }}',--}}
                            {{--{_token:'{{csrf_token()}}', id: id},--}}
                            {{--{emulateJSON:true})--}}
                            {{--.then(function (result) {//正确请求成功时处理--}}
                                {{--if(result.data.status != 0) {--}}
                                    {{--alert(result.data.msg);--}}
                                {{--}else {--}}
                                    {{--this.articles.splice(index, 1);--}}
                                {{--}--}}
                            {{--}).catch(function (result) { //捕捉错误处理--}}
                    {{--});--}}
                {{--},--}}
                {{--'setListOrder': function (index) {--}}
                    {{--var article = this.articles[index];--}}
                    {{--var id = article.id;--}}
                    {{--var listorder = article.listorder;--}}
                    {{--this.$http.post('{{ route('admin.articles.setListOrder') }}',--}}
                            {{--{_token:'{{csrf_token()}}', id: id, listorder: listorder},--}}
                            {{--{emulateJSON:true})--}}
                            {{--.then(function (result) {//正确请求成功时处理--}}
                                {{--if(result.data.status == 0) {--}}
                                    {{--alert(result.data.msg);--}}
                                {{--}--}}
                            {{--}).catch(function (result) { //捕捉错误处理--}}
                    {{--});--}}
                {{--}--}}
            }
        });
    </script>
@stop