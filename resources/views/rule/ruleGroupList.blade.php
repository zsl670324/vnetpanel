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
                            <span class="caption-subject"> 规则分组<small>（同一节点仅允许分配至一个分组内，编辑分配节点后重载节点审计规则）</small> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addRuleGroup()"> 添加分组 </button>
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
                                        <th> 审计模式 </th>
                                        <th style="width: 20%"> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($ruleGroupList->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($ruleGroupList as $ruleGroup)
                                            <tr class="odd gradeX">
                                                <td> {{$ruleGroup->id}} </td>
                                                <td> {{$ruleGroup->name}} </td>
                                                <td> {!! $ruleGroup->type_label !!} </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline green" onclick="assignNode('{{$ruleGroup->id}}')">分配节点</button>
                                                    <button type="button" class="btn btn-sm btn-outline blue" onclick="editRuleGroup('{{$ruleGroup->id}}')">编辑</button>
                                                    <button type="button" class="btn btn-sm btn-outline red" onclick="delRuleGroup('{{$ruleGroup->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$ruleGroupList->total()}} 个分组</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $ruleGroupList->links() }}
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
        // 分配节点
        function assignNode(id) {
            window.location.href = '/rule/assignNode?id=' + id;
        }

        // 添加规则分组
        function addRuleGroup() {
            window.location.href = '/rule/addRuleGroup';
        }

        // 编辑规则分组
        function editRuleGroup(id) {
            window.location.href = '/rule/editRuleGroup?id=' + id;
        }

        // 删除规则分组
        function delRuleGroup(id) {
            layer.confirm("确定删除吗？", {icon:3, title: '提示'}, function (index) {
                $.ajax({
                    type: "POST",
                    url: "/rule/delRuleGroup?id=" + id,
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
