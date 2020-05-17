@extends('user.layouts')
@section('css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{trans('home.ticket_title')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="/tickets" class="btn btn-sm btn-neutral">
                            <span>{{trans('home.ticket_title')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{trans('home.ticket_table_new_button')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" name="title" id="title"
                               placeholder="{{trans('home.ticket_table_title')}}"
                               class="form-control margin-bottom-20">
                        <br><br>
                        <textarea name="content" id="content" placeholder="{{trans('home.ticket_table_new_desc')}}"
                                  class="form-control margin-bottom-20" rows="4"></textarea>
                    </div>
                    <div class="card-footer py-4">
                        <button type="button" class="btn btn-primary"
                                onclick="addTicket()">{{trans('home.ticket_table_new_yes')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        function addTicket() {
            var title = $("#title").val();
            var content = $("#content").val();
            var data = {_token: '{{csrf_token()}}', title: title, content: content};
            if (title == '' || title == undefined) {
                ERR('您未填写工单标题');
                return false;
            }
            if (content == '' || content == undefined) {
                ERR('您未填写工单内容');
                return false;
            }
            ASK(
                "警告",
                "确定提交工单?",
                "确定",
                "/addTicket",
                data,
                "window.location.href = '/tickets'"
            )
        }
    </script>
@endsection
