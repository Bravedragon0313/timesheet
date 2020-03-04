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
                            <span class="caption-subject font-red sbold uppercase">Project List</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/projects/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Project</span></a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> No </th>
                                    <th style="width: 20%;"> Project Nr. </th>
                                    <th style="width: 20%;"> Project Name </th>
                                    <th style="width: 10%;"> Total Hrs. </th>
                                    <th style="width: 10%;"> Rates </th>
                                    <th style="width: 10%;"> Budget </th>
                                    <th style="width: 10%;"> Payment </th>
                                    <th style="width: 10%;"> Number of Employee </th>
                                    <th style="width: 10%;"> Project Manager </th>
                                    <th style="width: 10%;"> Start </th>
                                    <th style="width: 10%;"> End </th>
                                    <th style="width: 10%;"> Comments </th>
                                    <th style="width: 20%;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($projects as $project)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $project->project_number }}</td>
                                    <td class="center">{{ $project->project_name }}</td>
                                    <td class="center">{{ $project->project_totalhrs }}</td>
                                    <td class="center">{{ $project->project_rate }}</td>
                                    <td class="center">{{ $project->project_budget }}</td>
                                    <td class="center">{{ $project->project_payment }}</td>
                                    <td class="center">{{ $project->employee_num }}</td>
                                    <td class="center">{{ $project->project_manager }}</td>
                                    <td class="center">{{ $project->start_date }}</td>
                                    <td class="center">{{ $project->end_date }}</td>
                                    <td class="center">{{ $project->project_comments }}</td>
                                    <td class="center ">
                                        <a href="{{ url('/admin/projects/edit/'.$project->project_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit</a>                                                       
                                        <a href="{{ url('/admin/projects/delete/'.$project->project_id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
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