@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gradient-{{config('theme.invite_color')}}">
                            <div class="p-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <h3 class="text-white">{{trans('home.referrals')}}</h3>
                                        <p class="lead text-white mt-3">{{trans('home.promote_invite_code', ['referral_percent' => \App\Components\Helpers::systemConfig()['referral_percent'] * 100])}}</p>
                                        <p class="lead text-white mt-3">{{trans('home.invite_code_tips1')}}
                                            <strong> {{Auth::user()->invite_qty}}</strong> {{trans('home.invite_code_tips2', ['days' => \App\Components\Helpers::systemConfig()['user_invite_days']])}}
                                        </p>
                                    </div>
                                    <div class="col-lg-3 ml-lg-auto">
                                        <button type="button" class="btn btn-lg btn-block btn-white"
                                                onclick="makeInvite()"
                                                @if(!Auth::user()->invite_qty) disabled @endif> {{trans('home.invite_code_make')}} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{trans('home.invite_code_my_codes')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th> {{trans('home.invite_code_table_name')}} </th>
                                <th> {{trans('home.invite_code_table_date')}} </th>
                                <th> {{trans('home.invite_code_table_status')}} </th>
                                <th> {{trans('home.invite_code_table_user')}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($inviteList->isEmpty())
                                <tr>
                                    <td colspan="5" style="text-align: center;">
                                        <h3>{{trans('home.invite_code_table_none_codes')}}</h3></td>
                                </tr>
                            @else
                                @foreach($inviteList as $key => $invite)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td><a class="btn btn-secondary btn-sm copy"
                                               data-clipboard-text="{{\App\Components\Helpers::systemConfig()['website_url']}}/register?aff={{Auth::user()->code}}&code={{$invite->code}}"> {{$invite->code}} </a>
                                        </td>
                                        <td> {{$invite->dateline}} </td>
                                        <td>
                                            @if($invite->status == '0')
                                                <span class="badge badge-success"> {{trans('home.invite_code_table_status_un')}} </span>
                                            @elseif($invite->status == '1')
                                                <span class="badge badge-default"> {{trans('home.invite_code_table_status_yes')}} </span>
                                            @else
                                                <span class="badge badge-danger"> {{trans('home.invite_code_table_status_expire')}} </span>
                                            @endif
                                        </td>
                                        <td> {{empty($invite->user) ? ($invite->status == 1 ? '【账号已删除】' : '') : $invite->user->username}} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{trans('home.invite_code_summary', ['total' => $inviteList->total()])}}
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $inviteList->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // 生成邀请码
        function makeInvite() {
            var data = {_token: '{{csrf_token()}}'};
            ASK(
                "警告",
                "确定生成邀请码?",
                "确定",
                "/makeInvite",
                data,
                null
            )
        }
    </script>
@endsection