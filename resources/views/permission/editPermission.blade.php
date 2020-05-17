@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('successMsg'))
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        {{Session::get('successMsg')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">编辑权限行为</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="/permission/editPermission" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">行为</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" class="form-control" name="name" value="{{$permission->name}}" id="name" required>
                                        <input type="hidden" name="id" value="{{$permission->id}}" />
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                        <span class="help-block"> URL不带参PATH，例如：admin/userList </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">描述</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" class="form-control" name="description" value="{{$permission->description}}" id="description" required>
                                        <span class="help-block"> 例如：用户管理-用户列表 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9 col-sm-offset-2 col-sm-9">
                                        <button type="submit" class="btn green"> 提 交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
@endsection
