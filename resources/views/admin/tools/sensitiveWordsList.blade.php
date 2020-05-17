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
                            <span class="caption-subject"> 敏感词列表 </span><small></small>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" data-toggle="modal" data-target="#add_sensitive_words"> 添加敏感词 </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <select class="form-control" name="type" id="type" onChange="doSearch()">
                                    <option value="">类型</option>
                                    <option value="1" @if(Request::get('type') == '1') selected @endif>黑名单</option>
                                    <option value="2" @if(Request::get('type') == '2') selected @endif>白名单</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" class="col-md-4 col-sm-4 col-xs-12 form-control" name="words" value="{{Request::get('words')}}" id="words" placeholder="敏感词" onkeydown="if(event.keyCode==13){doSearch();}">
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
                                    <th> 敏感词 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($list->isEmpty())
                                    <tr>
                                        <td colspan="4" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($list as $vo)
                                        <tr class="odd gradeX">
                                            <td> {{$vo->id}} </td>
                                            <td> {!! $vo->type_label !!} </td>
                                            <td> <span class="label label-info"> {{$vo->words}} </span> </td>
                                            <td>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delWord('{{$vo->id}}')">删除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 个敏感词</div>
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

        <!-- 添加敏感词 -->
        <div id="add_sensitive_words" class="modal fade" tabindex="-1" data-focus-on="input:first" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"> 添加敏感词 </h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="add_type" class="col-md-4 control-label">类型</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="add_type" id="add_type">
                                        <option value="1">黑名单</option>
                                        <option value="2">白名单</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="add_words" class="col-md-4 control-label">敏感词</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="add_words" id="add_words" placeholder="完整的一级域名，例如：qq.com" class="form-control margin-bottom-20">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline"> 关闭 </button>
                        <button type="button" data-dismiss="modal" class="btn green btn-outline" onclick="addSensitiveWords()"> 提交 </button>
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
        // 添加敏感词
        function addSensitiveWords()
        {
            var type = $("#add_type option:selected").val();
            var words = $("#add_words").val();

            if (words == null) {
                layer.msg('敏感词不能为空', {time: 1000});
                $("#add_words").focus();
                return false;
            }

            $.post("/admin/addSensitiveWords", {_token:'{{csrf_token()}}', type:type, words:words}, function(ret) {
                layer.msg(ret.message, {time:1000}, function() {
                    if (ret.status == 'success') {
                        window.location.reload();
                    }
                });
            });
        }

        // 删除敏感词
        function delWord(id)
        {
            layer.confirm('确定删除该敏感词？', {icon: 2, title:'警告'}, function(index) {
                $.post("/admin/delSensitiveWords", {_token:'{{csrf_token()}}', id:id}, function(ret) {
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
            var type = $("#type option:selected").val();
            var words = $("#words").val();

            window.location.href = '/admin/sensitiveWordsList?type=' + type +'&words=' + words;
        }

        // 重置
        function doReset() {
            window.location.href = '/admin/sensitiveWordsList';
        }
    </script>
@endsection
