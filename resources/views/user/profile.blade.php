@extends('user.layouts')
@section('css')
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top: 0px; min-height: 354px;">
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
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption font-dark">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject bold">{{trans('home.profile')}}</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab">{{trans('home.password')}}</a>
                                        </li>
                                        <li>
                                            <a href="#tab_2" data-toggle="tab">{{trans('home.contact')}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <form action="/profile" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div class="form-group">
                                                    <label class="control-label">{{trans('home.current_password')}}</label>
                                                    <input type="password" class="form-control" name="old_password" id="old_password" autofocus required />
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">{{trans('home.new_password')}}</label>
                                                    <input type="password" class="form-control" name="new_password" id="new_password" required />
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class=" col-md-4">
                                                            <button type="submit" class="btn green">{{trans('home.submit')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab_2">
                                            <form action="/profile" method="post" enctype="multipart/form-data" class="form-bordered">
                                                <div class="form-group">
                                                    <label class="control-label">{{trans('home.gender')}}</label>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="gender" value="1" {{Auth::user()->gender ? 'checked' : ''}}> 男
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="gender" value="0" {{!Auth::user()->gender ? 'checked' : ''}}> 女
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">{{trans('home.phone')}}</label>
                                                    <input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}" id="phone" autocomplete="off" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">{{trans('home.wechat')}}</label>
                                                    <input type="text" class="form-control" name="wechat" value="{{Auth::user()->wechat}}" id="wechat" autocomplete="off" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> QQ </label>
                                                    <input type="text" class="form-control" name="qq" value="{{Auth::user()->qq}}" id="qq" autocomplete="off" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> {{trans('home.address')}} </label>
                                                    <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}" id="address" autocomplete="off" />
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn green">{{trans('home.submit')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
