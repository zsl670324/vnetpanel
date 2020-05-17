@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-6">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="/nodeList">{{trans('home.my_service')}}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{trans('home.account_access_log')}} </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-6 text-right">
                        <a href="javascript:history.back();" class="btn btn-sm btn-neutral">&laquo;</a>
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
                        <h3 class="mb-0">订阅访问日志</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th> #</th>
                                <th> 时间</th>
                                <th> IP</th>
                                <th> 归属地</th>
                                {{--<th> 请求头 </th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if($list->isEmpty())
                                <tr>
                                    <td colspan="4" style="text-align: center;">
                                        <h3>{{trans('home.invoice_table_none')}}</h3></td>
                                </tr>
                            @else
                                @foreach($list as $vo)
                                    <tr class="odd gradeX">
                                        <td> {{$vo->id}} </td>
                                        <td> {{$vo->request_time}} </td>
                                        <td> {{$vo->request_ip}} </td>
                                        <td> {{$vo->ipInfo}} </td>
                                        {{--<td> {{$vo->request_header}} </td>--}}
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        共 {{$list->total()}} 条记录
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $list->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection