<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Timesheet;
use App\User;
use App\Project;
use Illuminate\Support\Facades\DB;


class ProjectManagerController extends Controller
{    
    public function employee_index(){
        $employees=User::get();
        return view('admin.project_manager.employees')->with(compact('employees'));
    }
    
    public function employee_view(Request $request){
        $year = date("Y");
        $employee_id=$request->get('employee_id');
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where(['timesheets.user_id'=>$employee_id,'timesheets.year_val' =>$year])
            ->select('projects.project_name','timesheets.month_val','timesheets.year_val','users.rates',DB::raw('sum(total_time) as sum'))
            ->groupby(['timesheets.month_val','timesheets.year_val','projects.project_name','users.rates'])
            ->get();
        
        return ['content' => (string)view('admin.project_manager.employee_content')->with(compact('result_datas'))]; 
    }
    public function front_employee_index(){
        $employees=User::get();
        return view('project_manager.employees')->with(compact('employees'));
    }

    public function front_employee_view(Request $request){
        $year = date("Y");
        $employee_id=$request->get('employee_id');
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                                ->join('users', 'timesheets.user_id', '=', 'users.id')
                                ->where(['timesheets.user_id'=>$employee_id,'timesheets.year_val' =>$year])
                                ->select('projects.project_name','timesheets.year_val','timesheets.month_val','users.rates',DB::raw('sum(total_time) as sum'))
                                ->groupby(['timesheets.month_val','timesheets.year_val','projects.project_name','users.rates'])
                                ->get();
        
        return ['content' => (string)view('project_manager.employee_content')->with(compact('result_datas'))]; 
    }

    public function project_index(){
        $projects=Project::get();
        return view('admin.project_manager.projects')->with(compact('projects'));
    }
    public function project_view(Request $request){
        $project_id=$request->get('project_id');
        if ($project_id == NULL) return NULL;

        $get_years = Timesheet::select('year_val', 'week_date')
                     ->where('project_id', $project_id)
                     ->groupby('year_val')
                     ->get();
        
        if (count($get_years) > 1) {
            $get_month_year = Timesheet::select(DB::raw('date_format(week_date, "%M %Y") as date'))
                              ->where('project_id', $project_id)
                              ->where('total_time', '>', 0)
                              ->groupby('year_val','month_val')
                              ->get();
            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                            ->join('users', 'timesheets.user_id', '=', 'users.id')
                            ->where(['timesheets.project_id'=>$project_id])
                            ->select('users.fullname','timesheets.month_val', DB::raw('date_format(week_date, "%M %Y") as date'),'users.rates as rates',
                                    DB::raw('sum(total_time) as sum'),
                                    DB::raw('ROUND((SUM(timesheets.total_time) * users.rates) / timesheets.task_contract_amount * 100, 2) as contact_percent') )
                            ->groupby(['users.fullname','timesheets.month_val','timesheets.year_val', 'timesheets.task_contract_amount'])
                            ->orderby('users.fullname')
                            ->orderby('timesheets.week_date')
                            ->get();
            $user_lists=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                            ->join('users', 'timesheets.user_id', '=', 'users.id')
                            ->where(['timesheets.project_id'=>$project_id])
                            ->select('users.fullname','users.rates')
                            ->groupby(['users.fullname'])
                            ->orderby('users.fullname')
                            ->get();
            return ['content' => (string)view('project_manager.project_content_different_year')->with(compact('result_datas','get_month_year','user_lists'))]; 
        }
        else {
            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->join('users', 'timesheets.user_id', '=', 'users.id')
                ->where(['timesheets.project_id'=>$project_id])
                ->select('users.fullname','timesheets.month_val','timesheets.year_val','timesheets.week_date','users.rates as rates',DB::raw('sum(total_time) as sum'),
                        DB::raw('ROUND((SUM(timesheets.total_time) * users.rates) / timesheets.task_contract_amount * 100, 2) as contact_percent') )
                ->groupby(['timesheets.month_val','users.fullname','users.rates', 'timesheets.task_contract_amount','timesheets.year_val'])
                ->orderby('users.fullname')
                ->orderby('timesheets.week_date')
                ->get();
            $user_lists=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->join('users', 'timesheets.user_id', '=', 'users.id')
                ->where(['timesheets.project_id'=>$project_id])
                ->select('users.fullname')
                ->groupby(['users.fullname'])
                ->orderby('users.fullname')
                ->get();
            return ['content' => (string)view('project_manager.project_content')->with(compact('result_datas','user_lists'))]; 
        }
    }
    public function front_project_index(){
        $projects=Project::get();
        return view('project_manager.projects')->with(compact('projects'));
    }
    public function front_discipline_project_index(){
        $projects=Project::get();
        return view('project_manager.disciplines_projects')->with(compact('projects'));
    }
    public function front_phase_project_index(){
        $projects=Project::get();
        return view('project_manager.phase_projects')->with(compact('projects'));
    }
    public function front_project_view(Request $request){
        $project_id=$request->get('project_id');
        if ($project_id == NULL) return NULL;

        $get_years = Timesheet::select('year_val', 'week_date')
                     ->where('project_id', $project_id)
                     ->groupby('year_val')
                     ->get();
        
        
        if (count($get_years) > 1) {
            $get_month_year = Timesheet::select(DB::raw('date_format(week_date, "%M %Y") as date'))
                              ->where('project_id', $project_id)
                              ->where('total_time', '>', 0)
                              ->groupby('year_val','month_val')
                              ->get();
            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                            ->join('users', 'timesheets.user_id', '=', 'users.id')
                            ->where(['timesheets.project_id'=>$project_id])
                            ->select('users.fullname','timesheets.month_val', DB::raw('date_format(week_date, "%M %Y") as date'),'users.rates as rates',
                                    DB::raw('sum(total_time) as sum'),
                                    DB::raw('ROUND((SUM(timesheets.total_time) * users.rates) / timesheets.task_contract_amount * 100, 2) as contact_percent') )
                            ->groupby(['users.fullname','timesheets.month_val', 'timesheets.year_val', 'timesheets.task_contract_amount'])
                            ->orderby('users.fullname')
                            ->orderby('timesheets.week_date')
                            ->get();
            $user_lists=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                            ->join('users', 'timesheets.user_id', '=', 'users.id')
                            ->where(['timesheets.project_id'=>$project_id])
                            ->select('users.fullname','users.rates')
                            ->groupby(['users.fullname'])
                            ->orderby('users.fullname')
                            ->get();
            return ['content' => (string)view('project_manager.project_content_different_year')->with(compact('result_datas','get_month_year','user_lists'))]; 
        }
        else {
            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->join('users', 'timesheets.user_id', '=', 'users.id')
                ->where(['timesheets.project_id'=>$project_id])
                ->select('users.fullname','timesheets.month_val','timesheets.year_val','timesheets.week_date','users.rates as rates',DB::raw('sum(total_time) as sum'),
                        DB::raw('ROUND((SUM(timesheets.total_time) * users.rates) / timesheets.task_contract_amount * 100, 2) as contact_percent') )
                ->groupby(['timesheets.month_val','users.fullname','users.rates', 'timesheets.task_contract_amount','timesheets.year_val'])
                ->orderby('users.fullname')
                ->orderby('timesheets.week_date')
                ->get();
            $user_lists=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->join('users', 'timesheets.user_id', '=', 'users.id')
                ->where(['timesheets.project_id'=>$project_id])
                ->select('users.fullname')
                ->groupby(['users.fullname'])
                ->orderby('users.fullname')
                ->get();
            return ['content' => (string)view('project_manager.project_content')->with(compact('result_datas','user_lists'))]; 
        }
        
    }

    public function front_disciplines_project_view(Request $request){
        $year = date("Y");
        $project_id=$request->get('project_id');
        $result_datas=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('timesheets.month_val','timesheets.year_val','disciplines.discipline_type',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.project_id'=>$project_id,'timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','disciplines.discipline_type','timesheets.year_val'])
            ->get();
        
        return ['content' => (string)view('project_manager.disciplines_content')->with(compact('result_datas'))]; 
    }

    public function front_phase_project_view(Request $request){
        $year = date("Y");
        $project_id=$request->get('project_id');

        $result_datas=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->select('timesheets.month_val','timesheets.year_val','phases.phase_name',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.project_id'=>$project_id,'timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','timesheets.year_val','phases.phase_name'])
            ->get();
        
        return ['content' => (string)view('project_manager.phase_content')->with(compact('result_datas'))]; 
    }

    public function discipline_index(){
        $year = date("Y");
        $result_datas=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->select('timesheets.month_val','timesheets.year_val','disciplines.discipline_type',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','disciplines.discipline_type','timesheets.year_val'])
            ->get();
        
        return view('admin.project_manager.disciplines')->with(compact('result_datas'));
    }
    public function front_discipline_index(){
        $year = date("Y");
        $result_datas=Timesheet::join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->select('timesheets.month_val','timesheets.year_val','disciplines.discipline_type',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','disciplines.discipline_type','timesheets.year_val'])
            ->get();
        
        return view('project_manager.disciplines')->with(compact('result_datas'));
    }

    public function phase_index(){
        $year = date("Y");
        $result_datas=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->select('timesheets.month_val','timesheets.year_val','phases.phase_name',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','timesheets.year_val','phases.phase_name'])
            ->get();
        
        return view('admin.project_manager.phases')->with(compact('result_datas'));
    }
    public function front_phase_index(){
        $year = date("Y");
        $result_datas=Timesheet::join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->select('timesheets.month_val','timesheets.year_val','phases.phase_name',DB::raw('sum(total_time) as sum'))
            ->where(['timesheets.year_val' =>$year])
            ->groupby(['timesheets.month_val','timesheets.year_val','phases.phase_name'])
            ->get();
        
        return view('project_manager.phases')->with(compact('result_datas'));
    }
}
