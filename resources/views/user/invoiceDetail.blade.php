@extends('user.layouts')
@section('css')
    <link href="/assets/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="invoice-content-2 bordered">
            <div class="row invoice-body">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="invoice-title"> {{trans('home.service_name')}} </th>
                                <th class="invoice-title"> 每月流量 </th>
                                <th class="invoice-title"> 计费周期 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">{{$order->product->name}}</td>
                                <td>{{$order->product->traffic_label}}</td>
                                <td>{{getCycleLabel($order->cycle)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row invoice-subtotal">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2 class="invoice-title">{{trans('home.invoice_table_id')}}</h2>
                    <p class="invoice-desc">{{$order->payment->trade_no}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title">付费时间</h2>
                    <p class="invoice-desc">{{$order->paid_at}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title">{{trans('home.invoice_table_pay_way')}}</h2>
                    <p class="invoice-desc">{{$order->payment_method_label}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title">{{trans('home.coupon')}}</h2>
                    <p class="invoice-desc">{{$order->coupon ? $order->coupon->name : '未使用'}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title"> {{trans('home.service_subtotal_price')}} </h2>
                    <p class="invoice-desc"> ￥{{$order->subtotal}} </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title"> 余额抵扣 </h2>
                    <p class="invoice-desc grand-total"> ￥{{$order->credit}} </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title"> 实际支付 </h2>
                    <p class="invoice-desc grand-total"> ￥{{$order->amount}} </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h2 class="invoice-title"> 状态 </h2>
                    <p class="invoice-desc grand-total"> {!! $order->payment->status_label !!} </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-lg green-haze hidden-print print-btn" onclick="javascript:window.print();">打印明细</a>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
@endsection
