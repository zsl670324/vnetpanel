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
                            <span class="caption-subject"> 域名证书列表<small>（V2Ray节点的伪装域名）</small> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addCertificate()"> 添加域名证书 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> 域名 </th>
                                        <th> KEY </th>
                                        <th> PEM </th>
                                        <th> 签发机构 </th>
                                        <th> 签发日期 </th>
                                        <th> 到期时间 </th>
                                        <th> 操作 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="8" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {{$vo->domain}} </td>
                                                <td> {{$vo->key ? '✔' : '❌'}} </td>
                                                <td> {{$vo->pem ? '✔' : '❌'}} </td>
                                                <td> {{$vo->issuer}} </td>
                                                <td> {{$vo->from}} </td>
                                                <td> {{$vo->to}} </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm blue btn-outline" onclick="editCertificate('{{$vo->id}}')">编辑</button>
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="refreshCertificate('{{$vo->id}}')">重置证书</button>
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="delCertificate('{{$vo->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 个域名证书</div>
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
        // 添加域名证书
        function addCertificate() {
            window.location.href = '/admin/addCertificate';
        }

        // 编辑域名证书
        function editCertificate(id) {
            window.location.href = '/admin/editCertificate?id=' + id;
        }

        // 重置域名证书
        function refreshCertificate(id) {
            layer.confirm("该域名的证书KEY、证书PEM将被清空，确定继续操作吗？", {icon: 7, title:'提示'},  function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/refreshCertificate",
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

        // 删除域名证书
        function delCertificate(id) {
            layer.confirm("确定删除该证书吗？", {icon: 7, title:'提示'},  function (index) {
                $.ajax({
                    type: "POST",
                    url: "/admin/delCertificate",
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
