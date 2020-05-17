@extends('admin.layouts')
@section('css')
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('successMsg'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {{Session::get('successMsg')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="/assets/images/avatar.png" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{Auth::guard('master')->user()->username}} </div>
                            <div class="profile-usertitle-job">
                                @if (Auth::guard('master')->user()->level)
                                    {{config('common.master_level_map')[Auth::guard('master')->user()->level]}}
                                @else
                                    超级管理员
                                @endif
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <!--
                            <ul class="nav">
                                <li class="active">
                                    <a href="javascript:;">
                                        <i class="icon-user"></i> 个人资料 </a>
                                </li>
                            </ul>
                            -->
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab">修改信息</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane active" id="tab_1">
                                            <form action="/admin/profile" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div class="form-group">
                                                    <label class="control-label"> 用户名 </label>
                                                    <input type="username" class="form-control" name="username" value="{{Auth::guard('master')->user()->username}}" id="username" autofocus required />
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> 旧密码 </label>
                                                    <input type="password" class="form-control" name="old_password" id="old_password" required />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> 新密码 </label>
                                                    <input type="password" class="form-control" name="new_password" id="new_password" required />
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn green"> 提 交 </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
@endsection
