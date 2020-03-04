@extends('layouts.admin_layouts.admin_design')
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Employee List</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/users/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Employee</span></a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Employee ID </th>
                                    <th> Full Name </th>
                                    <th> Last Name </th>
                                    <th> Fisrt Name </th>
                                    <th> Employee Type </th>
                                    <th> Department </th>
                                    <th> Password </th>
                                    <th> Rates </th>
                                    <th> Education </th>
                                    <th> Citizenship </th>
                                    <th> Supervisor </th>
                                    <th style="width: 20%!important;"> Permission </th>
                                    <th style="width: 20%!important;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($users as $user)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $user->employee_id }}</td>
                                    <td class="center">{{ $user->fullname }}</td>
                                    <td class="center">{{ $user->lastname }}</td>
                                    <td class="center">{{ $user->firstname }}</td>
                                    <td class="center">
                                      <select style='width: 100%;height: 100%;' class='department' name='department'>                                       
                                        @foreach($employee_types as $employee_type)
                                        <option value="{{ $employee_type->type }}" {{ $employee_type->type==$user->employee_type ? 'selected' : '' }}>{{ $employee_type->type }}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td class="center">
                                        <select style='width: 100%;height: 100%;' class='department' name='department'>
                                            <option value=''></option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->discipline_id }}" {{ $department->discipline_id==$user->departmentid ? 'selected' : '' }}>{{ $department->discipline_type }}</option>
                                            @endforeach
                                        </select></td>
                                    <td class="center">********</td>
                                    <td class="center">{{ $user->rates }}</td>
                                    <td class="center">{{ $user->education }}</td>
                                    <td class="center">{{ $user->citizenship }}</td>
                                    <td class="center">{{ $user->supervisor }}</td>
                                    <td class="center">
                                        <div class="md-checkbox-inline">
                                            <div class="md-checkbox has-info">
                                                <input type="checkbox" id="timesheet_check" disabled="" class="md-check" {{ ($user->is_timesheets==1) ? "checked" : "" }}>
                                                <label for="checkbox12">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Timesheet </label>
                                            </div>
                                            <div class="md-checkbox has-info">
                                                <input type="checkbox" id="summary_check" disabled="" class="md-check" {{ ($user->is_summary==1) ? "checked" : "" }}>
                                                <label for="checkbox12">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Summary </label>
                                            </div>
                                            <div class="md-checkbox has-info">
                                                <input type="checkbox" id="accounting_check" disabled="" class="md-check" {{ ($user->is_accounting==1) ? "checked" : "" }}>
                                                <label for="checkbox12">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Accounting </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center ">
                                        <a href="{{ url('/admin/users/edit/'.$user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit</a>                                                       
                                        <a href="{{ url('/admin/users/delete/'.$user->id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@endsection