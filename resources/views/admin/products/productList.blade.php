@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <style>
        .fancybox > img {
            width: 75px;
            height: 75px;
        }
        input,select {
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject"> 产品列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addProduct()"> 添加产品 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="status" id="status" onChange="doSearch()">
                                    <option value="" @if(Request::get('status') == '') selected @endif>状态</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>上架</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>下架</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <button type="button" class="btn blue" onclick="doSearch();">查询</button>
                                <button type="button" class="btn grey" onclick="doReset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 名称 </th>
                                    <!-- <th> 图片 </th> -->
                                    <th> 内含流量 </th>
                                    <th> 授予等级 </th>
                                    <th> 授予速率 </th>
                                    <th> 赠邀请码 </th>
                                    <th> 限购 </th>
                                    <th> 排序 </th>
                                    <th> 热销 </th>
                                    <th> 状态 </th>
                                    <th style="text-align: center;"> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($productList->isEmpty())
                                    <tr>
                                        <td colspan="14" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($productList as $product)
                                        <tr class="odd gradeX">
                                            <td> {{$product->id}} </td>
                                            <td> {{$product->name}} </td>
                                            <!-- <td> @if($product->logo) <a href="{{$product->logo}}" class="fancybox"><img src="{{$product->logo}}"/></a> @endif </td> -->
                                            <td> {{$product->type == 3 ? '' : $product->traffic_label}} </td>
                                            <td> {{$product->type == 3 ? '' : $product->level_label}} </td>
                                            <td> {{$product->type == 3 ? '' : formatNetSpeed($product->speed)}} </td>
                                            <td> {{$product->type == 3 ? '' : $product->invite_qty . '枚'}} </td>
                                            <td> {{$product->type == 3 ? '' : $product->limit_qty . '次'}} </td>
                                            <td> {{$product->sort}} </td>
                                            <td> {!! $product->hot_label !!} </td>
                                            <td> {!! $product->status_label !!} </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-sm blue btn-outline" onclick="editProduct('{{$product->id}}')"> 编辑 </button>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delProduct('{{$product->id}}')"> 删除 </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$productList->total()}} 个商品</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $productList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 添加产品
        function addProduct() {
            window.location.href = '/admin/addProduct';
        }

        // 编辑产品
        function editProduct(id) {
            window.location.href = '/admin/editProduct?id=' + id;
        }

        // 删除产品
        function delProduct(id) {
            layer.confirm('确定删除该产品？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delProduct", {_token:'{{csrf_token()}}', id:id}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 搜索
        function doSearch() {
            var status = $("#status option:selected").val();

            window.location.href = '/admin/productList?status=' + status;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/productList';
        }

        // 查看产品图片
        $(document).ready(function () {
            $('.fancybox').fancybox({
                openEffect: 'elastic',
                closeEffect: 'elastic'
            })
        });
    </script>
@endsection
