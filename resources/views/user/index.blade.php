@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-6">
                <div class="portlet light">
                    <div class="portlet-body">
                        <ul class="list-inline">
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_expire')}}：</span>
                                    <span class="font-red">@if(date('Y-m-d') > Auth::user()->expire_time) {{trans('home.expired')}} @else {{Auth::user()->expire_time}} @endif</span>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_total_traffic')}}：</span>
                                    <span class="font-red">{{flowAutoShow(Auth::user()->transfer_enable)}}</span>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_bandwidth_usage')}}：</span>
                                    <span class="font-red">{{flowAutoShow(Auth::user()->u + Auth::user()->d)}}</span>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_limit_speed')}}：</span>
                                    <span class="font-red">{{formatNetSpeed(Auth::user()->speed_limit)}}</span>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_level')}}：</span>
                                    <span class="font-red">{{config('common.level_map')[Auth::user()->level]}}</span>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <span class="font-blue">{{trans('home.account_balance')}}：</span>
                                    <span class="font-red">{{Auth::user()->credit}}元</span>
                                </h4>
                            </li>
                            <li>
                                <a class="btn btn-large red" href="#" data-toggle="modal" data-target="#charge_modal" style="color: #FFF;">{{trans('home.recharge')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-directions font-green hide"></i>
                            <span class="caption-subject font-blue bold"> {{trans('home.announcement')}} </span>
                        </div>
                        <div class="actions">
                            @if(\App\Components\Helpers::systemConfig()['is_checkin'])
                            <span class="caption-subject">
                                <a class="btn btn-sm blue" href="javascript:checkIn();"> {{trans('home.check_in')}} </a>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            @if($notice)
                                {!!$notice->content!!}
                            @else
                                <div style="text-align: center;">
                                    <h3>{{trans('home.no_notice')}}</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>

    <!-- 充值 -->
    <div id="charge_modal" class="modal fade" tabindex="-1" data-focus-on="input:first" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{trans('home.recharge_balance')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none; text-align: center;" id="charge_msg"></div>
                    <form action="#" method="post" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="charge_type" class="col-md-4 control-label">{{trans('home.payment_method')}}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="charge_type" id="charge_type">
                                        <option value="1" selected>{{trans('home.coupon_code')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="charge_coupon_code">
                                <label for="charge_coupon" class="col-md-4 control-label"> {{trans('home.coupon_code')}} </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="charge_coupon" id="charge_coupon" placeholder="{{trans('home.please_input_coupon')}}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">{{trans('home.close')}}</button>
                    <button type="button" class="btn red btn-outline" onclick="return charge();">{{trans('home.recharge')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/echarts/echarts.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // 签到
        function checkIn() {
            $.post('/checkIn', function(ret) {
                if (ret.status == 'success') {
                    layer.alert(ret.message, {icon:1, title:'提示'});
                } else {
                    layer.alert(ret.message, {icon:2, title:'提示'})
                }
            });
        }

        // 充值
        function charge() {
            var charge_coupon = $("#charge_coupon").val();

            if (charge_coupon == '' || charge_coupon == undefined) {
                $("#charge_msg").show().html("{{trans('home.coupon_not_empty')}}");
                $("#charge_coupon").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                url: '/charge',
                data: {_token: '{{csrf_token()}}', coupon_sn: charge_coupon},
                beforeSend: function () {
                    $("#charge_msg").show().html("{{trans('home.recharging')}}");
                },
                success: function (ret) {
                    if (ret.status == 'fail') {
                        $("#charge_msg").show().html(ret.message);
                        return false;
                    }

                    $("#charge_modal").modal("hide");
                    layer.msg("充值成功", {time: 1000}, function () {
                        window.location.reload();
                    })
                },
                error: function () {
                    $("#charge_msg").show().html("{{trans('home.error_response')}}");
                },
                complete: function () {}
            });
        }
    </script>
@endsection
