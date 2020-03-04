<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Timesheet;
use App\User;
use App\Project;
use App\Client;
use Session;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    //
    function projectbudget_index(Request $request){
        $project_id = $request->project_id;
        $projects=Project::get();
        return view('admin.accounting.project_budget')->with(['projects'=> $projects, 'project_id'=> $project_id]);
    }
    function projectbudget_view(Request $request){
        $year=date("Y");
        $project_id=$request->get('project_id');
        
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
            ->where(['timesheets.project_id'=>$project_id])
            ->select('projects.project_name','projects.project_number','users.rates','users.fullname','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_name','projects.project_number','users.rates','users.fullname','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id'])
            ->get();
        $clients=Client::get();
        return ['content' => (string)view('admin.accounting.project_budget_content')->with(compact('result_datas','clients'))]; 
    }

    function projectbudget_store(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
            ->where(['timesheets.project_id'=>$data['project_id']])
            ->select('projects.project_name','projects.project_number','projects.project_rate','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_name','projects.project_number','projects.project_rate','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id'])
            ->get();
           
            if(count($result_datas)>0){
                Project::where(['project_id'=>$data['project_id']])->update(['clientid'=>$data['client_id'],'contractamount'=>$data['contract_amount'],'authorizedbudget'=>$data['authorized_budget']]);
                for($i=0; $i<count($result_datas); $i++){

                    Timesheet::where(['id'=>$data['timesheet_id'][$i]])->update(['task_contract_amount'=>$data['task_contract_amount'][$i]]);
                }
            }
        }
        // return redirect()->back();
        return redirect()->route('admin_project_budget', ['project_id' => $data['project_id']]); 
    }




    function front_projectbudget_index(Request $request){
        $project_id = $request->project_id;
        $projects=Project::get();
        return view('accounting.project_budget')->with(['projects'=> $projects, 'project_id'=> $project_id]);
    }

    function front_projectbudget_view(Request $request){

        $project_id=$request->get('project_id');
        if($project_id=="all"){
            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
                ->join('users', 'timesheets.user_id', '=', 'users.id')
                ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
                ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
                ->select('projects.project_name','projects.project_number','users.rates','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id',DB::raw('sum(total_time) as sum'))
                ->groupby(['projects.project_name','projects.project_number','users.rates','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id'])
                ->get();
            var_dump($result_datas);
            die();
            $clients=Client::get();
    
            return ['content' => (string)view('accounting.project_budget_viewAll')->with(compact('result_datas','clients'))]; 
        }else{
           $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
            ->where(['timesheets.project_id'=>$project_id])
            ->select('projects.project_name','projects.project_number','users.rates','users.fullname','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_name','projects.project_number','users.rates','users.fullname','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id'])
            ->get();
            
            $clients=Client::get();
    
            return ['content' => (string)view('accounting.project_budget_content')->with(compact('result_datas','clients'))]; 
        }
        
        
    }

    function front_projectbudget_store(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('phases', 'timesheets.phase_id', '=', 'phases.phase_id')
            ->join('disciplines', 'timesheets.discipline_id', '=', 'disciplines.discipline_id')
            ->join('resources', 'timesheets.resource_id', '=', 'resources.resource_id')
            ->where(['timesheets.project_id'=>$data['project_id']])
            ->select('projects.project_name','projects.project_number','projects.project_rate','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_name','projects.project_number','projects.project_rate','projects.project_actual_rate','phases.phase_name','disciplines.discipline_type','resources.resource_type','projects.clientid','timesheets.task_contract_amount','projects.contractamount','projects.authorizedbudget','timesheets.id'])
            ->get();
           
            if(count($result_datas)>0){
                Project::where(['project_id'=>$data['project_id']])->update(['clientid'=>$data['client_id'],'contractamount'=>$data['contract_amount'],'authorizedbudget'=>$data['authorized_budget']]);
                for($i=0; $i<count($result_datas); $i++){

                    Timesheet::where(['id'=>$data['timesheet_id'][$i]])->update(['task_contract_amount'=>$data['task_contract_amount'][$i]]);
                }
            }
        }
        // return redirect()->back();
        return redirect()->route('project_budget', ['project_id' => $data['project_id']]); 
    }


    function staffrates_index(Request $request){
        $employee_id = $request->employee_id;
        $employees=User::get();
        return view('admin.accounting.staff_rates')->with(['employees'=> $employees, 'employee_id'=> $employee_id]);
    }
    function staffrates_view(Request $request){

        $employee_id=$request->get('employee_id');
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('users', 'users.id', '=', 'timesheets.user_id')
            ->where(['timesheets.user_id'=>$employee_id])
            ->select('projects.project_id','projects.project_name','projects.project_number','users.rates','projects.project_actual_rate',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_id','projects.project_name','projects.project_number','users.rates','projects.project_actual_rate'])
            ->get();
        return ['content' => (string)view('admin.accounting.staff_rates_content')->with(compact('result_datas'))]; 
    }

    function staffrates_store(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->where(['timesheets.user_id'=>$data['employee_id']])
                ->select('projects.project_name','projects.project_number','projects.project_rate',DB::raw('sum(total_time) as sum'))
                ->groupby(['projects.project_name','projects.project_number','projects.project_rate'])
                ->get();
            if(count($result_datas)>0){
                for($i=0; $i<count($result_datas); $i++){
                    Project::where(['project_id'=>$data['project_id'][$i]])->update(['project_actual_rate'=>$data['actual_rate'][$i]]);
                }
            }
        }
        // return redirect()->back();
        return redirect()->route('admin_staff_rates', ['employee_id' => $data['employee_id']]); 
    }


    function front_staffrates_index(Request $request){

        $employee_id = $request->employee_id;
        $employees=User::get();
        return view('accounting.staff_rates')->with(['employees'=> $employees, 'employee_id'=> $employee_id]);
    }
    function front_staffrates_view(Request $request){

        $employee_id=$request->get('employee_id');
        $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
            ->join('users', 'users.id', '=', 'timesheets.user_id')
            ->where(['timesheets.user_id'=>$employee_id])
            ->select('projects.project_id','projects.project_name','projects.project_number','users.rates','projects.project_actual_rate',DB::raw('sum(total_time) as sum'))
            ->groupby(['projects.project_id','projects.project_name','projects.project_number','users.rates','projects.project_actual_rate'])
            ->get();
        return ['content' => (string)view('accounting.staff_rates_content')->with(compact('result_datas'))]; 
    }
    function front_staffrates_store(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

            $result_datas=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                ->where(['timesheets.user_id'=>$data['employee_id']])
                ->select('projects.project_name','projects.project_number','projects.project_rate',DB::raw('sum(total_time) as sum'))
                ->groupby(['projects.project_name','projects.project_number','projects.project_rate'])
                ->get();
            if(count($result_datas)>0){
                for($i=0; $i<count($result_datas); $i++){
                    Project::where(['project_id'=>$data['project_id'][$i]])->update(['project_actual_rate'=>$data['actual_rate'][$i]]);
                }
            }
        }
        // return redirect()->back();
        return redirect()->route('staff_rates', ['employee_id' => $data['employee_id']]); 
    }
}
