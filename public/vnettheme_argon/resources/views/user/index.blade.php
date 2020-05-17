@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-6">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">{{trans('home.home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">欢迎回来</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-6 text-right" id="a_page">
                        <button onclick="S_b();" class="btn btn-sm btn-neutral">
                            <span class="text-warning">  {{trans('home.recharge')}}</span>
                        </button>
                        @if(\App\Components\Helpers::systemConfig()['is_checkin'])
                        <a class="btn btn-sm btn-neutral" href="javascript:checkIn();" data-toggle="sweet-alert"
                           data-sweet-alert="wait">{{trans('home.check_in')}} </a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <a href="/services">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{trans('home.account_expire')}}</h5>
                                            <span class="h2 font-weight-bold mb-0">@if(date('Y-m-d') > Auth::user()->expire_time) {{trans('home.expired')}} @else {{Auth::user()->expire_time}} @endif</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="ni ni-active-40"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{trans('home.services')}}</span>
                                        <span class="text-nowrap">延长期限</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <a href="/services">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{trans('home.account_level')}}</h5>
                                            <span class="h2 font-weight-bold mb-0">{{config('common.level_map')[Auth::user()->level]}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{trans('home.services')}}</span>
                                        <span class="text-nowrap">提升等级</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <a href="javascript:S_b();">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{trans('home.account_balance')}}</h5>
                                            <span class="h2 font-weight-bold mb-0">{{Auth::user()->credit}}元</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="ni ni-money-coins"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 充值余额</span>
                                        <span class="text-nowrap">变身土豪</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <a href="/services">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{trans('home.account_limit_speed')}}</h5>
                                            <span class="h2 font-weight-bold mb-0">{{formatNetSpeed(Auth::user()->speed_limit)}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="ni ni-chart-bar-32"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{trans('home.services')}}</span>
                                        <span class="text-nowrap">提升速度</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--5">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-xl-0">
                <div class="" id="b_page" style="display: none">
                    <div class="card shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0"><i
                                                class="ni ni-bulb-61 ni-lg icon-ver"></i>&nbsp;{{trans('home.recharge_balance')}}
                                    </h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button onclick="S_a();"
                                            class="btn btn-sm btn-danger">{{trans('home.invoice_table_closed')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" style="font-size:16px;">
                                <div class="tab-pane active" id="nav-tab-1">
                                    <form action="#" method="post" enctype="multipart/form-data" class="form-bordered">
                                        <div class="form-group" id="charge_coupon_code">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                            class="input-group-text">{{trans('home.coupon_code')}}</span>
                                                </div>
                                                <input type="text" class="form-control" name="charge_coupon"
                                                       id="charge_coupon"
                                                       placeholder="{{trans('home.please_input_coupon')}}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="return charge();"><i class="fas fa-sync"></i> 使用
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><i
                                            class="ni ni-bell-55 ni-lg icon-ver"></i>&nbsp;{{trans('home.announcement')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($notice)
                            {!!$notice->content!!}
                        @else
                            <div style="text-align: center;">
                                <h3>{{trans('home.no_notice')}}</h3>
                            </div>
                        @endif
                    </div>
                </div>
                @if (config('theme.tutorials_index'))
                    <div class="row">
                        @if (config('theme.windows_id'))
                            <div class="col-lg-6 mb-xl-0">
                                <a href="/article/{{config('theme.windows_id')}}">
                                    <div class="card bg-gradient-primary">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h2 font-weight-bold mb-0 text-white">Windows使用教程</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        <i class="fab fa-windows"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-white mr-2"> <i class="ni ni-curved-next"></i></span>
                                                <span class="text-nowrap text-light">下载程序按步骤配置，带您穿越万里长城</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if (config('theme.ios_id'))
                            <div class="col-lg-6 mb-xl-0">
                                <a href="/article/{{config('theme.ios_id')}}">
                                    <div class="card bg-gradient-dark">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h2 font-weight-bold mb-0 text-white">iOS使用教程</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        <i class="ni ni-mobile-button"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-white mr-2"> <i class="ni ni-curved-next"></i></span>
                                                <span class="text-nowrap text-light">下载程序按步骤配置，带您穿越万里长城</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if (config('theme.android_id'))
                            <div class="col-lg-6 mb-xl-0">
                                <a href="/article/{{config('theme.android_id')}}">
                                    <div class="card bg-gradient-info">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h2 font-weight-bold mb-0 text-white">Android使用教程</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        <i class="fab fa-android"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-white mr-2"> <i class="ni ni-curved-next"></i></span>
                                                <span class="text-nowrap text-light">下载程序按步骤配置，带您穿越万里长城</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if (config('theme.mac_id'))
                            <div class="col-lg-6 mb-xl-0">
                                <a href="/article/{{config('theme.mac_id')}}">
                                    <div class="card bg-gradient-warning">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h2 font-weight-bold mb-0 text-white">Mac使用教程</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        <i class="fab fa-apple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-white mr-2"> <i class="ni ni-curved-next"></i></span>
                                                <span class="text-nowrap text-light">下载程序按步骤配置，带您穿越万里长城</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if (config('theme.linux_id'))
                            <div class="col-lg-6 mb-xl-0">
                                <a href="/article/{{config('theme.linux_id')}}">
                                    <div class="card bg-gradient-danger">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h2 font-weight-bold mb-0 text-white"> Linux使用教程</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                        <i class="fab fa-linux"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-white mr-2"> <i class="ni ni-curved-next"></i></span>
                                                <span class="text-nowrap text-light">下载程序按步骤配置，带您穿越万里长城</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="col-lg-6 mb-xl-0">
                            <a href="/tutorials">
                                <div class="card bg-gradient-secondary">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <span class="h2 font-weight-bold mb-0 text-blue">其他使用说明</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                    <i class="ni ni-satisfied"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm">
                                            <span class="text-blue mr-2"> <i class="ni ni-curved-next"></i></span>
                                            <span class="text-nowrap text-blue">下载程序按步骤配置，带您穿越万里长城</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><i
                                            class="ni ni-sound-wave ni-lg icon-ver"></i>&nbsp;{{trans('home.traffic_log_30days')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-Traffic" class="chart-canvas"></canvas>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <a href="javascript:void(0);"
                               class="btn btn-primary btn-sm">{{trans('home.account_total_traffic')}}
                                ：{{flowAutoShow(Auth::user()->transfer_enable)}}</a>
                            <a href="javascript:void(0);"
                               class="btn btn-info btn-sm">{{trans('home.account_bandwidth_usage')}}
                                ：{{flowAutoShow(Auth::user()->u + Auth::user()->d)}}</a>
                            <a href="javascript:void(0);"
                               class="btn btn-warning btn-sm">剩余流量：{{flowAutoShow(Auth::user()->transfer_enable - Auth::user()->u - Auth::user()->d)}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function checkIn() {
            $.post('/checkIn', function (ret) {
                if (ret.status == 'success') {
                    OK(ret.message);
                } else {
                    Err(ret.message);
                }
            });
        }
    </script>
    <script>
        // 充值
        function charge() {
            var charge_coupon = $("#charge_coupon").val();
            if (charge_coupon == '' || charge_coupon == undefined) {
                ERR("{{trans('home.please_input_coupon')}}");
                return false;
            }
            $.ajax({
                type: "POST",
                url: '/charge',
                data: {_token: '{{csrf_token()}}', coupon_sn: charge_coupon},
                beforeSend: function () {
                    WAIT("{{trans('home.recharging')}}");
                },
                success: function (ret) {
                    if (ret.status == 'fail') {
                        ERR(ret.message);
                        return false;
                    }
                    window.location.reload();
                },
                error: function () {
                    ERR("{{trans('home.error_response')}}");
                },
                complete: function () {
                }
            });
        }
    </script>
    <script>
        var ctx = document.getElementById("chart-Traffic").getContext('2d');
        var canUseTraffic = 100 - ((Number({{Auth::user()->u + Auth::user()->d}}) / Number({{Auth::user()->transfer_enable}})) * 100).toFixed(2);
        var usedTraffic = ((Number({{Auth::user()->u + Auth::user()->d}}) / Number({{Auth::user()->transfer_enable}})) * 100).toFixed(2);
        var myChart = new Chart(ctx, {
            type: 'doughnut',

            data: {
                datasets: [{
                    data: [
                        usedTraffic,
                        canUseTraffic,
                    ],
                    backgroundColor: [
                        '#11cdef',
                        '#5e72e4',

                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    '{{trans('home.account_bandwidth_usage')}}: ' + usedTraffic + ' %',
                    '剩余流量：' + canUseTraffic + ' %',
                ],
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                },
            }
        });
    </script>
@endsection