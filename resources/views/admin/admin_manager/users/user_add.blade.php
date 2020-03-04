@extends('layouts.admin_layouts.admin_design')
@section('content')

<div class="page-content-wrapper">
  
  <div class="page-content"><hr>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" method="post" action="{{ url('admin/users/create') }}" name="add_user" id="add_user">{{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="form-section">Add Employee</h3>
                            
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Employee ID</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="employee_id"  required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_lastname" id="user_lastname" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Fisrt Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_firstname" id="user_firstname" />
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Employee Type</label>
                                <div class="col-md-4">
                                    <select name="employee_type" class="form-control input-sm select2-multiple">
                                        @foreach($employee_types as $employee_type)
                                        <option value="{{ $employee_type->type }}">{{ $employee_type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Department</label>
                                <div class="col-md-4">
                                    <select style='width: 100%;height: 100%;' class='department' name='department'>
                                        <option value=''></option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->discipline_id }}">{{ $department->discipline_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" name="user_password" id="user_password" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Rates</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_rate" id="user_rate" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Education</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_education" id="user_education" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Citizenship</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_citizenship" id="user_citizenship" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Supervisor</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="user_supervisor" id="user_supervisor" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3" >Permission</label>
                                <div class="md-checkbox-list col-md-4">
                                    <div class="md-checkbox has-success">
                                        <input type="checkbox" id="timesheet_check" class="md-check">
                                        <input type="hidden" id="timesheet_check_temp" class="md-check" name="timesheet_check" value="">
                                        <label for="timesheet_check">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Timesheet </label>
                                    </div>
                                    <div class="md-checkbox has-error">
                                        <input type="checkbox" id="summary_check" class="md-check" >
                                        <input type="hidden" id="summary_check_temp" class="md-check" name="summary_check" value="">
                                        <label for="summary_check">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Project Manager </label>
                                    </div>
                                    <div class="md-checkbox has-warning">
                                        <input type="checkbox" id="accounting_check" class="md-check">
                                        <input type="hidden" id="accounting_check_temp" class="md-check" name="accounting_check" value="">
                                        <label for="accounting_check">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Accounting </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="submit" value="Add Employee" class="btn btn-success">
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
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#timesheet_check").click(function(){
            if($(this).is(":checked")){
                $("#timesheet_check_temp").val("1");
                console.log($("#timesheet_check_temp").val());
            }else{
                $("#timesheet_check_temp").val("");
            }
        });
        $("#summary_check").click(function(){
            if($(this).is(":checked")){
                $("#summary_check_temp").val("1");
            }else{
                $("#summary_check_temp").val("");
            }
        });
        $("#accounting_check").click(function(){
            if($(this).is(":checked")){
                $("#accounting_check_temp").val("1");
            }else{
                $("#accounting_check_temp").val("");
            }
        });
    });
    
</script>
@endsection