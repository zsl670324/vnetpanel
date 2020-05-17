@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gradient-{{config('theme.referral_color')}}">
                            <div class="p-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <h3 class="text-white">{{trans('home.referrals')}}</h3>
                                        <p class="lead text-white mt-3">{{trans('home.promote_link', ['referral_percent' => $referral_percent * 100])}}</p>
                                    </div>
                                    <div class="col-lg-3 ml-lg-auto">
                                        <button class="btn btn-lg btn-block btn-white copy"
                                                data-clipboard-text="{{$link}}"> {{trans('home.referral_button')}}{{trans('home.referral_my_link')}} </button>
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
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <ul class="nav nav-pills">
                                    <li class="nav-item mr-1 mr-md-0">
                                        <a href="#nav-tab-2" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span>{{trans('home.referral_title')}}</span>
                                        </a>
                                    </li>
                                    @if(config('theme.referral_apply_show'))
                                    <li class="nav-item mr-1 mr-md-0">
                                        <a href="#nav-tab-1" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span>{{trans('home.invite_user_title')}}</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="nav-item mr-1 mr-md-0">
                                        <a href="#nav-tab-3" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span>{{trans('home.referral_apply_title')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" style="font-size:16px;">
                        	@if(config('theme.referral_apply_show'))
                            <div class="tab-pane" id="nav-tab-1">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th> {{trans('home.invite_user_username')}} </th>
                                            <th> {{trans('home.invite_user_created_at')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($referralUserList->isEmpty())
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align: center;"> {{trans('home.referral_table_none')}} </td>
                                            </tr>
                                        @else
                                            @foreach($referralUserList as $key => $vo)
                                                <tr class="odd gradeX">
                                                    <td> {{$key + 1}} </td>
                                                    <td> {{str_replace(mb_substr($vo->username, 3, 4), "****", $vo->username)}}  </td>
                                                    <td> {{$vo->created_at}} </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{ $referralUserList->appends(Arr::except(Request::query(), 'user_page'))->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            @endif
                            <div class="tab-pane active" id="nav-tab-2">
                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width:1px;word-break:keep-all;">
                                        <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> {{trans('home.referral_table_date')}} </th>
                                            <th> {{trans('home.referral_table_user')}} </th>
                                            <th> {{trans('home.referral_table_amount')}} </th>
                                            <th> {{trans('home.referral_table_commission')}} </th>
                                            <th> {{trans('home.referral_table_status')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($referralLogList->isEmpty())
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align: center;"> {{trans('home.referral_table_none')}} </td>
                                            </tr>
                                        @else
                                            @foreach($referralLogList as $key => $referralLog)
                                                <tr class="odd gradeX">
                                                    <td> {{$key + 1}} </td>
                                                    <td> {{$referralLog->created_at}} </td>
                                                    <td> {{empty($referralLog->user) ? '【账号已删除】' : str_replace(mb_substr($referralLog->user->username, 3, 4), "****", $referralLog->user->username)}}</td>
                                                    <td> ￥{{$referralLog->amount}} </td>
                                                    <td> ￥{{$referralLog->ref_amount}} </td>
                                                    <td>
                                                        @if ($referralLog->status == 1)
                                                            <span class="badge badge-danger">申请中</span>
                                                        @elseif($referralLog->status == 2)
                                                            <span class="badge badge-default">已提现</span>
                                                        @else
                                                            <span class="badge badge-info">未提现</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    {{trans('home.referral_summary', ['total' => $referralLogList->total(), 'amount' => $canAmount, 'money' => $referral_money])}}
                                    <button type="submit" class="btn btn-sm btn-primary"
                                            onclick="extractMoney()"> {{trans('home.referral_table_apply')}} </button>
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{ $referralLogList->appends(Arr::except(Request::query(), 'log_page'))->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-tab-3">
                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width:1px;word-break:keep-all;">
                                        <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> {{trans('home.referral_apply_table_date')}} </th>
                                            <th> {{trans('home.referral_apply_table_amount')}} </th>
                                            <th> {{trans('home.referral_apply_table_status')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($referralApplyList->isEmpty())
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align: center;"> {{trans('home.referral_table_none')}} </td>
                                            </tr>
                                        @else
                                            @foreach($referralApplyList as $key => $vo)
                                                <tr class="odd gradeX">
                                                    <td> {{$key + 1}} </td>
                                                    <td> {{$vo->created_at}} </td>
                                                    <td> {{$vo->amount}} </td>
                                                    <td>
                                                        @if ($vo->status == 0)
                                                            <span class="badge badge-danger">待审核</span>
                                                        @elseif($vo->status == 1)
                                                            <span class="badge badge-default">审核通过待打款</span>
                                                        @elseif($vo->status == 2)
                                                            <span class="badge badge-default">已打款</span>
                                                        @else
                                                            <span class="badge badge-info">驳回</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{ $referralApplyList->appends(Arr::except(Request::query(), 'apply_page'))->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // 申请提现
        function extractMoney() {
            var data = {_token: '{{csrf_token()}}'};
            ASK(
                "提示",
                "确定申请提现吗?",
                "确定",
                "/extractMoney",
                data,
                null
            )
        }
    </script>
@endsection