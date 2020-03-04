@inject('admin_helper', 'App\Service\AdminHelper')
@php 
    // get menu name    
    $menu_name = $admin_helper->getFrontMenuName();
    
    // $admin = ($menu_name == 'projects' || $menu_name == 'disciplines' || $menu_name == 'phases' || $menu_name == 'resources' || $menu_name == 'users' ) ? true : false; 
    $account = ($menu_name == 'accounting/employee_rates' || $menu_name == 'accounting/project_exhaustion' || $menu_name == 'accounting/project_budget' || $menu_name == 'accounting/staff_rates') ? true : false; 
    $project_manager = ($menu_name == 'project_manager/employees' || $menu_name == 'project_manager/projects' || $menu_name == 'project_manager/disciplines' || $menu_name == 'project_manager/phases' ) ? true : false; 

@endphp
<style>
.active1{
    background-color:black;
    font-size:45;
}
</style>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top" style="background-color:rgb(38, 38, 38); height:70px; padding-top:10px; padding-bottom:10px">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            @if(session('is_summary'))
                <a href="{{ url('/projectmanager_dashboard') }}">
                <img src="{{ asset('assets/layouts/layout/img/aec-logo-1.png')}}" alt="logo" class="logo-default" style="width: 120px; margin-top:6px;" /> </a>
                
            @else
                <a href="{{ url('/employee_dashboard') }}">
                <img src="{{ asset('assets/layouts/layout/img/aec-logo-1.png')}}" alt="logo" class="logo-default" style="width: 120px; margin-top:6px;" /> </a>
            @endif
            
        </div>
        <!-- END LOGO -->
        <!-- BEGIN MEGA MENU -->
                <!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
                <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
                <div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
                    <ul class="nav navbar-nav">
                    
                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                        @if(session('is_summary'))
                            <li class="classic-menu-dropdown {{ $menu_name=='projectmanager_dashboard' ? 'active1' : '' }}">
                                <a href="{{ url('/projectmanager_dashboard') }}" style="font-size:20px; font-family:aria"> Dashboard
                                </a>
                            </li>
                            
                        @else
                            <li class="classic-menu-dropdown {{ $menu_name=='employee_dashboard' ? 'active1' : '' }}">
                                <a href="{{ url('/employee_dashboard') }}" style="font-size:20px; font-family:aria"> Dashboard
                                    {{-- <span class="selected"> </span> --}}
                                </a>
                            </li>
                        @endif
                        @if(session('is_timesheets'))
                            <li class="classic-menu-dropdown {{ $menu_name=='timesheet' ? 'active1' : '' }}">
                                <a href="{{ url('/timesheet') }}" style="font-size:20px; font-family:aria"> Timesheet
                                    {{-- <span class="selected"> </span> --}}
                                </a>
                            </li>
                        @endif

                        @if(session('is_timesheets'))
                            <li class="classic-menu-dropdown {{ $menu_name=='calendar_view' ? 'active1' : '' }}">
                                <a href="{{ url('/calendar_view') }}" style="font-size:20px; font-family:aria"> Calendar View
                                    {{-- <span class="selected"> </span> --}}
                                </a>
                            </li>
                        @endif
                        
                        @if(session('is_summary'))
                            <li class="classic-menu-dropdown {{ ($project_manager) ? 'active1' : '' }}">
                                <a href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true" style="font-size:20px; font-family:aria"> Project Manager
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="{{ url('/project_manager/employees') }}">
                                            <i class="fa fa-bookmark-o"></i> Employees </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/project_manager/projects') }}">
                                            <i class="fa fa-user"></i> Projects </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/project_manager/disciplines_project') }}">
                                            <i class="fa fa-puzzle-piece"></i> Disciplines </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/project_manager/disciplines') }}">
                                            <i class="fa fa-puzzle-piece"></i> Disciplines Total </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/project_manager/phases_project') }}">
                                            <i class="fa fa-gift"></i> Phases </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/project_manager/phases') }}">
                                            <i class="fa fa-gift"></i> Phases Total </a>
                                    </li>
                                    
                                </ul>
                            </li>
                        @endif
                        
                        @if(session('is_accounting'))
                            <li class="classic-menu-dropdown {{ ($account) ? 'active1' : '' }}">
                                <a href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true" style="font-size:20px; font-family:aria"> Accounting
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="{{ url('/accounting/employee_rates')}}">
                                            <i class="fa fa-bookmark-o"></i> Employee Rates </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/accounting/project_exhaustion')}}">
                                            <i class="fa fa-user"></i> Project Exhaustion </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/accounting/project_budget')}}">
                                            <i class="fa fa-puzzle-piece"></i> Project Budget </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/accounting/staff_rates')}}">
                                            <i class="fa fa-gift"></i> Staff Rates </a>
                                    </li>
                                    
                                </ul>
                            </li>
                        @endif
                        <li class="classic-menu-dropdown {{ $menu_name=='inbox' ? 'active1' : '' }}">
                            <a href="{{ url('/inbox') }}" style="font-size:20px; font-family:aria"> Inbox
                            </a>
                        </li>
                        @if(session('is_summary'))
                            <li class="classic-menu-dropdown {{ $menu_name=='submitted_timesheets' ? 'active1' : '' }}">
                                <a href="{{ url('/submitted_timesheets') }}" style="font-size:20px; font-family:aria"> Submitted timesheets
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- END MEGA MENU -->
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        @if(session('user_image'))
                        <img alt="" class="img-circle" src="{{ asset('/uploads/'.session('user_image')) }}" />
                        @endif
                        <span class="username username-hide-on-mobile"> {{ session('userSession') }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ url('/user_profile') }}">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-lock"></i> Lock Screen </a>
                        </li>
                        <li>
                            <a href="{{ url('/home') }}">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<style>
.img-circle{
    width: 50px!important;
    height: 50px!important;
    position: relative;
    top: -10px;
}
</style>