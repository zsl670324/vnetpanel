<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>管理后台登入</title>
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
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    @if(\App\Components\Helpers::systemConfig()['website_home_logo'])
        <a href="/admin/login"> <img src="{{\App\Components\Helpers::systemConfig()['website_home_logo']}}" alt="" style="max-width:300px; max-height:90px;"/> </a>
    @else
        <a href="/admin/login"> <img src="/assets/images/home_logo.png" alt="" /> </a>
    @endif
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="/admin/login" id="login-form" method="post">
        @if($errors->any())
            <div class="alert alert-danger">
                <span> {!! $errors->first() !!} </span>
            </div>
        @endif
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{trans('login.username')}}</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="{{trans('login.username')}}" name="username" value="{{Request::old('username')}}" required />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{trans('login.password')}}</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="{{trans('login.password')}}" name="password" value="{{Request::old('password')}}" required />
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </div>
        <div class="form-group" style="margin-bottom:65px;">
            <label class="control-label visible-ie8 visible-ie9">{{trans('login.captcha')}}</label>
            <input class="form-control form-control-solid placeholder-no-fix" style="width:60%;float:left;" type="text" autocomplete="off" placeholder="{{trans('login.captcha')}}" name="captcha" value="" />
            <img src="{{captcha_src()}}" onclick="this.src='/captcha/default?'+Math.random()" alt="{{trans('login.captcha')}}" style="float:right;" />
        </div>
        <div class="form-actions">
            <div class="pull-left">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1"> {{trans('login.remember')}}
                    <span></span>
                </label>
            </div>
            <div class="pull-right forget-password-block">
                <a href="/login" class="forget-password">用户登入</a>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn red btn-block">{{trans('login.login')}}</button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>

<!-- END LOGIN -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<script src="/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- 统计 -->
{!! \App\Components\Helpers::systemConfig()['website_analytics'] !!}
<!-- 客服 -->
{!! \App\Components\Helpers::systemConfig()['website_customer_service'] !!}
</body>

</html>
