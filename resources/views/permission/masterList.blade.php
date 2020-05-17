@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

    <style>
        a:hover {
            color:white;
        }
        a:link {
            color: white;
        }
        a:visited {
            color: white;
        }
        a:active {
            color: white;
        }
    </style>
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject"> 管理员列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <button class="btn blue" onclick="addMaster()"> 添加管理员 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th style="width:15%"> # </th>
                                        <th style="width:65%"> 名称 </th>
                                        <th style="width:20%"> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($masterList->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach ($masterList as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {{$vo->username}} </td>
                                                <td>
                                                    @if($vo->id != 1)
                                                        <button type="button" class="btn btn-sm blue btn-outline" onclick="editMaster('{{$vo->id}}')">编辑</button>
                                                        <button type="button" class="btn btn-sm red btn-outline" onclick="deleteMaster('{{$vo->id}}')">删除</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$masterList->total()}} 个管理员</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $masterList->links() }}
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
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 添加管理员
        function addMaster() {
            window.location.href = '/permission/addMaster';
        }

        function editMaster(master_id) {
            window.location.href = '/permission/editMaster?id=' + master_id;
        }

        // 删除管理员
        function deleteMaster(master_id) {
            layer.confirm('确定删除该管理员吗？', {icon: 7, title:'警告'}, function(index) {
                $.post("/permission/deleteMaster", {master_id:master_id, _token:'{{csrf_token()}}'}, function(ret) {
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
