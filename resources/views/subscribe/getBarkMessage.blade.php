<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>Bark推送消息</title>
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
                <a href="/"> <img src="{{\App\Components\Helpers::systemConfig()['website_logo']}}" alt="" style="width:300px; height:90px;"/> </a>
            @else
                <a href="/"> <img src="/assets/images/logo.png" alt="logo" class="logo-default" /> </a>
            @endif
        </div>
        <!-- END LOGO -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="tab-pane active">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-dark bold">{{$info->title}}</span>
                            </div>
                        </div>
                        <div class="portlet-body" style="word-wrap: break-word;word-break: break-all;overflow: hidden;">
                            <?php
                                // 解析markdown
                                $parse = new Parsedown();
                                echo $parse->text($info->content);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->

    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
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
