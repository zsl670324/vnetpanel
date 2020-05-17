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
                            <span class="caption-subject"> 用户画像 </span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="id" value="{{Request::get('id')}}" id="id" placeholder="用户ID" onkeydown="if(event.keyCode==13){doSearch(0);}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="username" value="{{Request::get('username')}}" id="username" placeholder="用户名" onkeydown="if(event.keyCode==13){doSearch(0);}">
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
                                    <th> 用户名 </th>
                                    <th> IP </th>
                                    <th> 国家 </th>
                                    <th> 省份 </th>
                                    <th> 城市 </th>
                                    <th> 区县 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($list->isEmpty())
                                        <tr>
                                            <td colspan="7" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach ($list as $vo)
                                            <tr class="odd gradeX">
                                                <td> {{$vo->id}} </td>
                                                <td> {{$vo->user->username}} </td>
                                                <td class="center"> {{$vo->ip}} </td>
                                                <td class="center"> {{$vo->country}} </td>
                                                <td class="center"> {{$vo->province}} </td>
                                                <td class="center"> {{$vo->city}} </td>
                                                <td class="center"> {{$vo->county}} </td>
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
@endsection
