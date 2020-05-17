@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="/services">{{trans('home.services')}}</a></li>
                                <li class="breadcrumb-item"><a href="/invoices">{{trans('home.invoices')}}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0">订单票据</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="invoice-title"> {{trans('home.service_name')}} </th>
                                    <th class="invoice-title"> 每月流量</th>
                                    <th class="invoice-title"> 计费周期</th>
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
                    <hr>
                    <div class="container-fluid mt-1">
                        <div class="row invoice-subtotal">
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title">{{trans('home.invoice_table_id')}}</h2>
                                <p>{{$order->payment->trade_no}}</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title">付费时间</h2>
                                <p>{{$order->paid_at}}</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title">{{trans('home.invoice_table_pay_way')}}</h2>
                                <p>{{$order->payment_method_label}}</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title">{{trans('home.coupon')}}</h2>
                                <p>{{$order->coupon ? $order->coupon->name : '未使用'}}</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title"> {{trans('home.service_subtotal_price')}} </h2>
                                <p> ￥{{$order->subtotal}}  </p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title"> 余额抵扣 </h2>
                                <p> ￥{{$order->credit}} </p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title"> 实际支付 </h2>
                                <p> ￥{{$order->amount}} </p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <h2 class="title"> 状态 </h2>
                                <p> {!! $order->payment->status_label !!} </p>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <button class="btn btn-info" onclick="javascript:window.print();">打印</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection