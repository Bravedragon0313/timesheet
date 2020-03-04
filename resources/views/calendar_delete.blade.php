@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.fc-title {
    color: black !important;
}
</style>
<input type="hidden" id="user_id" value="{{ session('user_id') }}" />
<br><br><br>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light calendar bordered">
                            <div class="portlet-title ">
                                <div class="caption">
                                    <i class="icon-calendar font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Calendar</span>
                                    &nbsp &nbsp &nbsp
                                    <a href="{!! url('/calendar_view'); !!}" class="btn btn-success uppercase"> back </a>
                                </div>
                            </div>
                            <div class="alert alert-danger uppercase" style="text-align: center;">please click any task for delete </div><br>
                            <br />
                            <div class="portlet-body">
                                <div id="calendar_view"> 
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
<script>
    
    $(document).ready(function(){
        var base_url =  "http://localhost/Timesheet/public";
        $('#calendar_view').fullCalendar({
            // put your options and callbacks here
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events : [
                @foreach($tasks as $task)
                {
                    title : '{{ 'TaskName: ('.$task->task_name.'), EmployeeName: ('.$task->fullname.'), ProjectName: ('.$task->project_name.'), CreatedBy: ('.$task->person_name.')'}}',
                    name : '{{ $task->user_id }}',
                    start : '{{ $task->start_date }}',
                    backgroundColor: '{{$task->color}}',
                    color: 'red',
                    textColor: 'black',
                    editable    : true,
                    @if ($task->end_date)
                        end: '{{ $task->end_date }}',
                    @endif
                    url : base_url + '/calendar_delete_id/{{ $task->id }}'
                },
                @endforeach
            ]
        });
        
    });
</script>
@endsection