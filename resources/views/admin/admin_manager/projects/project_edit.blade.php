@extends('layouts.admin_layouts.admin_design')
@section('content')
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
                    <form class="form-horizontal" method="post" action="{{ url('admin/projects/edit/'.$projectDetails->project_id) }}" name="edit_project" id="edit_project" novalidate="novalidate">{{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="form-section">Edit Project</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Nr.</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_number" id="project_number" value="{{ $projectDetails->project_number }}" />
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_name" id="project_name" value="{{ $projectDetails->project_name }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Total Hrs.</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_totalhrs" id="project_totalhrs" value="{{ $projectDetails->project_totalhrs }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Rate</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_rate" id="project_rate" value="{{ $projectDetails->project_rate }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Budget</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_budget" id="project_budget" value="{{ $projectDetails->project_budget }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Payment</label>
                                <div class="col-md-4">
                                    <select name="project_payment" class="form-control input-sm select2-multiple">
                                        <option value="paypal"  {{ $projectDetails->project_payment=="paypal" ? 'selected' : '' }}>Paypal</option>
                                        <option value="bankcard" {{ $projectDetails->project_payment=='bankcard' ? 'selected' : '' }}>Bank Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Number of Employee</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="employee_num" id="employee_num" value="{{ $projectDetails->employee_num }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Project Manager</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="project_manager" id="project_manager" value="{{ $projectDetails->project_manager }}"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Start Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="start_date">
                                    <input class="form-control" size="16" type="text" value="{{ $projectDetails->start_date }}" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="start_date" value="" name="start_date" required/><br/>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">End Date</label> 
                                <div class="input-group date form_datetime col-md-3" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="end_date">
                                    <input class="form-control" size="16" type="text" value="{{ $projectDetails->end_date }}" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="end_date" value="" name="end_date" required/><br/>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Comments</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="comments" id="comments" cols="10" rows="5">
                                        {{ $projectDetails->comments }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="submit" value="Edit Project" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
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