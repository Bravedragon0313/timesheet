<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Discipline;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class UserProfileController extends Controller
{
    public function index(){
        session_start();
        $result_userprofile = User::join('disciplines','users.departmentid','=','disciplines.discipline_id')->where(['users.id'=>$_SESSION['user_id']])->first();
        $departments=Discipline::get();
        return view('user_profile')->with(compact('result_userprofile','departments'));
    }
    public function change_profile_name(Request $request){
        
        session_start();
        $data=$request->all();
        User::where(['id'=>$_SESSION['user_id']])->update(['fullname'=>$data['user_lastname'].' '.$data['user_firstname'],                  'lastname'=>$data['user_lastname'],'firstname'=>$data['user_firstname'],'departmentid'=>$data['department']]);
    
        return redirect()->back()->with('flash_message_success', 'Project has been updated successfully');
    }

    public function change_user_password(Request $request){
        session_start();
        $data=$request->all();
        User::where(['id'=>$_SESSION['user_id']])->update(['password'=>$data['new_password']]);    
        return redirect()->back()->with('flash_message_success', 'Project has been updated successfully');
    }

    public function save_user_image(Request $request){
        session_start();
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/uploads/" . $image_name;


        file_put_contents($path, $data);
        User::where(['id'=>$_SESSION['user_id']])->update(['mime'=>'png','original_filename'=>$image_name,'filename'=>$image_name]);
        return response()->json(['success'=>'done']);
        
    }
}
