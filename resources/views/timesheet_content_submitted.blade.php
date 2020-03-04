<style>
tr, th, td {
    vertical-align: -webkit-baseline-middle !important;
    border: 1px solid gray;
    font-size: 11px !important;
}
#timesheet_caption_process {
    background: yellow !important;
    color: black!important;
}
#timesheet_caption_process .text-right{
    margin-left: 200px!important;
    color: black!important;
}
#timesheet_caption_approve {
    background: green!important;
    color: white!important;
}
#timesheet_caption_approve .text-right{
    margin-left: 200px!important;
    color: white!important;
}
#timesheet_caption_reject {
    background: red !important;
    color: black!important;
}
#timesheet_caption_reject .text-right{
    margin-left: 200px!important;
    color: white!important;
}
</style>
<div class="row">
    <br>
    <p>
    @if($status === 0)
    <div class="sheet_caption" style="border" id="timesheet_caption_process">
        <strong> {{ $month_text }} </strong>
        <strong class="text-right">This Timesheet is processing now....</strong>
    </div>
    @elseif($status === 1)
    <div class="sheet_caption" style="border" id="timesheet_caption_approve">
        <strong> {{ $month_text }}</strong>
        <strong class="text-right"> This Timesheet was approved.</strong>
    </div>
    @else
    <div class="sheet_caption" style="border" id="timesheet_caption_reject">
        <strong> {{ $month_text }} </strong>
        <strong class="text-right"> This Timesheet was rejected. Please Try Again.</strong>
    </div>
    @endif
    </p>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 col-xs-12 mobile-mb-15" style="text-align: center;">
            <h4><i class="icon-plus"></i> <span id="">Department</span></h4>
            <span id="C_C_C_W_lblTimesheetTotal" class="sale-num lblTimesheetTotal" style="float: none !important;">{{ $department }}</span>
        </div>
        <div class="col-md-3 col-xs-12 mobile-mb-15" style="text-align: center;">
            <h4><i class="icon-user"></i> <span id="">Employee Name</span></h4>
            <span id="C_C_C_W_lblTimesheetTotal" class="sale-num lblTimesheetTotal" style="float: none !important;">{{ $user_name }}</span>
        </div>
        <div class="col-md-3 col-xs-12 mobile-mb-15" style="text-align: center;">
            <h4><i class="icon-plus"></i> <span id="">Employee Number</span></h4>
            <span id="C_C_C_W_lblTimesheetTotal" class="sale-num lblTimesheetTotal" style="float: none !important;">{{ $user_id }}</span>
        </div>
        <div class="col-md-3 col-xs-12 mobile-mb-15" style="text-align: center;">
            <h4><i class="icon-plus"></i> <span id="">Timesheet Total</span></h4>
            <span id="TimesheetTotal" class="sale-num lblTimesheetTotal" style="float: none !important;">00:00</span>
        </div>
    </div>
    
    <div class="row" style="margin-top:1%">
        <table class="table-striped table-hover col-md-12" id="regular_time_table" name="data-tables">
            <thead>
                
                <tr><th colspan="16"><input type="button" class="btn_style_head" value="WeekEnding" /></th></tr>
                <tr>
                    <th rowspan="2" width="10%"><input type="button" class="btn_style_head" value="PROJECT NAME" /></th>
                    <th colspan="7"><input type="button" class="btn_style_head" value=" " /></th>
                    <th><input type="button" class="btn_style_head" value="FRI" /></th>
                    <th><input type="button" class="btn_style_head" value="SAT" /></th>
                    <th><input type="button" class="btn_style_head" value="SUN" /></th>
                    <th><input type="button" class="btn_style_head" value="MON" /></th>
                    <th><input type="button" class="btn_style_head" value="TUE" /></th>
                    <th><input type="button" class="btn_style_head" value="WEN" /></th>
                    <th><input type="button" class="btn_style_head" value="THU" /></th>
                    <th scope="row" rowspan="2">Project Total</th>
                </tr>
                <tr>
                    <th><input type="button" class="btn_style_head" value="Proj. No." /></th>
                    <th colspan="2"><input type="button" class="btn_style_head" value="Discipline" /></th>
                    <th colspan="2"><input type="button" class="btn_style_head" value="Phase" /></th>
                    <th colspan="2"><input type="button" class="btn_style_head" value="Resource Type" /></th>
                    @foreach ($days_array as $item)
                        <th><input type="button" class="btn_style_head" value="{{$item}}" /></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @if(count($regulartime_datas)>0)
                    @foreach($regulartime_datas as $regulartime_data)
                        <tr>
                        <td width='10%'>{{ $regulartime_data->project_name }}</td>
                        <td width='6%'>
                            <select class='project_num' name='project_num[]'>
                                <option value=''></option>
                                @foreach($project_lists as $project_list)
                                <option value="{{ $project_list->project_id }}" id="{{ $project_list->project_name }}" {{ $regulartime_data->project_id==$project_list->project_id ? 'selected' : '' }}>{{ $project_list->project_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'>
                            <select class='discipline_num' name='discipline_num[]'>
                                <option value=''></option>
                                @foreach($disciplines as $discipline)
                                <option {{ $regulartime_data->discipline_id==$discipline->discipline_id ? 'selected' : '' }} value="{{ $discipline->discipline_id }}" id="{{ $discipline->discipline_type }}">{{ $discipline->discipline_number }}
                                @endforeach
                            </select></td>
                        <td width='6%'>{{ $regulartime_data->discipline_type }}</td>
                        <td width='6%'>
                            <select class='phase_num' name='phase_num[]'>
                                <option value=''></option>
                                @foreach($phases as $phase)
                                <option {{ $regulartime_data->phase_id==$phase->phase_id ? 'selected' : '' }} value="{{ $phase->phase_id }}" id="{{ $phase->phase_name }}">{{ $phase->phase_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'>{{ $regulartime_data->phase_name }}</td>
                        <td width='6%'>
                            <select class='resource_num' name='resource_num[]'>
                                <option value=''></option>
                                @foreach($resources as $resource)
                                <option {{ $regulartime_data->resource_id==$resource->resource_id ? 'selected' : '' }} value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'>{{ $regulartime_data->resource_type }}</td>
                        <td width='4%' style="background: #00000061;"><input type='hidden' name='timevalue1[]' class="regular_time_val-{{ $i }}-0" onchange="sum_row(this)" value='{{ $regulartime_data->time_value1 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue2[]' class="regular_time_val-{{ $i }}-1" onchange="sum_row(this)" value='{{ $regulartime_data->time_value2 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue3[]' class="regular_time_val-{{ $i }}-2" onchange="sum_row(this)" value='{{ $regulartime_data->time_value3 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue4[]' class="regular_time_val-{{ $i }}-3" onchange="sum_row(this)" value='{{ $regulartime_data->time_value4 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue5[]' class="regular_time_val-{{ $i }}-4" onchange="sum_row(this)" value='{{ $regulartime_data->time_value5 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue6[]' class="regular_time_val-{{ $i }}-5" onchange="sum_row(this)" value='{{ $regulartime_data->time_value6 }}'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue7[]' class="regular_time_val-{{ $i }}-6" onchange="sum_row(this)" value='{{ $regulartime_data->time_value7 }}'></td>
                        <td  width='5%'><input type='number' min="0" name='regular_sum_row[]' class="regular_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                        <td  width='5%' style="display:none;"></td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                @endif
                @for($i=count($regulartime_datas); $i < 8; $i++)
                    <tr>
                        <td width='10%'></td>
                        <td width='6%'>
                            <select class='project_num' name='project_num[]'>
                                <option value=''></option>
                                @foreach($project_lists as $project_list)
                                <option value="{{ $project_list->project_id }}" id="{{ $project_list->project_name }}">{{ $project_list->project_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'>
                            <select class='discipline_num' name='discipline_num[]'>
                                <option value=''></option>
                                @foreach($disciplines as $discipline)
                                <option value="{{ $discipline->discipline_id }}" id="{{ $discipline->discipline_type }}">{{ $discipline->discipline_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'></td>
                        <td width='6%'>
                            <select class='phase_num' name='phase_num[]'>
                                <option value=''></option>
                                @foreach($phases as $phase)
                                <option value="{{ $phase->phase_id }}" id="{{ $phase->phase_name }}">{{ $phase->phase_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'></td>
                        <td width='6%'>
                            <select class='resource_num' name='resource_num[]'>
                                <option value=''></option>
                                @foreach($resources as $resource)
                                <option value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'></td>
                        <td width='4%' style="background: #00000061;"><input type='hidden' name='timevalue1[]' class="regular_time_val-{{ $i }}-0" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue2[]' class="regular_time_val-{{ $i }}-1" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue3[]' class="regular_time_val-{{ $i }}-2" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue4[]' class="regular_time_val-{{ $i }}-3" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue5[]' class="regular_time_val-{{ $i }}-4" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue6[]' class="regular_time_val-{{ $i }}-5" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue7[]' class="regular_time_val-{{ $i }}-6" onchange="sum_row(this)"></td>
                        <td width='5%'><input type='number' min="0" name='regular_sum_row[]' class="regular_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                        <td width='5%' style="display:none;"></td>
                    </tr>
                @endfor
                <tr id='regular_sum_col'>
                    <td colspan='8'>Regular Time total</td>
                    <td class="regular_sum_col-0" width='4%'></td>
                    <td class="regular_sum_col-1" width='4%'></td>
                    <td class="regular_sum_col-2" width='4%'></td>
                    <td class="regular_sum_col-3" width='4%'></td>
                    <td class="regular_sum_col-4" width='4%'></td>
                    <td class="regular_sum_col-5" width='4%'></td>
                    <td class="regular_sum_col-6" width='4%'></td>
                    <td class="regular_sum" width='5%'></td>
                    <td width='5%' style="border-color: #ffffff; background-color: white;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="margin-top:2%;">
        <table class="table-striped table-hover over_time_table col-md-12" id="over_time_table">
            <thead class="thead-light">
                <tr><th colspan="16"><input type="button" class="btn_style_head" value="Overtime Hours" /></th></tr>
            </thead>
            <tbody>
            @php
                $i=0;
            @endphp
            @if(count($overtime_datas)>0)
                @foreach($overtime_datas as $overtime_data)
                    <tr name="regular_sheet">
                    <td width='10%'>{{ $overtime_data->project_name }}</td>
                    <td width='6%'>
                        <select class='project_num' name='project_num[]'>
                            <option value=''></option>
                            @foreach($project_lists as $project_list)
                            <option value="{{ $project_list->project_id }}" id="{{ $project_list->project_name }}" {{ $overtime_data->project_id==$project_list->project_id ? 'selected' : '' }}>{{ $project_list->project_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'>
                        <select class='discipline_num' name='discipline_num[]'>
                            <option value=''></option>
                            @foreach($disciplines as $discipline)
                            <option {{ $overtime_data->discipline_id==$discipline->discipline_id ? 'selected' : '' }} value="{{ $discipline->discipline_id }}" id="{{ $discipline->discipline_type }}">{{ $discipline->discipline_number }}
                            @endforeach
                        </select></td>
                    <td width='6%'>{{ $overtime_data->discipline_type }}</td>
                    <td width='6%'>
                        <select class='phase_num' name='phase_num[]'>
                            <option value=''></option>
                            @foreach($phases as $phase)
                            <option {{ $overtime_data->phase_id==$phase->phase_id ? 'selected' : '' }} value="{{ $phase->phase_id }}" id="{{ $phase->phase_name }}">{{ $phase->phase_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'>{{ $overtime_data->phase_name }}</td>
                    <td width='6%'>
                        <select class='resource_num' name='resource_num[]'>
                            <option value=''></option>
                            @foreach($resources as $resource)
                            <option {{ $overtime_data->resource_id==$resource->resource_id ? 'selected' : '' }} value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'>{{ $overtime_data->resource_type }}</td>
                    <td width='4%'><input type='number' min="0" name='timevalue1[]' class="over_time_val-{{ $i }}-0" onchange="sum_row(this)" value='{{ $overtime_data->time_value1 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue2[]' class="over_time_val-{{ $i }}-1" onchange="sum_row(this)" value='{{ $overtime_data->time_value2 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue3[]' class="over_time_val-{{ $i }}-2" onchange="sum_row(this)" value='{{ $overtime_data->time_value3 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue4[]' class="over_time_val-{{ $i }}-3" onchange="sum_row(this)" value='{{ $overtime_data->time_value4 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue5[]' class="over_time_val-{{ $i }}-4" onchange="sum_row(this)" value='{{ $overtime_data->time_value5 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue6[]' class="over_time_val-{{ $i }}-5" onchange="sum_row(this)" value='{{ $overtime_data->time_value6 }}'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue7[]' class="over_time_val-{{ $i }}-6" onchange="sum_row(this)" value='{{ $overtime_data->time_value7 }}'></td>
                    <td width='5%'><input type='number' min="0" name='over_sum_row[]' class="over_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                    @if($i==3)
                        <td width='5%' rowspan="2">Overtime Total</td>
                    @endif
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            @endif
            @for($i=count($overtime_datas); $i < 5; $i++)
                <tr>
                    <td width='10%'></td>
                    <td width='6%'>
                        <select class='project_num' name='project_num[]'>
                            <option value=''></option>
                            @foreach($project_lists as $project_list)
                            <option value="{{ $project_list->project_id }}" id="{{ $project_list->project_name }}">{{ $project_list->project_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'>
                        <select class='discipline_num' name='discipline_num[]'>
                            <option value=''></option>
                            @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->discipline_id }}" id="{{ $discipline->discipline_type }}">{{ $discipline->discipline_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'></td>
                    <td width='6%'>
                        <select class='phase_num' name='phase_num[]'>
                            <option value=''></option>
                            @foreach($phases as $phase)
                            <option value="{{ $phase->phase_id }}" id="{{ $phase->phase_name }}">{{ $phase->phase_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'></td>
                    <td width='6%'>
                        <select class='resource_num' name='resource_num[]'>
                            <option value=''></option>
                            @foreach($resources as $resource)
                            <option value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                            @endforeach
                        </select></td>
                    <td width='6%'></td>
                    <td width='4%'><input type='number' min="0" name='timevalue1[]' class="over_time_val-{{ $i }}-0" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue2[]' class="over_time_val-{{ $i }}-1" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue3[]' class="over_time_val-{{ $i }}-2" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue4[]' class="over_time_val-{{ $i }}-3" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue5[]' class="over_time_val-{{ $i }}-4" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue6[]' class="over_time_val-{{ $i }}-5" onchange="sum_row(this)" ></td>
                    <td width='4%'><input type='number' min="0" name='timevalue7[]' class="over_time_val-{{ $i }}-6" onchange="sum_row(this)" ></td>
                    <td width='5%'><input type='number' name='over_sum_row[]' class="over_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                    @if($i==3)
                        <td width='5%' rowspan="2">Overtime Total</td>
                    @endif
                </tr>
            @endfor
                <tr id='sum_overtime'>
                    <td colspan='8'>OverTime total</td>
                    <td class="over_sum_col-0" width='4%'></td>
                    <td class="over_sum_col-1" width='4%'></td>
                    <td class="over_sum_col-2" width='4%'></td>
                    <td class="over_sum_col-3" width='4%'></td>
                    <td class="over_sum_col-4" width='4%'></td>
                    <td class="over_sum_col-5" width='4%'></td>
                    <td class="over_sum_col-6" width='4%'></td>
                    <td class="over_sum" width='5%'></td>
                    <td class="overtime_total" width='5%'></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row" style="margin-top:2%">
        <table class="table-striped other_time_table col-md-12" id="other_time_table">
            <tbody>
                @php
                    $other_project=["Administration","Annual Leave","Sick/Maternity Leave","Leave without pay","Public                          Holiday","Marketing/Business Development","Bids/Proposals"];
                    $other_project_no=["910-00","920-01","920-02","920-03","930-00","940-00","950-00"];
                    $i=0;
                    $pos=13;
                    $current=0;
                @endphp
                @if(count($othertime_datas)>0)
                    @foreach($othertime_datas as $othertime_data)
                        @if($i == ($othertime_data->orderby_id-13))
                            <tr>
                                <td width='10%'> {{ $other_project[$i] }}</td>
                                <td width='6%'> {{ $other_project_no[$i] }}</td>
                            @if($i==0)
                                <td colspan=4 rowspan=7 width='24%'></td>
                            @endif
                                <td width='6%'>
                                    <select class='resource_num' name='resource_num[]'>
                                        <option value=''></option>
                                        @foreach($resources as $resource)
                                        <option {{ $othertime_data->resource_id==$resource->resource_id ? 'selected' : '' }} value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                        @endforeach
                                    </select></td>
                                <td width='6%'>{{ $othertime_data->resource_type }}</td>
                                <td width='4%'><input type='number' min="0" name='timevalue1[]' class="other_time_val-{{ $i }}-0" onchange="sum_row(this)" value='{{ $othertime_data->time_value1 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue2[]' class="other_time_val-{{ $i }}-1" onchange="sum_row(this)" value='{{ $othertime_data->time_value2 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue3[]' class="other_time_val-{{ $i }}-2" onchange="sum_row(this)" value='{{ $othertime_data->time_value3 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue4[]' class="other_time_val-{{ $i }}-3" onchange="sum_row(this)" value='{{ $othertime_data->time_value4 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue5[]' class="other_time_val-{{ $i }}-4" onchange="sum_row(this)" value='{{ $othertime_data->time_value5 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue6[]' class="other_time_val-{{ $i }}-5" onchange="sum_row(this)" value='{{ $othertime_data->time_value6 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue7[]' class="other_time_val-{{ $i }}-6" onchange="sum_row(this)" value='{{ $othertime_data->time_value7 }}'></td>
                                <td width='5%'><input type='number' min="0" name='other_sum_row[]' class="other_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                                <td width='5%' style="display:none;"></td>
                            </tr>
                        @else
                            @for($pos=$current; $pos < ($othertime_data->orderby_id-13); $pos++, $current++)
                            <tr>
                                <td width='10%'> {{ $other_project[$pos] }}</td>
                                <td width='6%'> {{ $other_project_no[$pos] }}</td>
                            @if($pos==0)
                                <td colspan=4 rowspan=7 width='24%'></td>
                            @endif 
                                <td width='6%'>
                                    <select class='resource_num' name='resource_num[]'>
                                        <option value=''></option>
                                        @foreach($resources as $resource)
                                        <option value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                        @endforeach
                                    </select></td>
                                <td width='6%'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue1[]' class="other_time_val-{{ $pos }}-0" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue2[]' class="other_time_val-{{ $pos }}-1" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue3[]' class="other_time_val-{{ $pos }}-2" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue4[]' class="other_time_val-{{ $pos }}-3" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue5[]' class="other_time_val-{{ $pos }}-4" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue6[]' class="other_time_val-{{ $pos }}-5" onchange="sum_row(this)"></td>
                                <td width='4%'><input type='number' min="0" name='timevalue7[]' class="other_time_val-{{ $pos }}-6" onchange="sum_row(this)"></td>
                                <td width='5%'><input type='number' name='other_sum_row[]' class="other_sum_row-{{ $pos }}" style='width: 100%;height: 100%;' readonly></td>
                                <td width='5%' style="display:none;"></td>
                            </tr>
                            @endfor
                            <tr>
                                <td width='10%'> {{ $other_project[$pos] }}</td>
                                <td width='6%'> {{ $other_project_no[$pos] }}</td>
                            @if($pos==0)
                                <td colspan=4 rowspan=7 width='24%'></td>
                            @endif
                                <td width='6%'>
                                    <select class='resource_num' name='resource_num[]'>
                                        <option value=''></option>
                                        @foreach($resources as $resource)
                                        <option {{ $othertime_data->resource_id==$resource->resource_id ? 'selected' : '' }} value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                        @endforeach
                                    </select></td>
                                <td width='6%'>{{ $othertime_data->resource_type }}</td>
                                <td width='4%'><input type='number' min="0" name='timevalue1[]' class="other_time_val-{{ $pos }}-0" onchange="sum_row(this)" value='{{ $othertime_data->time_value1 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue2[]' class="other_time_val-{{ $pos }}-1" onchange="sum_row(this)" value='{{ $othertime_data->time_value2 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue3[]' class="other_time_val-{{ $pos }}-2" onchange="sum_row(this)" value='{{ $othertime_data->time_value3 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue4[]' class="other_time_val-{{ $pos }}-3" onchange="sum_row(this)" value='{{ $othertime_data->time_value4 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue5[]' class="other_time_val-{{ $pos }}-4" onchange="sum_row(this)" value='{{ $othertime_data->time_value5 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue6[]' class="other_time_val-{{ $pos }}-5" onchange="sum_row(this)" value='{{ $othertime_data->time_value6 }}'></td>
                                <td width='4%'><input type='number' min="0" name='timevalue7[]' class="other_time_val-{{ $pos }}-6" onchange="sum_row(this)" value='{{ $othertime_data->time_value7 }}'></td>
                                <td width='5%'><input type='number' min="0" name='other_sum_row[]' class="other_sum_row-{{ $pos }}" style='width: 100%;height: 100%;' readonly></td>
                                <td width='5%' style="display:none;"></td>
                            </tr>
                        @endif
                        
                        @php
                            $i++;
                            $current++;
                        @endphp
                    @endforeach
                    @for($i=$current; $i < 7; $i++)
                    <tr>
                        <td width='10%'> {{ $other_project[$i] }}</td>
                        <td width='6%'> {{ $other_project_no[$i] }}</td>
                    @if($i==0)
                        <td colspan=4 rowspan=7 width='24%'></td>
                    @endif 
                        <td width='6%'>
                            <select class='resource_num' name='resource_num[]'>
                                <option value=''></option>
                                @foreach($resources as $resource)
                                <option value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue1[]' class="other_time_val-{{ $i }}-0" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue2[]' class="other_time_val-{{ $i }}-1" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue3[]' class="other_time_val-{{ $i }}-2" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue4[]' class="other_time_val-{{ $i }}-3" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue5[]' class="other_time_val-{{ $i }}-4" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue6[]' class="other_time_val-{{ $i }}-5" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue7[]' class="other_time_val-{{ $i }}-6" onchange="sum_row(this)"></td>
                        <td width='5%'><input type='number' name='other_sum_row[]' class="other_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                        <td width='5%' style="display:none;"></td>
                    </tr>
                @endfor
                @else
                @for($i=0; $i < 7; $i++)
                    <tr>
                        <td width='10%'> {{ $other_project[$i] }}</td>
                        <td width='6%'> {{ $other_project_no[$i] }}</td>
                    @if($i==0)
                        <td colspan=4 rowspan=7 width='24%'></td>
                    @endif 
                        <td width='6%'>
                            <select class='resource_num' name='resource_num[]'>
                                <option value=''></option>
                                @foreach($resources as $resource)
                                <option value="{{ $resource->resource_id }}" id="{{ $resource->resource_type }}">{{ $resource->resource_number }}</option>
                                @endforeach
                            </select></td>
                        <td width='6%'></td>
                        <td width='4%'><input type='number' min="0" name='timevalue1[]' class="other_time_val-{{ $i }}-0" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue2[]' class="other_time_val-{{ $i }}-1" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue3[]' class="other_time_val-{{ $i }}-2" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue4[]' class="other_time_val-{{ $i }}-3" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue5[]' class="other_time_val-{{ $i }}-4" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue6[]' class="other_time_val-{{ $i }}-5" onchange="sum_row(this)"></td>
                        <td width='4%'><input type='number' min="0" name='timevalue7[]' class="other_time_val-{{ $i }}-6" onchange="sum_row(this)"></td>
                        <td width='5%'><input type='number' name='other_sum_row[]' class="other_sum_row-{{ $i }}" style='width: 100%;height: 100%;' readonly></td>
                        <td width='5%' style="display:none;"></td>
                    </tr>
                @endfor
                @endif
                
                <tr id='sum_othertime'>
                    <td colspan='8'>Total</td>
                    <td class="other_sum_col-0" width='4%'></td>
                    <td class="other_sum_col-1" width='4%'></td>
                    <td class="other_sum_col-2" width='4%'></td>
                    <td class="other_sum_col-3" width='4%'></td>
                    <td class="other_sum_col-4" width='4%'></td>
                    <td class="other_sum_col-5" width='4%'></td>
                    <td class="other_sum_col-6" width='4%'></td>
                    <td class="other_sum" width='5%'></td>
                    <td  width='5%' style="border-color: #eef1f5;background-color: #eef1f5;"></td>
                </tr>
            </tbody>
        </table>
    </div>

    
<script>
$(document).ready(function(){
    total_sum(8,7,'regular');
    total_sum(5,7,'overtime');
    total_sum(7,7,'othertime');
    $('body').on('change', '.project_num', function(){
        var project_name=$(this).children(":selected").attr("id");
        if(!project_name){
            project_name="";
        }
        $(this).closest('td').prev().html(project_name);
        // console.log($(this).closest('td').prev());
    });
    $('body').on('change', '.discipline_num', function(){
        var discipline_type=$(this).children(":selected").attr("id");
        if(!discipline_type){
            discipline_type="";
        }
        $(this).closest('td').next().html(discipline_type);
        // console.log($(this).closest('td').prev());
    });
    $('body').on('change', '.phase_num', function(){
        var phase_name=$(this).children(":selected").attr("id");
        if(!phase_name){
            phase_name="";
        }
        $(this).closest('td').next().html(phase_name);
        // console.log($(this).closest('td').prev());
    });
    $('body').on('change', '.resource_num', function(){
        var resource_type=$(this).children(":selected").attr("id");
        if(!resource_type){
            resource_type="";
        }
        $(this).closest('td').next().html(resource_type);
        // console.log($(this).closest('td').prev());
    });
});




function sum_row(sel){
    // console.log($(sel).attr('class'));
    var classArray = $(sel).attr('class').split('-');
    var time_type=classArray[0];
    var row_id = classArray[1];
    var col_id = classArray[2];
    // var $classOfBtn = $(sel).attr('class');
    
    var i, total = 0;
    if(time_type=='regular_time_val'){

        for(var j=0; j<7; j++){
            var k= $('.regular_time_val-' + row_id + '-'+j);
            total+= +k.val();
        }
        i=$('.regular_sum_row-' + row_id);
        i.val(total);
        total=0;
        for(var j=0; j<8; j++){
            var k= $('.regular_time_val-' + j + '-'+col_id);
            total+= +k.val();
        }
        i=$('.regular_sum_col-' + col_id);
        i.html(total);
        total=0;
        for(var j=0; j<8; j++){ var k= $('.regular_sum_row-' + j);  total+= +k.val();}
        $('.regular_sum').html(total);

    }else if(time_type=='over_time_val'){
        for(var j=0; j<7; j++){
            var k= $('.over_time_val-' + row_id + '-'+j);
            total+= +k.val();
        }
        i=$('.over_sum_row-' + row_id);
        i.val(total);
        total=0;
        for(var j=0; j<5; j++){
            var k= $('.over_time_val-' + j + '-'+col_id);
            total+= +k.val();
        }
        i=$('.over_sum_col-' + col_id);
        i.html(total);
        total=0;
        for(var j=0; j<5; j++){ var k= $('.over_sum_row-' + j); total+= +k.val();}
        $('.over_sum').html(total);
    }else{
        for(var j=0; j<7; j++){
            var k= $('.other_time_val-' + row_id + '-'+j);
            total+= +k.val();
        }
        i=$('.other_sum_row-' + row_id);
        i.val(total);
    }

    total=0;
    for(var j=0; j<8; j++){
        var k= $('.regular_time_val-' + j + '-'+col_id);
        total+= +k.val();
    }
    for(var j=0; j<5; j++){
        var k= $('.over_time_val-' + j + '-'+col_id);
        total+= +k.val();
    }
    for(var j=0; j<7; j++){
        var k= $('.other_time_val-' + j + '-'+col_id);
        total+= +k.val();
    }
    i=$('.other_sum_col-' + col_id);
    i.html(total);
    total=0;

    for(var j=0; j<7; j++){ var k= $('.other_sum_col-' + j); total+= +k.html();}
    $('.other_sum').html(total);

    $('.overtime_total').html($('.other_sum').html()-48);

    // console.log(total);
}
function total_sum(row,col,type){
    total=0;
    for(var j=0; j<row; j++){
        total=0;
        for(var i=0; i<col; i++){
            if(type=="regular"){
                var k= $('.regular_time_val-' + j + '-'+i);
            }else if(type=="overtime"){
                var k= $('.over_time_val-' + j + '-'+i);
            }else{
                var k= $('.other_time_val-' + j + '-'+i);
            }
            
            total+= +k.val();
        }
        if(type=="regular"){
            sum_cls=$('.regular_sum_row-' + j);
        }else if(type=="overtime"){
            sum_cls=$('.over_sum_row-' + j);
        }else{
            sum_cls=$('.other_sum_row-' + j);
        }
        
        sum_cls.val(total);
    }
    for(var j=0; j<col; j++){
        total=0;
        for(var i=0; i<row; i++){
            if(type=="regular"){
                var k= $('.regular_time_val-' + i + '-'+j);
            }else if(type=="overtime"){
                var k= $('.over_time_val-' + i + '-'+j);
            }else{
                var k= $('.other_time_val-' + i + '-'+j);
            }
            
            total+= +k.val();
        }
        if(type=="regular"){
            sum_cls=$('.regular_sum_col-' + j);
            sum_cls.html(total);
        }else if(type=="overtime"){
            sum_cls=$('.over_sum_col-' + j);
            sum_cls.html(total);
        }else{
            sum_cls=$('.regular_sum_col-' + j);
            total+= +sum_cls.html();
            sum_cls=$('.over_sum_col-' + j);
            total+= +sum_cls.html();
            sum_cls=$('.other_sum_col-' + j);
            sum_cls.html(total);
        }
    }
    total=0;
    for(var j=0; j<col; j++){
        if(type=="regular"){
            var k=$('.regular_sum_col-' + j);
        }else if(type=="overtime"){
            var k=$('.over_sum_col-' + j);
        }else{
            var k=$('.other_sum_col-' + j);
        }
        total+= +k.html();
    }
    if(type=="regular"){
        $('.regular_sum').html(total);
    }else if(type=="overtime"){
        $('.over_sum').html(total);
    }else{
        // total+= +$('.regular_sum').html();
        // total+= +$('.over_sum').html();
        $('.other_sum').html(total);
        $('#TimesheetTotal').html(total);
    }
    $('.overtime_total').html($('.other_sum').html()-48);
}
</script>
<style>
.project_num ,.discipline_num,.phase_num,.resource_num {
    width: 75%;
    /* height: 100%; */
    border-radius: 4px!important;
    border: 1px solid #c2cad8;
    text-align: center;
}
.btn_style_head{
    width:100%;
    height: 100%;
}
</style>