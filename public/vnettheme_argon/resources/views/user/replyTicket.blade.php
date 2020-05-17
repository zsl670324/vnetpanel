@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="/tickets">{{trans('home.ticket_title')}}</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="javascript:history.back();" class="btn btn-sm btn-neutral">&laquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{$ticket->title}} </h3>
                            </div>
                            @if($ticket->status != 2)
                                <div class="col text-right">
                                    <button class="btn btn-sm btn-primary" onclick="closeTicket()">关闭</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="/argon/img/theme/team-4-800x800.jpg" class="avatar">
                            </a>
                            <div class="mx-3">
                                <a href="#"
                                   class="text-dark font-weight-600 text-sm">{{trans('home.ticket_reply_me')}}</a>
                                <small class="d-block text-muted">{{$ticket->created_at}}</small>
                            </div>
                        </div>
                        <div class="text-right ml-auto">
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $ticket->content !!}
                        <div class="row align-items-center my-3 pb-3 border-bottom">
                        </div>
                        <!-- Comments -->
                        <div class="mb-1">
                            @foreach ($replyList as $reply)
                                <div class="media media-comment">
                                    @if($reply->master)
                                        <img alt="Image placeholder"
                                             class="avatar avatar-lg media-comment-avatar rounded-circle"
                                             src="/assets/images/avatar.png">
                                    @else
                                        <img alt="Image placeholder"
                                             class="avatar avatar-lg media-comment-avatar rounded-circle"
                                             src="/argon/img/theme/team-4-800x800.jpg">
                                    @endif
                                    <div class="media-body">
                                        <div class="media-comment-text">
                                            <h6 class="h5 mt-0">@if($reply->master){{trans('home.ticket_reply_master')}}@else{{trans('home.ticket_reply_me')}}@endif</h6>
                                            <div class="argon_a">
                                                {!! $reply->content !!}
                                            </div>
                                            <div class="icon-actions">
                                                <a href="#" class="like active">
                                                    <i class="ni ni-watch-time"></i>
                                                    <span class="text-muted">{{$reply->created_at}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if($ticket->status != 2)
                                <hr/>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-12">
                                                @if(config('theme.Editor') == 0)
                                                    <div id="editor"></div>
                                                @else
                                                    <script id="editor" type="text/plain"
                                                            style="padding-bottom:10px;"></script>
                                                @endif
                                                <br>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="replyTicket()"> {{trans('home.ticket_reply_button')}} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @if(config('theme.Editor') == 0)
        <script type="text/javascript" src="/js/js-xss/xss.min.js"></script>
        <script type="text/javascript" src="/js/wangEditor/wangEditor.min.js"></script>
    @else
        <script src="/js/ueditor/ueditor.config.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/ueditor/ueditor.all.js" type="text/javascript" charset="utf-8"></script>
    @endif
    <script type="text/javascript">
        @if($ticket->status != 2)
        @if(config('theme.Editor') == 0)
        // wangEditor富文本编辑器
        var E = window.wangEditor;
        var editor = new E('#editor');
        editor.customConfig.menus = [
            'bold',
            'italic',
            'underline',
            'image',
            'video'
        ];
        editor.create();
        @else
        // 百度富文本编辑器
        var ue = UE.getEditor('editor', {
            toolbars: [['source', 'undo', 'redo', 'bold', 'italic', 'underline', 'insertimage', 'insertvideo', 'lineheight', 'fontfamily', 'fontsize', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', 'forecolor', 'backcolor', 'link', 'unlink']],
            wordCount: true,                //关闭字数统计
            elementPathEnabled: false,    //是否启用元素路径
            maximumWords: 300,              //允许的最大字符数
            initialContent: '',             //初始化编辑器的内容
            initialFrameWidth: null,        //初始化宽度
            autoClearinitialContent: false, //是否自动清除编辑器初始内容
        });

        @endif
        @endif
        function closeTicket() {
            var data = {_token: '{{csrf_token()}}', id: '{{$ticket->id}}'};
            ASK(
                "警告",
                "您确定要关闭该工单吗?",
                "确定",
                "/closeTicket/{{$ticket->id}}",
                data,
                "window.location.href = '/tickets'"
            )
        }

        function replyTicket() {
                    @if(config('theme.Editor') == 0)
            var content = filterXSS(editor.txt.html());
                    @else
            var content = UE.getEditor('editor').getContent();
            @endif
            if (content == "" || content == undefined) {
                ERR('您未填写工单内容');
                return false;
            }
            var data = {_token: '{{csrf_token()}}', id: '{{$ticket->id}}', content: content};
            ASK(
                "警告",
                "您确定提交工单吗?",
                "确定",
                "/replyTicket/{{$ticket->id}}",
                data,
                "window.location.reload()"
            )
        }
    </script>
@endsection