@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">发起工单</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <form action="/ticket/addTicket" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return do_submit();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">用户名</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control" name="username" value="{{Request::get('username')}}" id="username" autocomplete="off" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">标题</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" class="form-control" name="title" id="title" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">内容</label>
                                    <div class="col-md-9 col-sm-9">
                                        <script id="editor" type="text/plain" style="height:310px;"></script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn green">提 交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/js/ueditor/ueditor.config.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/ueditor/ueditor.all.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        // 百度富文本编辑器
        var ue = UE.getEditor('editor', {
            toolbars:[['source','undo','redo','bold','italic','underline','insertimage','insertvideo','lineheight','fontfamily','fontsize','justifyleft','justifycenter','justifyright','justifyjustify','forecolor','backcolor','link','unlink']],
            wordCount:true,                //关闭字数统计
            elementPathEnabled : false,    //是否启用元素路径
            maximumWords:300,              //允许的最大字符数
            initialContent:'',             //初始化编辑器的内容
            initialFrameWidth:null,        //初始化宽度
            autoClearinitialContent:false, //是否自动清除编辑器初始内容
        });

        // ajax同步提交
        function do_submit() {
            var username = $('#username').val();
            var title = $('#title').val();
            var content = UE.getEditor('editor').getContent();

            $.ajax({
                type: "POST",
                url: "/admin/addTicket",
                async: false,
                data: {_token:'{{csrf_token()}}', username:username, title:title, content:content},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/ticketList';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
