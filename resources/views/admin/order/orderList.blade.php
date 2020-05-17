@extends('admin.layouts')
@section('css')
    <style type="text/css">
        input,select {
            margin-bottom: 5px;
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
                        <div class="caption">
                            <span class="caption-subject font-dark">订单列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="username" value="{{Request::get('username')}}" id="username" placeholder="用户名" onkeydown="if(event.keyCode==13){do_search();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="trade_no" value="{{Request::get('trade_no')}}" id="trade_no" placeholder="订单号" onkeydown="if(event.keyCode==13){do_search();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="is_coupon" id="is_coupon" onchange="doSearch()">
                                    <option value="" @if(Request::get('is_coupon') == '') selected @endif>使用优惠券</option>
                                    <option value="0" @if(Request::get('is_coupon') == '0') selected @endif>否</option>
                                    <option value="1" @if(Request::get('is_coupon') == '1') selected @endif>是</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="payment_method" id="payment_method" onchange="doSearch()">
                                    <option value="" @if(Request::get('payment_method') == '') selected @endif>支付方式</option>
                                    <option value="0" @if(Request::get('payment_method') == '0') selected @endif>余额支付</option>
                                    <option value="1" @if(Request::get('payment_method') == '1') selected @endif>支付宝</option>
                                    <option value="2" @if(Request::get('payment_method') == '2') selected @endif>微信</option>
                                    <option value="3" @if(Request::get('payment_method') == '3') selected @endif>财付通</option>
                                    <option value="4" @if(Request::get('payment_method') == '4') selected @endif>QQ钱包</option>
                                    <option value="5" @if(Request::get('payment_method') == '5') selected @endif>京东支付</option>
                                    <option value="6" @if(Request::get('payment_method') == '6') selected @endif>云闪付</option>
                                    <option value="7" @if(Request::get('payment_method') == '7') selected @endif>翼支付</option>
                                    <option value="8" @if(Request::get('payment_method') == '8') selected @endif>PayPal</option>
                                    <option value="9" @if(Request::get('payment_method') == '9') selected @endif>ApplePay</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="status" id="status" onchange="doSearch()">
                                    <option value="" @if(Request::get('status') == '') selected @endif>订单状态</option>
                                    <option value="-1" @if(Request::get('status') == '-1') selected @endif>已失效</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>待支付</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>已支付</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="form-control" name="time" id="range_time" placeholder="创建时间" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="mt-radio-inline" style="padding-top: 5px; padding-bottom: 0;">
                                    <label class="mt-radio">
                                        <input type="radio" name="sort" value="1" checked onchange="doSearch()"> 升序
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="sort" value="0" @if(Request::get('sort') == '0') checked @endif onchange="doSearch()"> 降序
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <button type="button" class="btn blue" onclick="doSearch();">查询</button>
                                <button type="button" class="btn grey" onclick="doReset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> 用户 </th>
                                        <th> 订单号 </th>
                                        <th> 商品 </th>
                                        <th> 优惠券 </th>
                                        <th> 计费周期 </th>
                                        <th> 小计 </th>
                                        <th> 余额抵扣 </th>
                                        <th> 实付金额 </th>
                                        <th> 支付时间 </th>
                                        <th> 支付网关 </th>
                                        <th> 支付方式 </th>
                                        <th> 订单状态 </th>
                                        <th> 创建时间 </th>
                                        <th> 下次出账时间 </th>
                                        <th> 流量重置时间 </th>
                                        <th> IP </th>
                                        <th> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orderList->isEmpty())
                                        <tr>
                                            <td colspan="18" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($orderList as $order)
                                            <tr>
                                                <td> {{$order->oid}} </td>
                                                <td>
                                                    @if(empty($order->user) )
                                                        【用户不存在】
                                                    @else
                                                        <a href="/admin/userList?id={{$order->user->id}}" target="_blank"> {{$order->user->username}} </a>
                                                    @endif
                                                </td>
                                                <td> <a href="/admin/orderList?trade_no={{$order->payment->trade_no}}">{{$order->payment->trade_no}}</a> </td>
                                                <td> {{$order->product->name}} </td>
                                                <td> {{$order->coupon ? $order->coupon->name . ' - ' . $order->coupon->sn : ''}} </td>
                                                <td> {{getCycleLabel($order->cycle)}} </td>
                                                <td> ￥{{$order->subtotal}} </td>
                                                <td> ￥{{$order->credit}} </td>
                                                <td> ￥{{$order->amount}} </td>
                                                <td> {{$order->paid_at}} </td>
                                                <td> {{$order->payment_gateway_label}} </td>
                                                <td> <span class="label label-info"> {{$order->payment_method_label}} </span> </td>
                                                <td> {!! $order->status_label !!} </td>
                                                <td> {{$order->created_at}} </td>
                                                <td> {{$order->bill_at}} </td>
                                                <td> {{$order->reset_at}} </td>
                                                <td> <a href="https://ip.sb/ip/{{$order->ip}}" target="_blank">{{$order->ip}}</a> </td>
                                                <td>
                                                    @if($order->status == 0)
                                                        <button type="button" class="btn btn-sm red btn-outline" onclick="closeOrder('{{$order->oid}}')"> 关闭 </button>
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
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$orderList->total()}} 个订单</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $orderList->links() }}
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
    <script src="/assets/global/plugins/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 有效期
        laydate.render({
            elem: '#range_time',
            type: 'datetime',
            range: '至',
            value: '{{urldecode(Request::get('range_time'))}}'
        });

        // 搜索
        function doSearch() {
            var username = $("#username").val();
            var trade_no = $("#trade_no").val();
            var is_coupon = $("#is_coupon").val();
            var payment_method = $("#payment_method").val();
            var status = $("#status").val();
            var sort = $("input:radio[name='sort']:checked").val();
            var range_time = $("#range_time").val();

            window.location.href = '/admin/orderList?username=' + username + '&trade_no=' + trade_no + '&is_coupon=' + is_coupon + '&payment_method=' + payment_method + '&status=' + status + '&sort=' + sort + '&range_time=' + range_time;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/orderList';
        }

        // 手动关闭订单
        function closeOrder(oid) {
            layer.confirm('确定关闭该订单？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/closeOrder", {oid:oid, _token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }
    </script>
@endsection
