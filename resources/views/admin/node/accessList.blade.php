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
                            <span class="caption-subject"> 节点授权列表<small>（WEBAPI）</small> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addAccess()"> 生成授权 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="nodeId" id="nodeId" onChange="doSearch()">
                                    <option value="">全部</option>
                                    @foreach($nodeList as $vo)
                                        <option value="{{$vo->id}}" @if(Request::get('nodeId') == $vo->id) selected @endif>{{$vo->id}} - {{$vo->name}} - {{$vo->ip}}</option>
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
                                        <th> 节点ID </th>
                                        <th> 节点类型 </th>
                                        <th> 节点名称 </th>
                                        <th> 节点域名 </th>
                                        <th> IPv4 </th>
                                        <th> 通信密钥<small>（节点用）</small> </th>
                                        <th> 反向通信密钥 </th>
                                        <th> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="9" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {{$vo->node_id}} </td>
                                                <td> {{$vo->node->type_label}} </td>
                                                <td> {{$vo->node ? Str::limit($vo->node->name, 20) : '【节点已删除】'}} </td>
                                                <td> {{$vo->node ? $vo->node->server : '【节点已删除】'}} </td>
                                                <td> {{$vo->node ? $vo->node->ip : '【节点已删除】'}} </td>
                                                <td> <span class="label label-info"> {{$vo->key}} </span> </td>
                                                <td> <span class="label label-info"> {{$vo->secret}} </span> </td>
                                                <td>
                                                    <a class="btn btn-sm btn-outline blue" href="#" data-toggle="modal" data-target="#install_{{$vo->node->type}}_{{$vo->id}}" >部署后端</a>
                                                    <button type="button" class="btn btn-sm btn-outline red" onclick="refreshAccess('{{$vo->id}}')">重置密钥</button>
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="delAccess('{{$vo->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 条授权</div>
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

        <!-- 部署后端 -->
        @foreach($list as $vl)
            <div id="install_{{$vl->node->type}}_{{$vl->id}}" class="modal fade" tabindex="-1" data-focus-on="input:first" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">
                                部署 {{$vl->node->type_label}} 后端
                            </h4>
                        </div>
                        <div class="modal-body">
                            @if($vl->node->type == '2')
                                <div class="alert alert-info" style="-ms-word-break: break-all;word-break: break-all;">
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">VNET-V2Ray</div>
                                        (yum install curl 2> /dev/null || apt install curl 2> /dev/null) \<br>
                                        && curl -L -s https://bit.ly/2xoemF2 \<br>
                                        | WEB_API="{{\App\Components\Helpers::systemConfig()['vnet_license'] ?: \App\Components\Helpers::systemConfig()['website_url']}}" \<br>
                                        NODE_ID={{$vl->node->id}} \<br>
                                        NODE_KEY={{$vl->key}} \<br>
                                        bash
                                    <br>
                                    <br>
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">操作命令</div>
                                    更新：同上
                                    <br>
                                    卸载：curl -L -s https://bit.ly/2xoemF2 | bash -s -- --remove
                                    <br>
                                    启动：systemctl start vnet-v2ray
                                    <br>
                                    停止：systemctl stop vnet-v2ray
                                    <br>
                                    状态：systemctl status vnet-v2ray
                                    <br>
                                    近期日志：journalctl -x -n 300 --no-pager -u vnet-v2ray
                                    <br>
                                    实时日志：journalctl -u vnet-v2ray -f
                                </div>
                                <div class="alert alert-info" style="-ms-word-break: break-all;word-break: break-all;">
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">V2Ray-Poseidon</div>
                                    (yum install curl 2> /dev/null || apt install curl 2> /dev/null) \<br>
                                    && curl -L -s https://bit.ly/2VhvcPz \<br>
                                    | WEB_API="{{\App\Components\Helpers::systemConfig()['vnet_license'] ?: \App\Components\Helpers::systemConfig()['website_url']}}" \<br>
                                    NODE_ID={{$vl->node->id}} \<br>
                                    NODE_KEY={{$vl->key}} \<br>
                                    bash
                                    <br>
                                    <br>
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">操作命令</div>
                                    更新：curl -L -s https://bit.ly/2VhvcPz | bash
                                    <br>
                                    卸载：curl -L -s https://bit.ly/2SGFMMY | bash
                                    <br>
                                    启动：systemctl start v2ray
                                    <br>
                                    停止：systemctl stop v2ray
                                    <br>
                                    状态：systemctl status v2ray
                                    <br>
                                    近期日志：journalctl -x -n 300 --no-pager -u v2ray
                                    <br>
                                    实时日志：journalctl -u v2ray -f
                                </div>
                            @elseif($vl->node->type == '3')
                                @if(!$vl->node->server)
                                    <h3>请先<a href="/admin/editNode?id={{$vl->node->id}}" target="_blank">填写节点域名</a>并将域名解析到节点对应的IP上</h3>
                                @else
                                    <div class="alert alert-info" style="-ms-word-break: break-all;word-break: break-all;">
                                        <div style="text-align: center; color: red; margin-bottom: 5px;">Trojan-Poseidon</div>
                                        (yum install curl 2> /dev/null || apt install curl 2> /dev/null) \<br>
                                        && curl -L -s https://bit.ly/33UdELu \<br>
                                        | WEB_API="{{\App\Components\Helpers::systemConfig()['vnet_license'] ?: \App\Components\Helpers::systemConfig()['website_url']}}" \<br>
                                        NODE_ID={{$vl->node->id}} \<br>
                                        NODE_KEY={{$vl->key}} \<br>
                                        NODE_HOST={{$vl->node->server}} \<br>
                                        bash
                                        <br>
                                        <br>
                                        <div style="text-align: center; color: red; margin-bottom: 5px;">操作命令</div>
                                        更新：curl -L -s https://bit.ly/33UdELu | bash
                                        <br>
                                        卸载：curl -L -s https://bit.ly/2Jl9bs7 | bash
                                        <br>
                                        启动：systemctl start trojanp
                                        <br>
                                        停止：systemctl stop trojanp
                                        <br>
                                        状态：systemctl status trojanp
                                        <br>
                                        近期日志：journalctl -x -n 300 --no-pager -u trojanp
                                        <br>
                                        实时日志：journalctl -u trojanp -f
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-info" style="-ms-word-break: break-all;word-break: break-all;">
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">VNET</div>
                                    (yum install curl 2> /dev/null || apt install curl 2> /dev/null) \<br>
                                    && curl -L -s https://bit.ly/2RNkPk7 \<br>
                                    | WEB_API="{{\App\Components\Helpers::systemConfig()['vnet_license'] ?: \App\Components\Helpers::systemConfig()['website_url']}}" \<br>
                                    NODE_ID={{$vl->node->id}} \<br>
                                    NODE_KEY={{$vl->key}} \<br>
                                    bash
                                    <br>
                                    <br>
                                    <div style="text-align: center; color: red; margin-bottom: 5px;">操作命令</div>
                                    更新：同上
                                    <br>
                                    卸载：curl -L -s https://bit.ly/2RNkPk7 | bash -s -- --remove
                                    <br>
                                    启动：systemctl start vnet
                                    <br>
                                    停止：systemctl stop vnet
                                    <br>
                                    重启：systemctl restart vnet
                                    <br>
                                    状态：systemctl status vnet
                                    <br>
                                    近期日志：journalctl -x -n 300 --no-pager -u vnet
                                    <br>
                                    实时日志：journalctl -u vnet -f
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // 搜索
        function doSearch() {
            var nodeId = $("#nodeId").val();

            window.location.href = '/admin/accessList?nodeId=' + nodeId;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/accessList';
        }

        // 生成授权KEY
        function addAccess() {
            layer.confirm("确定生成所有节点的授权吗？", {icon: 7, title:'提示'},  function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/addAccess",
                    async: false,
                    data: {_token: '{{csrf_token()}}'},
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

        // 删除授权
        function delAccess(id) {
            layer.confirm("确定删除该授权吗？", {icon: 7, title:'提示'},  function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/delAccess",
                    async: false,
                    data: {_token:'{{csrf_token()}}', id: id},
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

        // 重置授权认证KEY
        function refreshAccess(id) {
            layer.confirm("确定继续操作吗？", {icon: 7, title:'提示'},  function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/refreshAccess",
                    async: false,
                    data: {_token:'{{csrf_token()}}', id: id},
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
