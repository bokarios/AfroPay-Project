@extends('admin.layouts.default')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
<style>
    #table-log {
        font-size: 85%;
    }
    th, td {
        text-align: center;
    }
</style>
@endsection

@section('admin.content')

<div class="card">
    <div class="card-body">
    <div class="row" style="width:100%">

        <div align="center">
            <h4><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Visit Log</h4>
        </div>

        <div class="col-sm-12 col-md-12 table-container table-responsive">

            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops! Something went wrong!</strong>

                    <br><br>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table cellspacing="0" width="100%" id="table-log"
                class="table table-striped table-bordered table-sm table-hover table-condensed dt-responsive nowrap">
                @if (config('visitlog.iptolocation'))
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Browser</th>
                        <th>OS</th>
                        @if (config('visitlog.log_user'))
                            <th>User</th>
                        @endif
                        <th>Country</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Zip</th>
                        <th>Timezone</th>
                        <th>Lt, Ln</th>
                        <th>Updated</th>
                        @if (config('visitlog.delete_log_button'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Browser</th>
                        <th>OS</th>
                        @if (config('visitlog.log_user'))
                            <th>User</th>
                        @endif
                        <th>Country</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Zip</th>
                        <th>Timezone</th>
                        <th>Lt, Ln</th>
                        <th>Updated</th>
                        @if (config('visitlog.delete_log_button'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </tfoot>

                    <tbody>

                    @foreach($visitlogs as $key => $visitlog)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$visitlog->ip}}</td>
                            <td>{{$visitlog->browser}}</td>
                            <td>{{$visitlog->os}}</td>
                            @if (config('visitlog.log_user'))
                                <td>{{$visitlog->user_name}} ({{$visitlog->user_id}})</td>
                            @endif
                            <td>{{$visitlog->country_name}}</td>
                            <td>{{$visitlog->region_name}}</td>
                            <td>{{$visitlog->city}}</td>
                            <td>{{$visitlog->zip_code}}</td>
                            <td>{{$visitlog->time_zone}}</td>
                            <td>{{$visitlog->latitude}}, {{$visitlog->longitude}}</td>
                            <td title="{{$visitlog->updated_at}}">{{$visitlog->last_visit}}</td>
                            @if (config('visitlog.delete_log_button'))
                                <td align="center">
                                    <a title="Delete"
                                       class="confirm-delete text-danger"
                                       data-label="Visit Log"
                                       rel="{{route('__delete_visitlog__', ['id'=>$visitlog->id])}}"
                                       href="javascript:void(0);">
                                       <i class="fa fa-trash" style="font-size:16px"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Browser</th>
                        <th>OS</th>
                        @if (config('visitlog.log_user'))
                            <th>User</th>
                        @endif
                        <th>Updated</th>
                        @if (config('visitlog.delete_log_button'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Browser</th>
                        <th>OS</th>
                        @if (config('visitlog.log_user'))
                            <th>User</th>
                        @endif
                        <th>Updated</th>
                        @if (config('visitlog.delete_log_button'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </tfoot>

                    <tbody>

                    @foreach($visitlogs as $key => $visitlog)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$visitlog->ip}}</td>
                            <td>{{$visitlog->browser}}</td>
                            <td>{{$visitlog->os}}</td>
                            @if (config('visitlog.log_user'))
                                <td>{{$visitlog->user_name}} ({{$visitlog->user_id}})</td>
                            @endif
                            <td title="{{$visitlog->updated_at}}">{{$visitlog->last_visit}}</td>
                            @if (config('visitlog.delete_log_button'))
                                <td>
                                    <a title="Delete"
                                       class="confirm-delete text-danger"
                                       data-label="Visit Log"
                                       rel="{{route('__delete_visitlog__', ['id'=>$visitlog->id])}}"
                                       href="javascript:void(0);">
                                       <i class="fa fa-trash" style="font-size:16px"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

            @if (config('visitlog.delete_all_logs_button') && $visitlogs->count())
                <div align="center">
                    <a title="Delete All Logs"
                       class="confirm-delete btn btn-danger"
                       data-label="All Visit Log"
                       rel="{{route('__delete_visitlog_all__')}}"
                       href="javascript:void(0);">
                       <i class="fa fa-trash" style="font-size:16px"></i> Delete All Logs
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>

<!-- delete confirm modal start -->
<div class="modal fade " id="modal-delete-confirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header modal-header-danger">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-trash" style="font-size:16px"></i>
                    Confirm Delete
                </h4>
            </div>

            <div class="modal-body"></div>

            <div class="modal-footer">
                <button class="btn btn-default col-sm-2 pull-right" data-dismiss="modal">
                    Close
                </button>

                <form action="#" method="POST" style="display: inline;">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <button style="margin-right: 10px;" type="button"
                            class="btn confirm-delete-red-button btn-danger col-sm-12"
                            id="frm_submit">Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
<!-- delete confirm modal end -->
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        var $body = $('body');
        var table = $('#table-log').DataTable({
            "order": [0, 'asc'],
            "responsive": true,
            "pageLength": 25,
            "autoWidth": true,
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ]
        });
        // confirm delete
        $body.on('click', '.confirm-delete', function (e) {
            var label = $(this).data('label');
            var $dialog = $('#modal-delete-confirm');
            $dialog.find('.modal-body').html('You are about to delete <strong>' + label + '</strong>, continue ?');
            $dialog.find('form').attr('action', this.rel);
            $dialog.modal('show');
            e.preventDefault();
        });
        $body.on('click', '.confirm-delete-red-button', function (e) {
            $(this).attr('disabled', true);
            $(this).closest('form')[0].submit();
        });
        // filter columns
        $("#table-log tfoot th:not(:last)").each(function (i) {
            var select = $('<select style="width: 100%;"><option value=""></option></select>')
                .appendTo($(this).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    table.column(i)
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
            table.column(i).data().unique().sort().each(function (val, idx) {
                select.append('<option value="' + val + '">' + val + '</option>')
            });
        });
        // put filters on header
        $('tfoot').css('display', 'table-header-group');
    });
</script>
@endsection