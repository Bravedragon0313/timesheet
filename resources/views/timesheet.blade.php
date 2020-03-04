@extends('layouts.front_layouts.front_design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-container" id="timesheet_form">  
    
    <div class="page-content" >
        <form method="post" action="{{ url('timesheet_store') }}" name="timesheet" id="timesheet">{{ csrf_field() }}
            <div class="row">
                <div class="col-md-2" style="margin-left:70px;">
                    <br>
                    <p>
                        <label class="form-control" style="border: 1px solid red; border-radius: 10px; color: white;background: red;padding: 8px;text-align: center; width:100%">Select a WeekEnding</label>
                        <br>
                        <input type="date" id="week_sel" name="week_sel" max="3000-12-31" min="1000-01-01" class="form-control" value="{{$week_date}}">
                    </p>
                    <br>
                    <br>
                    <div class="form-group">
                        <input type="submit"  class=" btn purple btn-outline sbold col-md-12" value="Save" id="save_btn" style="width:100%">
                        <input type="hidden" value="Save" name="save_status" id="save_status" />
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                            <button type="button" class="btn dark btn-outline sbold uppercase" id="prev_btn" style="width:31%; font-size: 12px">Prev</button>
                            <button type="button" class="btn red-mint btn-outline sbold uppercase" id="cur_btn" style="width:31%; font-size: 12px">now</button>
                            <button type="button" class="btn blue-hoki btn-outline sbold uppercase" id="next_btn" style="width:31%; font-size: 12px">Next</button>                        
                    </div>
                </div>
                <div class="col-md-9">
                    <div id="timesheetContent" data-url={{route('timesheet.content')}}></div>
                    <br>
                </div>
                
            </div>
        </form>    
    </div>    
</div>

<div class="bootbox modal fade bootbox-prompt in" id="master_pass" tabindex="-1" role="dialog" style="display: none;padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content" style="width:40%;">
            <div class="modal-header">
                <label class="control-label">Unprotected Sheet</label>
                <button type="button" class="bootbox-close-button close" id="close_btn">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="bootbox-form">
                        <label class="control-label" style="width:60%">Username:</label>
                        <input class="bootbox-input bootbox-input-text form-control" autocomplete="off" type="text" id="master_name">
                    </form>
                </div>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="bootbox-form">
                        <label class="control-label" style="width:60%">Password:</label>
                        <input class="bootbox-input bootbox-input-text form-control" autocomplete="off" type="password" id="master_password">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline sbold uppercase" id="confirm_btn" style="width:35%">OK</button>
                <button type="button" class="btn red-mint btn-outline sbold uppercase" id="cancel_btn" style="width:35%">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        var default_date = $("#week_sel").val();
        default_load(default_date);

        $("#week_sel").change(function(e){
            e.preventDefault();
            default_load($(this).val());
        })
        function default_load (default_date) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: $("#timesheetContent").data('url'),
                data: {week_date: default_date},
                success: function(data) {
                    $("#save_btn").val(data.lock_status);
                    $("#save_status").val(data.lock_status);
                    $("#timesheetContent").html(data.content);
                
                }
            });
        }
       
        $("#prev_btn").click(function(){            
            var week_date = $("#week_sel").val();
            var date = new Date(week_date);
            date.setDate(date.getDate() - 7);
            var finalDate = date.getDate()+'-'+ (date.getMonth()+1) +'-'+date.getFullYear();

            default_load(finalDate);
            document.getElementById('week_sel').value = date.toISOString().slice(0,10);
        });

        $("#cur_btn").click(function(){
            let curr = new Date 
            let week = []
            
            if(curr.getDay()>4){
                temp_date=curr.getDate() - curr.getDay()+4
            }else{
                temp_date=curr.getDate() - curr.getDay()-3
            }
            for (let i = 1; i <= 7; i++) {
                let first = temp_date + i

                let day = new Date(curr.setDate(first)).toISOString().slice(0, 10)
                week.push(day)
            }
            $("#week_sel").val(week[6]).change();
        });

        $("#next_btn").click(function(){
            var week_date = $("#week_sel").val();
            var date = new Date(week_date);
            date.setDate(date.getDate() + 7);
            var finalDate = date.getDate()+'-'+ (date.getMonth()+1) +'-'+date.getFullYear();

            default_load(finalDate);
            document.getElementById('week_sel').value = date.toISOString().slice(0,10);
        });
        
        
        $("#save_btn").on("click", function(e){
            e.preventDefault();
            if($(this).val()=="Unlock"){
                $("#master_pass").toggle("slow");
                $("#master_password").val("");
                return;
            }
            
            $("#timesheet").serialize();
            $("#timesheet").submit();
            
        });

        
    });

    $("#confirm_btn").on("click", function(e){
        e.preventDefault();
        if($("#master_password").val()=="AEC@2019" && $("#master_name").val()=="AEC"){
            $("#master_pass").hide();
            $("#save_btn").val("Save");
            $("#save_status").val("Save");
        }else{
            alert("The password you supplied is not correct");
        }
    });
    $("#cancel_btn").on("click", function(e){
        e.preventDefault();
        $("#master_pass").hide();
    });
    $("#close_btn").on("click", function(e){
        e.preventDefault();
        $("#master_pass").hide();
    });

</script>

@endsection