@extends('user.layouts')
@section('css')
    <link href="/assets/pages/css/pricing.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="pricing-content-1" style="padding-top: 10px;">
                        <div class="row">
                            @if($productList->isEmpty())
                                <div class="col-md-12" style="text-align: center;">
                                    <h2>无可用服务</h2>
                                </div>
                            @else
                                @foreach($productList as $key => $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="price-column-container border-active" style="margin-bottom: 20px;">
                                            <div class="price-table-head bg-blue">
                                                <h2 class="no-margin">{{$product->name}}</h2>
                                            </div>
                                            <div class="arrow-down border-top-blue"></div>
                                            <div class="price-table-pricing">
                                                <h2>￥{{$product->monthly}}<small> / 月</small></h2>
                                                @if($product->hot)
                                                    <div class="price-ribbon">HOT</div>
                                                @endif
                                            </div>
                                            <div class="price-table-content">
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-bar-chart"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">每月流量：{{$product->traffic_label}}</div>
                                                </div>
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-plane"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">授予等级：<span style="color:red;">{{$product->level_label}}</span></div>
                                                </div>
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-energy"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">
                                                        @if($product->speed >= 0)
                                                            授予速率：<span style="color:red;">{{$product->speed_label}}</span>
                                                        @else
                                                            授予速率：{{formatNetSpeed($product->speed)}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-user-follow"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">
                                                        @if($product->invite_qty)
                                                            赠邀请码：<span style="color:red;">{{$product->invite_qty}} 枚</span>
                                                        @else
                                                            赠邀请码：{{$product->invite_qty}} 枚
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding">
                                                        <i class="icon-info"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-left mobile-padding">
                                                        @if($product->limit_qty)
                                                            限购 <span style="color:red;">{{$product->limit_qty}}</span> 次
                                                        @else
                                                            该服务不限购
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($product->description)
                                                    <div class="row mobile-padding">
                                                        <div class="col-xs-3 text-right mobile-padding">
                                                            <i class="icon-info"></i>
                                                        </div>
                                                        <div class="col-xs-9 text-left mobile-padding">{{$product->description}}</div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="arrow-down arrow-grey"></div>
                                            <div class="price-table-footer">
                                                <button type="button" class="btn btn-primary price-button" onclick="purchase('{{$product->id}}')">{{trans('home.service_buy_button')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
    <script type="text/javascript">
        function purchase(product_id) {
            window.location.href = '/purchase/' + product_id;
        }
    </script>
@endsection
