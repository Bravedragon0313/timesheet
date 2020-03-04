<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phase;

class PhaseController extends Controller
{
    //
    public function index(){
        $phases=Phase::get();
        return view('admin.admin_manager.phases.index')->with(compact('phases'));
    }
    public function addPhase(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $phase=new Phase;
            $phase->phase_number=$data['phase_number'];
            $phase->phase_name=$data['phase_name'];
            $phase->save();
            return redirect()->action('PhaseController@index')->with('flash_message_success', 'Phase have been added successfully');
        }
        return view('admin.admin_manager.phases.phase_add');
    }
    public function editPhase(Request $request, $id=null){
        if($request->isMethod('post')){
            $data=$request->all();
            Phase::where(['phase_id'=>$id])->update(['phase_number'=>$data['phase_number'], 'phase_name'=>$data['phase_name']]);
            return redirect()->action('PhaseController@index');
        }
        $phaseDetails=Phase::where(['phase_id'=>$id])->first();
        return view('admin.admin_manager.phases.phase_edit')->with(compact('phaseDetails'));
    }
    public function deletePhase($id=null){
        Phase::where(['phase_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Phase have been deleted successfully');
    }
}
