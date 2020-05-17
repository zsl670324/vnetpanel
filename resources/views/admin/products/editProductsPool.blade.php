@extends('admin.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-darm">编辑虚拟产品名称</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="/admin/editProductsPool" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return doSubmit();">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">产品名称</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$productsPool->name}}" id="name" autocomplete="off" autofocus required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-3 control-label">状态</label>
                            <div class="col-md-8">
                                <input type="checkbox" class="make-switch" id="status" {{$productsPool->status ? 'checked' : ''}} data-on-color="success" data-off-color="danger" data-on-text="启用" data-off-text="禁用">
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
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // ajax同步提交
        function doSubmit() {
            var _token = '{{csrf_token()}}';
            var id = '{{$productsPool->id}}';
            var name = $('#name').val();
            var status = Number($('#status').bootstrapSwitch('state'));

            $.ajax({
                type: "POST",
                url: "/admin/editProductsPool",
                async: false,
                data: {_token:_token, id:id, name: name, status:status},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/productsPool';
                        }
                    });
                }
            });

            return false;
        }
    </script>
@endsection
