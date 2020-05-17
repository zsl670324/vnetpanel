@extends('admin.layouts')
@section('css')
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-soft">
                                <span data-counter="counterup" data-value="{{$totalUserCount}}"></span>
                            </h3>
                            <small>总用户</small>
                        </div>
                        <div class="icon">
                            <i class="icon-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?enable=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-soft">
                                <span data-counter="counterup" data-value="{{$enableUserCount}}"></span>
                            </h3>
                            <small>有效用户</small>
                        </div>
                        <div class="icon">
                            <i class="icon-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?active=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$activeUserCount}}">0</span>
                            </h3>
                            <small>活跃用户（{{$expireDays}}日内）</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?unActive=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$unActiveUserCount}}">0</span>
                            </h3>
                            <small>休眠用户</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?online=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$onlineUserCount}}">0</span>
                            </h3>
                            <small>当前在线</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?expireWarning=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$expireWarningUserCount}}">0</span>
                            </h3>
                            <small>临近到期（{{$expireDays}}日内）</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?largeTraffic=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$largeTrafficUserCount}}">0</span>
                            </h3>
                            <small>流量大户</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/userList?flowAbnormal=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$flowAbnormalUserCount}}">0</span>
                            </h3>
                            <small>流量异常</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/nodeList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp">
                                <span data-counter="counterup" data-value="{{$nodeCount}}"></span>
                            </h3>
                            <small>节点</small>
                        </div>
                        <div class="icon">
                            <i class="icon-list"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/trafficLog');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp"> {{$totalTransfer}} </h3>
                            <small>总流量（单向、倍率）</small>
                        </div>
                        <div class="icon">
                            <i class="icon-speedometer"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/trafficLog');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp"> {{$monthTransfer}} </h3>
                            <small>本月流量（单向、倍率）</small>
                        </div>
                        <div class="icon">
                            <i class="icon-speedometer"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/trafficLog');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp"> {{$todayTransfer}} </h3>
                            <small>今日流量（单向、倍率）</small>
                        </div>
                        <div class="icon">
                            <i class="icon-speedometer"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/orderList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$totalOrder}}"></span>
                            </h3>
                            <small>总订单数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" onclick="skip('/admin/orderList');">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$totalOnlinePayOrder}}"></span>
                            </h3>
                            <small>在线支付订单数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/admin/orderList?status=2');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$totalSuccessOrder}}"></span>
                            </h3>
                            <small>已支付订单数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" onclick="skip('/admin/orderList?status=2&range_time={{date('Y-m-d 00:00:00') . ' 至 ' . date('Y-m-d 23:59:59')}}');">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$todaySuccessOrder}}"></span>
                            </h3>
                            <small>今日已支付订单数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                ￥<span data-counter="counterup" data-value="{{$todayOnlinePayOrderAmount}}"></span>
                            </h3>
                            <small>今日在线支付金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                ￥<span data-counter="counterup" data-value="{{$totalCredit}}"></span>
                            </h3>
                            <small>账户总余额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('admin/userRebateList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                ￥<span data-counter="counterup" data-value="{{$totalWaitRefAmount}}"></span>
                            </h3>
                            <small>待提现佣金</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                ￥<span data-counter="counterup" data-value="{{$totalRefAmount}}"></span>
                            </h3>
                            <small>已支出佣金</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
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
    <script src="/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function skip(url) {
            window.location.href = url;
        }
    </script>
@endsection
