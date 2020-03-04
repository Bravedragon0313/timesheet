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
                            <span class="caption-subject font-red sbold uppercase">Client List</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{url('/admin/clients/create')}}" class="btn btn-success"><span><i class="fa fa-plus"></i>Add New Client</span></a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> No </th>
                                    <th style="width: 10%;"> Client Name </th>
                                    <th style="width: 10%;"> Email </th>
                                    <th style="width: 10%;"> Address</th>
                                    <th style="width: 10%;"> Phone Number </th>                                    
                                    <th style="width: 10%;"> Person to Contact </th>
                                    <th style="width: 10%;"> Dicipline </th>
                                    <th style="width: 10%;"> Imortance Level </th>
                                    <th style="width: 10%;"> Comments </th>
                                    <th style="width: 20%;"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($clients as $client)
                                <tr>
                                    <td class="center">{{ $loop->iteration }} </td>
                                    <td class="center">{{ $client->client_name }}</td>
                                    <td class="center">{{ $client->client_email }}</td>
                                    <td class="center">{{ $client->client_addr }}</td>
                                    <td class="center">{{ $client->client_phone }}</td>                                    
                                    <td class="center">{{ $client->client_contact }}</td>
                                    <td class="center">{{ $client->client_dicip }}</td>
                                    <td class="center">
                                        @if($client->importance_level=="high")
                                        <label class="high"> {{ $client->importance_level }} </label>
                                        @elseif($client->importance_level=="medium")
                                        <label class="medium"> {{ $client->importance_level }} </label>
                                        @elseif($client->importance_level=="low")
                                        <label class="low"> {{ $client->importance_level }} </label>
                                        @else
                                        <label></label>
                                        @endif
                                    </td>
                                    <td class="center">{{ $client->client_comments }}</td>
                                    <td class="center ">
                                        <a href="{{ url('/admin/clients/edit/'.$client->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit "></i> Edit &nbsp &nbsp</a>                                                       
                                        <a href="{{ url('/admin/clients/delete/'.$client->id)}}" data-method="delete" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Delete</a>
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