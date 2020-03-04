@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.fc-title {
    color: black !important;
}
.title {
    font-weight: 600;
}
.detail {
    font-size: 18px;
    font-family: "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}
.fa.fa-check{
    background: #00a65a;
    color: white;
    padding: 3px!important;
    border-radius: 30px;
    margin-right: 10px;
}
.fa.fa-exclamation{
    background: #dd4b39;
    color: white;
    padding: 3px 8px !important;
    border-radius: 30px;
    margin-right: 10px;
}
.fa.fa-pie-chart{
    background: #00c0ef;
    color: white;
    padding: 3px!important;
    border-radius: 30px;
    margin-right: 10px;
}
.name {
    font-size: 18px;
    font-weight: bold;
}
.container {
    width: 100% !important;
}
</style>
<input type="hidden" id="user_id" value="{{ session('user_id') }}" />
<br><br><br>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light calendar bordered">
                            <div class="portlet-title ">
                                <div class="caption">
                                    <i class="icon-calendar font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Task Order</span>                                   
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table id="sample_editable_1" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Status </th>
                                            <th> Task Name </th>
                                            <th> Color </th>
                                            <th> Start </th>
                                            <th> End </th>
                                            <th> Employee Name </th>
                                            <th> Project </th>
                                            <th> Department </th>
                                            <th> Comment </th>
                                            <th> Created By </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            @if( $item->status == 1)
                                            <td class="btn btn-secondary" style="text-align: left!important;" >                                                
                                                <a href="{{url('/calendar_order/update_done/'.$item->id)}}" class="btn btn-success"> <i class="fa fa-check"></i> Done</a>
                                            </td>                                            
                                            @else                                                
                                            <td class="btn btn-secondary" style="text-align: left!important;">
                                                @if($item->diff <= 0)                                                     
                                                    <a href="{{url('/calendar_order/update_working/'.$item->id)}}" class="btn btn-danger"> <i class="fa fa-exclamation"></i> Stuck</a>
                                                @else                                                    
                                                    <a href="{{url('/calendar_order/update_working/'.$item->id)}}" class="btn btn-warning"> <i class="fa fa-pie-chart"></i> Working on it</a>
                                                @endif
                                                    
                                            </td>
                                            @endif
                                            <td>{{$item->task_name}}</td>
                                            <td style="background: {{$item->color}}; padding: 10px 0px;"></td>
                                            <td>{{$item->start}}</td>
                                            <td>{{$item->end}}</td>
                                            <td>{{$item->fullname}}</td>
                                            <td>{{$item->project_name}}</td>
                                            <td>{{$item->discipline}}</td>
                                            <td>{{$item->comments}}</td>
                                            <td>{{$item->person_name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>                                                              
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
@endsection