@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
<style>
    .input-group.date.form_datetime {
        padding-left: 15px !important;
    }
</style>
<div class="page-content-wrapper">
  
  <div class="page-content"><hr>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" method="post" name="add_task" id="add_task">
                        <div class="form-body">
                            <h3 class="form-section">Add Task</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Task Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="task_name" id="task_name" required/>
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
                                            <input name="color" class="form-control" placeholder="" readonly="" type="text" id="color_value">
                                        </div>
                                        <div class="bfh-colorpicker-popover">
                                            <canvas class="bfh-colorpicker-palette" width="384" height="256"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Start Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="start_date">
                                    <input class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="start_date" value="" name="start_date" required/><br/>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">End Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="end_date">
                                    <input class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="end_date" value="" name="end_date" required/><br/>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Employee Name</label>
                                <div class="col-md-4">
                                    <select name="user_id" id="user_id" class="form-control input-sm select2-multiple">
                                        <option></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" key="{{$user->socket_id}}">{{$user->fullname}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="socket_id">
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Name</label>
                                <div class="col-md-4">
                                    <select name="project_name" class="form-control input-sm select2-multiple" id="project_name">
                                        <option></option>
                                        @foreach ($projects as $project)
                                            <option value="{{$project->project_name}}">{{$project->project_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">DiscipLine</label>
                                <div class="col-md-4">
                                    <select name="discipline" class="form-control input-sm select2-multiple" id="discipline">
                                        <option></option>
                                        @foreach ($disciplines as $discipline)
                                            <option value="{{$discipline->discipline_type}}">{{$discipline->discipline_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Comments</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="comments" id="comments" cols="10" rows="5">
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Created By</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="person_name" id="person_name" value="{{session('userSession')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row" id="add-task">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="button" value="Add Task" class="btn btn-success" id="add_task_button">
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="hidden" class="form-control" id="from_user" value="{{session('user_id')}}"/>
                    <!-- END FORM-->
                </div>
            </div>
            
            <!-- END VALIDATION STATES-->
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
    $(document).ready(function(){
        $('#user_id').change(function(){
            $('#socket_id').val($(this).children(":selected").attr("key"));
        });
    });
</script>



@endsection