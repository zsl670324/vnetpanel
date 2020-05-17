@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
    <style>
        .ms-container {
            width: auto;
        }
        .ms-container .ms-list {
            height: 350px;
            line-height: 30px;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('successMsg'))
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        {{Session::get('successMsg')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <span> {{$errors->first()}} </span>
                    </div>
                @endif
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">添加用户分组</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="/admin/addUserGroup" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label"> 分组名称 </label>
                                    <div class="col-md-8 col-xs-12">
                                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" />
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nodes" class="col-md-2 control-label">选择节点</label>
                                    <div class="col-md-8">
                                        <input type="button" class="btn default" id="select-all" value="全选">
                                        <input type="button" class="btn default" id="deselect-all" value="反选">
                                        <div class="mt-checkbox-inline">
                                            <select multiple="multiple" class="multi-select" name="nodes[]" id="nodes">
                                                @foreach($nodeList as $vo)
                                                    <option value="{{$vo->id}}">{{$vo->id . ' - ' . $vo->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-4">
                                        <button type="submit" class="btn green"> 提 交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.quicksearch.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 权限列表
        $('#nodes').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='待分配的节点，此处可搜索'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='已分配的节点，此处可搜索'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        // 全选
        $('#select-all').click(function(){
            $('#nodes').multiSelect('select_all');
            return false;
        });

        // 反选
        $('#deselect-all').click(function(){
            $('#nodes').multiSelect('deselect_all');
            return false;
        });
    </script>
@endsection
