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
                            <span class="caption-subject font-red sbold uppercase">Total Hours per Phases</span>
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10%;"> Phase </th>
                                    <th colspan="13" style="width: 40%;">Total Hours</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%;"> January </th>
                                    <th style="width: 5%;"> February </th>
                                    <th style="width: 5%;"> March </th>
                                    <th style="width: 5%;"> April </th>
                                    <th style="width: 5%;"> May </th>
                                    <th style="width: 5%;"> June </th>
                                    <th style="width: 5%;"> July </th>
                                    <th style="width: 5%;"> August </th>
                                    <th style="width: 5%;"> September </th>
                                    <th style="width: 5%;"> October </th>
                                    <th style="width: 5%;"> November </th>
                                    <th style="width: 5%;"> December </th>
                                    <th style="width: 5%;"> Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_sum_col=array(0,0,0,0,0,0,0,0,0,0,0,0);
                                @endphp
                                @if(count($result_datas)>0)
                                    @foreach($result_datas as $result_data)
                                        @php 
                                            $total_sum=0;
                                        @endphp
                                        <tr>
                                            <td class="center">{{ $result_data->phase_name }}</td>
                                            @for($i=1; $i<13; $i++)
                                                @if($result_data->month_val==$i)
                                                    <td class="center">{{ $result_data->sum }}</td>
                                                    @php 
                                                        $total_sum+=$result_data->sum;
                                                        $total_sum_col[$i-1]+=$result_data->sum;
                                                    @endphp
                                                @else
                                                    <td class="center"></td>
                                                @endif
                                            @endfor
                                            <td class="center">{{ $total_sum }}</td>
                                        </tr>
                                    @endforeach
                                    @php 
                                        $total_sum=0;
                                    @endphp
                                    <tr>
                                        <td class="center">Total</td>
                                        @foreach ($total_sum_col as $value)
                                            <td class="center">{{$value}}</td>
                                            @php 
                                                $total_sum+=$value;
                                            @endphp
                                        @endforeach
                                        <td class="center">{{$total_sum}}</td>
                                    </tr>
                                @endif
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