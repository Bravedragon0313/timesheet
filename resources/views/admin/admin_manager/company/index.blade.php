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
                            <span class="caption-subject font-red sbold uppercase">Company List</span>
                        </div>                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/company/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Company</span></a>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Company Name </th>                                    
                                    <th> Address</th>
                                    <th> Alternative Address </th>
                                    <th> City </th>
                                    <th> State </th>
                                    <th> Zip Code </th>
                                    <th> Country </th>
                                    <th> Phone </th>
                                    <th> Alternative Phone </th>
                                    <th> Email </th>
                                    <th> Alternative Email </th>
                                    <th> Number of Employees </th>
                                    <th> Employee Type </th>
                                    <th> Work Hours per Week </th>
                                    <th> Number of Vacation Hours </th>
                                    <th> Number of Vacation Days </th>
                                    <th> Week Days Work </th>
                                    <th> Number of Departments </th>
                                    <th> Comments </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($result_datas as $result_data)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $result_data->company_name }}</td>
                                    <td class="center">{{ $result_data->company_address }}</td>
                                    <td class="center">{{ $result_data->company_alt_add }}</td>
                                    <td class="center">{{ $result_data->city }}</td>                                    
                                    <td class="center">{{ $result_data->state }}</td>
                                    <td class="center">{{ $result_data->zip_code }}</td>                                    
                                    <td class="center">{{ $result_data->country }}</td>
                                    <td class="center">{{ $result_data->phone_number }}</td>
                                    <td class="center">{{ $result_data->alt_phone_number }}</td>
                                    <td class="center">{{ $result_data->email }}</td>
                                    <td class="center">{{ $result_data->alt_email }}</td>
                                    <td class="center">{{ $result_data->number_of_employees }}</td>
                                    <td class="center">
                                      <select style='width: 100%;height: 100%;' class='department' name='department'>                                       
                                        @foreach($employee_types as $employee_type)
                                        <option value="{{ $employee_type->type }}" {{ $employee_type->type==$result_data->employee_type ? 'selected' : '' }}>{{ $employee_type->type }}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td class="center">{{ $result_data->number_work_hours_week }}</td>
                                    <td class="center">{{ $result_data->number_vacation_hours }}</td>
                                    <td class="center">{{ $result_data->number_vacation_days }}</td>
                                    <td class="center">
                                      @if($result_data->week_day1 == 1 || $result_data->week_day2 == 1 || $result_data->week_day3 == 1 || $result_data->week_day4 == 1 || $result_data->week_day5 == 1 || $result_data->week_day6 == 1 || $result_data->week_day7 == 1)
                                        <div class="btn btn-success">
                                        @if($result_data->week_day1 == 1)
                                          Mon, 
                                        @endif
                                        @if($result_data->week_day2 == 1)
                                          Tue, 
                                        @endif
                                        @if($result_data->week_day3 == 1)
                                          Wen, 
                                        @endif
                                        @if($result_data->week_day4 == 1)
                                          Thu, 
                                        @endif
                                        @if($result_data->week_day5 == 1)
                                          Fri, 
                                        @endif
                                        @if($result_data->week_day6 == 1)
                                          Sat, 
                                        @endif
                                        @if($result_data->week_day7 == 1)
                                          Sun, 
                                        @endif
                                        </div>
                                      @endif
                                    </td>
                                    <td class="center">{{ $result_data->number_of_department }}</td>
                                    <td class="center">{{ $result_data->comments }}</td>
                                    <td class="center ">
                                        <a href="{{ url('/admin/company/edit/'.$result_data->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit &nbsp &nbsp</a>                                                       
                                        <a href="{{ url('/admin/company/delete/'.$result_data->id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
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