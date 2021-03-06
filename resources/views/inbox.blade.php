@extends('layouts.front_layouts.front_design_inbox')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style media="screen">
    .container-fluid {
        width: 100%;
        background: white;
        height: 900px;
    }
    #chatApp {
        z-index: 1000 !important;
        height: 100%;
    }
    .panel {
        margin: 0px !important;
        border-radius: 5px !important;
        border: none !important;
    }
    .container.top-container {
        width: 100%;
    }

    .online {
        color: #32CD32!important;
    }
    .pull-right_inbox {
        float: left!important;
        position: relative;
        top: 20px;
        left: 40px;
        color: red;
    }
    .box-style {
        height: 40%;
        position: fixed;
        z-index: 1;
        bottom: 0;
    }
    .panel-default > .panel-heading{

        border: solid 1px #1073cb !important;
        background: #1073cb;
        border-radius: 6px 0 0 !important;
    }
    
    .panel-body{  
        width: 21.2em;
        margin-top: 0px;  
        height: calc(100% - 77px);
        overflow-y: auto;
    }
    
    .panel-body > .list-group{
        margin-bottom: 0;
    }
    .direct-chat-primary {
        height: calc(100% - 21px) !important;
    }
    .list-group-item.active {
        background: #33b7ab3d;
        border-color: #33b7ab3d;
        color: gray;
    }
    .list-group-item {
        height: 4em;
    }
    .box-header.with-border {
        border: solid 1px #1073cb !important;
        background: #1073cb;
        border-radius: 6px 6px 0 !important;
    }
    .box.box-primary {
        border-top: solid 1px #1073cb;
        border-radius: 6px 6px 0 !important;
    }
    .box-left-side {
        margin-right: 2em;
        width: 20em;
        border: 1px solid gray !important;
        height: calc(100% - 148px);
        position:fixed;
        top: 60px;
    }
    .direct-chat .box-body {
        height: calc(100% - 72px) !important;
        background: aliceblue!important;
    }

    .box-right-side {
        right: 20em;
        width: 20em;
    }

    

    .direct-chat-primary {
        height: calc(100% - 48px);
    }


    .direct-chat-messages {
        height: 100%;
        padding: 0px 40px;
    }
    .btn.btn-box-tool {
        background: white;
        border-radius: 30px!important;
        padding: 1px 5px !important;
        margin: 5px;
    }
    .btn.bell {
        background: white;
        border-radius: 30px!important;
        padding: 1px 5px !important;
        margin: 5px;
        width: 25px;
    }
    .img-circle {
        width: 30px;
        height: 30px;
    }
    .username.username-hide-on-mobile {
        margin-left: 0px;
        margin-top: -10px;
    }
    .fa.fa-user-o {
        width: 30px;
    }
    .badge.badge-danger{
        font-size:8px;
        width: 15px;
        height: 15px;
        padding: 2px;
        position: relative;
    }
    .img_left {
        width: 30px;
        height: 30px;
        border-radius: 30px!important;
    }
    .img-circle-user {
        width: 45px;
        height: 45px;
        position: relative;
        top: -10px;
        left: -12px;
        border-radius: 50% !important;
    }
    .new_wrapper {
        width: 15px;
        height: 20px;
        position: absolute;
        padding: 0px;
        overflow: hidden;
        top: 0px;
        right: 30px;
    }
    .search-wrapper input {

    }
    #chat_box_container {
        width: 100%;
        float: right;
        display: inline-flex;
        position:fixed;

    }
    .chat_box {
        width: 60%;
        margin: 0px 5px !important;
        padding: 3px 0 1px;
        position: fixed;
        display: flex;
        height: calc(100% - 90px);
        top: 50px;
    }
    .input-group {
        height: 5em;
    }
    .input-group input {
        margin-top: 18px;
    }

    @media only screen and (max-width: 981px) {
        .box-left-side {
            display: none !important;
        }
        .chat_box {
            width: 100%;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3" id="chatApp">
            <div class="panel panel-default box-left-side">
                
                <div class="input-group">
                    <span class="input-group-btn">
                    <div class="btn btn-default btn-file">
                    <i class="fa fa-search"></i>
                    </div>
                    </span>
                    <input name="search" v-model="search" placeholder="Search Employee.." v-on:keyup="filteredList" type="text" class="form-control"> 
                    
                </div>
                
                <div class="panel-body" style="padding:0px;">
                    <ul class="list-group">                        
                        <li class="list-group-item" v-bind:class="{ active:chatList.isActive }" v-for="chatList in chatLists" 
                        style="cursor: pointer;" @click="chat(chatList)" v-if="chatList.fullname && chatList.fullname.includes(search)">
                        
                            <img alt="" v-if="chatList.filename" class="img-circle-user" v-bind:src="'{{ asset('') }}/uploads/' + chatList.filename" />
                            <img alt="" v-if="!chatList.filename" class="img-circle-user" v-bind:src="'{{ asset('') }}/uploads/user.png'" />
                            <i class="fa fa-circle pull-right_inbox" v-bind:class="{'online': (chatList.online=='Y')}"></i>
                            <span class="username username-hide-on-mobile" v-if="chatList.fullname"> @{{ chatList.fullname }} </span>
                            
                            <span class="badge badge-warning" v-if="chatList.Count!=0">@{{ chatList.Count }}</span>
                        </li>
                        <li class="list-group-item" v-if="socketConnected.status == false">@{{ socketConnected.msg }}</li>
                    </ul>
                    
                </div>
                
            </div>            
        </div>
        <div class="col-md-8">
            <div id="chat_box_container"></div>  
        </div>
    </div>
    
</div>
@endsection