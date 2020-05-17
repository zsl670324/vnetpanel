<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('css')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            @if(\App\Components\Helpers::systemConfig()['website_logo'])
                <a href="/"><img src="{{\App\Components\Helpers::systemConfig()['website_logo']}}" alt="logo" class="logo-default" style="width:150px; height:30px;"/> </a>
            @else
                <a href="/"><img src="/assets/images/logo.png" alt="logo" class="logo-default" /> </a>
            @endif
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu" style="float:right">
            <ul class="nav navbar-nav pull-right">
                <li class="separator hide"> </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{Auth::user()->username}} </span>
                        <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                        <img alt="" class="img-circle" src="/assets/images/avatar.png" /> </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="/profile"> <i class="icon-user"></i>{{trans('home.profile')}}</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="/logout"> <i class="icon-logout"></i>{{trans('home.logout')}}</a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item start {{in_array(Request::path(), ['/', 'subscribe']) ? 'active open' : ''}}">
                    <a href="/" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">{{trans('home.home')}}</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['nodeList', 'subscribeLog', 'userBanLog']) || in_array(Request::segment(1), ['nodeList']) ? 'active open' : ''}}">
                    <a href="/nodeList" class="nav-link nav-toggle">
                        <i class="icon-list"></i>
                        <span class="title">{{trans('home.my_service')}}</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['services']) || in_array(Request::segment(1), ['purchase', 'payment']) ? 'active open' : ''}}">
                    <a href="/services" class="nav-link nav-toggle">
                        <i class="icon-basket"></i>
                        <span class="title">{{trans('home.services')}}</span>
                    </a>
                </li>
                @if(\App\Components\Helpers::systemConfig()['show_user_invite'])
                <li class="nav-item {{in_array(Request::path(), ['invite']) ? 'active open' : ''}}">
                    <a href="/invite" class="nav-link nav-toggle">
                        <i class="icon-user-follow"></i>
                        <span class="title">{{trans('home.invite_code')}}</span>
                    </a>
                </li>
                @endif
                @if(\App\Components\Helpers::systemConfig()['referral_status'])
                <li class="nav-item {{in_array(Request::path(), ['referral']) ? 'active open' : ''}}">
                    <a href="/referral" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">{{trans('home.referrals')}}</span>
                    </a>
                </li>
                @endif
                <li class="nav-item {{in_array(Request::path(), ['invoices']) || Request::segment(1) == 'invoice' ? 'active open' : ''}}">
                    <a href="/invoices" class="nav-link nav-toggle">
                        <i class="icon-wallet"></i>
                        <span class="title">{{trans('home.invoices')}}</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['tutorials']) || Request::segment(1) == 'article' ? 'active open' : ''}}">
                    <a href="/tutorials" class="nav-link nav-toggle">
                        <i class="icon-doc"></i>
                        <span class="title">{{trans('home.tutorials')}}</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['tickets', 'addTicket']) || Request::segment(1) == 'replyTicket' ? 'active open' : ''}}">
                    <a href="/tickets" class="nav-link nav-toggle">
                        <i class="icon-question"></i>
                        <span class="title">{{trans('home.tickets')}}</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['profile']) ? 'active open' : ''}}">
                    <a href="/profile" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">{{trans('home.profile')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link nav-toggle">
                        <i class="icon-logout"></i>
                        <span class="title">{{trans('home.logout')}}</span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        @yield('content')
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> Copyright &copy; 2017 - 2020 VNetPanel. All Rights Reserved. </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<script src="/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/js/layer/layer.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('script')
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- 统计 -->
{!! \App\Components\Helpers::systemConfig()['website_analytics'] !!}
<!-- 客服 -->
{!! \App\Components\Helpers::systemConfig()['website_customer_service'] !!}
</body>

</html>
