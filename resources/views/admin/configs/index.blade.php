@extends('admin.layouts.app')
@section('content')

    <div class="row" id="Config">
        <div class="col-md-6">

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">站点配置</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">网站名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" v-model="site_name" @change="siteConfig('site_name')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">网站网址</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="site_url" @change="siteConfig('site_url')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">网站LOGO</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="logo" @change="siteConfig('logo')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">站点邮箱</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2" v-model="site_email" @change="siteConfig('site_email')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">网站标题</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2" v-model="seo_title" @change="siteConfig('seo_title')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">关键词</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2" v-model="seo_keywords" @change="siteConfig('seo_keywords')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">网站简介</label>

                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" placeholder="Textarea" v-model="seo_description" @change="siteConfig('seo_description')"></textarea>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">用户中心设置</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">允许新会员注册</label>
                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_register" value="1"  v-model="member_register" @click="siteConfig('member_register')">是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_register" value="0"  v-model="member_register" @click="siteConfig('member_register')">否
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">新会员注册需要邮件验证</label>
                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_emailcheck" value="1"  v-model="member_emailcheck" @click="siteConfig('member_emailcheck')">是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_emailcheck"  value="0"  v-model="member_emailcheck" @click="siteConfig('member_emailcheck')">否
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">新会员注册需要审核</label>
                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_registecheck" value="1"  v-model="member_registecheck" @click="siteConfig('member_registecheck')">是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="member_registecheck" value="0"  v-model="member_registecheck" @click="siteConfig('member_registecheck')">否
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">注册登陆开启验证码</label>
                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio"  name="member_login_verify" value="1"  v-model="member_login_verify" @click="siteConfig('member_login_verify')">是
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio"  name="member_login_verify" value="0"  v-model="member_login_verify" @click="siteConfig('member_login_verify')">否
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-4 control-label">邮件认证模板</label>

                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" placeholder="Textarea"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-4 control-label">密码找回邮件内容</label>

                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" placeholder="Textarea" ></textarea>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">附件配置</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">允许上传附件大小</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="attach_maxsize" @change="siteConfig('attach_maxsize')">
                            </div>B
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">允许上传附件类型</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="attach_allowext" @change="siteConfig('attach_allowext')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">是否开启图片水印</label>
                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_enable" value="1"  v-model="watermark_enable" @click="siteConfig('watermark_enable')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_enable" value="0"  v-model="watermark_enable" @click="siteConfig('watermark_enable')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">水印文字内容</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watemard_text" @change="siteConfig('watemard_text')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">文字大小</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watemard_text_size" @change="siteConfig('watemard_text_size')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">文字颜色</label>#FFFFF为白色 #000000为黑色
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watemard_text_color" @change="siteConfig('watemard_text_color')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">字体</label>若水印为中文放中文字体在Public/Images/font/目录下
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watemard_text_face" @change="siteConfig('watemard_text_face')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">水印添加条件</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_minwidth" @change="siteConfig('watermark_minwidth')">
                            </div>PX宽
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_minheight" @change="siteConfig('watermark_minheight')">
                            </div>PX高
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">水印图片</label>水印图片路路径/Public/Images/
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_img" @change="siteConfig('watermark_img')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">水印透明度	</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_pct" @change="siteConfig('watermark_pct')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">JPEG 水印质量	</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_quality" @change="siteConfig('watermark_quality')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-4 control-label">水印边距</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="watermark_pospadding" @change="siteConfig('watermark_pospadding')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-2 control-label">水印位置</label>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="0"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">随机位置
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="1"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">上左
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="4"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">中左
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="7"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">下左
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="2"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">上中
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="5"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">中部
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="8"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">下中
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="3"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">上右
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="6"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">中右
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="watermark_pos" value="9"  v-model="watermark_pos" @click="siteConfig('watermark_pos')">下右
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <div class="col-md-6">

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">系统参数</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">列表分页数</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="PAGE_LISTROWS" @change="siteConfig('PAGE_LISTROWS')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">布局模板</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="LAYOUT_ON" value="1"  v-model="LAYOUT_ON" @click="siteConfig('LAYOUT_ON')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="LAYOUT_ON" value="0"  v-model="LAYOUT_ON" @click="siteConfig('LAYOUT_ON')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">令牌验证</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="TOKEN_ON" value="1"  v-model="TOKEN_ON" @click="siteConfig('TOKEN_ON')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="TOKEN_ON" value="0"  v-model="TOKEN_ON" @click="siteConfig('TOKEN_ON')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">令牌表单字段</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="TOKEN_NAME" @change="siteConfig('TOKEN_NAME')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">模板编译缓存</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="TMPL_CACHE_ON" value="1"  v-model="TMPL_CACHE_ON" @click="siteConfig('TMPL_CACHE_ON')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="TMPL_CACHE_ON" value="0"  v-model="TMPL_CACHE_ON" @click="siteConfig('TMPL_CACHE_ON')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">缓存有效期</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="HTML_CACHE_TIME" @change="siteConfig('HTML_CACHE_TIME')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">缓存读取方式</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">readfile
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">redirect
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">静态文件后缀</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"   v-model="HTML_FILE_SUFFIX" @change="siteConfig('HTML_FILE_SUFFIX')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">ADMIN_ACCESS</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="ADMIN_ACCESS" @change="siteConfig('ADMIN_ACCESS')" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">首页生成html</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="HOME_ISHTML" value="1"  v-model="HOME_ISHTML" @click="siteConfig('HOME_ISHTML')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="HOME_ISHTML" value="0"  v-model="HOME_ISHTML" @click="siteConfig('HOME_ISHTML')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">后台登录验证码</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ADMIN_VERIFY" value="1"  v-model="ADMIN_VERIFY" @click="siteConfig('ADMIN_VERIFY')">开启
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ADMIN_VERIFY" value="0"  v-model="ADMIN_VERIFY" @click="siteConfig('ADMIN_VERIFY')">关闭
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">cookie路径</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"   v-model="cookie_url" @change="siteConfig('cookie_url')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">cookie域名</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="cookie_domain" @change="siteConfig('cookie_domain')" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">默认语言</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">中文
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">英文
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">邮件系统</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">邮件发送模式</label>

                            <div class="col-sm-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">SMTP 函数发送
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios"  value="option1" checked="">sendmail
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">邮件服务器</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="mail_server" @change="siteConfig('mail_server')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">邮件发送端口</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="mail_port" @change="siteConfig('mail_port')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">发件人地址</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1"  v-model="mail_from" @change="siteConfig('mail_from')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">AUTH LOGIN</label>
                                <div class="col-sm-5">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="mail_auth" value="1"  v-model="mail_auth" @click="siteConfig('mail_auth')">开启
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="mail_auth" value="0"  v-model="mail_auth" @click="siteConfig('mail_auth')">关闭
                                        </label>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">验证用户名</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="mail_user" @change="siteConfig('mail_user')" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">验证密码</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2"  v-model="mail_password" @change="siteConfig('mail_password')" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">邮件设置测试</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-2" >
                            </div>
                        </div>

                    </form>

                </div>

            </div>

            <div class="panel panel-primary" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">添加系统变量</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">变量名称</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">变量介绍</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">变量值</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">添加变量</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>


    </div>


@stop

@section('script')
    <script src="/js/vue.js"></script>
    <script src="/js/vue-resource.js"></script>
    <script>
        var vm = new Vue({
            el: '#Config',
            data: {
                {{--site_name : '{{ $configs["site_name"] }}',--}}
                {{--site_url : '{{ $configs["site_url"] }}',--}}
                {{--logo : '{{ $configs["logo"] }}',--}}
                {{--site_email : '{{ $configs["site_email"] }}',--}}
                {{--seo_title : '{{ $configs["seo_title"] }}',--}}
                {{--seo_keywords : '{{ $configs["seo_keywords"] }}',--}}
                {{--seo_description : '{{ $configs["seo_description"] }}',--}}
                {{--configs: {{ $configs }}--}}
                @foreach($configs as $key => $config)
                {{ $key }} : '{{ $config }}',
                @endforeach
            },
            props:['value'],
            computed: {
            },
            methods: {
                'siteConfig' : function (name) {
                    this.$http.post('{{ route('admin.configs.setConfig') }}',
                        {_token:'{{csrf_token()}}',varname: name, value: this[name]},
                        {emulateJSON:true})
                            .then(function (result) {//正确请求成功时处理
                                if(result.data.status != 0) {
                                    alert(result.data.msg);
                                }
                            }).catch(function (result) { //捕捉错误处理
                    });
                },

                'getCheck': function(name, value) {
                    if(this[name] == value) {
                        alert(1);
                        return 1;
                    }else {
                        alert(0);
                        return 0;
                    }
                }
            },
            filters: {
            },
            components: {

            }
        });
    </script>
@stop