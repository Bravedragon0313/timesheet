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
                                    &nbsp &nbsp &nbsp
                                    <a href="/calendar_view" class="btn btn-success uppercase"> go to Back </a>                                    
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1 class="title">Set due dates and never miss a deadline</h1>
                                            <br>
                                            <p class="detail">See at a glance the next actions you should do in order to finish</p>
                                            <p class="detail">your project. See which takes should be done today, which </p>
                                            <p class="detail"> should be done soon and which are overdue. </p>
                                            <p class="detail">If you have been already some task, click "Working on it!" button. </p>
                                        </div>
                                        <div class="col-md-6" style="overflow-y: scroll; height: 500px;">
                                            <div class="row">
                                                <div class="btn btn-secondary col-md-6 col-sm-6">
                                                    Status
                                                </div>
                                                <div class="btn btn-secondary col-md-6 col-sm-6">
                                                    Due Date
                                                </div>
                                            </div>
                                            <br>
                                            @foreach($items as $item)
                                            <div class="row">
                                                @if( $item->status == 1)
                                                <div class="col-md-6 col-sm-6">
                                                    <a href="{{url('/calendar_order/update_done/'.$item->id)}}" class="btn btn-success col-md-12 col-sm-12">Done<a>
                                                </div>
                                                <div class="btn btn-secondary col-md-6 col-sm-6">
                                                    <i class="fa fa-check"></i>
                                                    {{$item->due_date}}
                                                </div>
                                                @else
                                                <div class="col-md-6 col-sm-6">
                                                    <a href="{{url('/calendar_order/update_working/'.$item->id)}}" class="btn btn-warning col-md-12 col-sm-12">Working on it!</a>
                                                </div>
                                                <div class="btn btn-secondary col-md-6 col-sm-6">
                                                    @if($item->diff <= 0)
                                                        <i class="fa fa-exclamation"></i> 
                                                    @else
                                                        <i class="fa fa-pie-chart"></i> 
                                                    @endif
                                                        {{$item->due_date}}
                                                </div>
                                                @endif
                                            </div>
                                            <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>                                
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