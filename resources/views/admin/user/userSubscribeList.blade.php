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
                            <span class="caption-subject">订阅码列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="code" value="{{Request::get('code')}}" id="code" placeholder="订阅码" autocomplete="off" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="user_id" value="{{Request::get('user_id')}}" id="user_id" placeholder="用户ID" autocomplete="off" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="username" value="{{Request::get('username')}}" id="username" placeholder="用户名" autocomplete="off" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="status" id="status" onChange="doSearch()">
                                    <option value="" @if(Request::get('status') == '') selected @endif>状态</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>正常</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>禁用</option>
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
                                    <th> 订阅码 </th>
                                    <th> 用户 </th>
                                    <th> 请求次数 </th>
                                    <th> 最后请求时间 </th>
                                    <th> 封禁时间 </th>
                                    <th> 封禁理由 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($subscribeList->isEmpty())
                                        <tr>
                                            <td colspan="8" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($subscribeList as $subscribe)
                                            <tr class="odd gradeX">
                                                <td> {{$subscribe->id}} </td>
                                                <td> {{$subscribe->code}} </td>
                                                <td>
                                                    @if(empty($subscribe->user))
                                                        【账号已删除】
                                                    @else
                                                        <a href="/admin/userList?id={{$subscribe->user->id}}" target="_blank">{{$subscribe->user->username}}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subscribe->user)
                                                        <a href="/admin/userSubscribeLog?user_id={{$subscribe->user->id}}" target="_blank">{{$subscribe->times}}</a> </td>
                                                    @endif
                                                <td> {{$subscribe->updated_at}} </td>
                                                <td> {{$subscribe->ban_time > 0 ? date('Y-m-d H:i:s', $subscribe->ban_time) : ''}} </td>
                                                <td> {{$subscribe->ban_desc}} </td>
                                                <td>
                                                    @if($subscribe->status == 0)
                                                        <button type="button" class="btn btn-sm green btn-outline" onclick="setUserSubscribeStatus('{{$subscribe->id}}', 1)">启用</button>
                                                    @endif
                                                    @if($subscribe->status == 1)
                                                        <button type="button" class="btn btn-sm red btn-outline" onclick="setUserSubscribeStatus('{{$subscribe->id}}', 0)">禁用</button>
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
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$subscribeList->total()}} 条记录</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $subscribeList->links() }}
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
            var user_id = $("#user_id").val();
            var username = $("#username").val();
            var code = $("#code").val();
            var status = $("#status option:selected").val();

            window.location.href = '/admin/userSubscribeList?user_id=' + user_id + '&username=' + username + '&code=' + code + '&status=' + status;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/userSubscribeList';
        }

        // 启用禁用用户的订阅
        function setUserSubscribeStatus(id, status) {
            $.post("/admin/setUserSubscribeStatus", {_token:'{{csrf_token()}}', id:id, status:status}, function(ret) {
                layer.msg(ret.message, {time:1000}, function() {
                    window.location.reload();
                });
            });
        }
    </script>
@endsection
