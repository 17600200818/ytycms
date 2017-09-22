@extends('admin.layouts.app')
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

                    <form role="form" class="form-horizontal form-groups-bordered" action="{{ route('admin.downloads.update', $download->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">栏目</label>

                            <div class="col-sm-5">
                                <select class="form-control" name="catid">
                                    @foreach($categories as $v)
                                        @if($v->id == $download->catid)
                                            <option selected value="{{ $v->id }}">{{ $v->catname }}</option>
                                        @else
                                            <option value="{{ $v->id }}">{{ $v->catname }}</option>
                                        @endif
                                    @endforeach
                                    <option value=1></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" value="{{ $download->title }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keywords" value="{{ $download->keywords }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">SEO简介</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"description>{{ $download->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">缩略图</label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="{{ '/storage'.substr($download->thumb, 6) }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="thumb" accept="/image/*">
											</span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">修改文件</label>

                            <div class="col-sm-5">

                                <input type="file" name="file" class="form-control file2 inline btn btn-primary" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files"/>

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
                            <label for="field-1" class="col-sm-2 control-label">访问权限</label>

                            <div class="col-sm-5">
                                @foreach(\App\Models\Role::get() as $v)
                                    <div class="checkbox">
                                        <label>
                                            @if(in_array($v->id, $readgroup))
                                                <input type="checkbox" checked name="readgroup[]" value="{{ $v->id }}"> {{ $v->name }}
                                            @else
                                                <input type="checkbox" name="readgroup[]" value="{{ $v->id }}"> {{ $v->name }}
                                            @endif
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
                                        @if(in_array($posid->id, $posidsArr))
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
                                    @foreach([1,2,3,4,5,6] as $posid)
                                        <option value='{{ $posid }}'>{{ $posid }}</option>
                                    @endforeach
                                </select>
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
            ue.setContent('{!! $download->content !!}');  //赋值给UEditor
        });

    </script>
@stop