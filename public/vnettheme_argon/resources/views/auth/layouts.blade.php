<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="{{config('theme.description_content')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}}</title>
    <link href="/argon/img/brand/favicon.png?v1.{{time()}}" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/argon/others/nucleo/css/nucleo.css?v1.{{time()}}" rel="stylesheet">
    <link href="/argon/others/font-awesome/css/font-awesome.min.css?v1.{{time()}}" rel="stylesheet">
    <link href="/argon/css/style.min.css?v1.{{time()}}" rel="stylesheet">
    <link href="/argon/css/float.css?v1.{{time()}}" rel="stylesheet"/>
    <link href="/argon/css/sweetalert2.min.css?v1.{{time()}}" rel="stylesheet"/>
    @if (config('theme.loading'))
        <link href="/argon/css/fakeLoader.min.css?v1.{{time()}}" rel="stylesheet"/>
    @endif
</head>
<body>
@if (config('theme.loading'))
    <div class="fakeLoader"></div>
@endif
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            @if(in_array(Request::path(), ['login']) )
                <a class="navbar-brand mr-lg-5" onclick="S_a();"><h4
                            class="text-white">{{\App\Components\Helpers::systemConfig()['website_name']}}</h4></a>
            @else
                <a class="navbar-brand mr-lg-5" href="/login"><h4
                            class="text-white">{{\App\Components\Helpers::systemConfig()['website_name']}}</h4></a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                    aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            @if(in_array(Request::path(), ['login']) )
                                <a class="navbar-brand mr-lg-5" onclick="S_a();"><h5
                                            class="text-blue">{{\App\Components\Helpers::systemConfig()['website_name']}}</h5>
                                </a>
                            @else
                                <a class="navbar-brand mr-lg-5" href="/login"><h5
                                            class="text-blue">{{\App\Components\Helpers::systemConfig()['website_name']}}</h5>
                                </a>
                            @endif
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
                    @if (config('theme.switch_language'))
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                                <i class="ni ni-world d-lg-none"></i>
                                <span class="nav-link-inner--text">Language</span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{url('lang', ['locale' => 'zh-CN'])}}" class="dropdown-item">简体中文</a>
                                <a href="{{url('lang', ['locale' => 'zh-tw'])}}" class="dropdown-item">繁體中文</a>
                                <a href="{{url('lang', ['locale' => 'en'])}}" class="dropdown-item">English</a>
                                <a href="{{url('lang', ['locale' => 'ja'])}}" class="dropdown-item">日本語</a>
                                <a href="{{url('lang', ['locale' => 'ko'])}}" class="dropdown-item">한국어</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item d-lg-none">
                        @if(in_array(Request::path(), ['login']) )
                            <a onclick="S_b();" class="nav-link nav-link-icon" title="{{trans('login.title')}}">
                                <i class="ni ni-circle-08"></i>
                                <span class="nav-link-inner--text d-lg-none"> {{trans('login.title')}}</span>
                            </a>
                        @else
                            <a href="/login" class="nav-link nav-link-icon" title="{{trans('login.title')}}">
                                <i class="ni ni-circle-08"></i>
                                <span class="nav-link-inner--text d-lg-none"> {{trans('login.title')}}</span>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item d-none d-lg-block ml-lg-4">
                        @if(in_array(Request::path(), ['login']) )
                            <button onclick="S_b();" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><i class="ni ni-circle-08"></i></span>
                                <span class="nav-link-inner--text"> {{trans('login.title')}}</span>
                            </button>
                        @else
                            <a href="/login" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><i class="ni ni-circle-08"></i></span>
                                <span class="nav-link-inner--text"> {{trans('login.title')}}</span>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link nav-link-icon" href="/register" data-toggle="tooltip"
                           title="{{trans('login.register')}}">
                            <i class="ni ni-user-run"></i>
                            <span class="nav-link-inner--text d-lg-none"> {{trans('login.register')}}</span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block ml-lg-4">
                        <a href="/register" class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon">
                            <i class="ni ni-user-run"></i>
                            </span>
                            <span class="nav-link-inner--text"> {{trans('login.register')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
@if (config('theme.float_button'))
    <div>
        <a class="float-action-button-{{config('theme.bg_color')}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false"></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            @if(in_array(Request::path(), ['login']) )
                <button class="dropdown-item" onclick="S_b();"><i class="ni ni-circle-08"></i> {{trans('login.title')}}
                </button>
            @else
                <a class="dropdown-item" href="/login"> <i class="ni ni-circle-08"></i> {{trans('login.title')}} </a>
            @endif
            <a class="dropdown-item" href="/register"> <i class="ni ni-user-run"></i> {{trans('login.register')}} </a>
            <a class="dropdown-item" href="/resetPassword"> <i
                        class="ni ni-key-25"></i> {{trans('login.forget_password')}}? </a>
        </div>
    </div>
@endif
@yield('content')
<div id="AvatarImage" style="display: none"></div>
<footer class="footer has-cards">
    <div class="container">
        <div class="row row-grid align-items-center my-md">
            <div class="col-lg-6">
                <h3 class="text-primary font-weight-light mb-2">{{config('theme.footer_title')}}</h3>
                <h4 class="mb-0 font-weight-light">{{config('theme.footer_content')}}</h4>
            </div>
            <div class="col-lg-6 text-lg-center btn-wrapper">
                @if(config('theme.twitter_url') != 'null')
                    <a target="_blank" href="{{config('theme.twitter_url')}}"
                       class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip"
                       data-original-title="Follow us">
                        <i class="fa fa-twitter"></i>
                    </a>
                @endif
                @if(config('theme.facebook_url') != 'null')
                    <a target="_blank" href="{{config('theme.facebook_url')}}"
                       class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip"
                       data-original-title="Like us">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                @endif
                @if(config('theme.qq_url') != 'null')
                    <a target="_blank" href="{{config('theme.qq_url')}}"
                       class="btn btn-neutral btn-icon-only btn-dribbble btn-lg btn-round" data-toggle="tooltip"
                       data-original-title="QQ group">
                        <i class="fa fa-qq"></i>
                    </a>
                @endif
                @if(config('theme.telegram_url') != 'null' )
                    <a target="_blank" href="{{config('theme.telegram_url')}}"
                       class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip"
                       data-original-title="Telegarm">
                        <i class="ni ni-send"></i>
                    </a>
                @endif
            </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
                <div class="copyright">
                    &copy; {{date("Y")}} <a href="/"
                                            class="font-weight-bold ml-1"><span id="website_name">{{\App\Components\Helpers::systemConfig()['website_name']}}</span></a>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-footer justify-content-end">
                    <li class="nav-item">
                        <a href="https://t.me/ssrtheme" class="nav-link" target="_blank">Theme</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://t.me/VNetPanel" class="nav-link" target="_blank">VNetPanel</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    var mail = '';
</script>
<script src="/argon/others/jquery/jquery.min.js?v1.{{time()}}"></script>
<script src="/argon/others/popper/popper.min.js?v1.{{time()}}"></script>
<script src="/argon/others/bootstrap/bootstrap.min.js?v1.{{time()}}"></script>
<script src="/argon/others/headroom/headroom.min.js?v1.{{time()}}"></script>
<script src="/argon/js/sweetalert2.min.js?v1.{{time()}}"></script>
<script src="/argon/js/clipboard.min.js?v1.{{time()}}"></script>
<script src='/argon/js/scripts.js?v1.{{time()}}'></script>
<script src="/argon/js/style.min.js?v1.{{time()}}"></script>
@if (config('theme.loading'))
    <script src="/argon/js/fakeLoader.min.js?v1.{{time()}}"></script>
    <script>
        $(document).ready(function () {
            $.fakeLoader({
                timeToHide: 1200,
                spinner: "{{config('theme.spinner')}}",
                bgColor: @if(config('theme.bg_color') == 'primary')'#5e72e4'
                @elseif(config('theme.bg_color') == 'secondary')'#f4f5f7'
                @elseif(config('theme.bg_color') == 'info') '#11cdef'
                @elseif(config('theme.bg_color') == 'success')'#2dce89'
                @elseif(config('theme.bg_color') == 'danger')'#f5365c'
                @elseif(config('theme.bg_color') == 'warning')'#fb6340'
                @elseif(config('theme.bg_color') == 'default') '#172b4d'
                @endif
            });
        });
    </script>
@endif
@yield('script')
</body>
</html>