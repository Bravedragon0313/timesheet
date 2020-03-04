<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Admin;
use App\Project;
use App\Timesheet;
use App\User;
use App\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function login(Request $request){
        $images=Image::where(['type'=>'log'])->get();
    	if($request->isMethod('post')){
    		$data = $request->input();
            
            $adminCount = Admin::where(['username' => $data['username'],'password'=>md5($data['password']),'status'=>1])->count(); 
            if($adminCount > 0){
                //echo "Success"; die;
                Session::put('adminSession', $data['username']);
                return redirect('/admin/dashboard');
        	}else{
                //echo "failed"; die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
        	}
    	}
    	return view('admin.admin_login')->with(compact('images'));
    }
    public function admin_dashboard(){
        
        $project_lists=Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')->select('projects.project_id','project_number','project_name','project_totalhrs','project_rate',DB::raw('sum(total_time) as sum'))->groupby('projects.project_id','project_number','project_name','project_totalhrs','project_rate')->get();
        $employee_lists=User::select('users.id','users.fullname','users.rates')->get();
        $total_projects=Project::count();
        $total_employees=User::count();
        return view('admin.admin_dashboard')->with(compact('project_lists','employee_lists','total_projects','total_employees'));
    }
    public function project_spenttime_load(Request $request){
        $temp=$request->get('temp');
        $total=Project::select('project_number as label', 'project_totalhrs as y')->orderby('project_number')->get();
        $worked = Timesheet::join('projects', 'timesheets.project_id', '=', 'projects.project_id')
                            ->select('projects.project_number as label', DB::raw('sum(timesheets.total_time) as y'))
                            ->groupby(['timesheets.project_id','projects.project_number'])
                            ->having('timesheets.project_id','>','0')
                            ->orderBy('project_number')
                            ->get();
        return ['total'=>$total, 'worked'=>$worked];
    }
}
