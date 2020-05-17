@extends('user.layouts')
@section('css')
    <link href="/assets/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .tool-bar{
            margin-top:-6px;
        }
        .tool-bar>.btn{
            margin-top:6px;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light" style="margin-bottom: 15px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue bold">{{trans('home.subscribe_address')}}</span>
                        </div>
                        <div class="actions">
                            <span class="caption-subject">
                                <a class="btn btn-sm default" href="javascript:subscribeLog();"> {{trans('home.account_access_log')}} </a>
                                <a class="btn btn-sm default" href="javascript:userBanLog();"> {{trans('home.account_disable_log')}} </a>
                            </span>
                        </div>
                    </div>
                    @if(Auth::user()->subscribe->status)
                        @if($nodeList->isEmpty())
                            <div style="text-align: center;"><h2>请先<a href="/services">购买服务</a></h2></div>
                        @else
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 5px;">
                                        @if(Agent::isDesktop())
                                            <div class="input-group">
                                                <input type="text" id="subscribe_link" class="form-control col-md-4 col-sm-4 col-xs-12" value="{{$link}}" />
                                                <span class="input-group-btn">
                                                    <a href="#subscribe_qrcode" class="btn green" data-toggle="modal">
                                                        <i class="fa fa-qrcode"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        @else
                                            <input type="text" id="subscribe_link" class="form-control col-md-4 col-sm-4 col-xs-12" value="{{$link}}" />
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 tool-bar">
                                        <a href="javascript:resetSubscribe();" class="btn blue">{{trans('home.exchange_subscribe')}}</a>
                                        <button class="btn btn-info" id="copy_subscribe_link" data-clipboard-action="copy" data-clipboard-target="#subscribe_link"> {{trans('home.copy_subscribe_address')}} </button>
                                        @if(Agent::is('iPhone') || Agent::is('iPad'))
                                            <a href="shadowrocket://add/{{$link_qrcode}}" class="btn red">一键订阅</a>
                                        @else
                                            <a href="{{$windows_subscribe_link}}" class="btn red">一键订阅</a>
                                        @endif
                                        <button class="btn btn-danger" id="copy_all_nodes" data-clipboard-text="{{$allNodes}}"> 复制所有节点 </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div style="text-align: center;"><h3>{{trans('home.subscribe_baned')}}</h3></div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 节点列表 -->
        <div id="stream_unblock">
            <div class="row">
                <div class="col-md-12">
                    @if(!$nodeList->isEmpty())
                        <div class="node-area">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-xs-12 col-12">
                                    @foreach($nodeList as $node)
                                        <div class="node-card" id="node-0">
                                            <div class="top-box">
                                                <div class="node-title-area col-lg-6 col-sm-6 col-xs-12 col-12">
                                                    <div class="node-flag">
                                                        @if($node->country_code)
                                                            <img src="{{asset('assets/images/country/' . $node->country_code . '.svg')}}"/>
                                                        @else
                                                            <img src="{{asset('/assets/images/country/un.svg')}}"/>
                                                        @endif
                                                    </div>
                                                    <div class="node-name">
                                                        <a data-toggle="modal" href="#txt_{{$node->id}}" title="{{$node->name}}"> {{Str::limit($node->name)}} </a>
                                                    </div>
                                                </div>
                                                <div class="node-bandwidth-area col-lg-offset-3 col-lg-3 col-sm-6 col-xs-6 col-6">
                                                    <span><a data-toggle="modal" href="#link_{{$node->id}}">Scheme</a></span>
                                                    <div class="node-bandwidth">
                                                        <a data-toggle="modal" href="#qrcode_{{$node->id}}">二维码</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!$node->label->isEmpty())
                                                <div class="bottom-box col-md-12">
                                                    <div class="node-tag-area">
                                                        <div class="node-tag">
                                                            @foreach($node->label as $vo)
                                                                <label>{{$vo->label_name}}</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-4 col-md-12 col-xs-12 col-12">
                                    <div class="doc-card">
                                        <div class="card-title">
                                            <span>{{trans('home.tutorials')}}</span>
                                        </div>
                                        @if(!$articleList->isEmpty())
                                            <div class="card-content">
                                                @foreach($articleList as $article)
                                                    <div class="card-item" onclick="window.open('/article/{{$article->id}}', '_blank');"><i class="fa fa-link"></i> {{$article->title}}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="card-bottom" onclick="window.open('/addTicket', '_blank');">
                                            <div class="bottom-item">
                                                <span>{{trans('home.ticket_title')}}</span>
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="dataTables_paginate paging_bootstrap_full_number pull-left">
                                        {{ $nodeList->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @foreach($nodeList as $node)
            <!-- 配置文本 -->
            <div class="modal fade draggable-modal" id="txt_{{$node->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{trans('home.setting_info')}}</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="11" readonly="readonly">{{$node->txt}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 配置链接 -->
            <div class="modal fade draggable-modal" id="link_{{$node->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{$node->name}}</h4>
                        </div>
                        <div class="modal-body">
                            @if($node->type == 1)
                                <textarea class="form-control" rows="5" readonly="readonly">{{$node->ssr_scheme}}</textarea>
                                <a href="{{$node->ssr_scheme}}" class="btn purple" style="display: block; width: 100%;margin-top: 10px;">打开 ShadowsocksR</a>
                            @elseif($node->type == 2)
                                <textarea class="form-control" rows="8" readonly="readonly">{{$node->v2_scheme}}</textarea>
                                <a href="{{$node->v2_scheme}}" class="btn blue" style="display: block; width: 100%;margin-top: 10px;">打开 V2Ray</a>
                            @else
                                <textarea class="form-control" rows="8" readonly="readonly">{{$node->trojan_scheme}}</textarea>
                                <a href="{{$node->trojan_scheme}}" class="btn blue" style="display: block; width: 100%;margin-top: 10px;">打开 Trojan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 配置二维码 -->
            <div class="modal fade" id="qrcode_{{$node->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{trans('home.scan_qrcode')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @if($node->type == 1)
                                    <div class="col-md-12">
                                        <div id="qrcode_ssr_img_{{$node->id}}" style="text-align: center;"></div>
                                        <div style="text-align: center;"><a id="download_qrcode_ssr_img_{{$node->id}}">{{trans('home.download')}}</a></div>
                                    </div>
                                @elseif($node->type == 2)
                                    <div class="col-md-12">
                                        <div id="qrcode_v2ray_img_{{$node->id}}" style="text-align: center;"></div>
                                        <div style="text-align: center;"><a id="download_qrcode_v2ray_img_{{$node->id}}">{{trans('home.download')}}</a></div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div id="qrcode_trojan_img_{{$node->id}}" style="text-align: center;"></div>
                                        <div style="text-align: center;"><a id="download_qrcode_trojan_img_{{$node->id}}">{{trans('home.download')}}</a></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- 订阅二维码 -->
        <div class="modal fade" id="subscribe_qrcode" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">请使用Shadowrocket扫描</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="subscribe_qrcode_img" style="text-align: center;"></div>
                                <div style="text-align: center;"><a id="download_subscribe_qrcode_img">{{trans('home.download')}}</a></div>
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
    <script src="/assets/global/plugins/clipboardjs/clipboard.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-qrcode/jquery.qrcode.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 订阅访问日志
        function subscribeLog() {
            window.location.href = '/subscribeLog';
        }

        // 订阅封禁访问日志
        function userBanLog() {
            window.location.href = '/userBanLog';
        }
    </script>

    <script type="text/javascript">
        var UIModals = function () {
            var n = function () {
                @foreach($nodeList as $node)
                $("#txt_{{$node->id}}").draggable({handle: ".modal-header"});
                $("#qrcode_{{$node->id}}").draggable({handle: ".modal-header"});
                @endforeach
            };

            return {
                init: function () {
                    n()
                }
            }
        }();

        jQuery(document).ready(function () {
            UIModals.init()
        });

        // 生成二维码
        @foreach ($nodeList as $node)
            @if($node->type == 1)
                $('#qrcode_ssr_img_{{$node->id}}').qrcode("{{$node->ssr_scheme}}");
                $('#download_qrcode_ssr_img_{{$node->id}}').attr({'download':'code','href':$('#qrcode_ssr_img_{{$node->id}} canvas')[0].toDataURL("image/png")})
            @elseif($node->type == 2)
                $('#qrcode_v2ray_img_{{$node->id}}').qrcode("{{$node->v2_scheme}}");
                $('#download_qrcode_v2ray_img_{{$node->id}}').attr({'download':'code','href':$('#qrcode_v2ray_img_{{$node->id}} canvas')[0].toDataURL("image/png")})
            @else
                $('#qrcode_trojan_img_{{$node->id}}').qrcode("{{$node->trojan_scheme}}");
                $('#download_qrcode_trojan_img_{{$node->id}}').attr({'download':'code','href':$('#qrcode_trojan_img_{{$node->id}} canvas')[0].toDataURL("image/png")})
            @endif
        @endforeach

        // 生成订阅地址二维码
        @if(Agent::is('iPhone') || Agent::is('iPad'))
            $('#subscribe_qrcode_img').qrcode("shadowrocket://add/{{$link_qrcode}}");
        @else
            $('#subscribe_qrcode_img').qrcode("{{$link_qrcode}}");
        @endif
        $('#download_subscribe_qrcode_img').attr({'download':'code','href':$('#subscribe_qrcode_img canvas')[0].toDataURL("image/png")});

        // 重置订阅地址
        function resetSubscribe() {
            layer.confirm('重置订阅地址将导致：<br>1.旧地址立即失效；<br>2.连接密码被更改；', {icon: 7, title:'警告'}, function(index) {
                $.post("/resetSubscribe", {_token:'{{csrf_token()}}'}, function (ret) {
                    layer.msg(ret.message, {time:1000}, function () {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });

                layer.close(index);
            });
        }
    </script>

    @if(!$nodeList->isEmpty())
        <script type="text/javascript">
            var copy_all_nodes = document.getElementById('copy_all_nodes');
            var clipboard = new Clipboard(copy_all_nodes);

            clipboard.on('success', function(e) {
                layer.alert("复制成功，通过右键菜单倒入节点链接即可", {icon:1, title:'提示'});
            });

            clipboard.on('error', function(e) {
                console.log(e);
            });
        </script>
    @endif

    <script type="text/javascript">
        var copy_subscribe_link = document.getElementById('copy_subscribe_link');
        var clipboard = new Clipboard(copy_subscribe_link);

        clipboard.on('success', function(e) {
            layer.msg("复制成功", {time:1000});
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });
    </script>
@endsection
