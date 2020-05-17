@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                            <span class="caption-subject"> 产品名称池<small>（用户提交订单时根据金额范围随机匹配一个虚拟产品名称用于实际订单记录）</small> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addProductsPool()"> 添加虚拟产品名称 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> 名称 </th>
                                    <th> 状态 </th>
                                    <th style="text-align: center;"> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($productsPool->isEmpty())
                                    <tr>
                                        <td colspan="4" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($productsPool as $vo)
                                        <tr class="odd gradeX">
                                            <td> {{$vo->id}} </td>
                                            <td> <span class="label label-info">{{$vo->name}}</span> </td>
                                            <td> {!! $vo->status_label !!} </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-sm blue btn-outline" onclick="editProductsPool('{{$vo->id}}')"> 编辑 </button>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delProductsPool('{{$vo->id}}')"> 删除 </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$productsPool->total()}} 个虚拟产品名称</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $productsPool->links() }}
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
    <script type="text/javascript">
        function addProductsPool() {
            window.location.href = '/admin/addProductsPool';
        }

        function editProductsPool(id) {
            window.location.href = '/admin/editProductsPool?id=' + id;
        }

        function delProductsPool(id) {
            layer.confirm('确定删除吗？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delProductsPool", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }
    </script>
@endsection
