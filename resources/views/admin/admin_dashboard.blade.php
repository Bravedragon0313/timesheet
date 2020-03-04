@extends('layouts.admin_layouts.admin_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <br><br>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="{{ $total_projects }}">0</span>
                                    </h3>
                                    <small>TOTAL PROJECTS</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-pie-chart"></i>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-red-haze">
                                        <span data-counter="counterup" data-value="{{ $total_employees }}">0</span>
                                    </h3>
                                    <small>TOTAL EMPLOYEES</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-like"></i>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN CHART PORTLET-->
                    
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-haze"></i>
                                <span class="caption-subject bold uppercase font-green-haze"> Spent Time per Project</span>
                            </div>
                            <div class="tools">
                                <button class="btn btn-success" id="prev"> PREV </button> &nbsp
                                <span id="page_num"> 1 </span>
                                &nbsp<button class="btn btn-success" id="next">NEXT  </button>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                            <!-- <div id="monthly_chart" class="chart" style="height: 400px;"> </div>
                            <div class="well margin-top-20">
                                <div class="row">
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
                            </div> -->
                        </div>
                    </div>
                    <!-- END CHART PORTLET-->
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Project List</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-sm table-bordered table-hover table-checkable order-column" id="sample_4">
                            <thead>
                                <tr>
                                    <th> Number </th>
                                    <th> Name </th>
                                    <th> Total Hrs </th>
                                    <th> Worked Hrs </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($project_lists as $project_list)
                                    <tr class="project_list" id="{{ $project_list->project_id }}">
                                        <td>{{ $project_list->project_number }}</td>
                                        <td>{{ $project_list->project_name }}</td>
                                        <td>{{ $project_list->project_totalhrs }}</td>
                                        <td>{{ $project_list->sum }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        <div class="" id="project_details"></div>
                        <div id="example_amchart" class="CSSAnimationChart"></div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Employee List</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> FullName </th>
                                    <th> Rate </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee_lists as $employee_list)
                                    <tr class="employee_list" id="{{ $employee_list->id }}">
                                        <td>{{ $employee_list->id }}</td>
                                        <td>{{ $employee_list->fullname }}</td>
                                        <td>{{ $employee_list->rates }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END QUICK SIDEBAR -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    var data_array_total = [];
    var data_array_worked = [];
    var page_num = 0;
    $(document).ready(function(){
        var label = document.getElementById('page_num');
        $(".project_list").click(function(e){
            e.preventDefault();
            project_number=$(this).children().eq(0).html();
            project_name=$(this).children().eq(1).html();
            console.log($(this).attr("id"));
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
                    if(data.total_hours>0){
                        content_data.push({'fullname':"Empty",'sum':data.total_hours});
                        initChartSample7(data.content);
                    }
                    $("#project_details").html("<label>"+project_number+":"+ project_name + "</label>")
                }
            });
        }

        

        
        // initChartSample5();
        project_spenttime_load();
        function project_spenttime_load () {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/dashboard/project_spenttime_load',
                data: {temp: "asdfasfd"},
                success: function(data) {
                    data_array_total = data.total;
                    data_array_worked = data.worked;
                    chartDraw(data_array_total,data_array_worked, 0, 5);
                }
            });
        }
        $("#next").click(function(){
            var total_page = Math.round(data_array_total.length / 5);
            page_num ++;
            
            if(page_num > total_page){
                page_num = total_page;
            }
            label.textContent = page_num+1;
            var start = page_num * 5;
            var end = (page_num + 1) * 5;
            chartDraw(data_array_total, data_array_worked, start, end);

        });
        $("#prev").click(function(){
            page_num --;

            if(page_num < 0){
                page_num = 0;
            }
            label.textContent = page_num+1;
            var start = page_num * 5;
            var end = (page_num + 1) * 5;
            chartDraw(data_array_total, data_array_worked, start, end);

        });
        
    });
    var chartDraw = function(total, worked, start, end){
        var arr_total = [];
        var arr_work = [];
        var max_value = 0;
        var j = 0;
        for(var i=start; i<end; i++){
            if(i >= data_array_total.length) break;
            if(max_value < data_array_total[i].y) max_value = data_array_total[i].y;
            if(max_value < data_array_worked[i].y) max_value = data_array_worked[i].y;
            arr_total[j] = data_array_total[i];
            arr_work[j]  = data_array_worked[i];            
            j++;
        }
        if(max_value > 100 && max_value < 1000){
            max_value = Math.ceil(max_value/100) * 100;
        }
        if(max_value > 1000 && max_value < 10000){
            max_value = Math.ceil(max_value/1000) * 1000;
        }
        if(max_value > 10000 && max_value < 100000){
            max_value = Math.ceil(max_value/10000) * 10000;
        }
        initChartSample5(arr_total, arr_work, max_value);
    }
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
    var initChartSample5 = function(total, work, max_val) {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,  
            axisY: {
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC",
                maximum: max_val
            },
            axisY2: {
                titleFontColor: "#C0504E",
                lineColor: "#C0504E",
                labelFontColor: "#C0504E",
                tickColor: "#C0504E",
                maximum: max_val
            },  
            toolTip: {
                shared: true
            },
            legend: {
                cursor:"pointer",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "Total:",
                legendText: "Total Hours",
                showInLegend: true, 
                dataPoints:total
            },
            {
                type: "column", 
                name: "Worked:",
                legendText: "Worked Hours",
                axisYType: "secondary",
                showInLegend: true,
                dataPoints:work
            }]
        });
        chart.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }
    }
</script>
@endsection