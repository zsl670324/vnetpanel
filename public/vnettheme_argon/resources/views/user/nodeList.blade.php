@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-5">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{trans('home.my_service')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-7 text-right">
                        <a href="javascript:subscribeLog();"
                           class="btn btn-sm btn-neutral"> {{trans('home.account_access_log')}}</a>
                        <a href="javascript:userBanLog();"
                           class="btn btn-sm btn-neutral">{{trans('home.account_disable_log')}} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--5">
        <div class="row">
            <div class="col-12 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{trans('home.subscribe_address')}}</h3>
                    </div>
                    <div class="card bg-gradient-Secondary">
                        <div class="card-body">
                            @if(Auth::user()->subscribe->status)
                                @if($nodeList->isEmpty())
                                    <div style="text-align: center;"><h2>请先<a href="/services">购买服务</a></h2></div>
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="description badge-dot mr-4"><i
                                                        class="bg-warning"></i>{{trans('home.subscribe_warning')}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(Agent::isDesktop())
                                                <div class="input-group">
                                                    <input type="text" id="subscribe_link" class="form-control"
                                                           value="{{$link}}"/>
                                                    <div class="input-group-append">
                                                        <a href="#subscribe_qrcode" class="btn btn-dark"
                                                           data-toggle="modal">
                                                            <i class="fa fa-qrcode"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="text" id="subscribe_link" class="form-control" value="{{$link}}" />
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="col-md-6">
                                            <div class="input-group-btn">
                                                <a href="javascript:exchangeSubscribe();"
                                                   class="btn btn-warning">{{trans('home.exchange_subscribe')}}</a>
                                                <button class="btn btn-info copy"
                                                        data-clipboard-text="{{$link}}"> {{trans('home.copy_subscribe_address')}} </button>
                                                @if(Agent::is('iPhone') || Agent::is('iPad'))
                                                    <a href="shadowrocket://add/{{$link_qrcode}}" class="btn btn-success">订阅</a>
                                                @else
                                                    <a href="{{$windows_subscribe_link}}" class="btn btn-success">订阅</a>
                                                @endif
                                                <button class="btn btn-neutral copy"
                                                        data-clipboard-text="{{$allNodes}}">
                                                    复制节点信息
                                                </button>
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
            </div>
        </div>
        @if(!$nodeList->isEmpty())
            @if (config('theme.node_style') == 0)
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="mb-0">{{trans('home.my_node_list')}}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">节点名称</th>
                                        <th scope="col">类型</th>
                                        <th scope="col">状态</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nodeList as $key => $node)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="#" class="avatar rounded-circle mr-3">
                                                        @if($node->country_code)
                                                            <img alt="Node_Image"
                                                                 src="{{asset('/argon/others/country/' . $node->country_code . '.png')}}"/>
                                                        @else
                                                            <img alt="Node_Image"
                                                                 src="{{asset('/argon/others/country/un.png')}}"/>
                                                        @endif
                                                    </a>
                                                    <div class="media-body">
                                                        @if (config('theme.node_txt'))
                                                            <span class="mb-0 text-sm"><a data-toggle="modal"
                                                                                          href="#txt_{{$node->id}}"
                                                                                          title="{{$node->name}}"> {{str_limit($node->name, 46)}} </a></span>
                                                        @else
                                                            <span class="mb-0 text-sm">{{str_limit($node->name, 46)}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                @if($node->type == 1)
                                                    @if($node->single == 1)
                                                        <span class="badge badge-info">SSR</span>
                                                    @else
                                                        <span class="badge badge-primary">SS</span>
                                                    @endif
                                                @elseif($node->type == 2)
                                                    <span class="badge badge-warning">V2RAY</span>
                                                @else
                                                    <span class="badge badge-success">Trojan</span>
                                                @endif
                                            </td>
                                            <td>
                                                    <span class="badge badge-dot mr-4">
                                                    @if($node->status == 1) <i class="bg-success"></i> 正常 @else <i
                                                                class="bg-warning"></i> 维护 @endif
                                                    </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if (config('theme.node_qrcode'))
                                                            <a class="dropdown-item" data-toggle="modal"
                                                               href="#qrcode_{{$node->id}}"> <i
                                                                        class="fa fa-qrcode"></i>二维码 </a>
                                                        @endif
                                                        @if (config('theme.node_link'))
                                                            <a class="dropdown-item" data-toggle="modal"
                                                               href="#link_{{$node->id}}">
                                                                @if($node->type == 1)
                                                                    <i class="fa fa-paper-plane"></i>
                                                                @elseif($node->type == 2)
                                                                    <i class="fab fa-vimeo-v"></i>
                                                                @else
                                                                    <i class="fa fa-text-width"></i>
                                                                @endif
                                                                    连接
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($nodeList as $key => $node)
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list my--3">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <a href="#" class="avatar rounded-circle">
                                                        @if($node->country_code)
                                                            <img alt="Node_Image"
                                                                 src="{{asset('/argon/others/country/' . $node->country_code . '.png')}}"/>
                                                        @else
                                                            <img alt="Node_Image"
                                                                 src="{{asset('/argon/others/country/un.png')}}"/>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0">
                                                        @if (config('theme.node_txt'))
                                                            <a data-toggle="modal" href="#txt_{{$node->id}}"
                                                               title="{{$node->name}}"> {{str_limit($node->name, 46)}} </a>
                                                        @else
                                                            {{str_limit($node->name, 46)}}
                                                        @endif
                                                    </h4>
                                                    @if($node->status == 1)
                                                        <span class="text-success">●</span>
                                                        <small>正常&emsp;</small>
                                                    @else
                                                        <span class="text-warning">●</span>
                                                        <small>维护&emsp;</small>
                                                    @endif
                                                    @if (config('theme.node_rate'))
                                                        <span class="text-danger">&emsp;●</span>
                                                        <small>倍率：{{$node->traffic_rate}} 倍</small>
                                                    @endif
                                                    @if (config('theme.node_label'))
                                                        <div class="row">
                                                            <div class="col-12">
                                                                @foreach($node->label as $vo)
                                                                    <span class="badge badge-lg badge-primary">{{$vo->label_name}}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-auto">
                                                    @if (config('theme.node_qrcode'))
                                                        <a @if($node->type == 1) class= "btn btn-sm btn-primary" @elseif($node->type == 2) class= "btn btn-sm btn-warning" @else class= "btn btn-sm btn-success" @endif data-toggle="modal"
                                                           href="#qrcode_{{$node->id}}"> <i
                                                                    class="fa fa-qrcode"></i></a>
                                                    @endif
                                                    @if (config('theme.node_link'))
                                                            @if($node->type == 1)
                                                                <a class="btn btn-sm btn-primary" data-toggle="modal"
                                                                   href="#link_{{$node->id}}">
                                                                    <i class="fa fa-paper-plane"></i>
                                                                </a>
                                                            @elseif($node->type == 2)
                                                                <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                                   href="#link_{{$node->id}}">
                                                                    <i class="fab fa-vimeo-v"></i>
                                                                </a>
                                                            @else
                                                                <a class="btn btn-sm btn-success" data-toggle="modal"
                                                                   href="#link_{{$node->id}}">
                                                                    <i class="fa fa-text-width"></i>
                                                                </a>
                                                            @endif
                                                    @endif
                                                </div>
                                            </div>
                                            @if (config('theme.node_desc'))
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="mt-3 mb-0 text-muted">{{$node->desc ? $node->desc : '暂无说明'}}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="card-body py-4">
                <nav aria-label="...">
                    <ul class="pagination justify-content-end mb-0">
                        {{ $nodeList->links() }}
                    </ul>
                </nav>
            </div>
        @endif
    </div>
    @foreach($nodeList as $node)
        @if (config('theme.node_txt'))
            <!-- 配置文本 -->
            <div class="modal fade" id="txt_{{$node->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                 aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-default">{{trans('home.setting_info')}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="12" readonly="readonly">{{$node->txt}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (config('theme.node_link'))
            <!-- 配置链接 -->
            <div class="modal fade" id="link_{{$node->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                 aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-default">{{$node->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($node->type == 1)
                                <textarea class="form-control" rows="5"
                                          readonly="readonly">{{$node->ssr_scheme}}</textarea>
                                <a href="{{$node->ssr_scheme}}" class="btn btn-primary uppercase"
                                   style="display: block; width: 100%;margin-top: 10px;">打开SSR</a>
                                @if($node->ss_scheme)
                                    <p></p>
                                    <textarea class="form-control" rows="5"
                                              readonly="readonly">{{$node->ss_scheme}}</textarea>
                                    <a href="{{$node->ss_scheme}}" class="btn btn-info uppercase"
                                       style="display: block; width: 100%;margin-top: 10px;">打开SS</a>
                                @endif
                            @elseif($node->type == 2)
                                <textarea class="form-control" rows="8" readonly="readonly">{{$node->v2_scheme}}</textarea>
                                <a href="{{$node->v2_scheme}}" class="btn btn-warning uppercase" style="display: block; width: 100%;margin-top: 10px;">打开 V2Ray</a>
                            @else
                                <textarea class="form-control" rows="8" readonly="readonly">{{$node->trojan_scheme}}</textarea>
                                <a href="{{$node->trojan_scheme}}" class="btn btn-success uppercase" style="display: block; width: 100%;margin-top: 10px;">打开 Trojan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (config('theme.node_qrcode'))
            <!-- 配置二维码 -->
            <div class="modal fade" id="qrcode_{{$node->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-default">{{trans('home.scan_qrcode')}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @if($node->type == 1)
                                    @if($node->compatible)
                                        <div class="col-12">
                                            <div id="qrcode_ssr_img_{{$node->id}}" style="text-align: center;"></div>
                                            <div style="text-align: center;"><a
                                                        id="download_qrcode_ssr_img_{{$node->id}}">{{trans('home.download')}}</a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div id="qrcode_ss_img_{{$node->id}}" style="text-align: center;"></div>
                                            <div style="text-align: center;"><a
                                                        id="download_qrcode_ss_img_{{$node->id}}">{{trans('home.download')}}</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div id="qrcode_ssr_img_{{$node->id}}" style="text-align: center;"></div>
                                            <div style="text-align: center;"><a
                                                        id="download_qrcode_ssr_img_{{$node->id}}">{{trans('home.download')}}</a>
                                            </div>
                                        </div>
                                    @endif
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
        @endif
    @endforeach
    <!-- 订阅二维码 -->
    <div class="modal fade" id="subscribe_qrcode" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">请使用Shadowrocket扫描</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="subscribe_qrcode_img" style="text-align: center;"></div>
                            <div style="text-align: center;"><a
                                        id="download_subscribe_qrcode_img">{{trans('home.download')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/global/plugins/clipboardjs/clipboard.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-qrcode/jquery.qrcode.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script>
        // 在线安装警告提示
        function onlineInstallWarning() {
            swal("仅限在Safari浏览器下有效", {icon: "error",});
        }
        @if(config('version.name') !='Standard')
        // 订阅封禁访问日志
        function userBanLog() {
            window.location.href = '/userBanLog';
        }

        // 订阅访问日志
        function subscribeLog() {
            window.location.href = '/subscribeLog';
        }
        @endif
    </script>
    <script>
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

        // 更换订阅地址
        function exchangeSubscribe() {
            var token = {_token: '{{csrf_token()}}'};
            ASK(
                "警告",
                "更换订阅将导致旧地址立即失效，连接密码被更改",
                "确定更换",
                "/exchangeSubscribe",
                token,
                null
            )
        }
    </script>
@endsection
