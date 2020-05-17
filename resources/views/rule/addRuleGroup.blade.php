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
                            <span class="caption-subject font-dark">添加规则分组</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="/rule/addRuleGroup" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name" class="control-label col-md-2 col-sm-2"> 分组名称 </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" />
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-2 col-sm-2">审计模式</label>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="mt-radio-inline">
                                            <label class="mt-radio">
                                                <input type="radio" name="type" value="1" checked /> 阻断
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="type" value="2" /> 仅放行
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rules" class="control-label col-md-2 col-sm-2">选择规则</label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="button" class="btn default" id="select-all" value="全选">
                                        <input type="button" class="btn default" id="deselect-all" value="反选">
                                        <div class="mt-checkbox-inline">
                                            @if($ruleList->isEmpty())
                                                <h3>请先 <a href="/rule/ruleList" target="_blank">添加规则</a></h3>
                                            @else
                                                <select multiple="multiple" class="multi-select" name="rules[]" id="rules">
                                                    @foreach($ruleList as $vo)
                                                        <option value="{{$vo->id}}">{{$vo->id . ' - ' . $vo->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9 col-sm-offset-2 col-sm-9">
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
        $('#rules').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='待分配规则，此处可搜索'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='已分配规则，此处可搜索'>",
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
            $('#rules').multiSelect('select_all');
            return false;
        });

        // 反选
        $('#deselect-all').click(function(){
            $('#rules').multiSelect('deselect_all');
            return false;
        });
    </script>
@endsection
