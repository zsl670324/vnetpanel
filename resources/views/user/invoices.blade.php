@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top: 0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold">{{trans('home.invoice_title')}}</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light table-checkable order-column">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> {{trans('home.invoice_table_id')}} </th>
                                        <th> {{trans('home.invoice_table_name')}} </th>
                                        <th> 计费周期 </th>
                                        <th> 实付金额 </th>
                                        <th> 创建时间 </th>
                                        <th> 付款时间 </th>
                                        <th> 下次出账时间 </th>
                                        <th> 下次流量重置时间 </th>
                                        <th> {{trans('home.invoice_table_status')}} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($orderList->isEmpty())
                                    <tr>
                                        <td colspan="10"><h3>{{trans('home.invoice_table_none')}}</h3></td>
                                    </tr>
                                @else
                                    @foreach($orderList as $key => $order)
                                        <tr class="odd gradeX">
                                            <td>{{$key + 1}}</td>
                                            <td><a href="/invoice/{{$order->payment->trade_no}}">{{$order->payment->trade_no}}</a></td>
                                            <td>{{empty($order->product) ? trans('home.invoice_table_goods_deleted') : $order->product->name}}</td>
                                            <td>{{getCycleLabel($order->cycle)}}</td>
                                            <td>￥{{$order->amount}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->paid_at}}</td>
                                            <td>{{$order->bill_at}}</td>
                                            <td>{{$order->reset_at}}</td>
                                            <td>
                                                @if($order->status == -1)
                                                    <a href="javascript:;" class="btn btn-sm default disabled"> 已失效 </a>
                                                @elseif($order->status == 1)
                                                    <a href="javascript:;" class="btn btn-sm green"> 使用中 </a>
                                                @else
                                                    @if($order->payment->status == 0 && $order->payment->qrcode)
                                                        <a href="/payment/{{$order->payment->trade_no}}" class="btn btn-sm blue"> 去支付 </a>
                                                    @else
                                                        <a href="javascript:;" class="btn btn-sm dark disabled"> 未支付 </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
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
@endsection
