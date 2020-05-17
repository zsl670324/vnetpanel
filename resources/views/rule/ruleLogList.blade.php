@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
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
                            <span class="caption-subject"> 触发记录 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <div class="btn-group">
                                    <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false"> 操作
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:clearLog();"> 清空记录 </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="uid" value="{{Request::get('uid')}}" id="uid" placeholder="用户ID" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="username" value="{{Request::get('username')}}" id="username" placeholder="用户名" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="node_id" id="node_id" onChange="doSearch()">
                                    <option value="" @if(Request::get('node_id') == '') selected @endif>节点</option>
                                    @foreach($nodeList as $node)
                                        <option value="{{$node->id}}" @if(Request::get('node_id') == $node->id) selected @endif>{{$node->id . ' - ' . $node->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="rule_id" id="rule_id" onChange="doSearch()">
                                    <option value="" @if(Request::get('rule_id') == '') selected @endif>规则</option>
                                    @foreach($ruleList as $rule)
                                        <option value="{{$rule->id}}" @if(Request::get('rule_id') == $rule->id) selected @endif>{{$rule->name}}</option>
                                    @endforeach
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
                                    <th> # </th>
                                    <th> 用户ID </th>
                                    <th> 用户名 </th>
                                    <th> 节点 </th>
                                    <th> 触发规则 </th>
                                    <th> 触发原因 </th>
                                    <th> 触发时间 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="7" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {{empty($vo->user) ? '【账号已删除】' : $vo->user->id}} </td>
                                                <td> {{empty($vo->user) ? '【账号已删除】' : $vo->user->username}} </td>
                                                <td> {{empty($vo->node) ? '【节点已删除】' : '【节点ID：' . $vo->node_id . '】' . $vo->node->name}} </td>
                                                <td> {{$vo->rule_id ? '[阻断] ' . ($vo->rule ? $vo->rule->name : '【规则已删除】') : '[仅允许] 访问非规则允许内容'}} </td>
                                                <td> {{$vo->reason}} </td>
                                                <td> {{$vo->created_at}} </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 条记录</div>
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
        // 搜索
        function doSearch() {
            var uid = $("#uid").val();
            var username = $("#username").val();
            var node_id = $("#node_id option:selected").val();
            var rule_id = $("#rule_id option:selected").val();

            window.location.href = '/rule/ruleLogList?uid=' + uid + '&username=' + username + '&node_id=' + node_id + '&rule_id=' + rule_id;
        }

        // 重置
        function doReset() {
            window.location.href = '/rule/ruleLogList';
        }

        // 清除所有记录
        function clearLog() {
            layer.confirm('确定清空所有记录吗？', {icon: 3, title:'警告'}, function(index) {
                $.post("/rule/clearLog", {'_token':'{{csrf_token()}}'}, function (ret) {
                    layer.msg(ret.message, {time: 1000}, function () {
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
