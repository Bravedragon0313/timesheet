<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Discipline;
use App\Timesheet;
use App\EmployeeType;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){
        $users=User::get();
        $departments=Discipline::get();
        $employee_types=EmployeeType::get();
        return view('admin.admin_manager.users.index')->with(compact('users','departments','employee_types'));
    }
    public function adduser(Request $request){  
        if ($request->isMethod('post')){
            $data=$request->all();
            $user=new User;
            $user->employee_id=$data['employee_id'];
            $user->fullname=$data['user_lastname'].' '.$data['user_firstname'];
            $user->lastname=$data['user_lastname'];
            $user->firstname=$data['user_firstname']? $data['user_firstname']: "";
            $user->employee_type=$data['employee_type'];
            $user->departmentid=$data['department'];
            $user->password=$data['user_password'];
            $user->rates=$data['user_rate'];
            $user->education=$data['user_rate'];
            $user->citizenship=$data['user_rate'];
            $user->supervisor=$data['user_rate'];
            $user->is_timesheets=($data['timesheet_check']) ? 1 : 0;
            $user->is_summary=($data['summary_check']) ? 1 : 0;
            $user->is_accounting=($data['accounting_check']) ? 1 : 0;
            $user->save();
            return redirect()->action('UserController@index')->with('flash_message_success','Employee has been added successfully');
        }
        $departments=Discipline::get();
        $employee_types=EmployeeType::get();
        return view('admin.admin_manager.users.user_add')->with(compact('departments','employee_types'));
    }
    public function edituser(Request $request,$id=null){

        if($request->isMethod('post')){
            $data = $request->all();
            $firstname=$data['user_firstname']? $data['user_firstname']: "";
            User::where(['id'=>$id])->update(['employee_id'=>$data['employee_id'],'fullname'=>$data['user_lastname'].' '.$data['user_firstname'],'lastname'=>$data['user_lastname'],'firstname'=>$firstname,'departmentid'=>$data['department'],'password'=>$data['user_password'],'rates'=>$data['user_rate'],'education'=>$data['user_education'],'citizenship'=>$data['user_citizenship'],'supervisor'=>$data['user_supervisor'],'is_timesheets'=>($data['timesheet_check']) ? 1 : 0,'is_summary'=>($data['summary_check']) ? 1 : 0,'is_accounting'=>($data['accounting_check']) ? 1 : 0]);
            User::where(['id'=>$id])
                ->update([
                    'employee_id'=>$data['employee_id'],
                    'fullname'=>$data['user_lastname'].' '.$data['user_firstname'],
                    'lastname'=>$data['user_lastname'],
                    'firstname'=>$firstname,
                    'employee_type'=>$data['employee_type'],
                    'departmentid'=>$data['department'],
                    'password'=>$data['user_password'],
                    'rates'=>$data['user_rate'],
                    'education'=>$data['user_education'],
                    'citizenship'=>$data['user_citizenship'],
                    'supervisor'=>$data['user_supervisor'],
                    'is_timesheets'=>($data['timesheet_check']) ? 1 : 0,
                    'is_summary'=>($data['summary_check']) ? 1 : 0,
                    'is_accounting'=>($data['accounting_check']) ? 1 : 0
            ]);
            return redirect()->action('UserController@index');
        }
        $userDetails = User::where(['id'=>$id])->first();
        $departments=Discipline::get();
        $employee_types=EmployeeType::get();
        return view('admin.admin_manager.users.user_edit')->with(compact('userDetails','departments','employee_types'));
    }

    public function deleteuser($id = null){
        User::where(['id'=>$id])->delete();
        Timesheet::where(['user_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Project has been deleted successfully');
    }
}
