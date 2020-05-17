@extends('user.layouts')
@section('css')
    <style type="text/css">
        .mod-title {
            line-height: 60px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            background: #fff;
            margin-top: 0px;
        }

        .mod-title .ico-wechat {
            display: inline-block;
            width: 41px;
            height: 36px;
            background: url("/assets/images/wechat-pay.png") 0 -115px no-repeat;
            vertical-align: middle;
            margin-right: 7px
        }

        .mod-title .text {
            font-size: 20px;
            color: #333;
            font-weight: normal;
            vertical-align: middle
        }

        .mod-ct {
            width: 100% !important;
            padding: 0 135px;
            margin: 0 auto;
            margin-top: 15px;
            background: #fff url("/assets/images/wave.png") top center repeat-x;
            text-align: center;
            color: #333; /* border:1px solid #e5e5e5; */
            border-top: none;
        }

        .mod-ct .order {
            font-size: 20px;
            padding-top: 30px
        }

        .mod-ct .amount {
            font-size: 48px;
            margin-top: 20px
        }

        .mod-ct .qr-image {
            margin-top: 30px
        }

        .mod-ct .qr-image img {
            width: 230px;
            height: 230px
        }

        .mod-ct .detail {
            margin-top: 60px;
            padding-top: 25px
        }

        .mod-ct .detail .detail-ct {
            display: none;
            font-size: 14px;
            text-align: right;
            line-height: 28px
        }

        .mod-ct .detail .detail-ct dt {
            font-weight: 400;
            float: left
        }

        .mod-ct .detail .detail-ct dd {
            line-height: 28px;
        }

        .mod-ct .detail-open {
            border-top: 1px solid #e5e5e5;
        }

        .mod-ct .detail .arrow {
            padding: 6px 34px;
            border: 1px solid #e5e5e5
        }

        .mod-ct .detail .arrow .ico-arrow {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url("/assets/images/wechat-pay.png") -25px -100px no-repeat
        }

        .mod-ct .detail-open .arrow .ico-arrow {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url("/assets/images/wechat-pay.png") 0 -100px no-repeat
        }

        .mod-ct .detail-open .detail-ct {
            display: block
        }

        .mod-ct .tip {
            margin-top: 40px;
            border-top: 1px dashed #e5e5e5;
            padding: 30px 0;
            position: relative
        }

        .mod-ct .tip .ico-scan {
            display: inline-block;
            width: 56px;
            height: 55px;
            background: url("/assets/images/wechat-pay.png") 0 0 no-repeat;
            vertical-align: middle;
            *display: inline;
            *zoom: 1
        }

        .mod-ct .tip .tip-text {
            display: inline-block;
            vertical-align: middle;
            text-align: left;
            margin-left: 23px;
            font-size: 16px;
            line-height: 28px;
            *display: inline;
            *zoom: 1
        }

        .mod-ct .tip .tip-text p {
            margin: 0;
            padding: 0;
        }

        .mod-ct .tip .dec {
            display: inline-block;
            width: 22px;
            height: 45px;
            background: url("/assets/images/wechat-pay.png") 0 -55px no-repeat;
            position: absolute;
            top: -23px
        }

        .mod-ct .tip .dec-left {
            background-position: 0 -55px;
            left: -136px
        }

        .mod-ct .tip .dec-right {
            background-position: -25px -55px;
            right: -136px
        }

        .mod-title .ico-alipay {
            display: inline-block;
            width: 41px;
            height: 36px;
            background: url("/assets/images/alipay-pay.png") 0 -115px no-repeat;
            vertical-align: middle;
            margin-right: 7px;
        }

        .mod-ct .tip .ico-scan-alipay {
            display: inline-block;
            width: 56px;
            height: 55px;
            background: url("/assets/images/alipay-pay.png") 0 0 no-repeat;
            vertical-align: middle;
        }

        .mod-ct .detail .arrow .ico-arrow-alipay {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url("/assets/images/alipay-pay.png") -25px -100px no-repeat;
        }

        .mod-ct .detail-open .arrow .ico-arrow-alipay {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url("/assets/images/alipay-pay.png") 0 -100px no-repeat
        }

        .open_app {
            margin-top: 30px;
        }

        .open_app > a {
            border: 1px solid #328CE5;
            padding: 10px 20px;
            color: #fff;
            background: #328CE5;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .mod-ct {
                width: 100% !important;
                padding: 0;
            }

            .mod-ct .tip .dec-right {
                display: none;
            }

            .mod-ct .detail {
                margin-top: 30px;
            }

            .mod-ct .detail .detail-ct {
                font-size: 14px;
                text-align: right;
                line-height: 28px;
            }
        }

        #qrcode {
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="page-content" style="padding-top: 0px; min-height: 830px;">
        <h1 class="mod-title">
            @if($payment->order->payment_method == 1)
                <span class="ico-alipay"></span><span class="text">支付宝支付</span>
            @else
                <span class="ico-wechat"></span><span class="text">微信支付</span>
            @endif
        </h1>
        <div class="mod-ct">
            <div class="order">
            </div>
            <div class="amount">￥{{$payment->amount}}</div>
            <div class="qr-image" id="qrcode">
            </div>
            <div class="detail" id="orderDetail">
                <dl class="detail-ct" style="display: none;">
                    <dt>购买物品</dt>
                    <dd id="productName">{{$payment->order->product->name}}</dd>
                    <dt>商户订单号</dt>
                    <dd id="billId">{{$payment->trade_no}}</dd>
                    <dt>创建时间</dt>
                    <dd id="createTime">{{$payment->created_at}}</dd>
                </dl>
                @if($payment->order->payment_method == 1)
                    <a href="javascript:void(0)" class="arrow"><i class="ico-arrow-alipay"></i></a>
                @else
                    <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
                @endif
            </div>
            <div class="tip">
                <span class="dec dec-left"></span>
                <span class="dec dec-right"></span>
                @if($payment->order->payment_method == 1)
                    <div class="ico-scan-alipay"></div>
                @else
                    <div class="ico-scan"></div>
                @endif
                <div class="tip-text">
                    @if($payment->order->payment_method == 1)
                        <p>请使用支付宝扫一扫</p>
                    @else
                        <p>请使用微信扫一扫</p>
                    @endif
                    <p>扫描二维码完成支付</p>
                </div>
            </div>
            <div class="tip-text">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-qrcode/jquery.qrcode.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            // 生成二维码
            $('#qrcode').qrcode("{{$payment->qrcode}}");

            var r = window.setInterval(function () {
                $.ajax({
                    type: 'GET',
                    url: '/payment/status',
                    data: 'trade_no={{$payment->trade_no}}',
                    dataType: 'json',
                    success: function (ret) {
                        if (ret.status == 'success') {
                            layer.msg("支付成功", {time: 1500});
                            window.clearInterval(r);
                            window.location.href = '/invoices';
                        }
                    }
                });
            }, 2000);

            // 订单详情
            $('#orderDetail .arrow').click(function (event) {
                if ($('#orderDetail').hasClass('detail-open')) {
                    $('#orderDetail .detail-ct').slideUp(500, function () {
                        $('#orderDetail').removeClass('detail-open');
                    });
                } else {
                    $('#orderDetail .detail-ct').slideDown(500, function () {
                        $('#orderDetail').addClass('detail-open');
                    });
                }
            });
        });
    </script>
@endsection
