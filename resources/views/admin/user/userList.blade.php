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
                            <span class="caption-subject"> 用户列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <div class="btn-group">
                                    <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false"> 操作
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:addUser();"> 添加用户 </a>
                                        </li>
                                        <li>
                                            <a href="javascript:batchAddUsers();"> 批量生成 </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="javascript:exportUser(1);"> 导出 </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="id" value="{{Request::get('id')}}" id="id" placeholder="用户ID" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="code" value="{{Request::get('code')}}" id="code" placeholder="订阅码" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="username" value="{{Request::get('username')}}" id="username" placeholder="用户名" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="wechat" value="{{Request::get('wechat')}}" id="wechat" placeholder="微信" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="qq" value="{{Request::get('qq')}}" id="qq" placeholder="QQ" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="address" value="{{Request::get('address')}}" id="address" placeholder="地址" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="phone" value="{{Request::get('phone')}}" id="phone" placeholder="电话" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="port" value="{{Request::get('port')}}" id="port" placeholder="端口" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="expire_time" value="{{Request::get('expire_time')}}" id="expire_time" placeholder="有效期" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="group_id" id="group_id" onChange="doSearch(0)">
                                    <option value="" @if(Request::get('group_id') == '') selected @endif>所属分组</option>
                                    @foreach($userGroupList as $vo)
                                        <option value="{{$vo->id}}" @if(Request::has('group_id') && Request::get('group_id') == $vo->id && Request::get('group_id') != '') selected @endif>{{$vo->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="level" id="level" onChange="doSearch(0)">
                                    <option value="" @if(Request::get('level') == '') selected @endif>等级</option>
                                    @foreach(config('common.level_map') as $key => $vo)
                                        <option value="{{$key}}" @if(Request::has('level') && Request::get('level') == $key && Request::get('level') != '') selected @endif>{{$vo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="pay_way" id="pay_way" onChange="doSearch(0)">
                                    <option value="" @if(Request::get('pay_way') == '') selected @endif>付费方式</option>
                                    <option value="0" @if(Request::get('pay_way') == '0') selected @endif>免费</option>
                                    <option value="1" @if(Request::get('pay_way') == '1') selected @endif>月付</option>
                                    <option value="2" @if(Request::get('pay_way') == '2') selected @endif>季付</option>
                                    <option value="3" @if(Request::get('pay_way') == '3') selected @endif>半年付</option>
                                    <option value="4" @if(Request::get('pay_way') == '4') selected @endif>年付</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="status" id="status" onChange="doSearch(0)">
                                    <option value="" @if(Request::get('status') == '') selected @endif>账号状态</option>
                                    <option value="-1" @if(Request::get('status') == '-1') selected @endif>禁用</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>未激活</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>正常</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="enable" id="enable" onChange="doSearch(0)">
                                    <option value="" @if(Request::get('enable') == '') selected @endif>代理状态</option>
                                    <option value="1" @if(Request::get('enable') == '1') selected @endif>启用</option>
                                    <option value="0" @if(Request::get('enable') == '0') selected @endif>禁用</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <button type="button" class="btn blue" onclick="doSearch(0);">查询</button>
                                <button type="button" class="btn grey" onclick="doReset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> UID </th>
                                    <th> 订阅码 </th>
                                    <th> 用户名 </th>
                                    <th> 端口 </th>
                                    <th> 所属分组 </th>
                                    <th> 等级 </th>
                                    <th> 限速 </th>
                                    <th> 已消耗 </th>
                                    <th> 最后使用 </th>
                                    <th> 最后连接 </th>
                                    <th> 归属地 </th>
                                    <th> 有效期 </th>
                                    <th> 状态 </th>
                                    <th> 代理 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($userList->isEmpty())
                                        <tr>
                                            <td colspan="15" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach ($userList as $user)
                                            <tr class="odd gradeX {{$user->trafficWarning ? 'danger' : ''}}">
                                                <td> {{$user->id}} </td>
                                                <td> <a href="javascript:;" class="copySubscribeLink" data-clipboard-text="{{$user->sub_link}}" title="点击复制订阅链接">{{$user->subscribe->code}}</a> </td>
                                                <td> <a href="javascript:;" class="copyShadowrocketSubLink" data-clipboard-text="{{$user->shadowrocket_sub_link}}" title="点击复制Shadowrocket订阅链接">{{$user->username}}</a> </td>
                                                <td> <a href="javascript:;" class="copyShadowrocketSubPage" data-clipboard-text="{{$user->shadowrocket_sub_page}}" title="点击复制Shadowrocket订阅提示页">{{$user->port ? $user->port : '未分配'}}</a> </td>
                                                <td> {{$user->group ? $user->group->name : ''}} </td>
                                                <td> <a href="javascript:;" class="copyAllNodes" data-clipboard-text="{{$user->ssr_link}}" title="点击复制所有可用节点">{{$user->level_label}}</a> </td>
                                                <td> <span class="label label-info"> {{formatNetSpeed($user->speed_limit)}} </span> </td>
                                                <td class="center"> {{$user->used_flow}} / {{$user->transfer_enable}} </td>
                                                <td class="center"> {{$user->t_label}} </td>
                                                <td class="center"> {{$user->ip}} </td>
                                                <td class="center"> {{$user->ipInfo}} </td>
                                                <td class="center">
                                                    @if ($user->expireWarning == '-1')
                                                        <span class="label label-danger"> {{$user->expire_time}} </span>
                                                    @elseif ($user->expireWarning == '0')
                                                        <span class="label label-warning"> {{$user->expire_time}} </span>
                                                    @elseif ($user->expireWarning == '1')
                                                        <span class="label label-default"> {{$user->expire_time}} </span>
                                                    @else
                                                        {{$user->expire_time}}
                                                    @endif
                                                </td>
                                                <td> {!! $user->status_label !!} </td>
                                                <td> {!! $user->enable_label !!} </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false" aria-haspopup="true"> 操作
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:editUser('{{$user->id}}');"> 编辑 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:delUser('{{$user->id}}');"> 删除 </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:doExport('{{$user->id}}');"> 配置信息 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:resetSubscribe('{{$user->id}}');"> 重置订阅 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:doMonitor('{{$user->id}}');"> 流量统计 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:ipMonitor('{{$user->id}}');"> 在线巡查 </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:resetTraffic('{{$user->id}}');"> 流量清零 </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:addTicket('{{$user->username}}');"> 发起工单 </a>
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
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$userList->total()}} 个账号</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $userList->links() }}
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
    <script src="/assets/global/plugins/laydate/laydate.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/clipboardjs/clipboard.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 到期时间
        laydate.render({
            elem: '#expire_time',
            type: 'date',
            range: '至',
            value: '{{urldecode(Request::get('expire_time'))}}'
        });

        // 导出用户订阅链接列表
        function exportUser() {
            layer.confirm("确定导出用户数据吗？", {icon:3, title: '按查询条件导出数据'}, function (index) {
                doSearch(1);

                layer.close(index);
            });
        }

        // 批量生成账号
        function batchAddUsers() {
            layer.confirm('将自动生成5个账号，确定继续吗？', {icon: 3, title:'注意'}, function(index) {
                $.post("/admin/batchAddUsers", {_token:'{{csrf_token()}}'}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 添加账号
        function addUser() {
            window.location.href = '/admin/addUser';
        }

        // 编辑账号
        function editUser(id) {
            @if(Request::getQueryString())
                window.location.href = '/admin/editUser?id=' + id + '&{!! urldecode(http_build_query(Request::except('id'))) !!}';
            @else
                window.location.href = '/admin/editUser?id=' + id;
            @endif
        }

        // 删除账号
        function delUser(id) {
            layer.confirm('确定删除账号？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delUser", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
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
        function doSearch(is_export) {
            var id = $("#id").val();
            var code = $("#code").val();
            var username = $("#username").val();
            var wechat = $("#wechat").val();
            var qq = $("#qq").val();
            var address = $("#address").val();
            var phone = $("#phone").val();
            var port = $("#port").val();
            var expire_time = $("#expire_time").val();
            var group_id = $("#group_id option:selected").val();
            var level = $("#level option:selected").val();
            var pay_way = $("#pay_way option:selected").val();
            var status = $("#status option:selected").val();
            var enable = $("#enable option:selected").val();
            var active = {{Request::get('active') ?: 0}};
            var unActive = {{Request::get('unActive') ?: 0}};
            var flowAbnormal = {{Request::get('flowAbnormal') ?: 0}};
            var expireWarning = {{Request::get('expireWarning') ?: 0}};
            var largeTraffic = {{Request::get('largeTraffic') ?: 0}};

            window.location.href = '/admin/userList?id=' + id
                + '&code=' + code
                + '&username=' + username
                + '&wechat=' + wechat
                + '&qq=' + qq
                + '&address=' + address
                + '&phone=' + phone
                + '&port=' + port
                + '&expire_time=' + expire_time
                + '&group_id=' + group_id
                + '&level=' + level
                + '&pay_way=' + pay_way
                + '&status=' + status
                + '&enable=' + enable
                + '&active=' + active
                + '&unActive=' + unActive
                + '&flowAbnormal=' + flowAbnormal
                + '&expireWarning=' + expireWarning
                + '&largeTraffic=' + largeTraffic
                + '&is_export=' + is_export;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/userList';
        }

        // 导出配置
        function doExport(id) {
            window.location.href = '/admin/export?id=' + id;
        }

        // 重置订阅
        function resetSubscribe(id) {
            layer.confirm('重置用户订阅会导致代理密码被改变，确定继续操作吗？', {icon: 7, title:'警告'}, function(index) {
                $.post("/admin/resetUserSubscribe", {_token:'{{csrf_token()}}', id:id}, function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 流量监控
        function doMonitor(id) {
            window.location.href = '/admin/userMonitor?id=' + id;
        }

        function ipMonitor(id) {
            window.location.href = '/admin/onlineIPMonitor?id=' + id;
        }

        // 重置流量
        function resetTraffic(id) {
            layer.confirm('确定重置该用户流量吗？', {icon: 7, title:'警告'}, function(index) {
                $.post("/admin/resetUserTraffic", {_token:'{{csrf_token()}}', id:id}, function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }

        // 发起工单
        function addTicket(username) {
            window.location.href = '/admin/addTicket?username=' + username;
        }

        // 修正table的dropdown
        $('.table-scrollable').on('show.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "inherit" );
        });

        $('.table-scrollable').on('hide.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "auto" );
        });

        // 复制订阅链接
        var sub_clipboard = new Clipboard('.copySubscribeLink');
        sub_clipboard.on('success', function(e) {
            layer.msg("已复制订阅链接", {time: 1000});
        });
        sub_clipboard.on('error', function(e) {
            console.log(e);
        });

        // 复制Shadowrocket订阅链接
        var shadowrocket_sub_link_clipboard = new Clipboard('.copyShadowrocketSubLink');
        shadowrocket_sub_link_clipboard.on('success', function(e) {
            layer.msg("已复制Shadowrocket订阅链接", {time: 1000});
        });
        shadowrocket_sub_link_clipboard.on('error', function(e) {
            console.log(e);
        });

        // 复制Shadowrocket订阅提示页
        var shadowrocket_sub_page_clipboard = new Clipboard('.copyShadowrocketSubPage');
        shadowrocket_sub_page_clipboard.on('success', function(e) {
            layer.msg("已复制Shadowrocket订阅提示页链接", {time: 1000});
        });
        shadowrocket_sub_page_clipboard.on('error', function(e) {
            console.log(e);
        });

        // 复制可用节点的SSR链接
        var copyAllNodes_clipboard = new Clipboard('.copyAllNodes');
        copyAllNodes_clipboard.on('success', function(e) {
            layer.msg("已复制所有节点链接", {time: 1000});
        });
        copyAllNodes_clipboard.on('error', function(e) {
            console.log(e);
        });

    </script>
@endsection
