<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discipline;


class DisciplineController extends Controller
{
    //
    public function index(){
        $disciplines=Discipline::get();
        return view('admin.admin_manager.disciplines.index')->with(compact('disciplines'));
    }
    public function addDiscipline(Request $request){
        
        if ($request->isMethod('post')){
            $data=$request->all();
            $discipline=new Discipline;
            $discipline->discipline_number=$data['discipline_number'];
            $discipline->discipline_type=$data['discipline_type'];
            $discipline->save();
            return redirect()->action('DisciplineController@index')->with('flash_message_success','Discipline have been added successfully');
        }
        return view('admin.admin_manager.disciplines.discipline_add');
    }
    //
    public function editDiscipline(Request $request, $id=null){
        if($request->isMethod('post')){
            $data=$request->all();
            Discipline::where(['discipline_id'=>$id])->update(['discipline_number'=>$data['discipline_number'],'discipline_type'=>$data['discipline_type']]);
            return redirect()->action('DisciplineController@index')->with('flash_message_success', 'Discipline have been updated successfully');
        }
        $disciplineDetails=Discipline::where(['discipline_id'=>$id])->first();
        return view('admin.admin_manager.disciplines.discipline_edit')->with(compact('disciplineDetails'));
    }
    //
    public function deleteDiscipline($id=null){
        Discipline::where(['discipline_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Discipline have been deleted successfully');
    }
}
