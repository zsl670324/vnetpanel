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
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{trans('home.ticket_title')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="/addTicket" class="btn btn-sm btn-neutral">
                            <span>{{trans('home.ticket_table_new_button')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{trans('home.ticket_title')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th> #</th>
                                    <th> {{trans('home.ticket_table_title')}} </th>
                                    <th> {{trans('home.ticket_table_status')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($ticketList->isEmpty())
                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            {{trans('home.ticket_table_none')}}
                                        </td>
                                    </tr>
                                @else
                                    @foreach($ticketList as $ticket)
                                        <tr class="odd gradeX">
                                            <td> {{$ticket->id}} </td>
                                            <td><a href="/replyTicket/{{$ticket->id}}">{{$ticket->title}}</a></td>
                                            <td>
                                                @if ($ticket->status == 0)
                                                    <span class="badge badge-info"> {{trans('home.ticket_table_status_wait')}} </span>
                                                @elseif ($ticket->status == 1)
                                                    <span class="badge badge-default"> {{trans('home.ticket_table_status_reply')}} </span>
                                                @else
                                                    <span class="badge badge-danger"> {{trans('home.ticket_table_status_close')}} </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $ticketList->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        //
    </script>
@endsection