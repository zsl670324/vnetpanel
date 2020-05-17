<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="{{config('theme.description_content')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}}</title>
    <link href="/argon/img/brand/favicon.png?v1.{{time()}}" rel="icon" type="image/png">
    <link href="/argon/others/nucleo/css/nucleo.css?v1.{{time()}}" rel="stylesheet"/>
    <link href="/argon/others/fontawesome/css/all.min.css?v1.{{time()}}" rel="stylesheet"/>
    <link href="/argon/css/sweetalert2.min.css?v1.{{time()}}" rel="stylesheet"/>
    @yield('css')
    <link href="/argon/css/argon.css?v1.{{time()}}" rel="stylesheet"/>
    <style>
        @media (max-width: 560px) {
            ul.pagination li:not(.show-mobile) {
                display: none;
            }
        }
    </style>
    @if (config('theme.loading'))
        <link href="/argon/css/fakeLoader.min.css?v1.{{time()}}" rel="stylesheet"/>
    @endif
</head>
<body class="">
@if (config('theme.loading'))
    <div class="fakeLoader"></div>
@endif
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-scrollx_visible">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="/">
                {{\App\Components\Helpers::systemConfig()['website_name']}}
            </a>
            <div class="ml-auto">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class=" nav-link  {{in_array(Request::path(), ['/', 'subscribe', 'profile']) ? 'active' : ''}}"
                           href=" /"> <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">{{trans('home.home')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['nodeList', 'subscribeLog', 'userBanLog']) || in_array(Request::segment(1), ['nodeList']) ? 'active' : ''}}"
                           href="/nodeList">
                            <i class="ni ni-planet text-blue"></i>
                            <span class="nav-link-text">{{trans('home.my_service')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['services']) || in_array(Request::segment(1), ['purchase', 'payment']) ? 'active' : ''}}"
                           href="/services">
                            <i class="ni ni-cart text-orange"></i>
                            <span class="nav-link-text">{{trans('home.services')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['invoices']) || Request::segment(1) == 'invoice' ? 'active' : ''}}"
                           href="/invoices">
                            <i class="ni ni-bullet-list-67 text-yellow"></i>
                            <span class="nav-link-text">{{trans('home.invoices')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['tickets', 'addTicket']) || Request::segment(1) == 'replyTicket' ? 'active' : ''}}"
                           href="/tickets">
                            <i class="ni ni-email-83 text-red"></i>
                            <span class="nav-link-text"> {{trans('home.tickets')}}</span>
                        </a>
                    </li>
                    @if(\App\Components\Helpers::systemConfig()['show_user_invite'])
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['invite']) ? 'active' : ''}}"
                           href="/invite">
                            <i class="ni ni-diamond text-info"></i>
                            <span class="nav-link-text">{{trans('home.invite_code')}}</span>
                        </a>
                    </li>
                    @endif
                    @if(\App\Components\Helpers::systemConfig()['referral_status'])
                        <li class="nav-item">
                            <a class="nav-link {{in_array(Request::path(), ['referral']) ? 'active' : ''}}"
                               href="/referral">
                                <i class="ni ni-favourite-28 text-pink"></i>
                                <span class="nav-link-text">{{trans('home.referrals')}}</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{in_array(Request::path(), ['tutorials', 'article']) ? 'active open' : ''}}"
                           href="/tutorials">
                            <i class="ni ni-books text-info"></i>
                            <span class="nav-link-text">{{trans('home.tutorials')}}</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted"></h6>
                <ul class="navbar-nav mb-md-3">
                    @if (config('theme.qq_group'))
                        <li class="nav-item">
                            <a class="nav-link" href="#qq_qrcode" data-toggle="modal">
                                <i class="ni ni-chat-round text-danger"></i>
                                <span class="nav-link-text">{{config('theme.qq_group_name')}}</span>
                            </a>
                        </li>
                    @endif
                    @if (config('theme.show_group'))
                        <li class="nav-item">
                            <a class="nav-link" href={{config('theme.group_link')}} target="_blank">
                                <i class="ni ni-chat-round text-primary"></i>
                                <span class="nav-link-text">{{config('theme.group_name')}}</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="ni ni-user-run text-danger"></i>
                            <span class="nav-link-text">{{trans('home.logout')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            </li>
            </ul>
        </div>
    </div>
</nav>
<div class="main-content">
    <nav class="navbar navbar-top navbar-expand border-bottom navbar-dark bg-gradient-{{config('theme.bg_color')}}">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-center ml-md-auto">
                    <li class="nav-item d-xl-none">
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                    @if(Auth::user()->transfer_enable)

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">以下是你的<strong class="text-primary">帐号信息</strong>
                                    </h6>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="/" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                                    <i class="ni ni-active-40"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_expire')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                            <span class="badge badge-lg badge-primary">
                                                            @if(date('Y-m-d') > Auth::user()->expire_time) {{trans('home.expired')}} @else {{Auth::user()->expire_time}} @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/nodeList" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                                    <i class="ni ni-chart-pie-35"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_total_traffic')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <span class="badge badge-lg badge-warning">
                                                        {{flowAutoShow(Auth::user()->transfer_enable)}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/services" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                                    <i class="ni ni-chart-bar-32"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_bandwidth_usage')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <span class="badge badge-lg badge-success">
                                                            {{flowAutoShow(Auth::user()->u + Auth::user()->d)}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/tickets" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                                    <i class="ni ni-books"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_limit_speed')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                       <span class="badge badge-lg badge-info">
                                                           {{formatNetSpeed(Auth::user()->speed_limit)}}
                                                       </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/tutorials" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                                    <i class="fas fa-user-graduate"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_level')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <span class="badge badge-lg badge-danger">
                                                            {{config('common.level_map')[Auth::user()->level]}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                                    <i class="ni ni-money-coins"></i>
                                                </span>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">{{trans('home.account_balance')}}</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <span class="badge badge-lg badge-warning">
                                                            {{Auth::user()->credit}}元
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ni ni-bell-55" style="color: #f4645f;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                                <div class="list-group list-group-flush">
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <img alt="Image placeholder" src="/argon/img/theme/team-1-800x800.jpg"
                                                     class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">Hey,</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>{{date('Y-m-d H:i:s', Auth::user()->last_login)}}</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">您的连接已被禁用，请购买服务！</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="/services"
                                   class="dropdown-item text-center text-primary font-weight-bold py-3">{{trans('home.services')}}</a>
                            </div>
                        </li>
                    @endif
                    @if (config('theme.Switch_language'))
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="fas fa-globe-asia"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                                <div class="row shortcuts px-4">
                                    <a href="{{url('lang', ['locale' => 'zh-CN'])}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                        <img alt="Image placeholder" src="/argon/others/country/cn.png">
                                        </span>
                                        <small>简体中文</small>
                                    </a>
                                    <a href="{{url('lang', ['locale' => 'zh-tw'])}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                        <img alt="Image placeholder" src="/argon/others/country/tw.png">
                                        </span>
                                        <small>繁體中文</small>
                                    </a>
                                    <a href="{{url('lang', ['locale' => 'en'])}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <img alt="Image placeholder" src="/argon/others/country/uk.png">
                                        </span>
                                        <small>English</small>
                                    </a>
                                    <a href="{{url('lang', ['locale' => 'ja'])}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                        <img alt="Image placeholder" src="/argon/others/country/jp.png">
                                        </span>
                                        <small>日本語</small>
                                    </a>
                                    <a href="{{url('lang', ['locale' => 'ko'])}}" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                        <img alt="Image placeholder" src="/argon/others/country/kr.png">
                                        </span>
                                        <small>한국어</small>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        @if (config('theme.avatar') == 0)
                                            <div id="AvatarImage"></div>
                                        @else
                                            <div id="AvatarImage" style="display: none"></div>
                                            <img alt="Image placeholder" src="http://i.pravatar.cc/200">
                                        @endif
                                    </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->username}}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="/profile" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>{{trans('home.profile')}}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout " class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>{{trans('home.logout')}}</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <div class="container-fluid mt--5">
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; {{date("Y")}} <a href="/" class="font-weight-bold ml-1"
                                                target="_blank"><span id="website_name">{{\App\Components\Helpers::systemConfig()['website_name']}}</span></a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            <a href="https://t.me/vnetpanel" class="nav-link" target="_blank">VNetPanel</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://t.me/ssrtheme" class="nav-link" target="_blank">Theme</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    @if (config('theme.qq_group'))
        <div class="modal fade" id="qq_qrcode" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{config('theme.qq_group_name')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div  class="argon_a" style="width:100%; height:auto;text-align: center;"><a href={{config('theme.qq_group_link')}}><img src={{config('theme.qq_group_qrcode')}}></a></div>
                                <div style="text-align: center;"><a href={{config('theme.qq_group_link')}}>点我跳转</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<!-- 统计 -->
    {!! \App\Components\Helpers::systemConfig()['website_analytics'] !!}
<!-- 客服 -->
    {!! \App\Components\Helpers::systemConfig()['website_customer_service'] !!}
    <script>
        var mail = '{{Auth::user()->username}}';
    </script>
    <script src="/argon/others/jquery/jquery.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/jquery/jquery.scrollbar.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/jquery/jquery-scrollLock.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/jquery/jquery.lavalamp.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/bootstrap/bootstrap.bundle.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/chart.js/Chart.min.js?v1.{{time()}}"></script>
    <script src="/argon/others/chart.js/Chart.extension.js?v1.{{time()}}"></script>
    <script src="/argon/js/sweetalert2.min.js?v1.{{time()}}"></script>
    <script src="/argon/js/clipboard.min.js?v1.{{time()}}"></script>
    <script src="/argon/js/scripts.js?v1.{{time()}}"></script>
    <script src="/argon/js/argon.js?v1.{{time()}}"></script>
    @if (config('theme.loading'))
        <script src="/argon/js/fakeLoader.min.js?v1.{{time()}}"></script>
        <script>
            $(document).ready(function () {
                $.fakeLoader({
                    timeToHide: 1200,
                    zIndex:'99999',
                    bgColor: @if(config('theme.bg_color') == 'primary')'#5e72e4'
                    @elseif(config('theme.bg_color') == 'secondary')'#f4f5f7'
                    @elseif(config('theme.bg_color') == 'info') '#11cdef'
                    @elseif(config('theme.bg_color') == 'success')'#2dce89'
                    @elseif(config('theme.bg_color') == 'danger')'#f5365c'
                    @elseif(config('theme.bg_color') == 'warning')'#fb6340'
                    @elseif(config('theme.bg_color') == 'default') '#172b4d'
                    @endif,
                    spinner: "{{config('theme.spinner')}}"
                });
            });
        </script>
@endif
@yield('script')
</body>
</html>