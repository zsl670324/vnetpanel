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
                            <span class="caption-subject"> 节点实时状态<small>（需启用节点宝塔API）</small> </span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 名称 </th>
                                    <th> 实时状态 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($nodeList->isEmpty())
                                        <tr>
                                            <td colspan="3" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($nodeList as $node)
                                            <tr class="odd gradeX">
                                                <td> {{$node->id}} </td>
                                                <td> {{Str::limit($node->name, 20)}} </td>
                                                <td> <span class="label label-info" id="node-online-status-{{$node->id}}"></span> </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
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
        // 修正table的dropdown
        $('.table-scrollable').on('show.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "inherit" );
        });

        $('.table-scrollable').on('hide.bs.dropdown', function () {
            $('.table-scrollable').css( "overflow", "auto" );
        });

        $(document).ready(function() {
            setInterval("getNodeStatus()", 2000);
        });

        // 检查节点实时状态
        function getNodeStatus() {
            $.ajax({
                type: "GET",
                url: "/admin/getNodeStatus",
                success: function (ret) {
                    console.log(ret);
                    $.each(ret.data, function (i, j) {
                        $("#node-online-status-" + i).html("上行：" + j.up + "KB，" + "下行：" + j.down + 'KB' + "，CPU：" + j.cpu[0] + "%，内存：" + (j.mem.memRealUsed / j.mem.memTotal * 100).toFixed(2) + "%（" + j.mem.memTotal + "M）" + "总发送：" + (j.upTotal / 1024 / 1024 / 1024).toFixed(2) + "GB" + "，总接收：" + (j.downTotal / 1024 / 1024 / 1024).toFixed(2) + "GB，" + j.cpu[1] + "核");
                    });
                },
                error: function () {
                    console.log("请求错误，请重试");
                }
            });
        }
    </script>
@endsection
