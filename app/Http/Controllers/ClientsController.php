<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Discipline;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    //
    public function index(){
        $clients=Client::get();
        return view('admin.admin_manager.clients.index')->with(compact('clients'));
    }
    public function addClient(Request $request){
        $disciplines=Discipline::get();
        if ($request->isMethod('post')){
            $data=$request->all();
            $client=new Client;
            $client->client_name=$data['client_name'];
            $client->client_addr=$data['client_addr'];
            $client->client_email=$data['client_email'];
            $client->client_phone=$data['client_phone'];
            $client->client_contact=$data['client_contact'];
            $client->client_dicip=$data['client_dicip'];
            $client->importance_level=$data['importance_level'];
            $client->client_comments=$data['client_comments'];
            $client->save();
            return redirect()->action('ClientsController@index')->with('flash_message_success','client has been added successfully');
        }

        return view('admin.admin_manager.clients.client_add')->with(compact('disciplines'));
    }
    public function editClient(Request $request,$id=null){
        $disciplines=Discipline::get();
        if($request->isMethod('post')){            
            $data = $request->all();
            Client::where(['id'=>$id])->update(['client_name'=>$data['client_name'],'client_email'=>$data['client_email'],'client_addr'=>$data['client_addr'],'client_phone'=>$data['client_phone']
            ,'client_contact'=>$data['client_contact'],'client_dicip'=>$data['client_dicip'],'client_comments'=>$data['client_comments'],'importance_level'=>$data['importance_level']]);
            return redirect()->action('ClientsController@index');
            
        }
        $clientDetails = Client::where(['id'=>$id])->first();
        return view('admin.admin_manager.clients.client_edit')->with(compact('clientDetails','disciplines'));
    }

    public function deleteClient($id = null){
        Client::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
}
