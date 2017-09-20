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
        <tr v-for="(article, key) in articles">
            <td><input type="text" v-model="article.listorder" @change="setListOrder(key)"></td>
            <td>@{{ article.id }}</td>
            <td>@{{ article.title }}</td>
            <td>@{{ article.status }}</td>
            <td>@{{ article.hits }}</td>
            <td>@{{ article.username }}</td>
            <td>
                <a :href="'/admin/articles/'+article.id+'/edit'" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i>
                    修改
                </a>

                <a href="#" @click='sub(article.id, key)' class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                删除
                </a>
            </td>
        </tr>
        </tbody>

    </table>

    <a href="{{ route('admin.articles.create', 0) }}" class="btn btn-primary">
        <i class="entypo-plus"></i>
        添加文章
    </a>
@stop
@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: "#Table",
            data: {
                articles: [
                    @foreach($articles as $article)
                        {
                            'listorder': '{{ $article["listorder"] }}',
                            'id': '{{ $article["id"] }}',
                            'title': '{{ $article["title"] }}',
                            'status': '{{ $article["status"] }}',
                            'hits': '{{ $article["hits"] }}',
                            'username': '{{ $article["username"] }}',
                        },
                    @endforeach
                ]
            },
            methods: {
                'sub': function (id, index) {

                    if (!confirm('确定删除么')) {
                        return false;
                    }

                    this.$http.post('{{ route('admin.articles.delete') }}',
                            {_token:'{{csrf_token()}}', id: id},
                            {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }else {
                                    this.articles.splice(index, 1);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                },
                'setListOrder': function (index) {
                    var article = this.articles[index];
                    var id = article.id;
                    var listorder = article.listorder;
                    this.$http.post('{{ route('admin.articles.setListOrder') }}',
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