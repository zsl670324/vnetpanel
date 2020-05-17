@extends('admin.layouts')
@section('css')
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
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">分配权限行为</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <form action="/permission/assignPermission" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">选择</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="button" class="btn default" id="select-all" value="全选">
                                        <input type="button" class="btn default" id="deselect-all" value="反选">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2">权限</label>
                                    <div class="col-md-8 col-sm-9">
                                        {{csrf_field()}}
                                        <input type="hidden" name="role_id" value="{{Request::input('role_id')}}">
                                        <select multiple="multiple" class="multi-select" id="permissions" name="permissions[]">
                                            @foreach($permissions as $vo)
                                                <option value="{{$vo->name}}" {{$vo->has ? 'selected' : ''}}>{{$vo->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9 col-sm-offset-2 col-sm-9">
                                        <button type="submit" class="btn green"> 提 交 </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $('#permissions').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='待分配的权限行为，此处可搜索'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='已分配的权限行为，此处可搜索'>",
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
            $('#permissions').multiSelect('select_all');
            return false;
        });

        // 反选
        $('#deselect-all').click(function(){
            $('#permissions').multiSelect('deselect_all');
            return false;
        });
    </script>
@endsection
