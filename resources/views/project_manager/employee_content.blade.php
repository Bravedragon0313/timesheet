<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
        <thead>
            <tr>
                <th rowspan="2" style="width: 10%;"> Project Name </th>
                <th colspan="15" style="width: 40%;">Total Hours</th>
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
                <th style="width: 5%;"> Rates </th>
                <th style="width: 5%;"> Total Budget </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sum_col=array(0,0,0,0,0,0,0,0,0,0,0,0);
                $total_rates=0;
                $total_budget=0;
            @endphp
            @if(count($result_datas)>0)
                @foreach($result_datas as $result_data)
                    @php 
                        $total_budget+=$result_data->sum*$result_data->rates;
                        $total_sum=0;
                        $total_rates+=(double)$result_data->rates;
                    @endphp
                    <tr>
                        <td class="center">{{ $result_data->project_name }}</td>
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
                        <td class="center">{{ $result_data->rates }}</td>
                        <td class="center">{{ $total_sum*$result_data->rates }}</td>
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
                    <td class="center">{{ $total_sum }}</td>
                    <td class="center">{{ round($total_rates/count($result_datas),2) }}</td>
                    <td class="center">{{ $total_budget }}</td>
                </tr>
            @endif
        </tbody>
    </table>