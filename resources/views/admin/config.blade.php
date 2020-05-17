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
                    <div class="portlet-body">
                        <ul class="nav nav-tabs">
                            <li @if(Request::get('tab') == '' || Request::get('tab') == '1') class="active" @endif>
                                <a href="#tab1" data-toggle="tab"> 加密方式 </a>
                            </li>
                            <li @if(Request::get('tab') == '2') class="active" @endif>
                                <a href="#tab2" data-toggle="tab"> 协议 </a>
                            </li>
                            <li @if(Request::get('tab') == '3') class="active" @endif>
                                <a href="#tab3" data-toggle="tab"> 混淆 </a>
                            </li>
                            <li @if(Request::get('tab') == '4') class="active" @endif>
                                <a href="#tab4" data-toggle="tab"> 国家/地区 </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade {{Request::get('tab') == '' || Request::get('tab') == '1' ? 'active in' : ''}}" id="tab1">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light table-checkable">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;"> 名称 </th>
                                                <th style="width: 50%;"> 操作 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($method_list->isEmpty())
                                            <tr>
                                                <td colspan="2">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($method_list as $method)
                                                <tr class="odd gradeX">
                                                    <td> {{$method->name}} </td>
                                                    <td>
                                                        @if($method->is_default)
                                                            <span class='label label-info'>默认</span>
                                                        @else
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('1', '{{$method->id}}')">默认</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{Request::get('tab') == '2' ? 'active in' : ''}}" id="tab2">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light table-checkable">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;"> 名称 </th>
                                                <th style="width: 50%;"> 操作 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($method_list->isEmpty())
                                            <tr>
                                                <td colspan="2">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($protocol_list as $protocol)
                                                <tr class="odd gradeX">
                                                    <td> {{$protocol->name}} </td>
                                                    <td>
                                                        @if($protocol->is_default)
                                                            <span class='label label-info'>默认</span>
                                                        @else
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('2', '{{$protocol->id}}')">默认</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{Request::get('tab') == '3' ? 'active in' : ''}}" id="tab3">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light table-checkable">
                                        <thead>
                                        <tr>
                                            <th style="width: 50%;"> 名称 </th>
                                            <th style="width: 50%;"> 操作 </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($obfs_list->isEmpty())
                                            <tr>
                                                <td colspan="2">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($obfs_list as $obfs)
                                                <tr class="odd gradeX">
                                                    <td> {{$obfs->name}} </td>
                                                    <td>
                                                        @if($obfs->is_default)
                                                            <span class='label label-info'>默认</span>
                                                        @else
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('3', '{{$obfs->id}}')">默认</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{Request::get('tab') == '4' ? 'active in' : ''}}" id="tab4">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light table-checkable">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%;"> 图标 </th>
                                                <th style="width: 30%;"> 代码 </th>
                                                <th style="width: 40%;"> 名称 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($country_list->isEmpty())
                                            <tr>
                                                <td colspan="3">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($country_list as $country)
                                                <tr class="odd gradeX" >
                                                    <td>
                                                        <img src="{{asset('assets/images/country/' . $country->code . '.svg')}}" style="width: 70px; height: 70px;" />
                                                    </td>
                                                    <td> {{$country->code}} </td>
                                                    <td> {{$country->name}} </td>
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
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // modal关闭时刷新页面
        $(".modal").on("hidden.bs.modal", function () {
            window.location.reload();
        });

        // 置为默认
        function setDefault(tabId, id) {
            var _token = '{{csrf_token()}}';
            $.ajax({
                type: "POST",
                url: "/admin/setDefaultConfig",
                async: false,
                data: {_token:_token, id: id},
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/config?tab=' + tabId;
                        }
                    });
                }
            });
        }
    </script>
@endsection
