<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Discipline;
use App\staffs;
use App\Recruitment;
use App\Template;
use App\Statement;
use App\Certificate;
use App\Profile;

class OtherController extends Controller
{
    // Controller for Staff_CVs
    public function staff_cvs(){
        $items=staffs::get();
        return view('admin.others.staff_cvs.index')->with(compact('items'));
    }
    public function addStaff(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.staff_cvs.create')->with(compact('disciplines'));
    }
    public function saveStaff(Request $request){
    	$request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
        	$request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
        	$request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        $staffs=new staffs;
        $staffs->staff_name=$request->staff_name;
        $staffs->department=$request->department;
        $staffs->education=$request->education;
        $staffs->citizenship=$request->citizenship;
        $staffs->experience=$request->experience;
        $staffs->comments=$request->comments;
        $staffs->attachment=$attachment;
        $staffs->temp=$temp;
        $staffs->save();

        return redirect()->action('OtherController@staff_cvs');
    }
    public function editStaff(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = staffs::where(['id'=>$id])->first();
        return view('admin.others.staff_cvs.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateStaff(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        staffs::where(['id'=>$id])->update(['staff_name'=>$request->staff_name,
                                            'department'=>$request->department,
                                            'education'=>$request->education,
                                            'citizenship'=>$request->citizenship,
                                            'experience'=>$request->experience,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@staff_cvs');
    }

    public function deleteStaff($id = null){
        staffs::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }

    // Controller for Recruitment
    public function recruitment(){
        $items=Recruitment::get();
        return view('admin.others.recruitment.index')->with(compact('items'));
    }
    public function addRecruitment(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.recruitment.create')->with(compact('disciplines'));
    }
    public function saveRecruitment(Request $request){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();

        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;

        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }

        $Recruitment=new Recruitment;
        $Recruitment->candidate_name=$request->candidate_name;
        $Recruitment->department=$request->department;
        $Recruitment->education=$request->education;
        $Recruitment->citizenship=$request->citizenship;
        $Recruitment->experience=$request->experience;
        $Recruitment->comments=$request->comments;
        $Recruitment->attachment=$attachment;
        $Recruitment->temp=$temp;
        $Recruitment->save();

        return redirect()->action('OtherController@recruitment');
    }
    public function editRecruitment(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = Recruitment::where(['id'=>$id])->first();
        return view('admin.others.recruitment.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateRecruitment(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        Recruitment::where(['id'=>$id])->update(['candidate_name'=>$request->candidate_name,
                                            'department'=>$request->department,
                                            'education'=>$request->education,
                                            'citizenship'=>$request->citizenship,
                                            'experience'=>$request->experience,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@recruitment');
    }

    public function deleteRecruitment($id = null){
        Recruitment::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }

    // Controller for Template
    public function templates(){
        $items=Template::get();
        return view('admin.others.template.index')->with(compact('items'));
    }
    public function addTemplates(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.template.create')->with(compact('disciplines'));
    }
    public function saveTemplates(Request $request){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();

        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;

        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }

        $Template=new Template;
        $Template->template_name=$request->template_name;
        $Template->department=$request->department;
        $Template->purpose=$request->purpose;
        $Template->comments=$request->comments;
        $Template->attachment=$attachment;
        $Template->temp=$temp;
        $Template->save();

        return redirect()->action('OtherController@templates');
    }
    public function editTemplates(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = Template::where(['id'=>$id])->first();
        return view('admin.others.template.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateTemplates(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        Template::where(['id'=>$id])->update(['template_name'=>$request->template_name,
                                            'department'=>$request->department,
                                            'purpose'=>$request->purpose,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@templates');
    }

    public function deleteTemplates($id = null){
        Template::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }

    // Controller for Capability Statements
    public function capability(){
        $items=Statement::get();
        return view('admin.others.capability.index')->with(compact('items'));
    }
    public function addCapability(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.capability.create')->with(compact('disciplines'));
    }
    public function saveCapability(Request $request){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();

        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;

        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }

        $Statement=new Statement;
        $Statement->statement_name=$request->statement_name;
        $Statement->department=$request->department;
        $Statement->purpose=$request->purpose;
        $Statement->comments=$request->comments;
        $Statement->attachment=$attachment;
        $Statement->temp=$temp;
        $Statement->save();

        return redirect()->action('OtherController@capability');
    }
    public function editCapability(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = Statement::where(['id'=>$id])->first();
        return view('admin.others.capability.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateCapability(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        Statement::where(['id'=>$id])->update(['statement_name'=>$request->statement_name,
                                            'department'=>$request->department,
                                            'purpose'=>$request->purpose,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@capability');
    }

    public function deleteCapability($id = null){
        Statement::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }

    // Controller for Certificates
    public function certificates(){
        $items=Certificate::get();
        return view('admin.others.certificates.index')->with(compact('items'));
    }
    public function addCertificates(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.certificates.create')->with(compact('disciplines'));
    }
    public function saveCertificates(Request $request){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();

        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;

        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }

        $Certificate=new Certificate;
        $Certificate->certificate_name=$request->certificate_name;
        $Certificate->department=$request->department;
        $Certificate->purpose=$request->purpose;
        $Certificate->comments=$request->comments;
        $Certificate->attachment=$attachment;
        $Certificate->temp=$temp;
        $Certificate->save();

        return redirect()->action('OtherController@certificates');
    }
    public function editCertificates(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = Certificate::where(['id'=>$id])->first();
        return view('admin.others.certificates.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateCertificates(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        Certificate::where(['id'=>$id])->update(['certificate_name'=>$request->certificate_name,
                                            'department'=>$request->department,
                                            'purpose'=>$request->purpose,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@certificates');
    }

    public function deleteCertificates($id = null){
        Certificate::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }

    // Controller for Company Profile
    public function company(){
        $items=Profile::get();
        return view('admin.others.company.index')->with(compact('items'));
    }
    public function addCompany(Request $request){
        $disciplines=Discipline::get();
        return view('admin.others.company.create')->with(compact('disciplines'));
    }
    public function saveCompany(Request $request){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();

        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;

        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }

        $Profile=new Profile;
        $Profile->company_name=$request->company_name;
        $Profile->department=$request->department;
        $Profile->purpose=$request->purpose;
        $Profile->comments=$request->comments;
        $Profile->attachment=$attachment;
        $Profile->temp=$temp;
        $Profile->save();

        return redirect()->action('OtherController@company');
    }
    public function editCompany(Request $request,$id=null){        
        
        $disciplines=Discipline::get();
        $staffDetails = Profile::where(['id'=>$id])->first();
        return view('admin.others.company.edit')->with(compact('staffDetails','disciplines'));
    }
    public function updateCompany(Request $request, $id=null){
        $request->validate([
            'attachment' => 'required|mimes:doc,docx,pdf,txt|max:4096',
       ]);
        $attachment = $request->attachment->getClientOriginalName();
        $fileName = time().'.'.$request->attachment->extension();
        if($request->attachment->extension() === "txt") {
            $request->attachment->move(public_path('txt'), $fileName);
            $temp = '/txt/'.$fileName;
        }
        elseif ($request->attachment->extension() === "doc" || $request->attachment->extension() === "docx") {
            $request->attachment->move(public_path('doc'), $fileName);
            $temp = '/doc/'.$fileName;
        }
        elseif ($request->attachment->extension() === "pdf") {
            $request->attachment->move(public_path('pdf'), $fileName);
            $temp = '/pdf/'.$fileName;
        }
        Profile::where(['id'=>$id])->update(['company_name'=>$request->company_name,
                                            'department'=>$request->department,
                                            'purpose'=>$request->purpose,
                                            'comments'=>$request->comments,
                                            'attachment'=>$attachment,
                                            'temp'=>$temp]);
        return redirect()->action('OtherController@company');
    }

    public function deleteCompany($id = null){
        Profile::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
}
