@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="/admin/addProduct" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-dark bold">产品信息</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <!--
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">LOGO</label>
                                                    <div class="col-md-6">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="/assets/images/default.png" alt="" /> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> 选择 </span>
                                                                    <span class="fileinput-exists"> 更换 </span>
                                                                    <input type="file" name="logo" id="logo">
                                                                </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 移除 </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                -->
                                                <div class="form-group">
                                                    <label for="name" class="control-label col-md-3 col-sm-3">名称</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="text" class="form-control" name="name" value="{{Request::old('name')}}" id="name" autocomplete="off" required>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="control-label col-md-3 col-sm-3">描述</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <textarea class="form-control" rows="2" name="description" id="description" placeholder="产品的简单描述">{{Request::old('description')}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="traffic" class="control-label col-md-3 col-sm-3">内含流量</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="traffic" value="10240" id="traffic" autocomplete="off" required>
                                                            <span class="input-group-addon">MiB</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="level" class="control-label col-md-3 col-sm-3">授予等级</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select id="level" class="form-control" name="level">
                                                            @foreach(config('common.level_map') as $key => $val)
                                                                <option value="{{$key}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="speed" class="control-label col-md-3 col-sm-3">授予速率</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select id="speed" class="form-control" name="speed">
                                                            <option value="-1" selected>Unchanged</option>
                                                            @foreach(config('common.speed_limit') as $vk => $vl)
                                                                <option value="{{$vk}}" @if(\App\Components\Helpers::systemConfig()['default_speed_limit'] == $vk) selected @endif>{{$vl}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="invite_qty" class="control-label col-md-3 col-sm-3">赠邀请码</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="invite_qty" value="{{Request::old('invite_qty') ?: 0}}" id="invite_qty">
                                                            <span class="input-group-addon">枚</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sort" class="control-label col-md-3 col-sm-3">排序</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="text" class="form-control" name="sort" value="{{Request::old('sort')}}" id="sort" autocomplete="off" placeholder="值越大排越前">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hot" class="control-label col-md-3 col-sm-3">热销</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="hot" value="1"> 是
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="hot" value="0" checked> 否
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fake" class="control-label col-md-3 col-sm-3">随机假名</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="fake" value="1"> 是
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="fake" value="0" checked> 否
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group last">
                                                    <label for="status" class="control-label col-md-3 col-sm-3">状态</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="status" value="1" checked> 上架
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="status" value="0"> 下架
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-dark bold">价格信息</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="form-group">
                                                    <label for="limit_qty" class="control-label col-md-3 col-sm-3">限购</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="limit_qty" value="{{Request::old('limit_qty') ?: 0}}" id="limit_qty" autocomplete="off">
                                                            <span class="input-group-addon">次</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="monthly" class="control-label col-md-3 col-sm-3">月付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="monthly" value="{{Request::old('monthly')}}" id="monthly" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quarterly" class="control-label col-md-3 col-sm-3">季付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="quarterly" value="{{Request::old('quarterly')}}" id="quarterly" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="semiannual" class="control-label col-md-3 col-sm-3">半年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="semiannual" value="{{Request::old('semiannual')}}" id="semiannual" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="annual" class="control-label col-md-3 col-sm-3">年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="annual" value="{{Request::old('annual')}}" id="annual" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="biennial" class="control-label col-md-3 col-sm-3">两年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="biennial" value="{{Request::old('biennial')}}" id="biennial" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="triennial" class="control-label col-md-3 col-sm-3">三年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="triennial" value="{{Request::old('triennial')}}" id="triennial" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
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
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection
