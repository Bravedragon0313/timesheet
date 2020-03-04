<?php


Route::match(['get','post'], '/admin', 'AdminController@login');
Route::match(['get','post'], '/', 'HomeController@user_login');

Auth::routes();

Route::match(['get'], '/chat', 'HomeController@chat')->name('chat');
Route::match(['get','post'], '/inbox', 'HomeController@inbox');
Route::match(['get'], '/submitted_timesheets','HomeController@submitted_timesheets');
Route::match(['get','post'],'/get_calendar_data','HomeController@get_calendar_data');

Route::match(['get','post'], '/calendar_view', 'HomeController@calendar_view');
Route::match(['get'], '/calendar_delete', 'HomeController@calendar_delete');
Route::match(['get'], '/calendar_delete_id/{id}', 'HomeController@calendar_delete_id');
Route::match(['get','post'], '/calendar_create', 'HomeController@calendar_create');
Route::match(['get','post'], '/calendar_store', 'HomeController@calendar_store');
Route::match(['get','post'], '/calendar_edit/{id}', 'HomeController@calendar_edit');
Route::match(['get','post'], '/calendar_order', 'HomeController@calendar_order');
Route::match(['get','post'], '/task_view', 'HomeController@task_view');
Route::match(['get', 'post'], '/calendar_order/update_done/{id}','HomeController@calendar_update_done');
Route::match(['get', 'post'], '/calendar_order/update_working/{id}','HomeController@calendar_update_working');
Route::match(['post'], '/calendar_view_load', 'HomeController@calendar_view_load');

Route::match(['get','post'], '/home', 'HomeController@login');
Route::match(['get','post'], '/employee_dashboard', 'HomeController@employee_dashboard');
Route::match(['post'], '/employee_dashboard/project_amchart_view', 'HomeController@project_amchart_view');

Route::match(['get','post'], '/projectmanager_dashboard', 'HomeController@projectmanager_dashboard');
Route::match(['post'], '/projectmanager_dashboard/employee_amchart_content', 'HomeController@employee_amchart_content');
Route::match(['post'], '/projectmanager_dashboard/project_amchart_content', 'HomeController@project_amchart_content');
Route::match(['post'], '/projectmanager_dashboard/discipline_amchart_content', 'HomeController@discipline_amchart_content');
Route::match(['post'], '/projectmanager_dashboard/discipline_total_amchart_content', 'HomeController@discipline_total_amchart_content');
Route::match(['post'], '/projectmanager_dashboard/phase_amchart_content', 'HomeController@phase_amchart_content');
Route::match(['post'], '/projectmanager_dashboard/phase_total_amchart_content', 'HomeController@phase_total_amchart_content');


Route::match(['get','post'], '/user_profile', 'UserProfileController@index');
Route::match(['get','post'], '/user_profilename_change', 'UserProfileController@change_profile_name');
Route::match(['get','post'], '/user_profileimage_save', 'UserProfileController@save_user_image');
Route::match(['get','post'], '/user_password_change', 'UserProfileController@change_user_password');

Route::match(['get'], '/timesheet', 'TimesheetController@index');
Route::match(['get'], '/timesheet/{week_date}', 'TimesheetController@index')->name('timesheet');
Route::match(['post'], '/timesheet/load_content', 'TimesheetController@timesheet_view')->name('timesheet.content');
Route::match(['post'], '/timesheet/load_content_submitted', 'TimesheetController@timesheet_submitted_view')->name('timesheet.submitted_content');
Route::match(['get','post'], '/timesheet/approve', 'TimesheetController@approve')->name('timesheet.approve');
Route::match(['get','post'], '/timesheet/reject', 'TimesheetController@reject')->name('timesheet.reject');

Route::match(['get','post'],'/timesheet_store', 'TimesheetController@timesheet_store');

Route::match(['get', 'post'], '/project_manager/employees','ProjectManagerController@front_employee_index');
Route::match(['post'], '/project_manager/load_content', 'ProjectManagerController@front_employee_view')->name('front_employees.content');
Route::match(['get', 'post'], '/project_manager/projects','ProjectManagerController@front_project_index');
Route::match(['post'], '/project_manager/load_project_content', 'ProjectManagerController@front_project_view')->name('front_projects.content');
Route::match(['get', 'post'], '/project_manager/disciplines','ProjectManagerController@front_discipline_index');
Route::match(['get', 'post'], '/project_manager/disciplines_project','ProjectManagerController@front_discipline_project_index');
Route::match(['post'], '/project_manager/load_disciplines_project_content', 'ProjectManagerController@front_disciplines_project_view')->name('front_projects.disciplines_content');
Route::match(['get', 'post'], '/project_manager/phases','ProjectManagerController@front_phase_index');
Route::match(['get', 'post'], '/project_manager/phases_project','ProjectManagerController@front_phase_project_index');
Route::match(['post'], '/project_manager/load_phase_project_content', 'ProjectManagerController@front_phase_project_view')->name('front_projects.phase_content');


Route::match(['get', 'post'], '/accounting/project_exhaustion','ProjectManagerController@front_project_index');
Route::match(['get', 'post'], '/accounting/employee_rates','ProjectManagerController@front_employee_index');
Route::match(['get'], '/accounting/project_budget','AccountingController@front_projectbudget_index');
Route::match(['get'], '/accounting/project_budget/{project_id}','AccountingController@front_projectbudget_index')->name('project_budget');
Route::match(['get', 'post'], '/accounting/project_budget_store','AccountingController@front_projectbudget_store');
Route::match(['post'], '/accounting/load_projectbudget_content', 'AccountingController@front_projectbudget_view')->name('front_projectbudget.content');
Route::match(['get'], '/accounting/staff_rates','AccountingController@front_staffrates_index');
Route::match(['get'], '/accounting/staff_rates/{employee_id}','AccountingController@front_staffrates_index')->name('staff_rates');
Route::match(['get', 'post'], '/accounting/staff_rates_store','AccountingController@front_staffrates_store');
Route::match(['post'], '/accounting/load_staffrates_content', 'AccountingController@front_staffrates_view')->name('front_staffrates.content');



Route::group(['middleware'=>['adminlogin']],function(){
    Route::match(['get'], '/admin/dashboard','AdminController@admin_dashboard');
    Route::match(['post'], '/admin/dashboard/project_spenttime_load', 'AdminController@project_spenttime_load');
    Route::match(['get'], '/admin/image', 'ImageController@index');
    Route::match(['post'], '/admin/save', 'ImageController@save');
    Route::match(['get', 'post'], '/admin/edit/{id}','ImageController@edit');
    Route::match(['get', 'post'], '/admin/delete/{id}','ImageController@delete');
    Route::match(['get'], '/admin/image_user', 'ImageController@employee_index');
    Route::match(['post'], '/admin/save_user', 'ImageController@employee_save');
    Route::match(['get', 'post'], '/admin/edit_user/{id}','ImageController@employee_edit');
    Route::match(['get', 'post'], '/admin/delete_user/{id}','ImageController@employee_delete');  
    
    Route::resource('/admin/company', 'CompanyController');
    Route::match(['get','post'],'/admin/company/create','CompanyController@Create');
    Route::match(['get', 'post'], '/admin/company/edit/{id}','CompanyController@Edit');
    Route::match(['get', 'post'], '/admin/company/delete/{id}','CompanyController@Delete');

    Route::resource('/admin/projects', 'ProjectController');
    Route::match(['get','post'],'/admin/projects/create','ProjectController@addProject');
    Route::match(['get', 'post'], '/admin/projects/edit/{id}','ProjectController@editProject');
    Route::match(['get', 'post'], '/admin/projects/delete/{id}','ProjectController@deleteProject');

    Route::resource('/admin/clients', 'ClientsController');
    Route::match(['get','post'],'/admin/clients/create','ClientsController@addClient');
    Route::match(['get', 'post'], '/admin/clients/edit/{id}','ClientsController@editClient');
    Route::match(['get', 'post'], '/admin/clients/delete/{id}','ClientsController@deleteClient');

    Route::resource('/admin/proposals', 'ProposalsController');
    Route::match(['get','post'],'/admin/proposals/create','ProposalsController@addProposal');
    Route::match(['get', 'post'], '/admin/proposals/edit/{id}','ProposalsController@editProposal');
    Route::match(['get', 'post'], '/admin/proposals/delete/{id}','ProposalsController@deleteProposal');
    
    Route::resource('/admin/disciplines', 'DisciplineController');
    Route::match(['get','post'],'/admin/disciplines/create','DisciplineController@addDiscipline');
    Route::match(['get', 'post'], '/admin/disciplines/edit/{id}','DisciplineController@editDiscipline');
    Route::match(['get', 'post'], '/admin/disciplines/delete/{id}','DisciplineController@deleteDiscipline');
    
    Route::resource('/admin/phases', 'PhaseController');
    Route::match(['get','post'],'/admin/phases/create','PhaseController@addPhase');
    Route::match(['get', 'post'], '/admin/phases/edit/{id}','PhaseController@editPhase');
    Route::match(['get', 'post'], '/admin/phases/delete/{id}','PhaseController@deletePhase');
    
    Route::resource('/admin/resources', 'ResourceController');
    Route::match(['get','post'],'/admin/resources/create','ResourceController@addResource');
    Route::match(['get', 'post'], '/admin/resources/edit/{id}','ResourceController@editResource');
    Route::match(['get', 'post'], '/admin/resources/delete/{id}','ResourceController@deleteResource');
    
    Route::resource('/admin/users', 'UserController');
    Route::match(['get','post'],'/admin/users/create','UserController@adduser');
    Route::match(['get', 'post'], '/admin/users/edit/{id}','UserController@edituser');
    Route::match(['get', 'post'], '/admin/users/delete/{id}','UserController@deleteuser');

    Route::resource('/admin/employee_type', 'EmployeeTypeController');
    Route::match(['get','post'],'/admin/employee_type/create','EmployeeTypeController@create');
    Route::match(['get', 'post'], '/admin/employee_type/edit/{id}','EmployeeTypeController@edit');
    Route::match(['get', 'post'], '/admin/employee_type/delete/{id}','EmployeeTypeController@delete');
    
    Route::match(['get', 'post'], 'admin/project_manager/employees','ProjectManagerController@employee_index');
    Route::match(['post'], 'admin/project_manager/load_content', 'ProjectManagerController@employee_view')->name('employees.content');
    Route::match(['get', 'post'], 'admin/project_manager/projects','ProjectManagerController@project_index');
    Route::match(['post'], 'admin/project_manager/load_project_content', 'ProjectManagerController@project_view')->name('projects.content');
    Route::match(['get', 'post'], 'admin/project_manager/disciplines','ProjectManagerController@discipline_index');
    Route::match(['get', 'post'], 'admin/project_manager/phases','ProjectManagerController@phase_index');
    Route::match(['get', 'post'], 'admin/accounting/project_exhaustion','ProjectManagerController@project_index');
    Route::match(['get', 'post'], 'admin/accounting/employee_rates','ProjectManagerController@employee_index');

    Route::match(['get'], 'admin/accounting/project_budget','AccountingController@projectbudget_index');
    Route::match(['get'], 'admin/accounting/project_budget/{project_id}','AccountingController@projectbudget_index')->name('admin_project_budget');
    Route::match(['get', 'post'], 'admin/accounting/project_budget_store','AccountingController@projectbudget_store');
    Route::match(['post'], 'admin/accounting/load_projectbudget_content', 'AccountingController@projectbudget_view')->name('projectbudget.content');
    Route::match(['get'], 'admin/accounting/staff_rates','AccountingController@staffrates_index');
    Route::match(['get'], 'admin/accounting/staff_rates/{employee_id}','AccountingController@staffrates_index')->name('admin_staff_rates');
    Route::match(['get', 'post'], 'admin/accounting/staff_rates_store','AccountingController@staffrates_store');
    Route::match(['post'], 'admin/accounting/load_staffrates_content', 'AccountingController@staffrates_view')->name('staffrates.content');

    // Route for Staff CVS, Recruitment, AEC Template, Capability Statements, Certificates, Company Profile
    Route::match(['get'], 'admin/others/staff_cvs', 'OtherController@staff_cvs');
    Route::match(['get','post'],'admin/others/staff_cvs/create','OtherController@addStaff');
    Route::match(['get','post'],'admin/others/staff_cvs/save','OtherController@saveStaff');
    Route::match(['get', 'post'], 'admin/others/staff_cvs/edit/{id}','OtherController@editStaff');
    Route::match(['get', 'post'], 'admin/others/staff_cvs/update/{id}','OtherController@updateStaff');
    Route::match(['get', 'post'], 'admin/others/staff_cvs/delete/{id}','OtherController@deleteStaff');

    Route::match(['get'], 'admin/others/recruitment', 'OtherController@recruitment');
    Route::match(['get','post'],'admin/others/recruitment/create','OtherController@addRecruitment');
    Route::match(['get','post'],'admin/others/recruitment/save','OtherController@saveRecruitment');
    Route::match(['get', 'post'], 'admin/others/recruitment/edit/{id}','OtherController@editRecruitment');
    Route::match(['get', 'post'], 'admin/others/recruitment/update/{id}','OtherController@updateRecruitment');
    Route::match(['get', 'post'], 'admin/others/recruitment/delete/{id}','OtherController@deleteRecruitment');

    Route::match(['get'], 'admin/others/templates', 'OtherController@templates');
    Route::match(['get','post'],'admin/others/templates/create','OtherController@addTemplates');
    Route::match(['get','post'],'admin/others/templates/save','OtherController@saveTemplates');
    Route::match(['get', 'post'], 'admin/others/templates/edit/{id}','OtherController@editTemplates');
    Route::match(['get', 'post'], 'admin/others/templates/update/{id}','OtherController@updateTemplates');
    Route::match(['get', 'post'], 'admin/others/templates/delete/{id}','OtherController@deleteTemplates');

    Route::match(['get'], 'admin/others/capability', 'OtherController@capability');
    Route::match(['get','post'],'admin/others/capability/create','OtherController@addCapability');
    Route::match(['get','post'],'admin/others/capability/save','OtherController@saveCapability');
    Route::match(['get', 'post'], 'admin/others/capability/edit/{id}','OtherController@editCapability');
    Route::match(['get', 'post'], 'admin/others/capability/update/{id}','OtherController@updateCapability');
    Route::match(['get', 'post'], 'admin/others/capability/delete/{id}','OtherController@deleteCapability');

    Route::match(['get'], 'admin/others/certificates', 'OtherController@certificates');
    Route::match(['get','post'],'admin/others/certificates/create','OtherController@addCertificates');
    Route::match(['get','post'],'admin/others/certificates/save','OtherController@saveCertificates');
    Route::match(['get', 'post'], 'admin/others/certificates/edit/{id}','OtherController@editCertificates');
    Route::match(['get', 'post'], 'admin/others/certificates/update/{id}','OtherController@updateCertificates');
    Route::match(['get', 'post'], 'admin/others/certificates/delete/{id}','OtherController@deleteCertificates');

    Route::match(['get'], 'admin/others/company', 'OtherController@company');
    Route::match(['get','post'],'admin/others/company/create','OtherController@addCompany');
    Route::match(['get','post'],'admin/others/company/save','OtherController@saveCompany');
    Route::match(['get', 'post'], 'admin/others/company/edit/{id}','OtherController@editCompany');
    Route::match(['get', 'post'], 'admin/others/company/update/{id}','OtherController@updateCompany');
    Route::match(['get', 'post'], 'admin/others/company/delete/{id}','OtherController@deleteCompany');

 
});
