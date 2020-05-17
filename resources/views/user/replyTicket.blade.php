@extends('user.layouts')
@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold" style="word-wrap: break-word;word-break: break-all;overflow: hidden;"> {{$ticket->title}} </span>
                        </div>
                        <div class="actions">
                            @if($ticket->status != 2)
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn red" onclick="closeTicket()">关闭</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-badge">
                                    <div class="timeline-icon">
                                        <i class="icon-user font-green-haze"></i>
                                    </div>
                                </div>
                                <div class="timeline-body">
                                    <div class="timeline-body-arrow"></div>
                                    <div class="timeline-body-head">
                                        <div class="timeline-body-head-caption">
                                            <span class="timeline-body-alerttitle font-blue-madison">{{trans('home.ticket_reply_me')}}</span>
                                            <span class="timeline-body-time font-grey-cascade"> {{$ticket->created_at}} </span>
                                        </div>
                                        <div class="timeline-body-head-actions"></div>
                                    </div>
                                    <div class="timeline-body-content" style="word-wrap: break-word;">
                                        <span class="font-grey-cascade"> {!! $ticket->content !!} </span>
                                    </div>
                                </div>
                            </div>
                            @foreach ($replyList as $reply)
                                <div class="timeline-item">
                                    <div class="timeline-badge">
                                        @if($reply->master)
                                            <img class="timeline-badge-userpic" src="/assets/images/avatar.png">
                                        @else
                                            <div class="timeline-icon">
                                                <i class="icon-user font-green-haze"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="timeline-body">
                                        <div class="timeline-body-arrow"></div>
                                        <div class="timeline-body-head">
                                            <div class="timeline-body-head-caption">
                                                @if($reply->master)
                                                    <a href="javascript:;" class="timeline-body-title font-red-intense">{{trans('home.ticket_reply_master')}}</a>
                                                @else
                                                    <span class="timeline-body-alerttitle font-blue-madison">{{trans('home.ticket_reply_me')}}</span>
                                                @endif
                                                <span class="timeline-body-time font-grey-cascade"> {{$reply->created_at}} </span>
                                            </div>
                                            <div class="timeline-body-head-actions"></div>
                                        </div>
                                        <div class="timeline-body-content" style="word-wrap: break-word;">
                                            <span class="font-grey-cascade"> {!! $reply->content !!} </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($ticket->status != 2)
                            <hr />
                            <div class="row">
                                <div class="col-md-offset-1 col-md-11 col-xs-offset-1 col-xs-11">
                                    <div id="editor"></div>
                                    <br>
                                    <button type="button" class="btn blue" onclick="replyTicket()"> {{trans('home.ticket_reply_button')}} </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript" src="/js/js-xss/xss.min.js"></script>
    <script type="text/javascript" src="/js/wangEditor/wangEditor.min.js"></script>
    <script type="text/javascript">
        @if($ticket->status != 2)
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
        @endif

        // 关闭工单
        function closeTicket() {
            layer.confirm('确定关闭本工单吗？', {icon: 7, title:'警告'}, function(index) {
                $.ajax({
                    type: "POST",
                    url: "/closeTicket/{{$ticket->id}}",
                    async: true,
                    data: {_token:'{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (ret) {
                        layer.msg(ret.message, {time:1000}, function() {
                            if (ret.status == 'success') {
                                window.location.href = '/tickets';
                            }
                        });
                    }
                });

                layer.close(index);
            });
        }

        // 回复工单
        function replyTicket() {
            var content = filterXSS(editor.txt.html());

            if (content == "" || content == undefined) {
                layer.alert('您未填写工单内容', {icon: 2, title:'提示'});
                return false;
            }

            layer.confirm('确定回复工单？', {icon: 3, title:'提示'}, function(index) {
                $.post("/replyTicket/{{$ticket->id}}",{_token:'{{csrf_token()}}', id:'{{$ticket->id}}', content:content}, function(ret) {
                    layer.msg(ret.message, {time:1000}, function() {
                        if (ret.status == 'success') {
                            window.location.reload();
                        }
                    });
                });
                layer.close(index);
            });
        }
    </script>
@endsection
