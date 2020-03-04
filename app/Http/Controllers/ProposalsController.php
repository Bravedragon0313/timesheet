<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Client;
use App\Discipline;

class ProposalsController extends Controller
{
    //
    public function index(){
        $proposals=Proposal::all();
        return view('admin.admin_manager.proposals.index')->with(compact('proposals'));
    }
    public function addProposal(Request $request){
        $clients=Client::get();
        $disciplines=Discipline::get();
        if ($request->isMethod('post')){
            $data=$request->all();
            $proposal=new Proposal;
            $proposal->proposal_name=$data['proposal_name'];
            $proposal->client_name=$data['client_name'];
            $proposal->client_email=$data['client_email'];
            $proposal->client_addr=$data['client_addr'];
            $proposal->client_contact=$data['client_contact'];
            $proposal->client_comments=$data['client_comments'];
            $proposal->client_phone=$data['client_phone'];
            $proposal->client_dicip=$data['client_dicip'];
            $proposal->startDate=$data['startDate'];
            $proposal->endDate=$data['endDate'];
            $proposal->importance_level=$data['importance_level'];
            $proposal->save();
            return redirect()->action('ProposalsController@index')->with('flash_message_success','Proposal has been added successfully');
        }
        return view('admin.admin_manager.proposals.proposal_add')->with(compact('clients','disciplines'));
    }
    public function editProposal(Request $request,$id=null){

        if($request->isMethod('post')){
            $data = $request->all();
            Proposal::where(['proposal_id'=>$id])->update(['proposal_name'=>$data['proposal_name'],'client_name'=>$data['client_name'],'client_email'=>$data['client_email'],
                            'client_addr'=>$data['client_addr'],'client_phone'=>$data['client_phone'],'client_dicip'=>$data['client_dicip'],
                            'client_comments'=>$data['client_comments'],'client_contact'=>$data['client_contact'],'startDate'=>$data['startDate'],'endDate'=>$data['endDate'],'importance_level'=>$data['importance_level']]);
            return redirect()->action('ProposalsController@index');
        }
        $clients=Client::get();
        $disciplines=Discipline::get();
        $proposalDetails = Proposal::where(['proposal_id'=>$id])->first();
        return view('admin.admin_manager.proposals.proposal_edit')->with(compact('proposalDetails', 'clients', 'disciplines'));
    }

    public function deleteProposal($id = null){
        Proposal::where(['proposal_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Proposal has been deleted successfully');
    }
}
