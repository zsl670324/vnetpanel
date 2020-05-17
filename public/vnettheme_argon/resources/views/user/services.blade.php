@extends('user.layouts')
@section('css')
    <link rel="stylesheet" type="text/css" href="/argon/css/price.css?v1.{{time()}}">
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
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{trans('home.services')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--5">
        <div class="row">
            <div class="col-12">
                @if($productList->isEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">商品列表</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12" style="text-align: center;">
                                <strong>无可用服务</strong>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row card-wrapper">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0">购买说明</h3>
                                </div>
                                <div class="card bg-gradient-Secondary">
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="description badge-dot mr-4"><strong>新用户请确定了解本站规则后再购买!老用户续费后请重新更新订阅!</strong>
                                            </p>
                                            <p class="description badge-dot mr-4"><i class="bg-warning"></i>在套餐生效的时间内，您将获得「套餐对应的网络速度」、「套餐内相应的流量」及其它特权。
                                            </p>
                                            <p class="description badge-dot mr-4"><i class="bg-warning"></i>基础套餐每月将会重置一次流量，重置日为每月购买日。
                                            </p>
                                            <p class="description badge-dot mr-4"><i class="bg-warning"></i>如在套餐未到期的情况下购买新套餐，则会导致旧套餐的所有配置立即失效，新套餐的配置立即生效。
                                            </p>
                                            <p class="description badge-dot mr-4"><strong>其他说明：</strong></p>
                                            <p class="description badge-dot mr-4"><i class="bg-warning"></i>仅对节点可用性做相关技术支持,因自身网络环境或客户端设置原因造成的节点使用问题,不提供免费协助.
                                            </p>
                                            <p class="description badge-dot mr-4"><i class="bg-warning"></i>购买前请确认自身网络环境,如购买后无法使用.请先浏览帮助中心教程.如果无法解决再<a
                                                        class="btn btn-{{config('theme.bg_color')}} btn-sm" href="/tickets">申请工单</a>帮助</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row card-wrapper">
                        @foreach($productList as $key => $product)
                            <div class="@if(config('theme.product_card')==4)col-lg-3 @else col-lg-4 @endif  col-md-6 col-sm-6">
                                <div class="card card-pricing border-0 text-center mb-2">
                                    <div class="card-header bg-gradient-{{config('theme.bg_color')}}">
                                        <h4 class="text-uppercase ls-1 text-white py-3 mb-0">{{$product->name}}</h4>
                                    </div>
                                    <div class="card-body @if(config('theme.product_card')==4)px-lg-3 @else px-lg-6 @endif">
                                        @if( $product->id == config('theme.product_id_1') )
                                            <div class="display-2">￥{{config('theme.show_price_1')}}</div>
                                            <span class=" text-blue">/ {{config('theme.show_cycle_1')}} </span>
                                        @elseif( $product->id == config('theme.product_id_2') )
                                            <div class="display-2">￥{{config('theme.show_price_2')}}</div>
                                            <span class=" text-blue">/ {{config('theme.show_cycle_2')}} </span>
                                        @elseif( $product->id == config('theme.product_id_3') )
                                            <div class="display-2">￥{{config('theme.show_price_3')}}</div>
                                            <span class=" text-blue">/ {{config('theme.show_cycle_3')}} </span>
                                        @else
                                            <div class="display-2">￥{{$product->monthly}}</div>
                                            <span class=" text-blue">/ 月 </span>
                                        @endif
                                        @if($product->hot)
                                            <span class="badge bg-danger"
                                                  style="padding: 7px 15px;font-weight: 600;color: #fff;border-radius: 60px;font-size: 18px;">
                                                <i class="fas fa-fire" style="font-size: 18px;"> 热销</i>
                                            </span>
                                        @endif
                                        <ul class="list-unstyled my-4">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="icon icon-xs icon-shape bg-gradient-{{config('theme.bg_color')}} text-white rounded-circle">
                                                            <i class="fas fa-terminal"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="pl-2 text-sm"><b>每月流量：</b><span
                                                                    style="color:orangered;"> {{$product->traffic_label}}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="icon icon-xs icon-shape bg-gradient-{{config('theme.bg_color')}} text-white rounded-circle">
                                                            <i class="fas fa-pen-fancy"></i>
                                                        </div>
                                                    </div>
                                                    <span class="pl-2 text-sm"><b>授予等级：</b> <span
                                                                style="color:deepskyblue;"> {{$product->level_label}}</span>
                                                    </span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="icon icon-xs icon-shape bg-gradient-{{config('theme.bg_color')}} text-white shadow rounded-circle">
                                                            <i class="fas fa-pen-fancy"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="pl-2 text-sm">
                                                            @if($product->speed >= 0)
                                                                <b>授予速率：</b> <span
                                                                        style="color:red;">{{$product->speed_label}}</span>
                                                            @else
                                                                <b>授予速率：</b> <span
                                                                        style="color:red;">{{formatNetSpeed($product->speed)}}</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="icon icon-xs icon-shape bg-gradient-{{config('theme.bg_color')}} text-white shadow rounded-circle">
                                                            <i class="fas fa-pen-fancy"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="pl-2 text-sm">
                                                            @if($product->invite_qty)<b>赠邀请码：</b>
                                                            <span style="color:red;">{{$product->invite_qty}} </span>
                                                            枚
                                                            @else
                                                                <b>赠邀请码：</b> <span style="color:red;">0 </span>
                                                                枚@endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="icon icon-xs icon-shape bg-gradient-{{config('theme.bg_color')}} text-white shadow rounded-circle">
                                                            <i class="fas fa-hdd"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="pl-2 text-sm">
                                                            @if($product->limit_qty)
                                                                <b>限购 </b>{{$product->limit_qty}} 次
                                                            @else
                                                                不限购
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <p>{{$product->description}}</p>
                                    </div>
                                    <a href="/purchase/{{$product->id}}">
                                        <div class="card-footer bg-gradient-{{config('theme.bg_color')}}">
                                            <span class="text-white"><i class="fa fa-arrow-right"></i> {{trans('home.service_buy_button')}} </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="row card-wrapper">
                    <div class="col">
                        <div class="card">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
    </script>
@endsection