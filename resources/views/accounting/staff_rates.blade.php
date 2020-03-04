@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
<div class="page-content">
    <form method="post" action="{{ url('/accounting/staff_rates_store') }}">{{ csrf_field() }}
        
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Staff Rates</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-1">
                                        <i class="icon-user"></i>  <span class="caption-subject font-red sbold uppercase">Employees</span>  
                                </div>
                                <div class="col-md-3">
                                    <select id="employee_sel" name="employee_id" class="form-control input-sm select2-multiple" style="    border-radius: 4px !important;">
                                        <option></option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ ($employee->id==$employee_id) ? "selected" : "" }}>{{$employee->fullname}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8" >
                                    <button type="submit" class="btn green-jungle" value="Save">
                                        <i class="icon-pencil"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="staffratesContent" data-url={{route('front_staffrates.content')}}></div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </form>
</div>
    
<!-- END CONTENT -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var default_employee = $("#employee_sel").val();
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
                url: $("#staffratesContent").data('url'),
                data: {employee_id: default_employee},
                success: function(data) {
                    $("#staffratesContent").html(data.content);
                }
            });
        }
    });
</script>
@endsection