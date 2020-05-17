@extends('user.layouts')
@section('css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">发起工单</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="/addTicket" method="post" class="form-horizontal" onsubmit="return do_submit();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('home.ticket_table_title')}}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="title" id="title" autocomplete="off" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">内容</label>
                                    <div class="col-md-8">
                                        <div id="editor"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn green">{{trans('home.ticket_table_new_yes')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
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
    <script type="text/javascript" src="/js/js-xss/xss.min.js"></script>
    <script type="text/javascript" src="/js/wangEditor/wangEditor.min.js"></script>
    <script type="text/javascript">
        // wangEditor富文本编辑器
        var E = window.wangEditor;
        var editor = new E('#editor');
        editor.customConfig.menus = [
            'bold',
            'italic',
            'underline',
            'image',
            'video'
        ];
        editor.create();

        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var title = $('#title').val();
            var content = filterXSS(editor.txt.html());

            $.ajax({
                type: "POST",
                url: "/addTicket",
                async: false,
                data: {
                    _token:_token,
                    title: title,
                    content:content,
                },
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/tickets';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
