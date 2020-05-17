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
                        <form action="/admin/editProduct" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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
                                                                @if ($product->logo)
                                                                    <img src="{{$product->logo}}" alt="" />
                                                                @else
                                                                    <img src="/assets/images/default.png" alt="" />
                                                                @endif
                                                            </div>
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
                                                    <label class="control-label col-md-3 col-sm-3">名称</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="text" class="form-control" name="name" value="{{$product->name}}" id="name" autocomplete="off" required>
                                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3">描述</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <textarea class="form-control" rows="2" name="description" id="description" placeholder="产品的简单描述">{{$product->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3">内含流量</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="traffic" value="{{$product->traffic}}" id="traffic" disabled>
                                                            <span class="input-group-addon">MiB</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="level" class="control-label col-md-3 col-sm-3">授予等级</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select id="level" class="form-control" name="level" disabled>
                                                            @foreach(config('common.level_map') as $key => $val)
                                                                <option value="{{$key}}" @if($product->level == $key) selected @endif>{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="speed" class="control-label col-md-3 col-sm-3">授予速率</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <select id="speed" class="form-control" name="speed" disabled>
                                                            <option value="-1" @if($product->speed == '-1') selected @endif>Unchanged</option>
                                                            @foreach(config('common.speed_limit') as $vk => $vl)
                                                                <option value="{{$vk}}" @if($product->speed == $vk) selected @endif>{{$vl}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="invite_qty" class="control-label col-md-3 col-sm-3">赠邀请码</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="invite_qty" value="{{$product->invite_qty}}" id="invite_qty">
                                                            <span class="input-group-addon">枚</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sort" class="control-label col-md-3 col-sm-3">排序</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="text" class="form-control" name="sort" value="{{$product->sort}}" id="sort" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hot" class="control-label col-md-3 col-sm-3">热销</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="hot" value="1" @if($product->hot == 1) checked @endif> 是
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="hot" value="0" @if($product->hot == 0) checked @endif> 否
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
                                                                <input type="radio" name="fake" value="1" @if($product->fake == 1) checked @endif> 是
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="fake" value="0" @if($product->fake == 0) checked @endif> 否
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group last">
                                                    <label class="control-label col-md-3 col-sm-3">状态</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="status" value="1" {{$product->status == 1 ? 'checked' : ''}} /> 上架
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="status" value="0" {{$product->status == 0 ? 'checked' : ''}} /> 下架
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
                                                            <input type="text" class="form-control" name="limit_qty" value="{{$product->limit_qty}}" id="limit_qty" autocomplete="off" required>
                                                            <span class="input-group-addon">次</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="monthly" class="control-label col-md-3 col-sm-3">月付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="monthly" value="{{$product->monthly}}" id="monthly" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quarterly" class="control-label col-md-3 col-sm-3">季付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="quarterly" value="{{$product->quarterly}}" id="quarterly" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="semiannual" class="control-label col-md-3 col-sm-3">半年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="semiannual" value="{{$product->semiannual}}" id="semiannual" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="annual" class="control-label col-md-3 col-sm-3">年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="annual" value="{{$product->annual}}" id="annual" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="biennial" class="control-label col-md-3 col-sm-3">两年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="biennial" value="{{$product->biennial}}" id="biennial" autocomplete="off" required>
                                                            <span class="input-group-addon">元</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="triennial" class="control-label col-md-3 col-sm-3">三年付</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="triennial" value="{{$product->triennial}}" id="triennial" autocomplete="off" required>
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
