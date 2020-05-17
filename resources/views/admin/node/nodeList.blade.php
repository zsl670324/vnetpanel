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
                            <span class="caption-subject"> 节点列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addNode()"> 添加节点 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> <span class="node-id"><a href="javascript:showIdTips();">ID</a></span> </th>
                                    <th> 类型 </th>
                                    <th> 名称 </th>
                                    <th> 等级 </th>
                                    <th> 限速 </th>
                                    <th> 限设备数 </th>
                                    <th> 域名 </th>
                                    <th> IP </th>
                                    <th> 存活 </th>
                                    <th> 状态 </th>
                                    <th> 在线 </th>
                                    <th> 倍率 </th>
                                    <th> 扩展 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($nodeList->isEmpty())
                                        <tr>
                                            <td colspan="13" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($nodeList as $node)
                                            <tr class="odd gradeX">
                                                <td> {{$node->id}} </td>
                                                <td> {{$node->type_label}}</td>
                                                <td> <span title="{{$node->name}}">{{Str::limit($node->name, 30)}}</span> </td>
                                                <td> {{$node->level_label}} </td>
                                                <td> {{formatNetSpeed($node->speed_limit)}} </td>
                                                <td> {{$node->client_limit}} </td>
                                                <td> <span class="label {{$node->status ? 'label-danger' : 'label-default'}}">{{$node->server}}</span> </td>
                                                <td>
                                                    @if($node->is_dynamic)
                                                        <span class="label {{$node->status ? 'label-danger' : 'label-default'}}">动态IP</span>
                                                    @else
                                                        <span class="label {{$node->status ? 'label-danger' : 'label-default'}}">{{$node->ip}}</span>
                                                    @endif
                                                </td>
                                                <td><span class="label {{$node->status ? 'label-info' : 'label-default'}}">{{$node->uptime}}</span></td>
                                                <td><span title="{{$node->load_info}}" class="label {{$node->load == '正常' ? 'label-info' : 'label-default'}}">{{$node->load}}</span></td>
                                                <td>{{$node->online_users}}</td>
                                                <td>{{$node->traffic_rate}}</td>
                                                <td>
                                                    @if($node->single) <span class="label label-info">单</span> @endif
                                                    @if($node->is_bt) <span class="label label-info">宝塔</span> @endif
                                                    @if($node->is_relay) <span class="label label-info">中转</span> @endif
                                                    @if(!$node->is_udp) <span class="label label-info"><s>UDP</s></span> @endif
                                                    @if(!$node->is_subscribe) <span class="label label-info"><s>订</s></span> @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> 操作
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:editNode('{{$node->id}}');"> 编辑 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:delNode('{{$node->id}}');"> 删除 </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:nodeMonitor('{{$node->id}}');"> 流量统计 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:reloadNode('{{$node->id}}');"> 重载后端 </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$nodeList->total()}} 个节点</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $nodeList->links() }}
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
        // 添加节点
        function addNode() {
            window.location.href = '/admin/addNode';
        }

        // 编辑节点
        function editNode(id) {
            window.location.href = '/admin/editNode?id=' + id + '&page={{Request::get('page', 1)}}';
        }

        // 删除节点
        function delNode(id) {
            layer.confirm('确定删除节点？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delNode", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 节点流量监控
        function nodeMonitor(id) {
            window.location.href = '/admin/nodeMonitor?id=' + id;
        }

        // 重载节点后端
        function reloadNode(id) {
            layer.confirm('确定重载节点后端吗？', {icon: 7, title:'警告'}, function(index) {
                $.post("/admin/reloadNode", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000});
                });

                layer.close(index);
            });
        }

        // 显示提示
        function showIdTips() {
            layer.tips('节点ID', '.node-id', {
                tips: [3, '#3595CC'],
                time: 1200
            });
        }

        // 修正table的dropdown
        $('.table-scrollable').on('show.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "inherit" );
        });

        $('.table-scrollable').on('hide.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "auto" );
        });
    </script>
@endsection
