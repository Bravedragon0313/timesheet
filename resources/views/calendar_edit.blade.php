@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" id="user_id" value="{{ session('user_id') }}" />
<br><br><br>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                      <form class="form-horizontal" method="post" action="{{ url('/calendar_edit/'.$calendarDetail->id) }}" name="add_task" id="add_task">{{ csrf_field() }}
                          <div class="form-body">
                              <h3 class="form-section">Edit Task</h3>
                              <div class="form-group has-success">
                                  <label class="control-label col-md-3">Task Name</label>
                                  <div class="col-md-4">
                                      <input type="text" class="form-control" name="task_name" id="task_name" value="{{$calendarDetail->task_name}}"required/>
                                  </div>
                              </div>
                              <div class="form-group has-success">
                                <label class="control-label col-md-3">Color</label>
                                <div class="col-md-4">
                                    <div class="bfh-colorpicker" data-name="color" data-color="#FF0000">
                                        <div class="input-group bfh-colorpicker-toggle" data-toggle="bfh-colorpicker">
                                            <span class="input-group-addon">
                                                <span class="bfh-colorpicker-icon" style="background-color: rgb(255, 0, 0);">
                                                </span>
                                            </span>
                                            <input name="color" class="form-control" placeholder="" readonly="" type="text">
                                        </div>
                                        <div class="bfh-colorpicker-popover">
                                            <canvas class="bfh-colorpicker-palette" width="384" height="256"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Start Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date="{{$calendarDetail->start_date}}" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" type="text" value="{{$calendarDetail->start_date}}" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="dtp_input1" value="{{$calendarDetail->start_date}}" name="start_date"/><br/>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">End Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date="{{$calendarDetail->end_date}}" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="dtp_input2">
                                    <input class="form-control" size="16" type="text" value="{{$calendarDetail->end_date}}" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="dtp_input2" value="{{$calendarDetail->end_date}}" name="end_date"/><br/>
                            </div>
                              
                              <div class="form-group has-success">
                                  <label class="control-label col-md-3">Employee Name</label>
                                  <div class="col-md-4">
                                      <select name="user_id" class="form-control input-sm select2-multiple">
                                          @foreach ($users as $user)
                                              <option value="{{ $user->id }}" {{ ($calendarDetail->user_id==$user->id) ? "selected" : "" }}>{{$user->fullname}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                             <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Name</label>
                                <div class="col-md-4">
                                    <select name="project_name" class="form-control input-sm select2-multiple">
                                        <option></option>
                                        @foreach ($projects as $project)
                                            <option value="{{$project->project_name}}" {{ ($calendarDetail->project_name==$project->project_name) ? "selected" : "" }}>{{$project->project_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">DiscipLine</label>
                                <div class="col-md-4">
                                    <select name="discipline" class="form-control input-sm select2-multiple">
                                        <option></option>
                                        @foreach ($disciplines as $discipline)
                                            <option value="{{$discipline->discipline_type}}" {{ ($calendarDetail->discipline==$discipline->discipline_type) ? "selected" : "" }}>{{$discipline->discipline_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Comments</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="comments" id="comments" cols="10" rows="5">
                                    {{ $calendarDetail->comments }}
                                    </textarea>
                                </div>
                            </div>
                              <div class="form-group has-success">
                                  <label class="control-label col-md-3">Created By</label>
                                  <div class="col-md-4">
                                      <input type="text" class="form-control" name="person_name" id="person_name" value="{{$calendarDetail->person_name}}"/>
                                  </div>
                              </div>                              
                          </div>
                          <div class="form-actions">
                              <div class="row">
                                  <div class="col-md-offset-3 col-md-9">
                                      <input type="submit" value="Edit Task" class="btn btn-success">
                                  </div>
                              </div>
                          </div>
                      </form>
                      <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery-2.2.3.min.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>

<script type="text/javascript">
var dateNow = new Date();
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1,
        defaultDate:dateNow
        
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
@endsection