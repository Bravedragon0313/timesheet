<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Image;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Project;
use App\Timesheet;
use App\Appointment;
use App\Discipline;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images=Image::where(['type'=>'log'])->get();
        return view('home')->with(compact('images'));
    }

    public function inbox()
    {
        return view('inbox');
    }

    public function submitted_timesheets()
    {
        $result_datas = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
                                    ->select('timesheets.user_id', 'users.fullname', 'timesheets.week_date','timesheets.status',
                                            DB::raw('max(timesheets.updated_at) as updated_at'))
                                    ->where('timesheets.user_id', '>', 0)
                                    ->groupby('timesheets.user_id', 'timesheets.week_date','users.fullname')
                                    ->orderby('updated_at', 'desc')
                                    ->get();
        return view('submitted_timesheets')->with(compact('result_datas'));
    }

    public function get_calendar_data(Request $request){
        session_start();
        $year = $request->get('year');
        $month = $request->get('month');
        $result_datas = Appointment::select('color', DB::raw('day(start_date) as sday'))
                                     ->whereYear('start_date', $year)
                                     ->whereMonth('start_date', $month)
                                     ->groupby('sday')
                                     ->get();
        return ['content' => $result_datas];
    }

    public function user_login()
    {
        $images=Image::where(['type'=>'log'])->get();
        return view('user_login')->with(compact('images'));
    }

    public function chat(){
        return view('chat');
    }
    //
    public function login(Request $request){
        $images=Image::where(['type'=>'log'])->get();
    	if($request->isMethod('post')){
    		$data = $request->input();
            $result_user = User::where(['fullname' => $data['username'],'password'=>$data['password']])->first(); 
            $result_count = User::where(['fullname' => $data['username'],'password'=>$data['password']])->count(); 
            if($result_count > 0){
                session_start();
                $_SESSION['username'] = $data['username'];
                $_SESSION['user_id'] = $result_user->id;
                Session::put('is_timesheets', $result_user->is_timesheets);
                Session::put('is_summary', $result_user->is_summary);
                Session::put('is_accounting', $result_user->is_accounting);
                Session::put('user_image', $result_user->filename);
                Session::put('userSession', $data['username']);
                Session::put('user_id', $result_user->id);
                if($result_user->is_summary){
                    return redirect('/projectmanager_dashboard');
                }else{
                    return redirect('/employee_dashboard');
                }
                
        	}else{
                //echo "failed"; die;
                return redirect('/home')->with('flash_message_error','Invalid Username or Password');
        	}
    	}
    	return view('user_login')->with(compact('images'));
    }
    public function employee_dashboard(){
        session_start();
        $current_year=date("Y");
        $current_month=date("m");
        $year = date("Y");
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')->where(['user_id'=>$_SESSION['user_id'], 'year_val'=>$current_year])->select('projects.project_id','project_number','project_name','project_totalhrs','project_rate','month_val','year_val',DB::raw('sum(total_time) as sum'))->groupby('projects.project_id','project_number','project_name','project_totalhrs','project_rate','year_val')->get();
        $result_projects=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')->select('projects.project_id','project_number','project_name','project_totalhrs','project_rate',DB::raw('sum(total_time) as sum'))->groupby('projects.project_id','project_number','project_name','project_totalhrs','project_rate')->get();
        $result_disciplines_total=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->select('timesheets.month_val','timesheets.year_val','disciplines.discipline_number','disciplines.discipline_type',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','disciplines.discipline_number','disciplines.discipline_type','timesheets.year_val'])
            ->get();

        $result_phase_total=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->select('timesheets.month_val','timesheets.year_val','phases.phase_number','phases.phase_name',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','timesheets.year_val','phases.phase_number','phases.phase_name'])
            ->get();
        $total_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'],'month_val'=>$current_month, 'year_val'=>$current_year])
                                    ->first();
        $total_hours = $total_hours_data->sum;

        $worked_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'], 'year_val'=>$current_year])
                                    ->first();
        $worked_hours = $worked_hours_data->sum;

        $overtime_hours = Timesheet::select(DB::raw('(sum(total_time)-48) as sum'), 'week_date')
                                    ->where(['user_id'=>$_SESSION['user_id'], 'year_val'=>$current_year])
                                    ->groupby('week_date')
                                    ->get();

        $other_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'],'hourly_type'=>'othertime', 'year_val'=>$current_year])
                                    ->whereBetween('orderby_id', [14, 16])
                                    ->first();
        $othertime_hours = $other_hours_data->sum;

        return view('employee_dashboard')->with(compact('result_datas','result_projects','result_disciplines_total','result_phase_total','total_hours','worked_hours','overtime_hours','othertime_hours'));
    }
    public function project_amchart_view(Request $request){
        session_start();
        $project_id=$request->get('project_id');
        $data=0;
        $result_datas=Timesheet::where(['user_id'=>$_SESSION['user_id'],'project_id'=>$project_id])->select('hourly_type', DB::raw('sum(total_time) as sum'))->groupby('hourly_type')->get();
        $total_hours=Project::where(['project_id'=>$project_id])->first();
        $data=$total_hours->project_totalhrs;
        foreach($result_datas as $item){
            $data-=$item->sum;
        }
        // return ['content' => (string)view('dashboard_content')->with(compact('result_datas'))];
        return ['content' => $result_datas,'total_hours'=>$data];
    }

    public function projectmanager_dashboard(){
        session_start();
        $current_year=date("Y");
        $current_month=date("m");
        $year = date("Y");
        $result_datas=User::get();
        $result_projects=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')->select('projects.project_id','project_number','project_name','project_totalhrs','project_rate',DB::raw('sum(total_time) as sum'))->groupby('projects.project_id','project_number','project_name','project_totalhrs','project_rate')->get();
        $result_disciplines_total=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->select('timesheets.month_val','timesheets.year_val','disciplines.discipline_number','disciplines.discipline_type',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','disciplines.discipline_number','disciplines.discipline_type','timesheets.year_val'])
            ->get();

        $result_phase_total=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->select('timesheets.month_val','timesheets.year_val','phases.phase_number','phases.phase_name',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','timesheets.year_val','phases.phase_number','phases.phase_name'])
            ->get();

        $total_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'],'month_val'=>$current_month, 'year_val'=>$current_year])
                                    ->first();
        $total_hours = $total_hours_data->sum;

        $worked_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'], 'year_val'=>$current_year])
                                    ->first();
        $worked_hours = $worked_hours_data->sum;

        $overtime_hours = Timesheet::select(DB::raw('(sum(total_time)-48) as sum'), 'week_date')
                                    ->where(['user_id'=>$_SESSION['user_id'], 'year_val'=>$current_year])
                                    ->groupby('week_date')
                                    ->get();
        // $overtime_hours = $overtime_hours_data->sum;

        $other_hours_data = Timesheet::select(DB::raw('sum(total_time) as sum'))
                                    ->where(['user_id'=>$_SESSION['user_id'],'hourly_type'=>'othertime', 'year_val'=>$current_year])
                                    ->whereBetween('orderby_id', [14, 16])
                                    ->first();
        $othertime_hours = $other_hours_data->sum;
        
        return view('projectmanager_dashboard')->with(compact('result_datas','result_projects','result_disciplines_total','result_phase_total','total_hours','worked_hours','overtime_hours','othertime_hours'));
    }

    public function employee_amchart_content(Request $request){
        session_start();
        $employee_id=$request->get('employee_id');
        $data=0;
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')->where(['user_id'=>$employee_id])->select('projects.project_id','project_number','project_name','project_totalhrs','project_rate',DB::raw('sum(total_time) as sum'))->groupby('projects.project_id','project_number','project_name','project_totalhrs','project_rate')->get();
        // $data=$total_hours->project_totalhrs;
        // foreach($result_datas as $item){
        //     $data-=$item->sum;
        // }
        // return ['content' => (string)view('dashboard_content')->with(compact('result_datas'))];
        return ['content' => $result_datas];
    }
    public function project_amchart_content(Request $request){
        session_start();
        $project_id=$request->get('project_id');
        $data=0;
        $result_datas=Timesheet::join('users', 'timesheets.user_id', '=', 'users.id')->where(['project_id'=>$project_id])->select('users.fullname',DB::raw('sum(total_time) as sum'))->groupby('users.fullname')->get();

        $total_hours=Project::where(['project_id'=>$project_id])->first();
        $data=$total_hours->project_totalhrs;
        foreach($result_datas as $item){
            $data-=$item->sum;
        }
        return ['content' => $result_datas,'total_hours'=>$data];
    }

    public function discipline_amchart_content(Request $request){
        session_start();
        $project_id=$request->get('project_id');
        $year = date("Y");

        $result_datas=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('disciplines.discipline_type as title',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.project_id'=>$project_id,'timesheets.year_val' =>$year])
            ->groupby(['disciplines.discipline_type'])
            ->get();
        return ['content' => $result_datas];
    }

    public function discipline_total_amchart_content(Request $request){
        session_start();
        $year = date("Y");

        $result_datas=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('disciplines.discipline_type as title',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['disciplines.discipline_type'])
            ->get();
        return ['content' => $result_datas];
    }

    public function phase_amchart_content(Request $request){
        session_start();
        $project_id=$request->get('project_id');
        $year = date("Y");

        $result_datas=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('phases.phase_name as title',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.project_id'=>$project_id,'timesheets.year_val' =>$year])
            ->groupby(['phases.phase_name'])
            ->get();
        return ['content' => $result_datas];
    }

    public function phase_total_amchart_content(Request $request){
        session_start();
        $project_id=$request->get('project_id');
        $year = date("Y");

        $result_datas=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('phases.phase_name as title',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['phases.phase_name'])
            ->get();
        return ['content' => $result_datas];
    }

    public function calendar_view(){
        $tasks = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
                                ->select('appointments.id', 'appointments.task_name', 'appointments.color', 'appointments.project_name',
                                        'appointments.discipline', 'appointments.comments', 'appointments.start_date', 'appointments.end_date',
                                        'users.fullname','appointments.person_name')
                                ->get();
        return view('calendar_view', compact('tasks'));
    }
    public function calendar_order(){
        session_start();
        $items = Appointment::where(['appointments.person_name'=>$_SESSION['username']])
                                ->select('appointments.id', 'appointments.status',
                                    DB::raw('date(appointments.end_date) as due_date'),
                                    DB::raw('DATEDIFF(DATE(appointments.end_date), DATE(NOW())) AS diff'))
                                ->orderby('due_date')
                                ->get();
        return view('calendar_order', compact('items'));
    }
    public function task_view(){
        $items = Appointment::join('users', 'appointments.user_id', '=','users.id')
                ->select('appointments.*','users.fullname', 'users.filename',
                        DB::raw('date(appointments.start_date) as start'),
                        DB::raw('date(appointments.end_date) as end'),
                        DB::raw('DATEDIFF(DATE(appointments.end_date), DATE(NOW())) AS diff'))
                ->orderby('end')
                ->get();
        $working = Appointment::join('users', 'appointments.user_id', '=','users.id')
                ->where('appointments.status','0')
                ->select('appointments.*','users.fullname', 'users.filename',
                    DB::raw('date(appointments.end_date) as due_date'),
                    DB::raw('DATEDIFF(DATE(appointments.end_date), DATE(NOW())) diff'))
                ->orderby('due_date')
                ->get();
        return view('task_view', compact('items'));
    }
    public function calendar_update_done($id=null){
        Appointment::where(['id' => $id])->update(['status'=>0]);
        return redirect()->action('HomeController@task_view');
    }
    public function calendar_update_working($id=null){
        Appointment::where(['id' => $id])->update(['status'=>1]);
        return redirect()->action('HomeController@task_view');
    }
    public function calendar_delete(){
        $tasks = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
                                ->select('appointments.id', 'appointments.task_name', 'appointments.color', 'appointments.project_name',
                                        'appointments.discipline', 'appointments.comments', 'appointments.start_date', 'appointments.end_date',
                                        'users.fullname','appointments.person_name')
                                ->get();
        return view('calendar_delete', compact('tasks'));
    }
    public function calendar_delete_id($id=null){
        Appointment::where(['id'=>$id])->delete();
        return redirect()->action('HomeController@calendar_delete');
    }
    public function calendar_create(Request $request)
    {
        $users = User::all();
        $projects = Project::all();
        $disciplines = Discipline::all();        
        return view('calendar_create')->with(compact('users','projects', 'disciplines'));
    }

    public function calendar_store(Request $request)
    {
        
        Appointment::create($request->all());
        return redirect()->action('HomeController@calendar_view');
    }

    public function calendar_edit(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            Appointment::where(['id'=>$id])->update(['task_name'=>$data['task_name'],'user_id'=>$data['user_id'],
                                'start_date'=>$data['start_date'],'end_date'=>$data['end_date'],
                                'project_name'=>$data['project_name'],'discipline'=>$data['discipline'],
                                'color'=>$data['color'],'comments'=>$data['comments'],'person_name'=>$data['person_name']]);
            return redirect()->action('HomeController@calendar_view');
        }
        $tasks = Appointment::all();
        $users=User::get();
        $projects = Project::all();
        $disciplines = Discipline::all();     
        $calendarDetail = Appointment::where(['id'=>$id])->first();
        return view('calendar_edit')->with(compact('calendarDetail', 'users','tasks', 'projects', 'disciplines'));
    }   

    public function calendar_view_load(Request $request){
        $calendar_view_content = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
                                ->select('appointments.id', 'appointments.task_name', 'appointments.color', 'appointments.project_name',
                                        'appointments.discipline', 'appointments.comments', 'appointments.start_date', 'appointments.end_date',
                                        'users.fullname','appointments.person_name')
                                ->get();
        $calendar_view_content=Timesheet::join('projects','projects.project_id','=','timesheets.project_id')->select('project_number as title','project_name','projects.created_at as start', DB::raw('sum(total_time) as sum'))->groupby('project_number','project_name','projects.created_at')->get();
        
        return ['calendar_view_content'=>$calendar_view_content];
    }

}
