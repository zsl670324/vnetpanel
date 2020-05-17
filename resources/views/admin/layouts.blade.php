<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}} - 管理后台</title>
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
            <a href="/admin"> <img src="/assets/images/logo.png" alt="logo" class="logo-default" /> </a>
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
                        <span class="username username-hide-on-mobile"> {{Auth::guard('master')->user()->username}} </span>
                        <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                        <img alt="" class="img-circle" src="/assets/images/avatar.png" /> </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="/admin/profile"> <i class="icon-user"></i> 个人设置 </a>
                        </li>
                        <li>
                            <a href="/admin/logout"> <i class="icon-logout"></i> 退出 </a>
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
                <li class="nav-item start {{in_array(Request::path(), ['admin', 'admin/profile']) ? 'active open' : ''}}">
                    <a href="/admin" class="nav-link nav-toggle">
                        <i class="fa fa-home"></i>
                        <span class="title">管理中心</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/inviteList']) ? 'active open' : ''}}">
                    <a href="/admin/inviteList" class="nav-link nav-toggle">
                        <i class="fa fa-puzzle-piece"></i>
                        <span class="title">邀请管理</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/applyList', 'admin/applyDetail']) ? 'active open' : ''}}">
                    <a href="/admin/applyList" class="nav-link nav-toggle">
                        <i class="fa fa-credit-card"></i>
                        <span class="title">提现管理</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/couponList', 'admin/addCoupon']) ? 'active open' : ''}}">
                    <a href="/admin/couponList" class="nav-link nav-toggle">
                        <i class="fa fa-ticket"></i>
                        <span class="title">卡券管理</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/ticketList', 'admin/addTicket', 'admin/replyTicket']) ? 'active open' : ''}}">
                    <a href="/admin/ticketList" class="nav-link nav-toggle">
                        <i class="fa fa-question-circle"></i>
                        <span class="title">工单管理</span>
                    </a>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/articleList', 'admin/addArticle', 'admin/editArticle']) ? 'active open' : ''}}">
                    <a href="/admin/articleList" class="nav-link">
                        <i class="fa fa-file-word-o"></i>
                        <span class="title">文章管理</span>
                    </a>
                </li>
		        <li class="nav-item {{in_array(Request::path(), ['admin/productList', 'admin/addProduct', 'admin/editProduct', 'admin/productsPool', 'admin/addProductsPool', 'admin/editProductsPool']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="title">产品管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/productList', 'admin/addProduct', 'admin/editProduct']) ? 'active open' : ''}}">
                            <a href="/admin/productList" class="nav-link">
                                <i class="icon-list"></i>
                                <span class="title">产品列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/productsPool', 'admin/addProductsPool', 'admin/editProductsPool']) ? 'active open' : ''}}">
                            <a href="/admin/productsPool" class="nav-link">
                                <i class="fa fa-th"></i>
                                <span class="title">产品名称池</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/orderList', 'admin/paymentCallbackList']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-list-alt"></i>
                        <span class="title">订单管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/orderList']) ? 'active open' : ''}}">
                            <a href="/admin/orderList" class="nav-link">
                                <i class="icon-list"></i>
                                <span class="title">订单列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/paymentCallbackList']) ? 'active open' : ''}}">
                            <a href="/admin/paymentCallbackList" class="nav-link">
                                <i class="fa fa-stethoscope"></i>
                                <span class="title">回调日志</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/userList', 'admin/userPersona', 'admin/addUser', 'admin/editUser', 'admin/userOrderList', 'admin/userCreditLogList', 'admin/userTrafficLogList', 'admin/userSubscribeExList', 'admin/userRebateList', 'admin/userBanLogList', 'admin/userMonitor', 'admin/userGroupList', 'admin/addUserGroup', 'admin/editUserGroup', 'admin/onlineIPMonitor', 'admin/userSubscribeList', 'admin/userSubscribeLog', 'admin/export', 'admin/userMonitor']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">用户管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/userList', 'admin/addUser', 'admin/editUser', 'admin/userMonitor', 'admin/export', 'admin/userMonitor']) ? 'active open' : ''}}">
                            <a href="/admin/userList" class="nav-link">
                                <i class="fa fa-user"></i>
                                <span class="title">用户列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userPersona']) ? 'active open' : ''}}">
                            <a href="/admin/userPersona" class="nav-link">
                                <i class="fa fa-user-secret"></i>
                                <span class="title">用户画像</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userGroupList', 'admin/addUserGroup', 'admin/editUserGroup']) ? 'active open' : ''}}">
                            <a href="/admin/userGroupList" class="nav-link">
                                <i class="icon-list"></i>
                                <span class="title">用户分组控制</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/onlineIPMonitor']) ? 'active open' : ''}}">
                            <a href="/admin/onlineIPMonitor" class="nav-link">
                                <i class="icon-list"></i>
                                <span class="title">实时在线监控</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userSubscribeList', 'admin/userSubscribeLog']) ? 'active open' : ''}}">
                            <a href="/admin/userSubscribeList" class="nav-link">
                                <i class="icon-list"></i>
                                <span class="title">用户订阅列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userCreditLogList']) ? 'active open' : ''}}">
                            <a href="/admin/userCreditLogList" class="nav-link">
                                <i class="fa fa-money"></i>
                                <span class="title">余额变动记录</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userTrafficLogList']) ? 'active open' : ''}}">
                            <a href="/admin/userTrafficLogList" class="nav-link">
                                <i class="fa fa-area-chart"></i>
                                <span class="title">流量变动记录</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userSubscribeExList']) ? 'active open' : ''}}">
                            <a href="/admin/userSubscribeExList" class="nav-link">
                                <i class="fa fa-area-chart"></i>
                                <span class="title">订阅变更记录</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userRebateList']) ? 'active open' : ''}}">
                            <a href="/admin/userRebateList" class="nav-link">
                                <i class="fa fa-credit-card"></i>
                                <span class="title">返利流水记录</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/userBanLogList']) ? 'active open' : ''}}">
                            <a href="/admin/userBanLogList" class="nav-link ">
                                <i class="fa fa-user-times"></i>
                                <span class="title">用户封禁记录</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/nodeList', 'admin/addNode', 'admin/editNode', 'admin/groupList', 'admin/addGroup', 'admin/editGroup', 'admin/labelList', 'admin/addLabel', 'admin/editLabel', 'admin/nodeRealTimeStatus', 'admin/nodeMonitor', 'admin/accessList', 'admin/certificateList', 'admin/addCertificate', 'admin/editCertificate']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-list-alt"></i>
                        <span class="title">节点管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/nodeList', 'admin/addNode', 'admin/editNode', 'admin/nodeMonitor']) ? 'active open' : ''}}">
                            <a href="/admin/nodeList" class="nav-link ">
                                <i class="fa fa-list"></i>
                                <span class="title">节点列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/accessList']) ? 'active open' : ''}}">
                            <a href="/admin/accessList" class="nav-link ">
                                <i class="fa fa-cog"></i>
                                <span class="title">节点授权</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/certificateList', 'admin/addCertificate', 'admin/editCertificate']) ? 'active open' : ''}}">
                            <a href="/admin/certificateList" class="nav-link">
                                <i class="fa fa-bookmark-o"></i>
                                <span class="title">证书列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/labelList', 'admin/addLabel', 'admin/editLabel']) ? 'active open' : ''}}">
                            <a href="/admin/labelList" class="nav-link">
                                <i class="fa fa-sticky-note-o"></i>
                                <span class="title">节点标签</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/groupList', 'admin/addGroup', 'admin/editGroup']) ? 'active open' : ''}}">
                            <a href="/admin/groupList" class="nav-link ">
                                <i class="fa fa-list-ul"></i>
                                <span class="title">节点分组</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/nodeRealTimeStatus']) ? 'active open' : ''}}">
                            <a href="/admin/nodeRealTimeStatus" class="nav-link">
                                <i class="fa fa-flash"></i>
                                <span class="title">节点状态</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['rule/ruleList', 'rule/addRule', 'rule/editRule', 'rule/ruleGroupList', 'rule/addRuleGroup', 'rule/editRuleGroup', 'rule/assignNode', 'rule/ruleLogList']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-eye"></i>
                        <span class="title">审计规则</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['rule/ruleList', 'rule/addRule', 'rule/editRule']) ? 'active open' : ''}}">
                            <a href="/rule/ruleList" class="nav-link">
                                <i class="fa fa-list"></i>
                                <span class="title">规则列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['rule/ruleGroupList', 'rule/addRuleGroup', 'rule/editRuleGroup', 'rule/assignNode']) ? 'active open' : ''}}">
                            <a href="/rule/ruleGroupList" class="nav-link">
                                <i class="fa fa-link"></i>
                                <span class="title">规则分组</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['rule/ruleLogList']) ? 'active open' : ''}}">
                            <a href="/rule/ruleLogList" class="nav-link">
                                <i class="fa fa-warning"></i>
                                <span class="title">触发记录</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['permission/permissionList', 'permission/addPermission', 'permission/editPermission', 'permission/roleList', 'permission/addRole', 'permission/editRole', 'permission/assignPermission', 'permission/masterList', 'permission/addMaster', 'permission/editMaster', 'permission/assignRole']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">权限管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['permission/permissionList', 'permission/addPermission', 'permission/editPermission']) ? 'active open' : ''}}">
                            <a href="/permission/permissionList" class="nav-link nav-toggle">
                                <i class="fa fa-clone"></i>
                                <span class="title">权限行为列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['permission/roleList', 'permission/addRole', 'permission/editRole', 'permission/assignPermission']) ? 'active open' : ''}}">
                            <a href="/permission/roleList" class="nav-link nav-toggle">
                                <i class="fa fa-child"></i>
                                <span class="title">权限角色列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['permission/masterList', 'permission/assignRole', 'permission/addMaster', 'permission/editMaster']) ? 'active open' : ''}}">
                            <a href="/permission/masterList" class="nav-link nav-toggle">
                                <i class="fa fa-male"></i>
                                <span class="title">管理员列表</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/marketingList', 'admin/addMarketing', 'admin/emailLog']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-send-o"></i>
                        <span class="title">营销管理</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/marketingList', 'admin/addMarketing']) ? 'active open' : ''}}">
                            <a href="/admin/marketingList" class="nav-link">
                                <i class="fa fa-inbox"></i>
                                <span class="title">营销列表</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/emailLog']) ? 'active open' : ''}}">
                            <a href="/admin/emailLog" class="nav-link">
                                <i class="fa fa-envelope-o"></i>
                                <span class="title">邮件投递记录</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/import', 'admin/trafficLog', 'admin/sensitiveWordsList', 'admin/addSensitiveWords']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-wrench"></i>
                        <span class="title">工具箱</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/import']) ? 'active open' : ''}}">
                            <a href="/admin/import" class="nav-link">
                                <i class="icon-plus"></i>
                                <span class="title">数据导入</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/trafficLog']) ? 'active open' : ''}}">
                            <a href="/admin/trafficLog" class="nav-link">
                                <i class="fa fa-area-chart"></i>
                                <span class="title">流量日志</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/sensitiveWordsList', 'admin/addSensitiveWords']) ? 'active open' : ''}}">
                            <a href="/admin/sensitiveWordsList" class="nav-link">
                                <i class="fa fa-font"></i>
                                <span class="title">注册敏感词</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['logs']) ? 'active open' : ''}}">
                            <a href="/logs" class="nav-link" target="_blank">
                                <i class="fa fa-cubes"></i>
                                <span class="title">系统运行日志</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{in_array(Request::path(), ['admin/config', 'admin/system']) ? 'active open' : ''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-gear"></i>
                        <span class="title">设置</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{in_array(Request::path(), ['admin/config']) ? 'active open' : ''}}">
                            <a href="/admin/config" class="nav-link ">
                                <i class="fa fa-cog"></i>
                                <span class="title">通用配置</span>
                            </a>
                        </li>
                        <li class="nav-item {{in_array(Request::path(), ['admin/system']) ? 'active open' : ''}}">
                            <a href="/admin/system" class="nav-link ">
                                <i class="fa fa-cogs"></i>
                                <span class="title">系统设置</span>
                            </a>
                        </li>
                    </ul>
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

</body>

</html>
