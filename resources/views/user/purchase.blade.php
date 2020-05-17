@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="row">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold">结账</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <form action="#" method="post" class="form-horizontal" onsubmit="return false;">
                            <input type="hidden" name="product_id" value="{{$product->id}}" />
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <div class="panel-title text-center">
                                                    <h4>{{$product->name}}</h4>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-12">
                                                        <p class="form-control-static"> 每月流量：{{$product->traffic_label}} </p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <p class="form-control-static">邀请码： {{$product->invite_qty}}枚 </p>
                                                    </div>
                                                    <div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-12">
                                                        <p class="form-control-static"> 授予等级：{{$product->level_label}} </p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <p class="form-control-static">授予速率： {{$product->speed_label}} </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-10">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="monthly" data-amount="{{$product->monthly}}"> 月付 x {{$product->monthly}}
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="quarterly" data-amount="{{$product->quarterly}}"> 季付 x {{$product->quarterly}}
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="semiannual" data-amount="{{$product->semiannual}}"> 半年付 x {{$product->semiannual}}
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="annual" data-amount="{{$product->annual}}"> 年付 x {{$product->annual}}
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="biennial" data-amount="{{$product->biennial}}"> 两年付 x {{$product->biennial}}
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="cycle" value="triennial" data-amount="{{$product->triennial}}"> 三年付 x {{$product->triennial}}
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                                                        <span class="help-block">填入优惠券</span>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="coupon_sn" id="coupon_sn" />
                                                            <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" onclick="redeemCoupon()"><i class="fa fa-refresh"></i> 使用 </button>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                                                        当前可用余额：<span id="credit">{{Auth::user()->credit}}</span>元
                                                        @if(Auth::user()->credit && \App\Components\Helpers::systemConfig()['payment_gateway'])
                                                            <div class="mt-checkbox">
                                                                <label class="mt-checkbox">
                                                                    <input type="checkbox" name="useCredit" value="0" id="useCredit" /> 抵扣
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-12">
                                                            <p class="form-control-static"> 小计：<span id="productAmount">0</span> </p>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <p class="form-control-static"> 优惠：<span id="couponAmount">0</span> </p>
                                                        </div>
                                                        <div class="col-md-offset-2 col-md-10 col-sm-offset-2 col-sm-10 col-xs-12">
                                                            <p class="form-control-static"> 总计：<span id="totalAmount">0</span> </p>
                                                        </div>
                                                        <div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-12">
                                                            <p class="form-control-static"> 余额抵扣：<span id="creditAmount">0</span> </p>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <p class="form-control-static"> 实际支付：<span id="amount">0</span> </p>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="padding:20px; margin-bottom:5px; border:1px solid #e0ebf9; background-color:#fafcff;">

                                            <!-- 自定义付款方式HTML -->
                                            {!! $purchaseMethodHTML !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row pull-right">
                                    <div class="col-md-12">
                                        @if($purchaseButtonHTML)
                                            {!! $purchaseButtonHTML !!}
                                        @else
                                            <button type="submit" class="btn btn-lg green" onclick="pay()">立即支付</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 选择计费周器
        $("input:radio[name='cycle']").on("change", function() {
            $("#productAmount, #totalAmount, #amount").text($("input:radio[name='cycle']:checked").data('amount').toFixed(2));
            $("#couponAmount, #creditAmount").text(0);
            $("#coupon_sn").val('');
            $("#coupon_sn").parent().removeClass("has-success");
            $(".input-group-addon").remove();
            $("#useCredit").prop("checked", false);
        });

        // 校验优惠券是否可用
        function redeemCoupon() {
            var cycle = $("input:radio[name='cycle']:checked").val();
            var coupon_sn = $('#coupon_sn').val();
            var productAmount = $("#productAmount").text();

            // 判断是否选中了计费周器
            if (cycle == undefined || cycle == '') {
                layer.msg('请选择计费周期', {time:1000});
                return false;
            }

            // 去除样式
            $("#coupon_sn").parent().removeClass("has-success");
            $(".input-group-addon").remove();

            if (coupon_sn == '' || coupon_sn == undefined) {
                $("#couponAmount").text(0);
                $("#totalAmount").text($("#productAmount").text());

                reCalcCreditAmount();

                $("#amount").text($("#totalAmount").text());
                return false;
            }

            $.ajax({
                type: "GET",
                url: "/redeemCoupon/" + coupon_sn + '/' + '{{$product->id}}',
                success: function (ret) {
                    if (ret.status == 'success') {
                        // 计算可以减免金额
                        var total_price = 0;
                        if (ret.data.type == '2') { // 折扣券
                            total_price = productAmount * ret.data.discount / 10;
                        } else if (ret.data.type == '4') { // 满减券
                            if (productAmount < ret.data.match_amount) {
                                layer.msg("不符合满减条件，该券无法使用", {time:1000});

                                return false;
                            }

                            total_price = productAmount - ret.data.amount;
                        } else { // 抵用券
                            total_price = productAmount - ret.data.amount;
                        }
                        total_price = total_price > 0 ? total_price : 0;

                        var couponAmount = (productAmount - total_price).toFixed(2);
                        $("#couponAmount").text(couponAmount);
                        $("#totalAmount").text(total_price.toFixed(2));

                        reCalcCreditAmount();

                        $("#amount").text(($("#totalAmount").text() - $("#creditAmount").text()).toFixed(2));

                        // 加样式
                        $("#coupon_sn").parent().addClass('has-success');
                        $("#coupon_sn").parent().prepend('<span class="input-group-addon"><i class="fa fa-check fa-fw"></i></span>');
                    } else {
                        $("#couponAmount").text(0);
                        $("#totalAmount").text($("#productAmount").text());

                        reCalcCreditAmount();

                        $("#amount").text(($("#totalAmount").text() - $("#creditAmount").text()).toFixed(2));

                        layer.msg(ret.message, {time: 1000}, function () {
                            $("#coupon_sn").val('').focus();
                        });
                    }
                }
            });
        }

        // 使用余额
        $("input:checkbox[name='useCredit']").change(function() {
            var cycle = $("input:radio[name='cycle']:checked").val();

            // 判断是否选中了计费周器
            if (cycle == undefined || cycle == '') {
                layer.msg('请选择计费周期', {time:1000});
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
                layer.msg('请选择计费周期');
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
                beforeSend: function () {
                    index = layer.load(2, {
                        shade: [0.7,'#CCC']
                    });
                },
                success: function (ret) {
                    layer.close(index);
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            if (ret.data.qrcode.length > 0) { // 如果第三方支付返回的是支付二维码，则跳到支付二维码渲染页
                                window.location.href = '/payment/' + ret.data.trade_no;
                            } else if (ret.data.url.length > 0) { // 如果第三方支付需要跳转支付的则跳转
                                window.location.href = ret.data.url;
                            } else {
                                window.location.href = '/invoices';
                            }
                        }
                    });
                }
            });

            return false;
        }
    </script>

    <!-- 自定义JS代码 -->
    {!! $purchaseScript !!}
@endsection
