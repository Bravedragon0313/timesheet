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
<link href="{{ asset('css/calendarview.css') }}" rel="stylesheet" type="text/css" />
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:600);

.box {
  font-family:'Open Sans';
  text-align:center;
  color:#0084A8;
  font-size: 24px;
  box-sizing: border-box;
  height: 100%;
  width: 100%;
  background-color: #F89C48;
  transition: all .3s linear;
  -webkit-transform: translateY(0) scale(0.9, 0.9);
}

.box:hover {
  box-shadow: 0 15px 20px rgba(0,0,0,0.5);
  transform: translateY(-10px) scale(1, 1);
  -webkit-transform: translateY(-10px) scale(1, 1);
}
  body {
    font-family: Trebuchet MS;
  }
  .white-color{
      color:white !important;
  }
  .widget-bg-color-white{
      background-color:#00b393
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
    margin-left: 30px;
  }
 
#selectBox {
    display: none;
} 
#clock {
}

#clock:hover {
  box-shadow: 30px;
  cursor: pointer;
}
#clock1 {
}

#clock1:hover {
  box-shadow: 30px;
  cursor: pointer;
}
#clock2 {
}

#clock2:hover {
  box-shadow: 30px;
  cursor: pointer;
}

</style>
<div class="page-content" style="background-color: white !important;">
    <br><br><br>
    <div class="row">
        <br>
        <div style="text-align:center">
        <div class="col-md-4 col-sm-4"  style="text-align: center; height: 20em;">
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
        <div class="col-md-4 col-sm-4" style="text-align: center; height: 20em;">
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
        <div class="col-md-4 col-sm-4" style="text-align: center; height: 20em;">
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
        
                  
    </div>
    <br />
    <div class="row">
        <div class="col-md-4 ">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/clock.jpg" style="width:140px; height:100px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                                <span class="white-color widget-thumb-body-stat" data-counter="counterup" data-value="{{ $total_hours }}">0</span>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Total Hours(current month)</h4>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/clock.jpg" style="width:140px; height:100px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                                <span class="white-color widget-thumb-body-stat" data-counter="counterup" data-value="{{ $worked_hours }}">0</span>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Worked Hours(all months)</h4>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box" style="background-color:rgb(238,107,115)">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/overtime.png" style="width:120px; height:100px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                                <span class="white-color widget-thumb-body-stat" data-counter="counterup" data-value="{{ $overtime_hrs_total<0? 0: $overtime_hrs_total }}">0</span>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Overtime Hrs.</h4>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/clock.jpg" style="width:140px; height:100px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                                <span class="white-color widget-thumb-body-stat" data-counter="counterup" data-value="{{ $othertime_hours }}">0</span>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Sick/Annual/Leave Hrs.</h4>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/clock.jpg" style="width:140px; height:100px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                                <span class="white-color widget-thumb-body-stat" data-counter="counterup" data-value="{{ 187 - $othertime_hours }}">0</span>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Remaining vacation Hrs.</h4>
                    </div>
                </div>
            </div>
            </div>
            <!-- END WIDGET THUMB -->
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered box" style="background-color: rgb(59,168,212)">
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/task.png" style="width:140px; height:120px">
                    </div>
                    <div class="col-md-8" style="margin-top:15px">
                        <div class="widget-thumb-wrap" style="margin-bottom:10px">
                            <div class="widget-thumb-body">
                            <span class="white-color widget-thumb-subtitle">&nbsp</span>
                        <a href="{!! url('/task_view'); !!}" class="white-color" style="font-size:25px"> CLICK ME FOR VIEW </a>
                            </div>
                        </div>
                        <h4 class="white-color widget-thumb-heading">Tasks of Everybody</h4>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>
        <div class="row" style="justify-content: space-between; display:flex">
            <div  style="width: 35%; padding:15px; margin-left:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
            <div class="width: 55%; col-md-7 col-sm-6" style="padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
        <div class="row" style="margin-top:20px; justify-content: space-between; display:flex">
            <div  style="width: 35%; padding:15px; margin-left:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">Disciplines Totals</span>
                            
                        </div>
                    </div>
                    <div class="portlet-body table-both-scroll ">
                        <div class="row" style="height: 500px; overflow-y: scroll;">
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
            <div class="width: 55%; col-md-7 col-sm-6" style="padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
        <div class="row" style="margin-top:20px; justify-content: space-between; display:flex">
            <div  style="width: 35%; padding:15px; margin-left:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">Phase per Project</span>
                            
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
            <div class="width: 55%; col-md-7 col-sm-6" style="padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
        <div class="row" style="margin-top:20px; justify-content: space-between; display:flex">
            <div  style="width: 35%; padding:15px; margin-left:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">Phase Totals</span>
                            
                        </div>
                    </div>
                    <div class="portlet-body table-both-scroll ">
                        <div class="row" style="height: 500px; overflow-y: scroll;">
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
            <div class="width: 55%; col-md-7 col-sm-6" style="padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
        <div class="row" style="margin-top:20px; justify-content: space-between; display:flex">
            <div  style="width: 35%; padding:15px; margin-left:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">Employee List</span>
                            
                        </div>
                    </div>
                    <div class="portlet-body table-both-scroll ">
                        <div class="row" style="height: 500px; overflow-y: scroll;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%"> ID </th>
                                        <th width="15%"> Employee Name </th>
                                        <th width="10%"> Employee Rate </th>
                                        {{-- <th width="20%"> % </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result_datas as $result_data)
                                        <tr class="employee_list" id="{{ $result_data->id }}">
                                            <td>{{ $result_data->id }}</td>
                                            <td>{{ $result_data->fullname }}</td>
                                            <td>{{ $result_data->rates }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="width: 55%; col-md-7 col-sm-6" style="padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                                
                            <i class="icon-bar-chart font-green-haze"></i>
                            
                            <span class="caption-subject bold uppercase font-green-haze"> Spent Time per Project</span>
                        </div>
                        <div class="tools">
                            <div class="" id="employee_details"></div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        
                        <div id="monthly_chart" class="chart" style="height: 400px;"> </div>
                        <div class="well margin-top-20">
                            <div class="row" >
                                <div class="col-sm-3">
                                    <label class="text-left">Top Radius:</label>
                                    <input class="monthly_chart_chart_input" data-property="topRadius" type="range" min="0" max="1.5" value="1" step="0.01" /> </div>
                                <div class="col-sm-3">
                                    <label class="text-left">Angle:</label>
                                    <input class="monthly_chart_chart_input" data-property="angle" type="range" min="0" max="89" value="30" step="1" /> </div>
                                <div class="col-sm-3">
                                    <label class="text-left">Depth:</label>
                                    <input class="monthly_chart_chart_input" data-property="depth3D" type="range" min="1" max="120" value="40" step="1" /> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CHART PORTLET-->
            </div>
        </div>
        <div class="row" style="margin-top:20px; justify-content: space-between; display:flex">
            <div  style="width: 40%; padding:15px; margin-left:45px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">Projects List</span>
                            
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
                                        <th width="10%"> Worked Hrs. </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result_projects as $result_project)
                                        <tr class="project_list" id="{{ $result_project->project_id }}">
                                            <td>{{ $result_project->project_number }}</td>
                                            <td>{{ $result_project->project_name }}</td>
                                            <td>{{ $result_project->project_totalhrs }}</td>
                                            <td>{{ $result_project->sum }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                
            </div>
            <div  style="width: 38%; padding:15px; margin-right:30px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
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
            <div  style="width: 38%; padding:15px; margin-right:45px; background-color:rgb(220,222,222) ; border-radius:10px !important;">
                <div class="portlet light bordered" >
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
<<<<<<< HEAD
    </div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="/js/calendarview.js"></script>
<script type="text/javascript" src="/js/clock.js"></script>
=======
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/calendarview.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/clock.js') }}"></script>
>>>>>>> 2c28f7be8dc11a668cd4de60f76e2e1126a57b7d
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
                url: '/projectmanager_dashboard/project_amchart_content',
                data: {project_id: project_id},
                success: function(data) {
                    var content_data=data.content;
                    var extra_data;
                    if(data.total_hours>=0){
                        content_data.push({'fullname':"Empty",'sum':data.total_hours});
                        initChartSample7(content_data);
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
    let el = document.getElementById('clock')

/* Get the height and width of the element */
const height = el.clientHeight
const width = el.clientWidth

/*
  * Add a listener for mousemove event
  * Which will trigger function 'handleMove'
  * On mousemove
  */
el.addEventListener('mousemove', handleMove)

/* Define function a */
function handleMove(e) {
  /*
    * Get position of mouse cursor
    * With respect to the element
    * On mouseover
    */
  /* Store the x position */
  const xVal = e.layerX
  /* Store the y position */
  const yVal = e.layerY
  
  /*
    * Calculate rotation valuee along the Y-axis
    * Here the multiplier 20 is to
    * Control the rotation
    * You can change the value and see the results
  */
  const yRotation = 20 * ((xVal - width / 2) / width)
  
  /* Calculate the rotation along the X-axis */
  const xRotation = -20 * ((yVal - height / 2) / height)
  
  /* Generate string for CSS transform property */
  const string = 'perspective(500px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'
  
  /* Apply the calculated transformation */
  el.style.transform = string
}



let el1 = document.getElementById('clock1')

/* Get the height and width of the element */
const height1 = el1.clientHeight
const width1 = el1.clientWidth

/*
  * Add a listener for mousemove event
  * Which will trigger function 'handleMove'
  * On mousemove
  */
el1.addEventListener('mousemove', handleMove1)

/* Define function a */
function handleMove1(e) {
  /*
    * Get position of mouse cursor
    * With respect to the element
    * On mouseover
    */
  /* Store the x position */
  const xVal1 = e.layerX
  /* Store the y position */
  const yVal1 = e.layerY
  
  /*
    * Calculate rotation valuee along the Y-axis
    * Here the multiplier 20 is to
    * Control the rotation
    * You can change the value and see the results
  */
  const yRotation1 = 20 * ((xVal1 - width1 / 2) / width1)
  
  /* Calculate the rotation along the X-axis */
  const xRotation1 = -20 * ((yVal1 - height1 / 2) / height1)
  
  /* Generate string for CSS transform property */
  const string1 = 'perspective(500px) scale(1.1) rotateX(' + xRotation1 + 'deg) rotateY(' + yRotation1 + 'deg)'
  
  /* Apply the calculated transformation */
  el1.style.transform = string1
}


let el2 = document.getElementById('clock2')

/* Get the height and width of the element */
const height2 = el2.clientHeight
const width2 = el2.clientWidth

/*
  * Add a listener for mousemove event
  * Which will trigger function 'handleMove'
  * On mousemove
  */
el2.addEventListener('mousemove', handleMove2)

/* Define function a */
function handleMove2(e) {
  /*
    * Get position of mouse cursor
    * With respect to the element
    * On mouseover
    */
  /* Store the x position */
  const xVal1 = e.layerX
  /* Store the y position */
  const yVal1 = e.layerY
  
  /*
    * Calculate rotation valuee along the Y-axis
    * Here the multiplier 20 is to
    * Control the rotation
    * You can change the value and see the results
  */
  const yRotation1 = 20 * ((xVal1 - width1 / 2) / width1)
  
  /* Calculate the rotation along the X-axis */
  const xRotation1 = -20 * ((yVal1 - height1 / 2) / height1)
  
  /* Generate string for CSS transform property */
  const string1 = 'perspective(500px) scale(1.1) rotateX(' + xRotation1 + 'deg) rotateY(' + yRotation1 + 'deg)'
  
  /* Apply the calculated transformation */
  el2.style.transform = string1
}

/* Add listener for mouseout event, remove the rotation */
el.addEventListener('mouseout', function() {
  el.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
})

/* Add listener for mousedown event, to simulate click */
el.addEventListener('mousedown', function() {
  el.style.transform = 'perspective(500px) scale(0.9) rotateX(0) rotateY(0)'
})

/* Add listener for mouseup, simulate release of mouse click */
el.addEventListener('mouseup', function() {
  el1.style.transform = 'perspective(500px) scale(1.1) rotateX(0) rotateY(0)'
})

el1.addEventListener('mouseout', function() {
  el1.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
})

/* Add listener for mousedown event, to simulate click */
el1.addEventListener('mousedown', function() {
  el1.style.transform = 'perspective(500px) scale(0.9) rotateX(0) rotateY(0)'
})

/* Add listener for mouseup, simulate release of mouse click */
el1.addEventListener('mouseup', function() {
  el1.style.transform = 'perspective(500px) scale(1.1) rotateX(0) rotateY(0)'
})

el2.addEventListener('mouseout', function() {
  el2.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
})

/* Add listener for mousedown event, to simulate click */
el2.addEventListener('mousedown', function() {
  el2.style.transform = 'perspective(500px) scale(0.9) rotateX(0) rotateY(0)'
})

/* Add listener for mouseup, simulate release of mouse click */
el2.addEventListener('mouseup', function() {
  el2.style.transform = 'perspective(500px) scale(1.1) rotateX(0) rotateY(0)'
})



    
</script>

@endsection