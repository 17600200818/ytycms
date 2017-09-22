@extends('admin.layouts.app')
@section('head')
    {{--<script src="http://www.jq22.com/jquery/vue.min.js"></script>--}}
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <style>
        .upload_warp_img_div_del {
            position: absolute;
            top: 6px;
            width: 16px;
            right: 4px;
        }

        .upload_warp_img_div_top {
            position: absolute;
            top: 0;
            width: 100%;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.4);
            line-height: 30px;
            text-align: left;
            color: #fff;
            font-size: 12px;
            text-indent: 4px;
        }

        .upload_warp_img_div_text {
            white-space: nowrap;
            width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .upload_warp_img_div img {
            max-width: 100%;
            max-height: 100%;
            vertical-align: middle;
        }

        .upload_warp_img_div {
            position: relative;
            height: 100px;
            width: 120px;
            border: 1px solid #ccc;
            margin: 0px 30px 10px 0px;
            float: left;
            line-height: 100px;
            display: table-cell;
            text-align: center;
            background-color: #eee;
            cursor: pointer;
        }

        .upload_warp_img {
            border-top: 1px solid #D2D2D2;
            padding: 14px 0 0 14px;
            overflow: hidden
        }

        .upload_warp_text {
            text-align: left;
            margin-bottom: 10px;
            padding-top: 10px;
            text-indent: 14px;
            border-top: 1px solid #ccc;
            font-size: 14px;
        }

        .upload_warp_right {
            float: left;
            width: 57%;
            margin-left: 2%;
            height: 100%;
            border: 1px dashed #999;
            border-radius: 4px;
            line-height: 130px;
            color: #999;
        }

        .upload_warp_left img {
            margin-top: 32px;
        }

        .upload_warp_left {
            float: left;
            width: 40%;
            height: 100%;
            border: 1px dashed #999;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload_warp {
            margin: 14px;
            height: 130px;
        }

        .upload {
            border: 1px solid #ccc;
            background-color: #fff;
            width: 650px;
            box-shadow: 0px 1px 0px #ccc;
            border-radius: 4px;
        }

        .hello {
            width: 650px;
            margin-left: 18%;
            text-align: center;
        }
    </style>
@stop
@section('content')
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.pictures.update', $picture->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">栏目</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="catid">
                                    @foreach($categories as $k=>$v)
                                        @if($v->id == $picture->catid)
                                            <option value='{{ $v->id }}' selected>{{ $v->catname }}</option>
                                        @else
                                            <option value='{{ $v->id }}'>{{ $v->catname }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" value="{{ $picture->title }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords" value="{{ $picture->keywords }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">SEO简介</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"description>{{ $picture->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">图组</label>

                            <div>
                                <div id="app">

                                    <input type="hidden" name="images[]" :value="v.file.src" v-for="(v, key) in imgList">
                                    <div class="hello">
                                        <div class="upload">
                                            <div class="upload_warp">
                                                <div class="upload_warp_left" @click="fileClick">
                                                <img src="/images/upload.png">
                                            </div>
                                            <div class="upload_warp_right" @drop="drop($event)" @dragenter="dragenter($event)" @dragover="dragover($event)">
                                            或者将文件拖到此处
                                        </div>
                                    </div>
                                    <div class="upload_warp_text">
                                        选中@{{imgList.length}}张文件，共@{{bytesToSize(this.size)}}
                                    </div>
                                    <input @change="fileChange($event)" type="file" id="upload_file" multiple style="display: none"/>
                                    <div class="upload_warp_img" v-show="imgList.length!=0">
                                        <div class="upload_warp_img_div" v-for="(item,index) of imgList">
                                            <div class="upload_warp_img_div_top">
                                                <div class="upload_warp_img_div_text">
                                                    @{{item.file.name}}
                                                </div>
                                                <img src="/images/del.png" class="upload_warp_img_div_del" @click="fileDel(index)">
                                            </div>
                                            <img :src="item.file.src">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label">内容</label>

                <div class="col-sm-10">
                    <script id="editor" type="text/plain" style="width:820px;height:500px;"></script>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label">发布开始时间</label>
                <div class="col-sm-5">
                    <div class="date-and-time">
                        <input type="text" class="form-control datepicker" name="start_at1" data-format="yyyy-mm-dd" value="{{ $startAt1 }}">
                        <input type="text" class="form-control timepicker" name="start_at2" data-template="dropdown" data-default-time="0:00" data-show-meridian="false" data-minute-step="1" value="{{ $startAt2 }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label">发布结束时间<br/>(不选时间不会结束发布)</label>
                <div class="col-sm-5">
                    <div class="date-and-time">
                        <input type="text" class="form-control datepicker" name="stop_at1" data-format="yyyy-mm-dd" value="{{ $stopAt1 }}">
                        <input type="text" class="form-control timepicker" name="stop_at2" data-template="dropdown" data-default-time="" data-show-meridian="false" data-minute-step="1" value="{{ $stopAt2 }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label">推荐位</label>

                <div class="col-sm-5">
                    <select class="form-control" name="posid">
                        @foreach($posids as $posid)
                            @if($posid->id == $picture->posid)
                                <option selected value='{{ $posid->id }}'>{{ $posid->name }}</option>
                            @else
                                <option value='{{ $posid->id }}'>{{ $posid->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label">模板</label>

                <div class="col-sm-5">
                    <select class="form-control" name="template">
                        @foreach([1,2,3,4,5,6] as $template)
                            <option value='{{ $template }}'>{{ $template }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" class="btn btn-default">修改</button>
                </div>
            </div>
            </form>

        </div>

    </div>

    </div>
    </div>
@stop

@section('script')
    <script src="/assets/js/fileinput.js"></script>

    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/js/daterangepicker/moment.min.js"></script>
    <script src="/assets/js/daterangepicker/daterangepicker.js"></script>
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

        ue.ready(function() {//编辑器初始化完成再赋值
            ue.setContent('{!! $picture->content !!}');  //赋值给UEditor
        });
    </script>

    <script>
        //  import up from  './src/components/Hello'
        var app = new Vue({
            el: '#app',
            data () {
                return {
                    imgList: [
                        @foreach($pics as $pic)
                        {
                            'file': {
                                'src': '/storage'+ '{{ substr($pic, 6) }}',
                            },
                        },
                        @endforeach
                    ],
                    size: 0
                }
            },
            methods: {
                fileClick(){
                    document.getElementById('upload_file').click()
                },
                fileChange(el){
                    if (!el.target.files[0].size) return;
                    this.fileList(el.target.files);
                    el.target.value = ''
                },
                fileList(files){
                    for (let i = 0; i < files.length; i++) {
                        this.fileAdd(files[i]);
                    }
                },
                fileAdd(file){
                    this.size = this.size + file.size;//总大小
                    let reader = new FileReader();
                    reader.vue = this;
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        file.src = this.result;
                        this.vue.imgList.push({
                            file
                        });
                    }
                },
                fileDel(index){
                    this.size = this.size - this.imgList[index].file.size;//总大小
                    this.imgList.splice(index, 1);
                },
                bytesToSize(bytes){
                    if (bytes === 0) return '0 B';
                    let k = 1000, // or 1024
                            sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                            i = Math.floor(Math.log(bytes) / Math.log(k));
                    return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
                },
                dragenter(el){
                    el.stopPropagation();
                    el.preventDefault();
                },
                dragover(el){
                    el.stopPropagation();
                    el.preventDefault();
                },
                drop(el){
                    el.stopPropagation();
                    el.preventDefault();
                    this.fileList(el.dataTransfer.files);
                }
            }
        })
    </script>
@stop