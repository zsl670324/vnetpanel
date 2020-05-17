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
                            <span class="caption-subject"> 规则列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-sm blue" href="#" data-toggle="modal" data-target="#add_modal" style="color: #FFF;">添加规则</a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="type" id="type" onChange="doSearch()">
                                    <option value="">类型</option>
                                    <option value="reg" @if(Request::get('type') == 'reg') selected @endif>正则表达式</option>
                                    <option value="protocol" @if(Request::get('type') == 'protocol') selected @endif>协议</option>
                                    <option value="domain" @if(Request::get('type') == 'domain') selected @endif>域名</option>
                                    <option value="ip" @if(Request::get('type') == 'ip') selected @endif>IP</option>
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
                                    <th> 类型 </th>
                                    <th> 描述 </th>
                                    <th> 值 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="5" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {!! $vo->type_label !!} </td>
                                                <td> {{$vo->name}} </td>
                                                <td> {{Str::limit($vo->pattern, 50)}} </td>
                                                <td> <button type="button" class="btn btn-sm btn-outline red" onclick="delRule('{{$vo->id}}')">删除</button> </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 条审计规则</div>
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

        <div id="add_modal" class="modal fade" tabindex="-1" data-focus-on="input:first" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">添加规则</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display: none; text-align: center;" id="add_msg"></div>
                        <form action="#" method="post" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="type" class="col-md-3 control-label"> 类型 </label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="add_type" id="add_type">
                                            <option value="reg" selected>正则表达式</option>
                                            <option value="protocol">协议</option>
                                            <option value="domain">域名</option>
                                            <option value="ip">IP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-md-3 control-label"> 描述 </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-md-3 control-label"> 值 </label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="5" name="pattern" id="pattern"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-outline dark">取消</button>
                        <button type="button" class="btn btn-outline red" onclick="return addRule();">确定</button>
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
        // 添加规则
        function addRule() {
            var type = $("#add_type option:selected").val();
            var name = $("#name").val();
            var pattern = $("#pattern").val();

            if (!name) {
                $("#add_msg").show().html('请填入描述');
                $("#name").focus();
                return false;
            } else if (!pattern) {
                $("#add_msg").show().html('请填入值');
                $("#pattern").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/rule/addRule",
                data: {_token: '{{csrf_token()}}', type: type, name: name, pattern: pattern},
                beforeSend: function () {
                    $("#add_msg").show().html("添加中，请稍后...");
                },
                success: function (ret) {
                    if (ret.status == 'fail') {
                        $("#add_msg").show().html(ret.message);
                        return false;
                    }

                    $("#add_modal").modal("hide");
                    window.location.reload();
                },
                error: function () {
                    $("#add_msg").show().html("请求异常，请刷新页面重试");
                },
                complete: function () {}
            });
        }

        // 编辑规则
        function editRule(id) {
            window.location.href = "/rule/editRule/" + id;
        }

        // 删除规则
        function delRule(id) {
            layer.confirm("确定删除吗？", {icon:3, title: '提示'}, function (index) {
                $.ajax({
                    type: "POST",
                    url: "/rule/delRule?id=" + id,
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

        // 搜索
        function doSearch() {
            var type = $("#type option:selected").val();

            window.location.href = '/rule/ruleList?type=' + type;
        }

        // 重置
        function doReset() {
            window.location.href = '/rule/ruleList';
        }
    </script>
@endsection
