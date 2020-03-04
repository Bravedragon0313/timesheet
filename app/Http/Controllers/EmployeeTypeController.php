<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeType;
use Illuminate\Support\Facades\Validator;

class EmployeeTypeController extends Controller
{
    public function index(){
        $result_datas=EmployeeType::get();
        return view('admin.admin_manager.employee_type.index')->with(compact('result_datas'));
    }
    public function create(Request $request){

        if ($request->isMethod('post')){
            $data=$request->all();

            $type=new EmployeeType;
            $type->type=$data['type'];
            $type->save();

            return redirect()->action('EmployeeTypeController@index')->with('flash_message_success','client has been added successfully');
        }

        return view('admin.admin_manager.employee_type.create');
    }

    public function edit(Request $request,$id=null){     

      if($request->isMethod('post')){            
        $data = $request->all();
        $type=$data['type'];
        EmployeeType::where(['id'=>$id])->update(['type'=>$type]);

        return redirect()->action('EmployeeTypeController@index');            
      }

      $result_data = EmployeeType::where(['id'=>$id])->first();
      return view('admin.admin_manager.employee_type.edit')->with(compact('result_data'));
    }

    public function Delete($id = null){
        EmployeeType::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
}