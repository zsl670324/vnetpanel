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
                                <li class="breadcrumb-item active" aria-current="page">{{trans('home.invoices')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{trans('home.invoices')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"> #</th>
                                <th> {{trans('home.invoice_table_id')}} </th>
                                <th> {{trans('home.invoice_table_name')}} </th>
                                <th> 计费周期</th>
                                <th> 实付金额</th>
                                <th> 创建时间</th>
                                <th> 付款时间</th>
                                <th> 下次出账时间 </th>
                                <th> 下次流量重置时间 </th>
                                <th> {{trans('home.invoice_table_status')}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($orderList->isEmpty())
                                <tr>
                                    <td colspan="10" style="text-align: center;">
                                        {{trans('home.invoice_table_none')}}
                                    </td>
                                </tr>
                            @else
                                @foreach($orderList as $key => $order)
                                    <tr class="odd gradeX">
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            @if($order->payment->status == 0 && $order->payment->qrcode)
                                                <a class="btn btn-danger btn-sm"
                                                   href="/payment/{{$order->payment->trade_no}}">{{$order->payment->trade_no}}</a>
                                            @else
                                                <a class="btn btn-secondary btn-sm"
                                                   href="/invoice/{{$order->payment->trade_no}}">{{$order->payment->trade_no}}</a>
                                            @endif
                                        </td>
                                        <td>{{empty($order->product) ? trans('home.invoice_table_goods_deleted') : $order->product->name}}</td>
                                        <td>{{getCycleLabel($order->cycle)}}</td>
                                        <td>￥{{$order->amount}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->paid_at}}</td>
                                        <td>{{$order->bill_at}}</td>
                                        <td>{{$order->reset_at}}</td>
                                        <td>
                                            @if($order->status == -1)
                                                <a href="javascript:;" class="btn btn-danger btn-sm disabled"> 已失效 </a>
                                            @elseif($order->status == 1)
                                                <a href="javascript:;" class="btn btn-primary btn-sm"> 使用中 </a>
                                            @else
                                                @if($order->payment->status == 0 && $order->payment->qrcode)
                                                    <a href="/payment/{{$order->payment->trade_no}}"
                                                       class="btn btn-info btn-sm"> 去支付 </a>
                                                @else
                                                    <a href="javascript:;" class="btn btn-dark btn-sm disabled">
                                                        未支付 </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $orderList->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection