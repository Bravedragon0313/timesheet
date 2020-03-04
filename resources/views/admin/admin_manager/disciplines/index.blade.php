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
                            <span class="caption-subject font-red sbold uppercase">Discipline List</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/disciplines/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Discipline</span></a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th style="width: 20%;"> No </th>
                                    <th style="width: 20%;"> Discipline Nr. </th>
                                    <th style="width: 40%;"> Discipline Type </th>
                                    <th style="width: 20%;"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($disciplines as $discipline)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $discipline->discipline_number }}</td>
                                    <td class="center">{{ $discipline->discipline_type }}</td>
                                    <td class="center ">
                                        <a href="{{ url('/admin/disciplines/edit/'.$discipline->discipline_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit</a>                                                       
                                        <a href="{{ url('/admin/disciplines/delete/'.$discipline->discipline_id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
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