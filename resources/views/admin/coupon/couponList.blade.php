@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        input,select {
            margin-bottom: 5px;
        }

        .fancybox > img {
            width: 75px;
            height: 75px;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject"> 卡券列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn blue" onclick="exportCoupon()"> 导出 </button>
                                <button class="btn blue" onclick="addCoupon()"> 生成 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="padding-bottom:5px;">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="type" id="type" onChange="do_search()">
                                    <option value="" @if(Request::get('type') == '') selected @endif>类型</option>
                                    <option value="1" @if(Request::get('type') == '1') selected @endif>抵用券</option>
                                    <option value="2" @if(Request::get('type') == '2') selected @endif>折扣券</option>
                                    <option value="3" @if(Request::get('type') == '3') selected @endif>充值券</option>
                                    <option value="4" @if(Request::get('type') == '4') selected @endif>满减券</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="sn" value="{{Request::get('sn')}}" id="sn" placeholder="券码" autocomplete="off" onkeydown="if(event.keyCode==13){do_search();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <button type="button" class="btn blue" onclick="do_search();">查询</button>
                                <button type="button" class="btn grey" onclick="do_reset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> 类型 </th>
                                    <th> 名称 </th>
                                    <th> 券码 </th>
                                    <th> LOGO </th>
                                    <th> 用途 </th>
                                    <th> 优惠 </th>
                                    <th> 适用产品 </th>
                                    <th> 有效期 </th>
                                    <th> 状态 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($couponList->isEmpty())
                                    <tr>
                                        <td colspan="10" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($couponList as $coupon)
                                        <tr class="odd gradeX">
                                            <td> {{$coupon->id}} </td>
                                            <td> {!! $coupon->type_label !!} </td>
                                            <td> {{$coupon->name}} </td>
                                            <td> {{$coupon->sn}} </td>
                                            <td> @if($coupon->logo) <a href="{{$coupon->logo}}" class="fancybox"><img src="{{$coupon->logo}}"/></a> @endif </td>
                                            <td> {!! $coupon->usage_label !!} </td>
                                            <td> {{$coupon->desc}} </td>
                                            <td> {{$coupon->products}} </td>
                                            <td> {{date('Y-m-d', $coupon->available_start)}} 至 {{date('Y-m-d', $coupon->available_end)}} </td>
                                            <td> {!! $coupon->status_label !!} </td>
                                            <td>
                                                @if($coupon->status != '1')
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="delCoupon('{{$coupon->id}}')"> 删除 </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$couponList->total()}} 张卡券</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $couponList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 批量导出卡券
        function exportCoupon() {
            layer.confirm("确定导出所有卡券吗？", {icon:3, title: '提示'}, function (index) {
                window.location.href = '/admin/exportCoupon';

                layer.close(index);
            });
        }

        // 添加卡券
        function addCoupon() {
            window.location.href = '/admin/addCoupon';
        }

        // 删除卡券
        function delCoupon(id) {
            layer.confirm('确定删除该卡券吗？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delCoupon", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 搜索
        function do_search() {
            var sn = $("#sn").val();
            var type = $("#type option:selected").val();

            window.location.href = '/admin/couponList?sn=' + sn + '&type=' + type;
        }

        // 重置
        function do_reset() {
            window.location.href = '/admin/couponList';
        }

        // 查看商品图片
        $(document).ready(function () {
            $('.fancybox').fancybox({
                openEffect: 'elastic',
                closeEffect: 'elastic'
            })
        })
    </script>
@endsection
