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
                    <form class="form-horizontal" method="post" action="{{ url('admin/company/create') }}" name="add_company" id="add_company">{{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="form-section">Add Company Preferences</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Name*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="company_name" id="company_name" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Address*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="company_address" id="company_address" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Alternative Address</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="company_alt_address" id="company_alt_address"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">City*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="city" id="city" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">State*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="state" id="state" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Zip Code*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="zip_code" id="zip_code" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Country*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="country" id="country" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Phone Number*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Alternative Phone Number</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="alt_phone_number" id="alt_phone_number"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company email*</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="email" id="email" required/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Company Alternative email</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="alt_email" id="alt_email" />
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Number Of Employees</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="number_of_employees" id="number_of_employees"/>
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
                                <label class="control-label col-md-3">Number Of Work Hours per Week</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="number_work_hours_week" id="number_work_hours_week"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Number Of Vacation Hours </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="number_vacation_hours" id="number_vacation_hours"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Number Of Vacation Days</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="number_vacation_days" id="number_vacation_days"/>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Week Days Work</label>
                                <div class="row col-md-6">
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Monday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day1" id="checkboxID1"><label for="checkboxID1"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Tuesday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day2" id="checkboxID2"><label for="checkboxID2"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Wenseday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day3" id="checkboxID3"><label for="checkboxID3"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Thursday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day4" id="checkboxID4"><label for="checkboxID4"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Friday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day5" id="checkboxID5"><label for="checkboxID5"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Saturday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day6" id="checkboxID6"><label for="checkboxID6"></label></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2"> Sunday: </label>
                                    <div class="col-md-4">
                                      <p class="onoff"><input type="checkbox" value="1" name="week_day7" id="checkboxID7"><label for="checkboxID7"></label></p>
                                    </div>
                                  </div>
                                </div>   
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Number Of Department</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="number_of_department" id="number_of_department"/>
                                </div>
                            </div>                            
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Comments</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="comments" id="comments" col="10" row="5">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="submit" value="Apply" class="btn btn-success">
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
@endsection