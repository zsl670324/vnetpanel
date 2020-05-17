@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
    <style>
        .ms-container {
            width: auto;
        }
        .ms-container .ms-list {
            height: 340px;
            line-height: 30px;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="tab-pane">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="/permission/addMaster" method="post" class="form-horizontal" onsubmit="return do_submit();">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-dark">账号信息</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label for="username" class="control-label col-md-2 col-sm-2">用户名</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="" autocomplete="off" autofocus required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="control-label col-md-2 col-sm-2">密码</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" name="password" id="password" placeholder="留空则自动生成随机密码" autocomplete="off" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success" type="button" onclick="makePassword()"> 生成 </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2">有效期至</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="expire_time" value="{{date('Y-m-d H:i:s', strtotime("+1 year"))}}" id="expire_time" autocomplete="off" />
                                                        <span class="help-block">默认有效期1年</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="level" class="control-label col-md-2 col-sm-2">等级</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select class="form-control" name="level" id="level">
                                                        @foreach(config('common.master_level_map') as $key => $val)
                                                            <option value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="credit" class="control-label col-md-2 col-sm-2">余额</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" name="credit" value="0" id="credit" autocomplete="off" />
                                                        <span class="input-group-addon">元</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="remark" class="control-label col-md-2 col-sm-2">备注</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <textarea class="form-control" rows="4" name="remark" id="remark"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="control-label col-md-2 col-sm-2">状态</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" value="1" checked /> 正常
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" value="0" /> 禁用
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-dark">授予权限角色</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2">选择</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="button" class="btn default" id="select-all" value="全选">
                                                    <input type="button" class="btn default" id="deselect-all" value="反选">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2">角色</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select multiple="multiple" class="multi-select" id="roles" name="roles[]">
                                                        @foreach($roles as $vo)
                                                            <option value="{{$vo->id}}" {{$vo->has ? 'selected' : ''}}>{{$vo->description}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn green">提 交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/laydate/laydate.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery.quicksearch.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 有效期
        laydate.render({
            elem: '#expire_time',
            type: 'datetime'
        });

        // 权限列表
        $('#roles').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='搜索'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='搜索'>",
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
            $('#roles').multiSelect('select_all');
            return false;
        });

        // 反选
        $('#deselect-all').click(function(){
            $('#roles').multiSelect('deselect_all');
            return false;
        });

        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var username = $('#username').val();
            var password = $('#password').val();
            var level = $("#level option:selected").val();
            var expire_time = $('#expire_time').val();
            var credit = $('#credit').val();
            var status = $("input:radio[name='status']:checked").val();
            var remark = $('#remark').val();
            var roles = $('#roles').val();

            $.ajax({
                type: "POST",
                url: "/permission/addMaster",
                async: false,
                data: {
                    _token:_token,
                    username: username,
                    password:password,
                    level:level,
                    expire_time:expire_time,
                    credit:credit,
                    status:status,
                    remark:remark,
                    roles:roles,
                },
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/permission/masterList';
                        }
                    });
                }
            });

            return false;
        }

        // 生成随机密码
        function makePassword() {
            $.get("/makePasswd",  function(ret) {
                $("#password").val(ret);
            });
        }
    </script>
@endsection
