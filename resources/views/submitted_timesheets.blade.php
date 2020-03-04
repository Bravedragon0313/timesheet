@extends('layouts.front_layouts.front_design')
@section('content')
<!-- BEGIN CONTENT -->
<style>
    .modal-show {
        width: 90%;
        margin-left: 50px;
    }
    .modal-dialog {
        width: 80%;
    }
    #timesheetContent {
        width: 90%;
        margin-left: 50px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
    <br>
    <br>
    <br>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Submitted Timesheets List</span>
                    </div>                    
                </div>
                <div class="portlet-body">
                    <table id="sample_editable_1" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10%;"> No </th>
                                <th style="width: 20%;"> Employee Name </th>
                                <th style="width: 20%;"> Week Date </th>
                                <th style="width: 20%;"> Created Time </th>
                                <th style="width: 10%;"> Status </th>
                                <th style="width: 20%;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                           @foreach($result_datas as $result_data)
                            <tr class="modal_data" data-toggle="modal" data-target=".bd-example-modal-lg" id={{$result_data->user_id}}>
                                <td class="modal_show">{{ $loop->iteration }} </td>
                                <td class="modal_show" style="font-size: 16px;">{{ $result_data->fullname }}</td>
                                <td class="modal_show" style="font-size: 16px;">{{ $result_data->week_date }}</td>
                                <td class="modal_show" style="font-size: 16px;">{{ $result_data->updated_at }}</td>
                                <td>
                                    @if($result_data->status === 0)
                                        <a class="btn btn-warning uppercase"> processing... </a>
                                    @elseif($result_data->status === 1)
                                        <a class="btn btn-success uppercase"> approved </a>
                                    @else
                                        <a class="btn btn-danger uppercase"> rejected </a>
                                    @endif
                                </td>
                                <td><a class="btn btn-success uppercase">approve</a>
                                    <a class="btn btn-danger uppercase">reject</a>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="row" id="timesheetContent" data-url="{!! url('timesheet/load_content_submitted'); !!}">
                    </div>
                </div>
              </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var base_url =  "http://localhost/Timesheet/public";
        $('.modal_show').click(function(){
            $('.modal-content').text();
            var user_id = $(this).parent().attr("id");
            var week_date = $(this).parent().children("td:eq(2)")[0].innerHTML;
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: $("#timesheetContent").data('url'),
                data: {week_date: week_date, user_id: user_id},
                success: function(data) {
                    $("#timesheetContent").html(data.content);                
                }
            });
        });

        $('.btn-success').click(function(){
            var parent = $(this).parent().parent();
            var user_id = $(this).parent().parent().attr("id");
            var week_date = $(this).parent().parent().children("td:eq(2)")[0].innerHTML;
            var update_time = $(this).parent().parent().children("td:eq(3)")[0].innerHTML;
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: base_url + '/timesheet/approve',
                data: {week_date: week_date, user_id: user_id, updated_at: update_time},
                success: function(data) {
                    location.href=base_url + "/submitted_timesheets";             
                }
            });
        });

        $('.btn-danger').click(function(){
            var parent = $(this).parent().parent();
            var user_id = $(this).parent().parent().attr("id");
            var week_date = $(this).parent().parent().children("td:eq(2)")[0].innerHTML;
            var update_time = $(this).parent().parent().children("td:eq(3)")[0].innerHTML;
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: base_url + '/timesheet/reject',
                data: {week_date: week_date, user_id: user_id, updated_at: update_time},
                success: function(data) {
                    location.href=base_url + "/submitted_timesheets";             
                }
            });
        });
    });
</script>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@endsection