<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Image;
 
class ImageController extends Controller
{
 
    public function index()
    {
        $images = Image::where(['type'=>'log'])->get();
        return view('admin.image')->with(compact('images'));
    }
 
    public function save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('img'), $imageName);
        $image=new Image;
        $image->image=$imageName;
        $image->type="log";
        $image->save();

        return back()
            ->with('success','You have successfully upload image.');
    }
    public function edit(Request $request,$id=null)
    {
        if($request->isMethod('post')){            
            $data = $request->all();
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            Image::where(['id'=>$id])->update(['image'=>$imageName]);
            return redirect()->action('ImageController@index');
            
        }
        $image = Image::where(['id'=>$id])->first();
        return view('admin.image_edit')->with(compact('image'));
    }
    public function delete($id = null){
        Image::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
    public function employee_index()
    {
        $images = Image::where(['type'=>'user'])->get();
        return view('admin.image_user')->with(compact('images'));
    }
    public function employee_save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);
        $image=new Image;
        $image->image=$imageName;
        $image->type="user";
        $image->save();

        return back()
            ->with('success','You have successfully upload image.');
    }
    public function employee_edit(Request $request,$id=null)
    {
        if($request->isMethod('post')){            
            $data = $request->all();
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            Image::where(['id'=>$id])->update(['image'=>$imageName]);
            return redirect()->action('ImageController@employee_index');
            
        }
        $image = Image::where(['id'=>$id])->first();
        return view('admin.image_user_edit')->with(compact('image'));
    }
    public function employee_delete($id = null){
        Image::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
}