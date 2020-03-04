<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheet;
use App\Project;
use App\Discipline;
use App\Resource;
use App\Phase;
use App\User;
use Session;
class TimesheetController extends Controller
{
    //
    public function index(Request $request){
        session_start();   
        $date = date("Y-m-d");
        $week_date = empty($request->week_date) ? $this->get_week($date) : $this->get_week($request->week_date); 
        $week_array = $this->calc_week();
        return view('timesheet')->with(['week_date'=> $week_date]);
    }

    private function calc_week() {
        $week = array();
        for($y=2019; $y<2100; $y++){
            for($i=1; $i<13; $i++){
                $num_of_days=cal_days_in_month(0 ,$i,$y);
                $num_of_weeks = 0;
                $start_day_of_week = 4;

                for($j=1; $j<=$num_of_days; $j++)
                {
                    $dd=$y.'-'.$i.'-'.$j;
                    $timestamp=strtotime(date('Y-m-d', strtotime($dd)));
                    $day_of_week = date( "w", $timestamp);
                    if($day_of_week==$start_day_of_week)
                    {
                        $week[] = date('Y-m-d',strtotime($dd));
                    }   
                }            
            }
        }
        return $week;
    }

    private function get_week($date) {
        $timestamp=strtotime(date('Y-m-d', strtotime($date)));
        $day_of_week = date( "w", $timestamp);
        $day_of_week= ($day_of_week>4) ? 11-$day_of_week : 4-$day_of_week;
        $timestamp = $timestamp + $day_of_week*86400;
        $current_week=date("Y-m-d", $timestamp);
        return $current_week;
    }

    public function timesheet_view(Request $request){
        session_start();
        $date=$request->get('week_date');
        $week_date = $this->get_week($date);
        $days_array=array();
        $ts = strtotime($week_date);
        $dow = date(0, $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        $ts = $ts - $offset*86400;
        for ($i = 0; $i < 7; $i++, $ts += 86400){
            $days_array[]=date("d", $ts);
        }

        $month_text=date("F",strtotime($week_date)).'- Weekly Timesheets';
        $user =User::join('disciplines','users.departmentid','=','disciplines.discipline_id')
                    ->where(['fullname'=>$_SESSION['username']])
                    ->select('users.id','disciplines.discipline_type')
                    ->first();
        $user_id=$user->id;
        $department=$user->discipline_type;
        $regulartime_datas = Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                                        ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
                                        ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
                                        ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                        ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'regular'])
                                        ->get();
                        
        $overtime_datas = Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                                    ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
                                    ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
                                    ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                    ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'overtime'])
                                    ->get();

        $othertime_datas = Timesheet::join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                    ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'othertime'])
                                    ->get();

        $status_data = Timesheet::select('status')
                                ->where(['user_id'=>$user_id,'week_date'=>$week_date])
                                ->first(); 
        $status = $status_data==NULL? 0: $status_data->status;
        $project_lists = Project::get();
        $disciplines=Discipline::get();
        $phases=Phase::get();
        $resources=Resource::get();

        //check if exit the data - save or unlock
        $user =User::where(['fullname'=>$_SESSION['username']])->first();
        $user_id=$user->id;
        $result=Timesheet::where(['week_date'=>$week_date,'user_id'=>$user_id])->get();        
        $lock_status=(count($result)>0) ? "Unlock" : "Save";
        if($status==0 || $status==2){
            $lock_status = "Save";
        }

        $time1 = strtotime($week_date);
        $time3 = strtotime(date("Y-m-d H:i:s", time()));
        $diff = $time3 - $time1;

        if($diff > 327600 && count($result)>0){
            $lock_status = "Unlock";
        }
        else{
            $lock_status = "Save";
        }
        
        return ['content' => (string)view('timesheet_content')->with(compact('regulartime_datas','overtime_datas','othertime_datas','project_lists','disciplines','phases','resources','user_id','department','month_text','days_array','status')),'lock_status'=>$lock_status];        
       
    }
    public function timesheet_submitted_view(Request $request){
        session_start();
        $date=$request->get('week_date');
        $id = $request->get('user_id');
        $week_date = $this->get_week($date);
        $days_array=array();
        $ts = strtotime($week_date);
        $dow = date(0, $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        $ts = $ts - $offset*86400;
        for ($i = 0; $i < 7; $i++, $ts += 86400){
            $days_array[]=date("d", $ts);
        }


        $month_text=date("F",strtotime($week_date)).'- Weekly Timesheets';        
        $user =User::join('disciplines','users.departmentid','=','disciplines.discipline_id')
                    ->where(['id'=>$id])
                    ->select('users.id','disciplines.discipline_type')
                    ->first();
        $user_id=$user->id;
        $department=$user->discipline_type;
        $regulartime_datas = Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                                        ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
                                        ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
                                        ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                        ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'regular'])
                                        ->get();
                        
        $overtime_datas = Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                                    ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
                                    ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
                                    ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                    ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'overtime'])
                                    ->get();

        $othertime_datas = Timesheet::join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                                    ->where(['timesheets.week_date'=>$week_date,'timesheets.user_id'=>$user_id,'timesheets.hourly_type'=>'othertime'])
                                    ->get();

        $status_data = Timesheet::select('status')
                                ->where(['user_id'=>$user_id,'week_date'=>$week_date])
                                ->first();

        $status = $status_data==NULL? 0: $status_data->status;
        $project_lists = Project::get();
        $disciplines=Discipline::get();
        $phases=Phase::get();
        $resources=Resource::get();

        //check if exit the data - save or unlock
        $user =User::where(['id'=>$id])->first();
        $user_id=$user->id;
        $user_name=$user->fullname;
        $result=Timesheet::where(['week_date'=>$week_date,'user_id'=>$user_id])->get();        
        $lock_status=(count($result)>0) ? "Unlock" : "Save";

        $time1 = strtotime($week_date);
        $time3 = strtotime(date("Y-m-d H:i:s", time()));
        $diff = $time3 - $time1;

        if($diff > 327600 && count($result)>0){
            $lock_status = "Unlock";
        }
        else{
            $lock_status = "Save";
        }
        
        return ['content' => (string)view('timesheet_content_submitted')->with(compact('regulartime_datas','overtime_datas','othertime_datas','project_lists','disciplines','phases','resources','user_id','user_name','department','month_text','days_array','status')),'lock_status'=>$lock_status];        
        
    }

    public function approve(Request $request){
        session_start();
        $date=$request->get('week_date');
        $id = $request->get('user_id');
        $week_date = $this->get_week($date);
        $updated_at = $request->get('updated_at');
        Timesheet::where(['week_date'=>$week_date,'user_id'=>$id])->update(['status'=>1, 'updated_at'=>$updated_at]);
        return response()->json(['success'=>'done']);
    }

    public function reject(Request $request){
        session_start();
        $date=$request->get('week_date');
        $id = $request->get('user_id');
        $updated_at = $request->get('updated_at');
        $week_date = $this->get_week($date);
        Timesheet::where(['week_date'=>$week_date,'user_id'=>$id])->update(['status'=>2, 'updated_at'=>$updated_at]);
        return response()->json(['success'=>'done']);
    }

    public function timesheet_store(Request $request){

        if($request->isMethod('post')){
            $data=$request->all();
            //check if lock or unlock
            if($data['save_status']=="Save"){
                session_start();

                $date=$data['week_sel'];
                $week_date = $this->get_week($date);
                $user =User::where(['fullname'=>$_SESSION['username']])->first();
                $user_id=$user->id;
                $month_val=date("m",strtotime($week_date));
                $year_val=date("Y",strtotime($week_date));

                $hourly_type="regular";
                $result_data= Timesheet::where(['week_date'=>$week_date,'user_id'=>$user_id,'hourly_type'=>$hourly_type])->get();
                for($i=0; $i<20; $i++){
                    if($i<8){ 
                        $hourly_type="regular"; 
                        $total_sum=$data['regular_sum_row'][$i];
                    }elseif($i<13 && $i>7){ 
                        $hourly_type="overtime"; 
                        $total_sum=$data['over_sum_row'][$i-8];
                    }else{
                        $hourly_type="othertime"; 
                        $total_sum=$data['other_sum_row'][$i-13];
                    }
                    if($i<13){
                        if(count($result_data)>0){

                            Timesheet::where(['week_date'=>$week_date,'orderby_id'=>$i,'user_id'=>$user_id,'hourly_type'=>$hourly_type])->update(['project_id'=>$data['project_num'][$i],'discipline_id'=>$data['discipline_num'][$i],'phase_id'=>$data['phase_num'][$i],'resource_id'=>$data['resource_num'][$i],'time_value1'=>$data['timevalue1'][$i],'time_value2'=>$data['timevalue2'][$i],'time_value3'=>$data['timevalue3'][$i],'time_value4'=>$data['timevalue4'][$i],'time_value5'=>$data['timevalue5'][$i],'time_value6'=>$data['timevalue6'][$i],'time_value7'=>$data['timevalue7'][$i],'total_time'=>$total_sum]);
                        }else{
                            $timesheet=new Timesheet;
                            $timesheet->project_id=$data['project_num'][$i];
                            $timesheet->discipline_id=$data['discipline_num'][$i];
                            $timesheet->phase_id=$data['phase_num'][$i];
                            $timesheet->resource_id=$data['resource_num'][$i];
                            $timesheet->time_value1=$data['timevalue1'][$i];
                            $timesheet->time_value2=$data['timevalue2'][$i];
                            $timesheet->time_value3=$data['timevalue3'][$i];
                            $timesheet->time_value4=$data['timevalue4'][$i];
                            $timesheet->time_value5=$data['timevalue5'][$i];
                            $timesheet->time_value6=$data['timevalue6'][$i];
                            $timesheet->time_value7=$data['timevalue7'][$i];
                            $timesheet->total_time=$total_sum;
                            $timesheet->hourly_type=$hourly_type;
                            $timesheet->orderby_id=$i;
                            $timesheet->week_date =$week_date;
                            $timesheet->month_val =$month_val; 
                            $timesheet->year_val =$year_val;
                            $timesheet->user_id =$user_id;
                            $timesheet->save();
                        }
                    }else{
                        if(count($result_data)>0){
                            Timesheet::where(['week_date'=>$week_date,'orderby_id'=>$i,'user_id'=>$user_id,'hourly_type'=>$hourly_type])
                                        ->update([
                                            'resource_id'=>$data['resource_num'][$i],
                                            'time_value1'=>$data['timevalue1'][$i],
                                            'time_value2'=>$data['timevalue2'][$i],
                                            'time_value3'=>$data['timevalue3'][$i],
                                            'time_value4'=>$data['timevalue4'][$i],
                                            'time_value5'=>$data['timevalue5'][$i],
                                            'time_value6'=>$data['timevalue6'][$i],
                                            'time_value7'=>$data['timevalue7'][$i],
                                            'total_time'=>$total_sum
                                        ]);
                        }else{
                            $timesheet=new Timesheet;
                            $timesheet->resource_id=$data['resource_num'][$i];
                            $timesheet->time_value1=$data['timevalue1'][$i];
                            $timesheet->time_value2=$data['timevalue2'][$i];
                            $timesheet->time_value3=$data['timevalue3'][$i];
                            $timesheet->time_value4=$data['timevalue4'][$i];
                            $timesheet->time_value5=$data['timevalue5'][$i];
                            $timesheet->time_value6=$data['timevalue6'][$i];
                            $timesheet->time_value7=$data['timevalue7'][$i];
                            $timesheet->total_time=$total_sum;
                            $timesheet->hourly_type=$hourly_type;
                            $timesheet->orderby_id=$i;
                            $timesheet->week_date =$week_date;
                            $timesheet->month_val =$month_val; 
                            $timesheet->year_val =$year_val; 
                            $timesheet->user_id =$user_id;
                            $timesheet->save();
                        }
                    }
                    
                }
                return redirect()->route('timesheet', ['week_date' => $week_date]); 
            }
        }
    }
}
