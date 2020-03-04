@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $total_hrs=0;
    $total_workedhrs=0;
    $total_budget=0;
    $overtime_hrs_total=0;
@endphp
@foreach ($result_datas as $result_data)
    @php
        $total_hrs+=$result_data->project_totalhrs;
        $total_workedhrs+=$result_data->sum;    
        $total_budget+=$result_data->sum*$result_data->project_rate;
    @endphp
@endforeach
@foreach ($overtime_hours as $overtime)
    @php
        $overtime_hrs_total+=$overtime->sum;
    @endphp
@endforeach
<link rel="stylesheet" href="/css/calendarview.css">
<style>
  body {
    font-family: Trebuchet MS;
  }
  div.calendar {
    max-width: 240px;
    margin-left: auto;
    margin-right: auto;
  }
  div.calendar table {
    width: 100%;
    margin: 10px;
  }
  div.dateField {
    width: 140px;
    padding: 6px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    color: #555;
    background-color: white;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
  }
  div#popupDateField:hover {
    background-color: #cde;
    cursor: pointer;
  }
  .current {
    color: red;
  }
  .current_timezone {
    color: #ff00f5;
  }
  .usaTime {
    color: green;
  }
  .ukTime {
    color: blue;
  }
  #selectBox {
    opacity: 0;
  }
  #monthAndYear {
    text-align: center;
    font-weight: bold;
    font-size: 36px !important;
  }
  .card {
    margin-left: 20px;
  }
  .page-content {
    min-height: 840px !important;
    background-color: rgb(229,222,222) !important;
    }   

#selectBox {
    display: none;
} 

</style>
<div class="page-content">
    <br><br><br>
    <div class="row">
        <br>
        <div class="col-sm-12 col-md-3 col-lg-3 mt-5">
            <div class="card">
                <h3 class="card-header" id="monthAndYear"></h3>
                <table class="table table-bordered table-responsive-sm" id="calendar111">
                    <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                    </thead>
                    <tbody id="calendar111-body">
                    </tbody>
                </table>
                <div class="form-inline">
                    <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Previous</button>
                    <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next</button>
                </div>
                <br/>
                <form id="selectBox"class="form-inline">
                    <label class="lead mr-2 ml-2" for="month">Jump To: </label>
                    <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                        <option value=0>Jan</option>
                        <option value=1>Feb</option>
                        <option value=2>Mar</option>
                        <option value=3>Apr</option>
                        <option value=4>May</option>
                        <option value=5>Jun</option>
                        <option value=6>Jul</option>
                        <option value=7>Aug</option>
                        <option value=8>Sep</option>
                        <option value=9>Oct</option>
                        <option value=10>Nov</option>
                        <option value=11>Dec</option>
                    </select>
                    <label for="year"></label>
                    <select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                        <option value=1990>1990</option>                    
                    </select>
                </form>
            </div>
        </div>        
        <div class="col-md-3 col-sm-4" style="text-align: center; height: 20em;">
                <div id="clock">
                  <div class="hour"> 
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <div class="hour">
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <!-- <div id="alarm"> </div> -->
                  <div id="min"></div>
                  <div id="hour"></div>
                  <div id="sec"></div>
                  <ol>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ol>
                  <br>
                  <label class="current"> UAE </label>
                  <br>
                  <br>
                  <label class="current_timezone uppercase"> Gulf Standard Time </label>
                </div>
        </div>
        <div class="col-md-3 col-sm-4" style="text-align: center; height: 20em;">
                <div id="clock1">
                  <div class="hour"> 
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <div class="hour">
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <!-- <div id="alarm"> </div> -->
                  <div id="min1"></div>
                  <div id="hour1"></div>
                  <div id="sec1"></div>
                  <ol>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ol>
                  <br>
                <label class="current"> USA </label>
                <br>
                <br>
                <label class="usaTime uppercase"> EASTERN STANDARD TIME </label>
                </div>
        </div>
        <div class="col-md-3 col-sm-4" style="text-align: center; height: 20em;">
                <div id="clock2">
                  <div class="hour"> 
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <div class="hour">
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                    <div class="min"></div>
                  </div>
                  <!-- <div id="alarm"> </div> -->
                  <div id="min2"></div>
                  <div id="hour2"></div>
                  <div id="sec2"></div>
                  <ol>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ol>
                <br>
                <label class="current"> UK </label>
                <br>
                <br>
                <label class="ukTime uppercase"> Greenwich Mean Time </label>
                </div>
        </div>           
    </div>
    <br />
    <div class="row">
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Hours(current month)</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Hrs</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $total_hours }}">0</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Worked Hours(all months)</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-yellow icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Hrs</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $worked_hours }}">0</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Overtime Hrs.</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Hrs</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $overtime_hrs_total<0? 0: $overtime_hrs_total }}">0</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Sick/Annual/Leave Hrs.</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-blue icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Hrs</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ $othertime_hours }}">0</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Remaining vacation Hrs.</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Hrs</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ 187 - $othertime_hours}}">0</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading uppercase">Tasks of Everybody</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-orange icon-user"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">&nbsp</span>
                        <a href="{!! url('/task_view'); !!}" class="widget-thumb-body-stat"> CLICK ME FOR VIEW </a>
                    </div>
                </div>
                <a href="{!! url('/task_view'); !!}"></a>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-madison bold uppercase">Disciplines per Project</span>
                        
                    </div>
                </div>
                <div class="portlet-body table-both-scroll ">
                    <div class="row" style="height: 500px; overflow-y: scroll;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"> # </th>
                                    <th width="15%"> Project Name </th>
                                    <th width="10%"> Total Hrs. </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result_projects as $result_project)
                                    <tr class="discipline_list" id="{{ $result_project->project_id }}">
                                        <td>{{ $result_project->project_number }}</td>
                                        <td>{{ $result_project->project_name }}</td>
                                        <td>{{ $result_project->sum }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Hours of Disciplines per Project</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="" id="discipline_details"></div>
                    <div id="discipline_amchart" class="CSSAnimationChart"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-madison bold uppercase">Disciplines Totals</span>
                        
                    </div>
                </div>
                <div class="portlet-body table-both-scroll ">
                    <div class="row" style="height: 500px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"> # </th>
                                    <th width="15%">Discipline</th>
                                    <th width="10%"> Total Hrs. </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result_disciplines_total as $result_project)
                                    <tr class="discipline_total_list" id="{{ $result_project->discipline_id }}">
                                        <td>{{ $result_project->discipline_number }}</td>
                                        <td>{{ $result_project->discipline_type }}</td>
                                        <td>{{ $result_project->sum }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Hours per Project</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="" id="discipline_total_details"></div>
                    <div id="discipline_total_amchart" class="CSSAnimationChart"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-madison bold uppercase">Phase per Project</span>
                        
                    </div>
                </div>
                <div class="portlet-body table-both-scroll ">
                    <div class="row" style="height: 500px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"> # </th>
                                    <th width="15%"> Project Name </th>
                                    <th width="10%"> Total Hrs. </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result_projects as $result_project)
                                    <tr class="phase_list" id="{{ $result_project->project_id }}">
                                        <td>{{ $result_project->project_number }}</td>
                                        <td>{{ $result_project->project_name }}</td>
                                        <td>{{ $result_project->sum }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Hours of Phases per Project</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="" id="phase_details"></div>
                    <div id="phase_amchart" class="CSSAnimationChart"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-madison bold uppercase">Phase Totals</span>
                        
                    </div>
                </div>
                <div class="portlet-body table-both-scroll ">
                    <div class="row" style="height: 500px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"> # </th>
                                    <th width="15%">Phase</th>
                                    <th width="10%"> Total Hrs. </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result_phase_total as $result_project)
                                    <tr class="phase_total_list" id="{{ $result_project->phase_id }}">
                                        <td>{{ $result_project->phase_number }}</td>
                                        <td>{{ $result_project->phase_name }}</td>
                                        <td>{{ $result_project->sum }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Hours per Project</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="" id="phase_total_details"></div>
                    <div id="phase_total_amchart" class="CSSAnimationChart"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row widget-row">
        <div class="col-md-3">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-madison bold uppercase">My Projects List</span>
                        
                    </div>
                </div>
                <div class="portlet-body table-both-scroll ">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"> # </th>
                                    <th width="15%"> Project Name </th>
                                    <th width="10%"> Total Hrs. </th>
                                    <th width="10%"> Worked Hrs. </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result_datas as $result_data)
                                    <tr class="project_list" id="{{ $result_data->project_id }}">
                                        <td>{{ $result_data->project_number }}</td>
                                        <td>{{ $result_data->project_name }}</td>
                                        <td>{{ $result_data->project_totalhrs }}</td>
                                        <td>{{ $result_data->sum }}</td>                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>  
            </div>           
        </div>
        <div class="col-md-4">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Hours per Project</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="" id="project_details"></div>
                        <div id="example_amchart" class="CSSAnimationChart"></div>                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Extra Hours per Project</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="" id="project_extra_details"></div>
                        <div id="example_amchart_extra" class="CSSAnimationChart"></div>                        
                    </div>
                </div>
            </div>
        
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="/js/calendarview.js"></script>
<script type="text/javascript" src="/js/clock.js"></script>
<script src="{{ asset('js/clock_modern.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".employee_list").click(function(e){
            e.preventDefault();
            employee_fullname=$(this).children().eq(1).html();
            employee_amchart_load($(this).attr("id"),employee_fullname);
        });
        function employee_amchart_load (employee_id,employee_fullname) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/projectmanager_dashboard/employee_amchart_content',
                data: {employee_id: employee_id},
                success: function(data) {
                    initChartSample5(data.content)
                    $("#employee_details").html("<label>"+ employee_fullname + "</label>")
                }
            });
        }

        $(".project_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            project_amchart_load($(this).attr("id"),project_number,project_name);
        });
        function project_amchart_load (project_id,project_number,project_name) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/employee_dashboard/project_amchart_view',
                data: {project_id: project_id},
                success: function(data) {
                    console.log(data);
                    var content_data=data.content;
                    if(data.total_hours>=0){
                        content_data.push({'hourly_type':"Empty ",'sum':data.total_hours});
                        initChartSample7(data.content);
                    }
                    else{
                        content_data.push({'fullname':"Empty",'sum':0});
                        initChartSample7(content_data);
                        var extra_hrs = data.total_hours * (-1);
                        extra_data = [{'fullname':'Extra Hrs', 'sum': extra_hrs}];
                        initChartSample7_extra(extra_data);
                    }
                    $("#project_details").html("<label>"+project_number+":"+ project_name + "</label>");
                    $("#project_extra_details").html("<label>"+project_number+":"+ project_name + "</label>");
                }
            });
        }

        // discipline
        $(".discipline_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            discipline_amchart_load($(this).attr("id"),project_number,project_name);
        });
        function discipline_amchart_load (project_id,project_number,project_name) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/projectmanager_dashboard/discipline_amchart_content',
                data: {project_id: project_id},
                success: function(data) {
                    initChartSample7_1(data.content);
                    $("#discipline_details").html("<label>"+project_number+":"+ project_name + "</label>")
                }
            });
        }
        //end discipline

        // phase
        $(".phase_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            phase_amchart_load($(this).attr("id"),project_number,project_name);
        });
        function phase_amchart_load (project_id,project_number,project_name) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/projectmanager_dashboard/phase_amchart_content',
                data: {project_id: project_id},
                success: function(data) {
                    initChartSample7_2(data.content);
                    $("#phase_details").html("<label>"+project_number+":"+ project_name + "</label>")
                }
            });
        }
        //end phase

        // discipline total
        $(".discipline_total_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            discipline_total_amchart_load($(this).attr("id"),project_number,project_name);
        });
        function discipline_total_amchart_load (project_id,project_number,project_name) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/projectmanager_dashboard/discipline_total_amchart_content',
                data: {project_id: project_id},
                success: function(data) {
                    initChartSample7_3(data.content);
                    $("#discipline_total_details").html("<label>"+project_number+":"+ project_name + "</label>")
                }
            });
        }
        //end discipline total

        // phase total
        $(".phase_total_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            phase_total_amchart_load($(this).attr("id"),project_number,project_name);
        });
        function phase_total_amchart_load (project_id,project_number,project_name) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/projectmanager_dashboard/phase_total_amchart_content',
                data: {project_id: project_id},
                success: function(data) {
                    initChartSample7_4(data.content);
                    $("#phase_total_details").html("<label>"+project_number+":"+ project_name + "</label>")
                }
            });
        }
        //end phase total
    
    });

    var initChartSample7 = function(array_data) {
        var chart = AmCharts.makeChart("example_amchart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "hourly_type",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#example_amchart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }

    var initChartSample7_extra = function(array_data) {
        var chart = AmCharts.makeChart("example_amchart_extra", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "fullname",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#example_amchart_extra').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }

    var initChartSample7_1 = function(array_data) {
        var chart = AmCharts.makeChart("discipline_amchart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "title",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#discipline_amchart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }

    var initChartSample7_2 = function(array_data) {
        var chart = AmCharts.makeChart("phase_amchart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "title",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#phase_amchart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }

    var initChartSample7_3 = function(array_data) {
        var chart = AmCharts.makeChart("discipline_total_amchart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "title",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#discipline_total_amchart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }

    var initChartSample7_4 = function(array_data) {
        var chart = AmCharts.makeChart("phase_total_amchart", {
            "type": "pie",
            "theme": "light",
            "fontFamily": 'Open Sans',
            "color":    '#888',
            "dataProvider": array_data,
            "valueField": "sum",
            "titleField": "title",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                    icon: '/lib/3/images/export.png',
                    format: 'png'
                }]
            }
        });

        $('#phase_total_amchart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }
    var initChartSample5 = function(data_array) {
        var chart = AmCharts.makeChart("monthly_chart", {
            "theme": "light",
            "type": "serial",
            "startDuration": 2,

            "fontFamily": 'Open Sans',
            
            "color":    '#888',

            "dataProvider": data_array,
            "valueAxes": [{
                "position": "left",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "colorField": "color",
                "fillAlphas": 0.85,
                "lineAlpha": 0.1,
                "type": "column",
                "topRadius": 1,
                "valueField": "sum"
            }],
            "depth3D": 40,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "project_number",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0

            },
            "exportConfig": {
                "menuTop": "20px",
                "menuRight": "20px",
                "menuItems": [{
                    "icon": '/lib/3/images/export.png',
                    "format": 'png'
                }]
            }
        }, 0);

        jQuery('.monthly_chart_chart_input').off().on('input change', function() {
            var property = jQuery(this).data('property');
            var target = chart;
            chart.startDuration = 0;

            if (property == 'topRadius') {
                target = chart.graphs[0];
            }

            target[property] = this.value;
            chart.validateNow();
        });

        $('#monthly_chart').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }   
</script>

@endsection