<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class ResourceController extends Controller
{
    //
    public function index(){
        $resources=Resource::get();
        return view('admin.admin_manager.resources.index')->with(compact('resources'));
    }
    public function addResource(Request $request){
        
        if ($request->isMethod('post')){
            $data=$request->all();
            $resource=new Resource;
            $resource->resource_number=$data['resource_number'];
            $resource->resource_type=$data['resource_type'];
            $resource->save();
            return redirect()->action('ResourceController@index')->with('flash_message_success','Resource have been added successfully');
        }
        return view('admin.admin_manager.resources.resource_add');
    }
    //
    public function editResource(Request $request, $id=null){
        if($request->isMethod('post')){
            $data=$request->all();
            Resource::where(['resource_id'=>$id])->update(['resource_number'=>$data['resource_number'],'resource_type'=>$data['resource_type']]);
            return redirect()->action('ResourceController@index');
        }
        $resourceDetails=resource::where(['resource_id'=>$id])->first();
        return view('admin.admin_manager.resources.resource_edit')->with(compact('resourceDetails'));
    }
    //
    public function deleteResource($id=null){
        Resource::where(['resource_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Resource have been deleted successfully');
    }
}
