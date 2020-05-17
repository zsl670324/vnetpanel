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
                            <span class="caption-subject"> 营销列表 </span>
                        </div>
                        <div class="actions">
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <div class="btn-group">
                                        <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false"> 操作
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:singleSendEmail();"> 单个投递邮件 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:batchSendEmail();"> 批量投递邮件 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="status" id="status" onChange="doSearch()">
                                    <option value="" @if(Request::get('status') == '') selected @endif>状态</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>等待发送</option>
                                    <option value="-1" @if(Request::get('status') == '-1') selected @endif>失败</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>成功</option>
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
                                    <th> 消息标题 </th>
                                    <th> 消息内容 </th>
                                    <th> 发送状态 </th>
                                    <th> 发送时间 </th>
                                    <th> 错误信息 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($list->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($list as $vo)
                                        <tr class="odd gradeX">
                                            <td> {{$vo->id}} </td>
                                            <td> {{$vo->title}} </td>
                                            <td> {{$vo->content}} </td>
                                            <td> {{$vo->status_label}} </td>
                                            <td> {{$vo->created_at}} </td>
                                            <td> {{$vo->error}} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 条消息</div>
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
        // 单个投递邮件
        function singleSendEmail() {
            window.location.href = '/admin/addMarketing';
        }

        // 批量投递邮件
        function batchSendEmail() {
            layer.msg("开发中，敬请期待");
        }

        function doSearch() {
            var status = $("#status option:selected").val();

            window.location.href = "/admin/marketingList?status=" + status;
        }

        function doReset() {
            window.location.href = "/admin/marketingList";
        }
    </script>
@endsection
