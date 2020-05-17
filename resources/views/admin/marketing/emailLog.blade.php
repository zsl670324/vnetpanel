@extends('admin.layouts')
@section('css')
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
                            <span class="caption-subject"> 邮件投递记录 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="type" id="type" onChange="doSearch()">
                                    <option value="" @if(Request::get('type') == '') selected @endif>类型</option>
                                    <option value="1" @if(Request::get('type') == '1') selected @endif>邮件</option>
                                    <option value="2" @if(Request::get('type') == '2') selected @endif>ServerChan</option>
                                    <option value="3" @if(Request::get('type') == '3') selected @endif>Bark</option>
                                    <option value="4" @if(Request::get('type') == '4') selected @endif>Telegram</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 form-control" name="address" value="{{Request::get('address')}}" id="address" placeholder="收信地址" onkeydown="if(event.keyCode==13){do_search();}">
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
                                        <th> 识别码 </th>
                                        <th> 收信地址 </th>
                                        <th> 标题 </th>
                                        <th> 内容 </th>
                                        <th> 投递时间 </th>
                                        <th> 投递状态 </th>
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
                                            <td> {!! $vo->type_label !!} </td>
                                            <td> @if($vo->type == 3) <a href="/b/{{$vo->code}}" target="_blank">{{$vo->code}}</a> @endif </td>
                                            <td> {{$vo->address}} </td>
                                            <td> {{$vo->title}} </td>
                                            <td> {{$vo->content}} </td>
                                            <td> {{$vo->created_at}} </td>
                                            <td>
                                                @if($vo->status < 0)
                                                    <span class="label label-danger"> {{Str::limit($vo->error)}} </span>
                                                @elseif($vo->status > 0)
                                                    <labe class="label label-success">投递成功</labe>
                                                @else
                                                    <span class="label label-default"> 等待投递 </span>
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
            var type = $("#type option:selected").val();
            var address = $("#address").val();

            window.location.href = '/admin/emailLog?type=' + type + '&address=' + address;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/emailLog';
        }
    </script>
@endsection
