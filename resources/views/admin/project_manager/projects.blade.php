@extends('layouts.admin_layouts.admin_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
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
                            <span class="caption-subject font-red sbold uppercase">Total Hours per Projects</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="caption-subject font-red sbold uppercase">Projects</span>  
                                </div>
                                <div class="col-md-3">
                                    <select id="project_sel" class="form-control input-sm select2-multiple">
                                        <option></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->project_id }}">{{$project->project_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="projectsContent" data-url={{route('projects.content')}}></div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var default_project = '';
        default_load(default_project);

        $("#project_sel").change(function(e){
            e.preventDefault();
            default_load($(this).val());
        })
        function default_load (default_project) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: $("#projectsContent").data('url'),
                data: {project_id: default_project},
                success: function(data) {
                    $("#projectsContent").html(data.content);
                }
            });
        }
    });
</script>
@endsection