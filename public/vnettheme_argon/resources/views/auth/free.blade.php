@extends('auth.head')
@section('title', trans('home.free_invite_codes_title'))
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{trans('home.free_invite_codes_title')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            @if(\App\Components\Helpers::systemConfig()['is_invite_register'])
                                @if(\App\Components\Helpers::systemConfig()['is_free_code'])
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;"> {{trans('home.invite_code_table_name')}} </th>
                                        <th style="text-align: center;"> {{trans('home.invite_code_table_date')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($inviteList->isEmpty())
                                        <tr>
                                            <td colspan="2"
                                                style="text-align: center;">{{trans('home.invite_code_table_none_codes')}}</td>
                                        </tr>
                                    @else
                                        @foreach($inviteList as $key => $invite)
                                            <tr>
                                                <td style="width: 50%; text-align: center;"><a
                                                            href="/register?code={{$invite->code}}" target="_blank"
                                                            title="点击注册">{{$invite->code}}</a></td>
                                                <td style="width: 50%; text-align: center;"> {{$invite->dateline}} </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                @else
                                    <tbody>
                                    <tr>
                                        <td colspan="2"
                                            style="text-align: center;">{{trans('home.invite_code_table_none_codes')}}</td>
                                    </tr>
                                    </tbody>
                                @endif
                            @else
                                <tbody>
                                <tr>
                                    <td colspan="2"
                                        style="text-align: center;">{{trans('home.no_need_invite_codes')}}</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                    @if(\App\Components\Helpers::systemConfig()['is_invite_register'] && \App\Components\Helpers::systemConfig()['is_free_code'])
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    {{ $inviteList->links() }}
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
