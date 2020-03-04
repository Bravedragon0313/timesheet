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
                            <span class="caption-subject font-red sbold uppercase">Staff CVS List</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/others/staff_cvs/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Staff CVS</span></a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> No </th>
                                    <th style="width: 10%;"> Staff Name </th>
                                    <th style="width: 10%;"> Department </th>
                                    <th style="width: 10%;"> Education</th>
                                    <th style="width: 10%;"> Citizenship </th>
                                    <th style="width: 10%;"> Experience </th>
                                    <th style="width: 10%;"> Comments </th>
                                    <th style="width: 10%;"> Attachment </th>
                                    <th style="width: 20%;"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($items as $item)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $item->staff_name }}</td>
                                    <td class="center">{{ $item->department }}</td>
                                    <td class="center">{{ $item->education }}</td>
                                    <td class="center">{{ $item->citizenship }}</td>
                                    <td class="center">{{ $item->experience }}</td>
                                    <td class="center">{{ $item->comments }}</td>
                                    <td class="center">
                                        <a href="{{ url($item->temp) }}"> {{ $item->attachment }}</a>                                        
                                    </td>
                                    <td class="center ">
                                        <a href="{{ url('admin/others/staff_cvs/edit/'.$item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit &nbsp &nbsp</a>                                                       
                                        <a href="{{ url('admin/others/staff_cvs/delete/'.$item->id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
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