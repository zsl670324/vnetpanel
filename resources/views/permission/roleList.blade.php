@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                            <span class="caption-subject"> 权限角色列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <button class="btn blue" onclick="addRole()"> 添加角色 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;"> # </th>
                                        <th style="width: 30%;"> 名称 </th>
                                        <th style="width: 35%;"> 描述 </th>
                                        <th style="width: 20%;"> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($list->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach ($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> <span class="label label-info"> {{$vo->name}} </span> </td>
                                                <td> <span class="label label-info"> {{$vo->description}} </span> </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm green btn-outline" onclick="assignPermission('{{$vo->id}}')">分配权限</button>
                                                    <button type="button" class="btn btn-sm blue btn-outline" onclick="editRole('{{$vo->id}}')">编辑</button>
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="deleteRole('{{$vo->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 个权限角色</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $list->links() }}
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
        // 添加角色
        function addRole() {
            window.location.href = '/permission/addRole';
        }

        // 编辑角色
        function editRole(id) {
            window.location.href = '/permission/editRole?id=' + id;
        }

        // 授予角色权限
        function assignPermission(role_id) {
            window.location.href = '/permission/assignPermission?role_id=' + role_id;
        }

        // 删除角色
        function deleteRole(id) {
            layer.confirm('确定删除角色？', {icon: 2, title:'警告'}, function(index) {
                $.post("/permission/deleteRole", {_token:'{{csrf_token()}}', id:id}, function(ret) {
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
