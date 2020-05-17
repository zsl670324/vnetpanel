@extends('admin.layouts')
@section('css')
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
                            <span class="caption-subject font-dark">添加域名证书</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        @if (Session::has('errorMsg'))
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <strong>错误：</strong> {{Session::get('errorMsg')}}
                            </div>
                        @endif
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" onsubmit="return do_submit();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">域名</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="domain" value="" id="domain" placeholder="有效的域名" required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">KEY</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="10" name="key" id="key" placeholder="域名证书的KEY值，允许为空，VNET-V2Ray后端支持自动签证书"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">PEM</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="10" name="pem" id="pem" placeholder="域名证书的PEM值，允许为空，VNET-V2Ray后端支持自动签证书"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">提交</button>
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
    <script type="text/javascript">
        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var domain = $('#domain').val();
            var key = $('#key').val();
            var pem = $('#pem').val();

            $.ajax({
                type: "POST",
                url: "/admin/addCertificate",
                async: false,
                data: {_token:_token, domain:domain, key:key, pem:pem},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/certificateList';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
