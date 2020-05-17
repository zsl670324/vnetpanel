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
                                <li class="breadcrumb-item"><a href="/invoices">结账</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="#" method="post" class="form-horizontal" onsubmit="return false;">
        <input type="hidden" name="product_id" value="{{$product->id}}"/>
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-gradient-{{config('theme.purchase_color')}} border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{$product->name}}</h5>
                                    <span class="h3 font-weight-bold mb-0 text-white"></span>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">邀请码： {{$product->invite_qty}} 枚</a>
                                        <a class="dropdown-item" href="#">授予等级：{{$product->level_label}} </a>
                                        <a class="dropdown-item" href="#">授予速率： {{$product->speed_label}} </a>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="#"
                                   class="text-nowrap text-white font-weight-600">每月流量：{{$product->traffic_label}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">选择付款周期</h3>
                </div>
                <div class="card-body">
                    <div class="mt-radio-inline">
                    	@if( $product->monthly != config('theme.product_price') )
                        <label class="mt-radio">
                            <input type="radio" name="cycle" value="monthly"
                                   data-amount="{{$product->monthly}}"> <a class="btn btn-outline-default">按月付</a>
                            <span></span>
                        </label>
                        @endif
                    	@if( $product->quarterly != config('theme.product_price') )
                        <label class="mt-radio">
                            <input type="radio" name="cycle" value="quarterly"
                                   data-amount="{{$product->quarterly}}"> <a class="btn btn-outline-primary">季度付</a>
                            <span></span>
                        </label>
                        @endif
                    	@if( $product->semiannual != config('theme.product_price') )
                        <label class="mt-radio">
                            <input type="radio" name="cycle" value="semiannual"
                                   data-amount="{{$product->semiannual}}"> <a class="btn btn-outline-warning">半年付</a>
                            <span></span>
                        </label>
                        @endif
                    	@if( $product->annual != config('theme.product_price') )
                        <label class="button">
                            <input type="radio" name="cycle" value="annual"
                                   data-amount="{{$product->annual}}"> <a class="btn btn-outline-info">一年付</a>
                            <span></span>
                        </label>
                        @endif
                    	@if( $product->biennial != config('theme.product_price') )
                        <label class="mt-radio">
                            <input type="radio" name="cycle" value="biennial"
                                   data-amount="{{$product->biennial}}"> <a class="btn btn-outline-success">二年付</a>
                            <span></span>
                        </label>
                        @endif
                    	@if( $product->triennial != config('theme.product_price') )
                        <label class="mt-radio">
                            <input type="radio" name="cycle" value="triennial"
                                   data-amount="{{$product->triennial}}"> <a class="btn btn-outline-danger">三年付</a>
                            <span></span>
                        </label>
                        @endif
                    </div>
                    <hr/>
                    <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <input type="text" class="form-control" name="coupon_sn" id="coupon_sn"
                               placeholder="{{trans('home.coupon')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="redeemCoupon()"><i
                                        class="fas fa-sync"></i> 使用
                            </button>
                        </div>
                    </div>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead>
                            <tr>
                                <th class="text-center"> 小计</th>
                                <th class="text-center"> 优惠</th>
                                <th class="text-center"> 总计</th>
                                <th class="text-center"> 余额抵扣</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">
                                    <h2><span id="productAmount">0</span></h2>
                                </td>
                                <td class="text-center"> ￥<span id="couponAmount">0</span></td>
                                <td class="text-center"> ￥<span id="totalAmount">0</span></td>
                                <td class="text-center"> ￥<span id="creditAmount">0</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container-fluid mt-1">
                        <div class="row">
                            <div class="col-6">
                                @if(Auth::user()->credit)
                                    <p> 帐号余额：<span id="credit">{{Auth::user()->credit}}</span>元 </p>
                                    <div class="mt-checkbox">
                                        <label class="mt-checkbox">

                                            <label class="custom-toggle">
                                                <input type="checkbox" name="useCredit" value="0" id="useCredit">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="关闭"
                                                      data-label-on="抵扣"></span>
                                            </label>
                                        </label>
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <p class="text-right"> {{trans('home.service_total_price')}} </p>
                                <h2 class="text-right"> ￥<span id="amount">0</span></h2>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @if (1==1)
                    {!! $purchaseMethodHTML !!}
                    @else
                    <div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="type" value="alipay" checked> <img src="/assets/images/alipay.svg" height="40px" />
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <span>  </span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="type" value="wxpay"> <img src="/assets/images/wechatpay.svg" height="40px" />
                                <span></span>
                            </label>
                            @if (1==2)
                            <label class="mt-radio">
                                <input type="radio" name="type" value="qqpay"> <img src="/assets/images/qpay.svg" height="50px" />
                                <span></span>
                            </label>
                            <!--
                            <label class="mt-radio">
                                <input type="radio" name="type" value="jdpay"> <img src="/assets/images/jdpay.svg" height="50px" />
                                <span></span>
                            </label>
                            -->
                            @endif
                        </div>
                    	</div>
                </div>
                            @endif
                    <hr/>
                    @if($purchaseButtonHTML)
                        {!! $purchaseButtonHTML !!}
                    @else
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" onclick="pay()">立即支付</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 选择计费周器
        $("input:radio[name='cycle']").on("change", function () {
            $("#productAmount, #totalAmount, #amount").text($("input:radio[name='cycle']:checked").data('amount').toFixed(2));
            $("#couponAmount, #creditAmount").text(0);
            $("#coupon_sn").val('');
            $("#coupon_sn").parent().removeClass("has-success");
            $(".input-group-prepend").remove();
            $("#useCredit").prop("checked", false);
        });

        // 校验优惠券是否可用
        function redeemCoupon() {
            var cycle = $("input:radio[name='cycle']:checked").val();
            var coupon_sn = $('#coupon_sn').val();
            var productAmount = $("#productAmount").text();

            // 判断是否选中了计费周器
            if (cycle == undefined || cycle == '') {
                ERR('请选择计费周期');
                return false;
            }

            // 去除样式
            $("#coupon_sn").parent().removeClass("has-success");
            $(".input-group-prepend").remove();

            if (coupon_sn == '' || coupon_sn == undefined) {
                $("#couponAmount").text(0);
                $("#totalAmount").text($("#productAmount").text());

                reCalcCreditAmount();

                $("#amount").text($("#totalAmount").text());
                return false;
            }

            $.ajax({
                type: "GET",
                url: "/redeemCoupon/" + coupon_sn,
                success: function (ret) {
                    if (ret.status == 'success') {
                        // 加样式
                        $("#coupon_sn").parent().addClass('has-success');
                        $("#coupon_sn").parent().prepend('<span class="input-group-prepend"><i class="fa fa-check fa-fw"></i></span>');

                        // 计算可以减免金额
                        var total_price = 0;
                        if (ret.data.type == '2') {
                            total_price = productAmount * ret.data.discount / 10;
                        } else {
                            total_price = productAmount - ret.data.amount;
                            total_price = total_price > 0 ? total_price : 0;
                        }

                        var couponAmount = (productAmount - total_price).toFixed(2);
                        $("#couponAmount").text(couponAmount);
                        $("#totalAmount").text(total_price.toFixed(2));

                        reCalcCreditAmount();

                        $("#amount").text(($("#totalAmount").text() - $("#creditAmount").text()).toFixed(2));
                    } else {
                        $("#couponAmount").text(0);
                        $("#totalAmount").text($("#productAmount").text());

                        reCalcCreditAmount();

                        $("#amount").text(($("#totalAmount").text() - $("#creditAmount").text()).toFixed(2));

                        ERR(ret.message);

                        $("#coupon_sn").val('').focus();
                    }
                }
            });
        }

        // 使用余额
        $("input:checkbox[name='useCredit']").change(function () {
            var cycle = $("input:radio[name='cycle']:checked").val();

            // 判断是否选中了计费周器
            if (cycle == undefined || cycle == '') {
                ERR('请选择计费周期');
                $(this).prop("checked", false);
                return false;
            }

            // 每次点击改变value值
            if ($(this).prop("checked")) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }

            redeemCoupon();
            reCalcCreditAmount();

            $("#amount").text(($("#productAmount").text() - $("#couponAmount").text() - $("#creditAmount").text()).toFixed(2));
        });

        // 重新计算余额抵扣值
        function reCalcCreditAmount() {
            if ($("#useCredit").prop("checked")) {
                OK('余额抵扣成功！')
                if ($("#credit").text() - $("#totalAmount").text() >= 0) {
                    $("#creditAmount").text($("#totalAmount").text());
                } else {
                    $("#creditAmount").text($("#credit").text());
                }
            } else {
                $("#creditAmount").text(0);
            }
        }

        // 支付
        function pay() {
            var product_id = '{{$product->id}}';
            var coupon_sn = $('#coupon_sn').val();
            var useCredit = $('#useCredit').val();
            var cycle = $("input:radio[name='cycle']:checked").val();
            var type = $("input:radio[name='type']:checked").val();
            var index;

            if (cycle == undefined || cycle == '') {
                ERR('请选择计费周期');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/payment/purchase",
                async: false,
                data: {
                    _token: '{{csrf_token()}}',
                    product_id: product_id,
                    coupon_sn: coupon_sn,
                    useCredit: useCredit,
                    cycle: cycle,
                    type: type
                },
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'success') {
                        OK(ret.message);
                        if (ret.data.qrcode.length > 0) { // 如果第三方支付返回的是支付二维码，则跳到支付二维码渲染页
                            window.location.href = '/payment/' + ret.data.trade_no;
                        } else if (ret.data.url.length > 0) { // 如果第三方支付需要跳转支付的则跳转
                            window.location.href = ret.data.url;
                        } else {
                            window.location.href = '/invoices';
                        }
                    } else {
                        ERR(ret.message);
                    }
                }
            });

            return false;
        }
    </script>

    <!-- 自定义JS代码 -->
    {!! $purchaseScript !!}
@endsection
