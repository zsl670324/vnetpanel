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
                            <span class="caption-subject"> 文章列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addArticle()"> 添加文章 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="title" value="{{Request::get('title')}}" id="title" placeholder="标题" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="type" id="type" onChange="doSearch()">
                                    <option value="" @if(Request::get('type') == '') selected @endif>类型</option>
                                    <option value="1" @if(Request::get('type') == '1') selected @endif>文章</option>
                                    <option value="2" @if(Request::get('type') == '2') selected @endif>站内公告</option>
                                    <option value="3" @if(Request::get('type') == '3') selected @endif>站外公告</option>
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
                                    <th> 标题 </th>
                                    <th> 排序 </th>
                                    <th> 发布日期 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($list->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($list as $vo)
                                        <tr class="odd gradeX">
                                            <td> {{$vo->id}} </td>
                                            <td> {{$vo->type_label}} </td>
                                            <td> <a href="/article/{{$vo->id}}" target="_blank"> {{Str::limit($vo->title, 80)}} </a> </td>
                                            <td> {{$vo->sort}} </td>
                                            <td> {{$vo->created_at}} </td>
                                            <td>
                                                <button type="button" class="btn btn-sm blue btn-outline" onclick="editArticle('{{$vo->id}}')"> 编辑 </button>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delArticle('{{$vo->id}}')"> 删除 </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 篇文章</div>
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
        // 添加文章
        function addArticle() {
            window.location.href = '/admin/addArticle';
        }

        // 编辑文章
        function editArticle(id) {
            window.location.href = '/admin/editArticle?id=' + id + '&page=' + '{{Request::get('page', 1)}}';
        }

        // 删除文章
        function delArticle(id) {
            layer.confirm('确定删除文章？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delArticle", {id:id, _token:'{{csrf_token()}}'}, function(ret) {
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
        function doSearch() {
            var title = $("#title").val();
            var type = $("#type option:selected").val();

            window.location.href = '/admin/articleList?title=' + title +'&type=' + type;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/articleList';
        }
    </script>
@endsection
