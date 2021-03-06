@inject('admin_helper', 'App\Service\AdminHelper')
@php 
    // get menu name    
    $menu_name = $admin_helper->getAdminMenuName();
    $dashboard=($menu_name == 'dashboard') ? true : false; 
    $admin = ($menu_name == 'company' || $menu_name == 'projects' || $menu_name == 'disciplines' || $menu_name == 'phases' || $menu_name == 'resources' || $menu_name == 'users' || $menu_name == 'employee_type' || $menu_name == 'clients' || $menu_name == 'proposals') ? true : false;
    $image = ($menu_name == 'image') ? true : false; 
    $account = ($menu_name == 'accounting/employee_rates' || $menu_name == 'accounting/project_exhaustion' || $menu_name == 'accounting/project_budget' || $menu_name == 'accounting/staff_rates') ? true : false; 
    $project_manager = ($menu_name == 'project_manager/employees' || $menu_name == 'project_manager/projects' || $menu_name == 'project_manager/disciplines' || $menu_name == 'project_manager/phases' ) ? true : false;
    $others = ($menu_name == 'others/staff_cvs' || $menu_name == 'others/recruitment' || $menu_name == 'others/templates' || $menu_name == 'others/capability' || $menu_name == 'others/certificates' || $menu_name == 'others/company') ? true : false;

@endphp
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="300" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                    <span></span>
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>                    
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item" {{($dashboard) ? 'active open' : ''}}>
                <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            
            <li class="nav-item  {{($project_manager) ? 'active open' : ''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">PROJECT MANAGER</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/project_manager/employees')}}" class="nav-link ">
                            <span class="title">EMPLOYEES</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/project_manager/projects')}}" class="nav-link ">
                            <span class="title">PROJECTS</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/project_manager/disciplines')}}" class="nav-link ">
                            <span class="title">DISCIPLINE</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/project_manager/phases')}}" class="nav-link ">
                            <span class="title">PHASES</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{($account) ? 'active open' : ''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">ACCOUNTING</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/accounting/employee_rates')}}" class="nav-link ">
                            <span class="title">EMPLOYEE RATES</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/accounting/project_exhaustion')}}" class="nav-link ">
                            <span class="title">PROJECT EXHAUSTION</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/accounting/project_budget')}}" class="nav-link ">
                            <span class="title">PROJECT BUDGET</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/accounting/staff_rates')}}" class="nav-link ">
                            <span class="title">STAFF RATES</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{($admin) ? 'active open' : ''}} ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">ADMIN</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/company')}}" class="nav-link ">
                            <span class="title">COMPANY PREFERENCES</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/projects')}}" class="nav-link ">
                            <span class="title">PROJECT</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/disciplines')}}" class="nav-link ">
                            <span class="title">DISCIPLINE</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/phases')}}" class="nav-link ">
                            <span class="title">PHASE</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/resources')}}" class="nav-link ">
                            <span class="title">RESOURCE</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/users')}}" class="nav-link ">
                            <span class="title">EMPLOYEE LIST</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/employee_type')}}" class="nav-link ">
                            <span class="title">EMPLOYEE TYPE</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/clients')}}" class="nav-link ">
                            <span class="title">CLIENTS LIST</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/proposals')}}" class="nav-link ">
                            <span class="title">PROPOSALS</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{($image) ? 'active open' : ''}} ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-picture"></i>
                    <span class="title">PICTURES</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/image')}}" class="nav-link ">
                            <span class="title">LOGIN BACK GROUND PICTURE </span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('/admin/image_user')}}" class="nav-link ">
                            <span class="title">AEC PICTURES</span>
                        </a>
                    </li>                    
                </ul>
            </li>
            <li class="nav-item  {{($others) ? 'active open' : ''}} ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-user-secret"></i>
                    <span class="title">OTHERS</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/staff_cvs')}}" class="nav-link ">
                            <span class="title">STAFF CVS</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/recruitment')}}" class="nav-link ">
                            <span class="title">RECRUITMENT</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/templates')}}" class="nav-link ">
                            <span class="title">AEC TEMPLATES</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/capability')}}" class="nav-link ">
                            <span class="title">CAPABILITY STATEMENTS</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/certificates')}}" class="nav-link ">
                            <span class="title">CERTIFICATES</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('admin/others/company')}}" class="nav-link ">
                            <span class="title">COMPANY PROFILE</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->

