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
                            <span class="caption-subject font-dark">添加节点分组</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" onsubmit="return do_submit();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">分组名称</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{$group->name}}" id="name" placeholder="" autofocus required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
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
            var id = '{{$group->id}}';
            var name = $('#name').val();

            $.ajax({
                type: "POST",
                url: "/admin/editGroup",
                async: false,
                data: {_token:_token, id:id, name:name},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/groupList';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
