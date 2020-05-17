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
    @if (config('theme.loading'))
        <link href="/argon/css/fakeLoader.min.css?v1.{{time()}}" rel="stylesheet"/>
    @endif
    <style>
    </style>
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
                        <a class=" nav-link active"
                           href=" /login"> <i class="ni ni-circle-08 text-primary"></i>
                            <span class="nav-link-text">{{trans('login.title')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="/register">
                            <i class="ni ni-user-run text-blue"></i>
                            <span class="nav-link-text">{{trans('login.register')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/resetPassword">
                            <i class="ni ni-key-25 text-orange"></i>
                            <span class="nav-link-text">{{trans('login.forget_password')}}</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted"></h6>
                <ul class="navbar-nav mb-md-3">
                    @if (config('theme.show_group'))
                        <li class="nav-item">
                            <a class="nav-link" href={{config('theme.group_link')}} target="_blank">
                                <i class="ni ni-chat-round text-primary"></i>
                                <span class="nav-link-text">{{config('theme.group_name')}}</span>
                            </a>
                        </li>
                    @endif
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
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a class="dropdown-item"
                               href=" /login"> <i class="ni ni-circle-08 text-primary"></i>
                                <span>{{trans('login.title')}}</span>
                            </a>
                            <a class="dropdown-item"
                               href="/register">
                                <i class="ni ni-user-run text-blue"></i>
                                <span>{{trans('login.register')}}</span>
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
                            <a href="https://t.me/VNetPanel" class="nav-link" target="_blank">VNetPanel</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://t.me/ssrtheme" class="nav-link" target="_blank">Theme</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <!-- 统计 -->
    {!! \App\Components\Helpers::systemConfig()['website_analytics'] !!}
<!-- 客服 -->
    {!! \App\Components\Helpers::systemConfig()['website_customer_service'] !!}
    <script>
        var mail = '';
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