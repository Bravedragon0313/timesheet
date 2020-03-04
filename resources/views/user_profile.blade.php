@extends('layouts.front_layouts.front_design')
<link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-container">
    <br>
    <!-- BEGIN CONTENT -->
    {{-- <div class="page-content-wrapper"> --}}
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url('/employee_dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>User</span>
                    </li>
                </ul>
                
            </div>
            <!-- END PAGE BAR -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet ">
                            <!-- SIDEBAR USERPIC -->
                            <div id="upload-demo-i" style="background:#e1e1e1; width:300px; padding:30px;height:300px;margin-top:30px">
                                @if($result_userprofile->filename)
                                    <img src="{{ asset('uploads/'.$result_userprofile->filename) }}" class="img-responsive" alt="" /> 

                                @else
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" class="img-responsive" alt="" /> 
                                @endif
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{$result_userprofile->fullname}} </div>
                                <div class="profile-usertitle-job"> {{$result_userprofile->type}} </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                        
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form role="form" action="{{ url('/user_profilename_change') }}">{{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label">First Name</label>
                                                        <input type="text"  name="user_firstname" class="form-control" value="{{ $result_userprofile->firstname }}"/> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Last Name</label>
                                                        <input type="text" name="user_lastname" class="form-control" value="{{ $result_userprofile->lastname }}"/> </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label">Development</label>
                                                        <select class="form-control" name="department">
                                                            <option value=''></option>
                                                            @foreach($departments as $department)
                                                            <option value="{{ $department->discipline_id }}" {{ $department->discipline_id==$result_userprofile->departmentid ? 'selected' : '' }}>{{ $department->discipline_type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <input type="submit" value="Save Changes" class="btn green">
                                                        {{-- <a href="javascript:;" class="btn green"> Save Changes </a> --}}
                                                        <a href="/employee_dashboard" class="btn default"> Cancel </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <div id="upload-demo" style="width:350px"></div>
                                                    </div>
                                                    <div class="col-md-4" style="padding:30px;">
                                                        <strong>Select Image:</strong>
                                                        <br/>
                                                        <input type="file" id="upload">
                                                        <br/>
                                                        <button class="btn btn-success upload-result">Upload Image</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form action="{{ url('user_password_change') }}" method="POST" id="frmpasswordchange">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password</label>
                                                        <input type="password" class="form-control" id="confirm_password" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input type="password" class="form-control" id="new_password" name="new_password" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" class="form-control" id="renew_password" /> </div>
                                                    <div class="margin-top-10">
                                                        <input type="submit" id="change_password" value="Change Password" class="btn green">
                                                        {{-- <a href="javascript:;" class="btn green"> Change Password </a> --}}
                                                        <a href="/employee_dashboard" class="btn default"> Cancel </a>
                                                    </div>
                                                    <input type="hidden" class="form-control" id="current_password" value="{{ $result_userprofile->password }}"/> </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    <!-- END CONTENT -->
</div>
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
<script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });


        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });


        $('#upload').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: "/user_profileimage_save",
                    type: "POST",
                    data: {"image":resp},
                    success: function (data) {
                        html = '<img src="' + resp + '" />';
                        $("#upload-demo-i").html(html);
                    }
                });
            });
        });
    $("#change_password").on("click", function(e){
        e.preventDefault();
        if($("#confirm_password").val()!=$("#current_password").val()){
            alert("Old Password is Incorrect!");
            return;
        }
        if($("#new_password").val()!=$("#renew_password").val()){
            alert("The passwords you entered don't match");
            return;
        }
        if($("#new_password").val()==""){
            alert("New Password is required!");
            return;
        }
        
        $("#frmpasswordchange").serialize();
        $("#frmpasswordchange").submit();
        
    });
    
</script>
@endsection