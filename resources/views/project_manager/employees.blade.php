@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
    <div class="page-content">
        {{ csrf_field() }}
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Total Hours per Employees</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="caption-subject font-red sbold uppercase">Employees</span>  
                                </div>
                                <div class="col-md-3">
                                    <select id="employee_sel" class="form-control input-sm select2-multiple">
                                        <option></option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{$employee->fullname}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="employeesContent" data-url={{route('front_employees.content')}}></div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    
<!-- END CONTENT -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var default_employee = '';
        default_load(default_employee);

        $("#employee_sel").change(function(e){
            e.preventDefault();
            default_load($(this).val());
        })
        function default_load (default_employee) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: $("#employeesContent").data('url'),
                data: {employee_id: default_employee},
                success: function(data) {
                    $("#employeesContent").html(data.content);
                }
            });
        }
    });
</script>
@endsection