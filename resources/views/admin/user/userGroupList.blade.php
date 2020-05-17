@extends('admin.layouts')
@section('css')
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
                            <span class="caption-subject"> 用户分组控制<small>（同一节点可分配至多个分组，一个用户只能属于一个分组；对于用户可见/可用节点：先按分组后按等级）</small> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addUserGroup()"> 添加分组 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> 分组名称 </th>
                                        <th style="width: 20%"> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="3" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $userGroup)
                                            <tr class="odd gradeX">
                                                <td> {{$userGroup->id}} </td>
                                                <td> {{$userGroup->name}} </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline blue" onclick="editUserGroup('{{$userGroup->id}}')">编辑</button>
                                                    <button type="button" class="btn btn-sm btn-outline red" onclick="delUserGroup('{{$userGroup->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 个分组</div>
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
    <script type="text/javascript">
        // 添加用户分组
        function addUserGroup() {
            window.location.href = '/admin/addUserGroup';
        }

        // 编辑用户分组
        function editUserGroup(id) {
            window.location.href = '/admin/editUserGroup?id=' + id;
        }

        // 删除用户分组
        function delUserGroup(id) {
            layer.confirm("确定删除吗？", {icon:3, title: '提示'}, function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/delUserGroup?id=" + id,
                    async: false,
                    data: {_token:'{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (ret) {
                        layer.msg(ret.message, {time:1000}, function() {
                            if (ret.status == 'success') {
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
