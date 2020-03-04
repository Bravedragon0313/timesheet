<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\EmployeeType;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(){
        $result_datas=Company::get();
        $employee_types = EmployeeType::get();
        return view('admin.admin_manager.company.index')->with(compact('result_datas','employee_types'));
    }
    public function Create(Request $request){

        if ($request->isMethod('post')){
            $data=$request->all();

            $company=new Company;
            $company->company_name=$data['company_name'] ? $data['company_name'] : "";
            $company->company_address=$data['company_address'] ? $data['company_address'] : "";
            $company->company_alt_add=$data['company_alt_address'] ? $data['company_alt_address'] : "";
            $company->city=$data['city'] ? $data['city'] : "";
            $company->state=$data['state'] ? $data['state'] : "";
            $company->zip_code=$data['zip_code'] ? $data['zip_code'] : "";
            $company->country=$data['country'] ? $data['country'] : "";
            $company->phone_number=$data['phone_number'] ? $data['phone_number'] : "";
            $company->alt_phone_number=$data['alt_phone_number'] ? $data['alt_phone_number'] : "";
            $company->email=$data['email'] ? $data['email'] : "";
            $company->alt_email=$data['alt_email'] ? $data['alt_email'] : "";
            $company->number_of_employees=$data['number_of_employees'] ? $data['number_of_employees'] : 0;
            $company->employee_type=$data['employee_type'] ? $data['employee_type'] : "full-time";
            $company->number_work_hours_week=$data['number_work_hours_week'] ? $data['number_work_hours_week'] : 0;
            $company->number_vacation_hours=$data['number_vacation_hours'] ? $data['number_vacation_hours'] : 0;
            $company->number_vacation_days=$data['number_vacation_days'] ? $data['number_vacation_days'] : 0;
            $company->week_day1=isset($data['week_day1']) ? 1 : 0;
            $company->week_day2=isset($data['week_day2']) ? 1 : 0;
            $company->week_day3=isset($data['week_day3']) ? 1 : 0;
            $company->week_day4=isset($data['week_day4']) ? 1 : 0;
            $company->week_day5=isset($data['week_day5']) ? 1 : 0;
            $company->week_day6=isset($data['week_day6']) ? 1 : 0;
            $company->week_day7=isset($data['week_day7']) ? 1 : 0;
            $company->number_of_department=$data['number_of_department'] ? $data['number_of_department'] : 0;
            $company->comments=$data['comments'] ? $data['comments'] : "";
            $company->save();

            return redirect()->action('CompanyController@index')->with('flash_message_success','client has been added successfully');
        }

        $employee_types = EmployeeType::get();
        return view('admin.admin_manager.company.create')->with(compact('employee_types'));
    }

    public function Edit(Request $request,$id=null){

        if($request->isMethod('post')){            
            $data = $request->all();

            $company_name=$data['company_name'] ? $data['company_name'] : "";
            $company_address=$data['company_address'] ? $data['company_address'] : "";
            $company_alt_add=$data['company_alt_address'] ? $data['company_alt_address'] : "";
            $city=$data['city'] ? $data['city'] : "";
            $state=$data['state'] ? $data['state'] : "";
            $zip_code=$data['zip_code'] ? $data['zip_code'] : "";
            $country=$data['country'] ? $data['country'] : "";
            $phone_number=$data['phone_number'] ? $data['phone_number'] : "";
            $alt_phone_number=$data['alt_phone_number'] ? $data['alt_phone_number'] : "";
            $email=$data['email'] ? $data['email'] : "";
            $alt_email=$data['alt_email'] ? $data['alt_email'] : "";
            $number_of_employees=$data['number_of_employees'] ? $data['number_of_employees'] : 0;
            $employee_type=$data['employee_type'] ? $data['employee_type'] : "full-time";
            $number_work_hours_week=$data['number_work_hours_week'] ? $data['number_work_hours_week'] : 0;
            $number_vacation_hours=$data['number_vacation_hours'] ? $data['number_vacation_hours'] : 0;
            $number_vacation_days=$data['number_vacation_days'] ? $data['number_vacation_days'] : 0;
            $week_day1=isset($data['week_day1']) ? 1 : 0;
            $week_day2=isset($data['week_day2']) ? 1 : 0;
            $week_day3=isset($data['week_day3']) ? 1 : 0;
            $week_day4=isset($data['week_day4']) ? 1 : 0;
            $week_day5=isset($data['week_day5']) ? 1 : 0;
            $week_day6=isset($data['week_day6']) ? 1 : 0;
            $week_day7=isset($data['week_day7']) ? 1 : 0;
            $number_of_department=$data['number_of_department'] ? $data['number_of_department'] : 0;
            $comments=$data['comments'] ? $data['comments'] : "";

            Company::where(['id'=>$id])
                    ->update(['company_name'=>$company_name,
                            'company_address'=>$company_address,
                            'company_alt_add'=>$company_alt_add,
                            'city'=>$city,
                            'state'=>$state,
                            'zip_code'=>$zip_code,
                            'country'=>$country,
                            'phone_number'=>$phone_number,
                            'alt_phone_number'=>$alt_phone_number,
                            'email'=>$email,
                            'alt_email'=>$alt_email,
                            'number_of_employees'=>$number_of_employees,
                            'employee_type'=>$employee_type,
                            'number_work_hours_week'=>$number_work_hours_week,
                            'number_vacation_hours'=>$number_vacation_hours,
                            'number_vacation_days'=>$number_vacation_days,
                            'week_day1'=>$week_day1,
                            'week_day2'=>$week_day2,
                            'week_day3'=>$week_day3,
                            'week_day4'=>$week_day4,
                            'week_day5'=>$week_day5,
                            'week_day6'=>$week_day6,
                            'week_day7'=>$week_day7,
                            'number_of_department'=>$number_of_department,
                            'comments'=>$comments

                    ]);
            return redirect()->action('CompanyController@index');            
        }
        
        $result_data = Company::where(['id'=>$id])->first();
        $employee_types = EmployeeType::get();
        return view('admin.admin_manager.company.edit')->with(compact('result_data','employee_types'));
    }

    public function Delete($id = null){
        Company::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'client has been deleted successfully');
    }
}