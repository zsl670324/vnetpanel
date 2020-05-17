@extends('admin.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-darm">编辑文章</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="/admin/editLabel" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return doSubmit();">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">标题</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="{{$label->name}}" id="name" autocomplete="off" autofocus required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">排序</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="sort" value="{{$label->sort}}" id="sort" autocomplete="off" required />
                                <span class="help-block"> 值越高显示时越靠前 </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-4">
                                <button type="submit" class="btn green">提 交</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // ajax同步提交
        function doSubmit() {
            var _token = '{{csrf_token()}}';
            var id = '{{$label->id}}';
            var name = $('#name').val();
            var sort = $('#sort').val();

            $.ajax({
                type: "POST",
                url: "/admin/editLabel",
                async: false,
                data: {_token:_token, id:id, name: name, sort:sort},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/labelList';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
