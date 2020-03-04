<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Timesheet;

class ProjectController extends Controller
{
    //
    public function index(){
        $projects=Project::get();
        return view('admin.admin_manager.projects.index')->with(compact('projects'));
    }
    public function addProject(Request $request){
        
        if ($request->isMethod('post')){
            $data=$request->all();
            $project=new Project;
            $project->project_number=$data['project_number'];
            $project->project_name=$data['project_name'];
            $project->project_totalhrs=$data['project_totalhrs'];
            $project->project_rate=$data['project_rate'];
            $project->project_budget=$data['project_budget'];
            $project->project_payment=$data['project_payment'];
            $project->employee_num=$data['employee_num'];
            $project->project_manager=$data['project_manager'];
            $project->start_date=$data['start_date'];
            $project->end_date=$data['end_date'];
            $project->comments=$data['comments'];
            $project->save();

            $insert_data = Project::select('project_id')->where('project_number', $data['project_number'])->first();
            $timesheets = new Timesheet;
            $timesheets->project_id = $insert_data->project_id;
            $timesheets->total_time = 0;
            $timesheets->orderby_id = 99;
            $timesheets->save();
            return redirect()->action('ProjectController@index')->with('flash_message_success','Project has been added successfully');
        }
        return view('admin.admin_manager.projects.project_add');
    }
    public function editProject(Request $request,$id=null){

        if($request->isMethod('post')){
            $data = $request->all();
            Project::where(['project_id'=>$id])
                    ->update([
                        'project_number'=>$data['project_number'],
                        'project_name'=>$data['project_name'],
                        'project_totalhrs'=>$data['project_totalhrs'],
                        'project_rate'=>$data['project_rate'],
                        'project_budget'=>$data['project_budget'],
                        'project_payment'=>$data['project_payment'],
                        'employee_num'=>$data['employee_num'],
                        'project_manager'=>$data['project_manager'],
                        'start_date'=>$data['start_date'],
                        'end_date'=>$data['end_date'],
                        'comments'=>$data['comments'],
                        ]);
            return redirect()->action('ProjectController@index');
        }

        $projectDetails = Project::where(['project_id'=>$id])->first();
        return view('admin.admin_manager.projects.project_edit')->with(compact('projectDetails'));
    }

    public function deleteProject($id = null){
        Project::where(['project_id'=>$id])->delete();
        Timesheet::where(['project_id'=>$id, 'orderby_id'=>99])->delete();
        return redirect()->back()->with('flash_message_success', 'Project has been deleted successfully');
    }
}
