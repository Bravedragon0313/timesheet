<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
        <thead>
            <tr>
                <th style="width: 5%;"> Project Nr. </th>
                <th style="width: 1%;"> Client Name </th>
                <th style="width: 10%;"> Project Name </th>
                <th style="width: 10%;"> Project Phases </th>
                <th style="width: 5%;"> Project Discipline </th>
                <th style="width: 10%;"> Project Resource Types </th>
                <th style="width: 5%;"> Task Contract Amount </th>
                <th style="width: 5%;"> Contract Amount </th>
                <th style="width: 5%;"> Authorized Budget </th>
                <th style="width: 5%;"> Not Authorized </th>
                <th style="width: 5%;"> Project Budget </th>
                <th style="width: 5%;"> Task Budget </th>
                <th style="width: 5%;"> Employee Name</th>
                <th style="width: 5%;"> Contract Exhaustion(AED) </th>
                <th style="width: 5%;"> % of Contract </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sum_col=array(0,0,0,0,0,0,0,0,0,0,0,0);
                $total_exhaustion=0;
                $total_task_contract_amount=0;
                $i=0;
            @endphp
            @if(count($result_datas)>0)
                @foreach($result_datas as $result_data)
                    @php 
                        $total_exhaustion+=$result_data->sum * $result_data->rates;
                        $total_task_contract_amount+=$result_data->task_contract_amount;
                    @endphp
                @endforeach
                @foreach($result_datas as $result_data)
                    @php 
                        $task_budget= ($result_data->contractamount) ? $result_data->task_contract_amount/$result_data->contractamount*$result_data->authorizedbudget*0.9 : 0;
                        $percentofconstract=($result_data->authorizedbudget) ? round(1-$total_task_contract_amount/$result_data->authorizedbudget*0.9,2) : 0;
    
                        $total_sum_col[0]+=$result_data->task_contract_amount;
                        $total_sum_col[1]=$result_data->contractamount;
                        $total_sum_col[2]=$result_data->authorizedbudget;
                        $total_sum_col[3]=$result_data->contractamount-$result_data->authorizedbudget;
                        $total_sum_col[4]=$result_data->authorizedbudget*0.9;
                        $total_sum_col[5]+=$task_budget;
                        $total_sum_col[6]+=$result_data->sum * $result_data->rates;
    
                    @endphp
                    <tr>
                        @if($i==0)
                            <td rowspan="{{ count($result_datas) }}" class="center">{{ $result_data->project_number }}</td>
                            <td rowspan="{{ count($result_datas) }}" class="center">
                                <select id="client_sel" name="client_id" class="form-control input-sm select2-multiple" style="border-radius: 4px !important;">
                                    <option></option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ ($client->id==$result_data->clientid) ? "selected" : "" }}>{{$client->client_name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type='text' name='client_name' style='width: 100%;height: 100%; border: none;' value='{{ $result_data->client_name }}'></td> --}}
                            <td rowspan="{{ count($result_datas) }}" class="center">{{ $result_data->project_name }}</td>
                        @endif
                            <td class="center">{{ $result_data->phase_name }}</td>
                            <td class="center">{{ $result_data->discipline_type }}</td>
                            <td class="center">{{ $result_data->resource_type }}</td>
                            <td class="center"><input type='number' min="0" name='task_contract_amount[]' onchange="calc1(this)" style='width: 100%;height: 100%; border: none;' data-initial-value='{{ $result_data->task_contract_amount }}' value='{{ $result_data->task_contract_amount }}'></td>
                        @if($i==0)
                            <td rowspan="{{ count($result_datas) }}" class="center"><input type='number' min="0" name='contract_amount' onchange="calc2(this)" style='width: 100%;height: 100%; border: none;' data-initial-value='{{ $result_data->contractamount }}' value='{{ $result_data->contractamount }}'></td>
                            <td rowspan="{{ count($result_datas) }}" class="center"><input type='number' min="0" name='authorized_budget' onchange="calc3(this)" style='width: 100%;height: 100%; border: none;' data-initial-value='{{ $result_data->authorizedbudget }}' value='{{ $result_data->authorizedbudget }}'></td>
                            <td rowspan="{{ count($result_datas) }}" class="center">{{ $result_data->contractamount-$result_data->authorizedbudget }}</td>
                            <td rowspan="{{ count($result_datas) }}" class="center">{{ $result_data->authorizedbudget*0.9 }}</td>
                        @endif
                        <td class="center">{{ round($task_budget) }}</td>
                        <td class="center">{{ $result_data->fullname }}</td>
                        <td class="center">{{ $result_data->sum * $result_data->rates }}</td>
                        <td class="center">{{ ($result_data->task_contract_amount != 0) ? round($result_data->sum * $result_data->rates/$result_data->task_contract_amount*100,2) : 0 }}</td>
                        {{-- @if($i==0)
                            <td rowspan="{{ count($result_datas) }}" class="center">{{ $percentofconstract }}</td>
                        @endif --}}
                        {{-- <td class="center">{{ ($result_data->task_contract_amount) ? round(($result_data->sum * $result_data->rates)/$result_data->task_contract_amount*100,2) : 0 }}</td> --}}
                    </tr>
                    <input type='hidden' name='timesheet_id[]' value='{{ $result_data->id }}' />
                    @php
                        $i+=1;
                    @endphp
                @endforeach
                
                <tr>
                    <td colspan="6" class="center">Total</td>
                    <td class="center" id="total_task_contract_amount">{{ $total_sum_col[0] }}</td>
                    <td class="center" id="total_contract_amount">{{ $total_sum_col[1] }}</td>
                    <td class="center" id="total_authorized_budget">{{ $total_sum_col[2] }}</td>
                    <td class="center" id="total_not_authorized">{{ $total_sum_col[3] }}</td>
                    <td class="center" id="total_project_budget">{{ $total_sum_col[4] }}</td>
                    <td class="center" id="total_task_budget">{{ $total_sum_col[5] }}</td>
                    <td></td>
                    <td class="center" id="total_AED">{{ $total_sum_col[6] }}</td>
                    <td class="center" id="total_percent_contract">{{ ($total_sum_col[0]) ? round(($total_sum_col[6])/$total_sum_col[0]*100,2) : 0 }}</td>
                    {{-- <td class="center" id="total_percent_contract"></td> --}}
                </tr>
            @endif
        </tbody>
    </table>
    <style>
    table, td{
        vertical-align: middle !important;
    }
    </style>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            
        });
        function calc1(sel){
            var pre_value=$(sel).attr("data-initial-value");
            var current_value=$(sel).val();
            var pre_total_value =Number($("#total_task_contract_amount").html());
            
            $("#total_task_contract_amount").html(Number(pre_total_value-(pre_value-current_value)).toFixed(2));
            
            pre_total_value =Number($("#total_task_contract_amount").html());
            var authorized_budget=$(sel).parent().parent().parent().children().eq(0).children().eq(8).children().val();
            if(authorized_budget){
                $(sel).parent().parent().parent().children().eq(0).children().eq(13).html(Number(1-pre_total_value/authorized_budget*0.9).toFixed(2));
            }
            
            $(sel).attr("data-initial-value",current_value);
        }
        function calc2(sel){
            var pre_value=$(sel).attr("data-initial-value");
            var current_value=$(sel).val();
            var pre_total_value =Number($("#total_contract_amount").html());
            
            $("#total_contract_amount").html(Number(pre_total_value-(pre_value-current_value)).toFixed(2));
            
            var authorized_budget=$(sel).parent().parent().children().eq(8).children().val();
            $(sel).parent().parent().children().eq(9).html(current_value-authorized_budget); //Not Authorized value calc
    
            var total_value=Number($("#total_contract_amount").html());
            var total_authorized_budget=Number($("#total_authorized_budget").html());
            $("#total_not_authorized").html(total_value-total_authorized_budget);   //Not Authorized Total value calc
    
            $(sel).attr("data-initial-value",current_value);
        }
        function calc3(sel){
            var pre_value=$(sel).attr("data-initial-value");
            var current_value=$(sel).val();
            var pre_total_value =Number($("#total_authorized_budget").html());
            
            $("#total_authorized_budget").html(Number(pre_total_value-(pre_value-current_value)));
            
            var contract_amount=$(sel).parent().parent().children().eq(7).children().val();
            
            $(sel).parent().parent().children().eq(9).html(contract_amount-current_value); //Not Authorized value calc
            $(sel).parent().parent().children().eq(10).html(Number(current_value*0.9).toFixed(2)); //Project Budget value calc
    
            var project_budget=$(sel).parent().parent().children().eq(10).html();
    
            var totalRowCount = $("#sample_editable_1 tr").length;
            for(var i=1; i<totalRowCount-1; i++){
                if(i==1){
                    var task_contract_amount= $(sel).parent().parent().children().eq(6).children().val();
                    var task_budget= (contract_amount) ? task_contract_amount/contract_amount*project_budget : '';
                    $(sel).parent().parent().children().eq(11).html(Number(task_budget).toFixed(2)); //Task Budget value calc
                    
                }else{
                    var task_contract_amount= $(sel).parent().parent().parent().children().eq(i).children().eq(3).children().val();
                    var task_budget= (contract_amount) ? task_contract_amount/contract_amount*project_budget : '';
                    $(sel).parent().parent().parent().children().eq(i).children().eq(4).html(Number(task_budget).toFixed(2));
                }
            }
    
            var total_value=Number($("#total_authorized_budget").html());
            var total_contract_amount=Number($("#total_contract_amount").html());
            $("#total_not_authorized").html(total_contract_amount-total_value);   //Total Not Authorized  value calc
            
            $("#total_project_budget").html(Number(total_value*0.).toFixed(2)); //Total Project Budget value calc
            $("#total_task_budget").html(Number(total_value*0.).toFixed(2)); //Total Task Budget value calc
    
            $(sel).attr("data-initial-value",current_value);
        }
    </script>