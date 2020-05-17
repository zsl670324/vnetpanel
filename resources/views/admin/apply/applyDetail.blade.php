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
                        <div class="caption">
                            <span class="caption-subject font-dark bold">提现申请详情</span>
                        </div>
                        <div class="actions">
                            @if($info->status == -1)
                                <span class="label label-default label-danger"> 已驳回 </span>
                            @elseif($info->status == 2)
                                <span class="label label-default label-success"> 已打款 </span>
                            @else
                                <div class="btn-group">
                                    <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown"> 审核
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        @if($info->status == 0)
                                        <li>
                                            <a href="javascript:setStatus('1');"> <i class="fa fa-check"></i> 审核通过 </a>
                                        </li>
                                        <li>
                                            <a href="javascript:setStatus('-1');"> <i class="fa fa-remove"></i> 驳回 </a>
                                        </li>
                                        @endif
                                        @if($info->status == 1)
                                        <li>
                                            <a href="javascript:setStatus('2');"> <i class="fa fa-circle-o"></i> 已打款 </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-checkable">
                                <thead>
                                    <tr>
                                        <th colspan="6">申请单ID：{{$info->id}} | 申请人：{{$info->user->username}} | 申请提现金额：￥{{$info->amount}} | 申请时间：{{$info->created_at}}</th>
                                    </tr>
                                    <tr>
                                        <th> # </th>
                                        <th> 关联人 </th>
                                        <th> 关联订单 </th>
                                        <th> 订单金额 </th>
                                        <th> 佣金 </th>
                                        <th> 下单时间 </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($list->isEmpty())
                                        <tr>
                                            <td colspan="6" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($list as $vo)
                                            <tr>
                                                <td> {{$vo->id}} </td>
                                                <td> {{empty($vo->user) ? '【账号已删除】' : $vo->user->username}} </td>
                                                <td> <a href="/admin/orderList?trade_no={{$vo->order->payment->trade_no}}" target="_blank">{{$vo->order->product->name}}</a></td>
                                                <td> ￥{{$vo->amount}} </td>
                                                <td> ￥{{$vo->ref_amount}} </td>
                                                <td> {{$vo->created_at}} </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">本申请共涉及 {{$list->total()}} 单</div>
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
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 更改状态
        function setStatus(status) {
            $.post("/admin/setApplyStatus", {_token:'{{csrf_token()}}', id:'{{$info->id}}', status:status}, function(ret){
                layer.msg(ret.message, {time:1000}, function() {
                    window.location.reload();
                });
            });
        }
    </script>
@endsection
