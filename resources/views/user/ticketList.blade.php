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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold"> {{trans('home.ticket_title')}} </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn blue" onclick="addTicket()"> {{trans('home.ticket_table_new_button')}} </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> {{trans('home.ticket_table_title')}} </th>
                                        <th> {{trans('home.ticket_table_status')}} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($ticketList->isEmpty())
                                    <tr>
                                        <td colspan="3" style="text-align: center;"> <h3>{{trans('home.ticket_table_none')}}</h3> </td>
                                    </tr>
                                @else
                                    @foreach($ticketList as $ticket)
                                        <tr class="odd gradeX">
                                            <td style="width: 15%;"> {{$ticket->id}} </td>
                                            <td style="width: 65%;"> <a href="/replyTicket/{{$ticket->id}}" target="_blank">{{Str::limit($ticket->title)}}</a> </td>
                                            <td style="width: 20%;">
                                                @if ($ticket->status == 0)
                                                    <span class="label label-info"> {{trans('home.ticket_table_status_wait')}} </span>
                                                @elseif ($ticket->status == 1)
                                                    <span class="label label-danger"> {{trans('home.ticket_table_status_reply')}} </span>
                                                @else
                                                    <span class="label label-default"> {{trans('home.ticket_table_status_close')}} </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $ticketList->links() }}
                                </div>
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
    <script type="text/javascript">
        function addTicket() {
            window.location.href = '/addTicket';
        }
    </script>
@endsection
