@extends('admin.layouts')
@section('css')
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="tab-pane">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="/admin/addUser" method="post" class="form-horizontal" onsubmit="return do_submit();">
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
                                                <label for="username" class="col-md-3 control-label">用户名</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="" autocomplete="off" autofocus required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-md-3 control-label">密码</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="password" value="" id="password" placeholder="留空则自动生成随机密码" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">用途</label>
                                                <div class="col-md-8">
                                                    <div class="mt-checkbox-inline">
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" name="usage" value="1" checked /> 手机
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" name="usage" value="2" /> 电脑
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" name="usage" value="3" /> 路由器
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" name="usage" value="4" /> 平板
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pay_way" class="col-md-3 control-label">付费周期</label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="0" /> 免费
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="1" /> 月付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="2" /> 季付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="3" checked /> 半年付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="4" /> 年付
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="invite_qty" class="control-label col-md-3">邀请码</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="invite_qty" value="0" id="invite_qty">
                                                        <span class="input-group-addon">枚</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id" class="col-md-3 control-label">所属分组</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="group_id" id="group_id">
                                                        <option value="0">全部</option>
                                                        @foreach($user_group_list as $user_group)
                                                            <option value="{{$user_group->id}}">{{$user_group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="level" class="col-md-3 control-label">等级</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="level" id="level">
                                                        @foreach(config('common.level_map') as $key => $val)
                                                            <option value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">有效期</label>
                                                <div class="col-md-8">
                                                    <div class="input-group input-large input-daterange">
                                                        <input type="text" class="form-control" name="enable_time" id="enable_time" autocomplete="off" />
                                                        <span class="input-group-addon"> 至 </span>
                                                        <input type="text" class="form-control" name="expire_time" id="expire_time" autocomplete="off" />
                                                    </div>
                                                    <span class="help-block"> 付费方式非免费时，自动生成相应时长，免费时如果留空则默认为一年 </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-md-3 control-label">账户状态</label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" value="1" checked /> 正常
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" value="0" /> 未激活
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" value="-1" /> 禁用
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">性别</label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="gender" value="1" checked> 男
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="gender" value="0"> 女
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="wechat" class="col-md-3 control-label">微信</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="wechat" id="wechat" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="qq" class="col-md-3 control-label">QQ</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="qq" id="qq" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="col-md-3 control-label">电话</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="col-md-3 control-label">地址</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="address" id="address" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="remark" class="col-md-3 control-label">备注</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="3" name="remark" id="remark"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-dark">代理信息</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label for="speed_limit" class="col-md-3 control-label">限速</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="speed_limit" id="speed_limit">
                                                        @foreach(config('common.speed_limit') as $vk => $vl)
                                                            <option value="{{$vk}}" @if(\App\Components\Helpers::systemConfig()['default_speed_limit'] == $vk) selected @endif>{{$vl}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block"> 举例：100Mbps的下载速度约为12.5MB/s </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="transfer_enable" class="col-md-3 control-label">可用流量</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="transfer_enable" value="1024" id="transfer_enable" autocomplete="off" required>
                                                        <span class="input-group-addon">GB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="enable" class="col-md-3 control-label">代理状态</label>
                                                <div class="col-md-8">
                                                    <input type="checkbox" class="make-switch" id="enable" checked data-on-color="success" data-off-color="danger" data-on-text="启用" data-off-text="禁用">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="port" class="col-md-3 control-label">端口</label>
                                                <div class="col-md-8">
                                                    @if(\App\Components\Helpers::systemConfig()['is_rand_port'])
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="port" value="{{$last_port}}" id="port" autocomplete="off" />
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-success" type="button" onclick="makePort()"> 生成 </button>
                                                            </span>
                                                        </div>
                                                    @else
                                                        <input type="text" class="form-control" name="port" value="{{$last_port}}" id="port" autocomplete="off" aria-required="true" aria-invalid="true" aria-describedby="number-error" required />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="passwd" class="col-md-3 control-label">密码</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" name="passwd" id="passwd" placeholder="留空则自动生成随机密码" autocomplete="off" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success" type="button" onclick="makePasswd()"> 生成 </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="method" class="col-md-3 control-label">加密方式</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="method" id="method">
                                                        @foreach ($method_list as $method)
                                                            <option value="{{$method->name}}" @if($method->is_default) selected @endif>{{$method->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="protocol" class="col-md-3 control-label">协议</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="protocol" id="protocol">
                                                        @foreach ($protocol_list as $protocol)
                                                            <option value="{{$protocol->name}}" @if($protocol->is_default) selected @endif>{{$protocol->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="obfs" class="col-md-3 control-label">混淆</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="obfs" id="obfs">
                                                        @foreach ($obfs_list as $obfs)
                                                            <option value="{{$obfs->name}}" @if($obfs->is_default) selected @endif>{{$obfs->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="obfs_param" class="col-md-3 control-label">混淆参数</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="5" name="obfs_param" id="obfs_param" placeholder="不填则取节点自定义混淆参数"></textarea>
                                                </div>
                                            </div>
                                            <hr>

                                            <hr>
                                            <div class="form-group">
                                                <label for="uuid" class="col-md-3 control-label">V2Ray UUID</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" name="uuid" value="{{\Webpatser\Uuid\Uuid::generate()->string}}" id="uuid" autocomplete="off" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success" type="button" onclick="makeUUID()"> <i class="fa fa-refresh"></i> </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="uuid" class="col-md-3 control-label">Trojan Password</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static"> 将根据 V2Ray UUID 自动生成 </p>
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

    <script type="text/javascript">
        // 有效期-开始
        laydate.render({
            elem: '#enable_time'
        });

        // 有效期-结束
        laydate.render({
            elem: '#expire_time'
        });

        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var uuid = $('#uuid').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var pay_way = $("input:radio[name='pay_way']:checked").val();
            var status = $("input:radio[name='status']:checked").val();
            var enable_time = $('#enable_time').val();
            var expire_time = $('#expire_time').val();
            var gender = $("input:radio[name='gender']:checked").val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var wechat = $('#wechat').val();
            var qq = $('#qq').val();
            var remark = $('#remark').val();
            var group_id = $("#group_id option:selected").val();
            var level = $("#level option:selected").val();
            var invite_qty = $("#invite_qty").val();
            var port = $('#port').val();
            var passwd = $('#passwd').val();
            var method = $('#method').val();
            var transfer_enable = $('#transfer_enable').val();
            var enable = Number($('#enable').bootstrapSwitch('state'));
            var protocol = $("#protocol option:selected").val();
            var obfs = $("#obfs option:selected").val();
            var obfs_param = $("#obfs_param").val();
            var speed_limit = $("#speed_limit option:selected").val();

            // 用途
            var usage = '';
            $.each($("input:checkbox[name='usage']"), function(){
                if (this.checked) {
                    usage += $(this).val() + ',';
                }
            });
            usage = usage.substring(0, usage.length - 1);

            $.ajax({
                type: "POST",
                url: "/admin/addUser",
                async: false,
                data: {
                    _token:_token,
                    uuid:uuid,
                    username: username,
                    password:password,
                    usage:usage,
                    pay_way:pay_way,
                    status:status,
                    enable_time:enable_time,
                    expire_time:expire_time,
                    gender:gender,
                    phone:phone,
                    address:address,
                    wechat:wechat,
                    qq:qq,
                    remark:remark,
                    group_id:group_id,
                    level:level,
                    invite_qty:invite_qty,
                    port:port,
                    passwd:passwd,
                    method:method,
                    transfer_enable:transfer_enable,
                    enable:enable,
                    protocol:protocol,
                    obfs:obfs,
                    obfs_param:obfs_param,
                    speed_limit:speed_limit
                },
                dataType: 'json',
                success: function (ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.href = '/admin/userList';
                        }
                    });
                }
            });

            return false;
        }

        // 生成随机端口
        function makePort() {
            $.get("/admin/makePort",  function(ret) {
                $("#port").val(ret);
            });
        }

        // 生成UUID
        function makeUUID() {
            $.get("/makeUUID",  function(ret) {
                $("#uuid").val(ret);
            });
        }

        // 生成随机密码
        function makePasswd() {
            $.get("/makePasswd",  function(ret) {
                $("#passwd").val(ret);
            });
        }
    </script>
@endsection
