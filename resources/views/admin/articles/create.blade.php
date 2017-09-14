@extends('admin.layouts.app')
@section('content')
    <script type="text/javascript" charset="utf-8" src="/ueditor1_4_3_3-utf8/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor1_4_3_3-utf8/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor1_4_3_3-utf8/lang/zh-cn/zh-cn.js"></script>
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Input Sizes
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.articles.store') }}" method="post">

                        {{csrf_field()}}
                        @if($catid == 0)
                            <div class="form-group">
                                <label for="field-1" class="col-sm-2 control-label">栏目</label>

                                <div class="col-sm-5">
                                    <select class="form-control" name="moduleid">
                                        <option value=1></option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="catid" value="{{ $catid }}">
                        @endif
                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="username" value="{{ Auth::user()->name }}">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">SEO简介</label>
                            <div class="col-sm-5">
                                <textarea name="description" id="" cols="30" rows="10"description></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">内容</label>

                            <div class="col-sm-10">
                                <script id="editor" type="text/plain" style="width:820px;height:500px;"></script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">发布时间</label>
                            <div class="col-sm-5">
                                <textarea name="created_at" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">来源</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="copyfrom" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">来源网址</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="fromlink" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">访问权限</label>

                            <div class="col-sm-5">
                                @foreach(\App\Models\Role::get() as $v)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="readgroup[]" value="{{ $v->id }}"> {{ $v->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">推荐位</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="posid">
                                    @foreach($posids as $posid)
                                        <option value='{{ $posid->id }}'>{{ $posid->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">模板</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="templ">
                                    @foreach([1,2,3,4,5,6] as $posid)
                                        <option value='{{ $posid }}'>{{ $posid }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">发布时间</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <input type="radio" name="release" value="0">发布
                                </div>
                                <div class="radio">
                                    <input type="radio" name="release" value="1">定时发布
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">添加</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@stop

@section('script')
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }
</script>
@stop