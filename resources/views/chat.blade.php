
<style media="screen">
    #chatApp {
        z-index: 1000 !important;
        height: 40%;
    }
    .panel {
        margin: 0px !important;
        border-radius: 5px !important;
        border: none ;
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
        top: 30px;
        left: 48px;
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
        height: calc(100% - 75px);
        border-left: solid 1px darkgray;
        border-bottom: solid 1px darkgray;
        overflow-y: scroll;
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
        height: 5em;
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
        right: 0;
        width: 20em;
    }
    .direct-chat .box-body {
        height: calc(100% - 72px) !important;
        background: aliceblue;
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
        padding: 0px 20px;
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
        width: 50px;
        height: 50px;
    }
    .username.username-hide-on-mobile_chat {
        margin-left: 0px;
        position: relative;
        top: -30px;
        font-size: 16px;
        width: 5em;
        overflow-x: hidden;
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
        width: 50px;
        height: 50px;
        position: relative;
        top: -10px;
        left: -10px;
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
        width: auto;
        float: right;
        display: inline-flex;
        position:fixed;
        right: 20em;
        height: 40%;
    }
    .chat_box {
        width: 20em;
        margin: 0px 5px !important;
        padding: 3px 0 1px;
        position: relative;
        float: right;
        display: flex;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="chatApp">
            <div class="panel panel-default box-style box-left-side">
                <div class="box-tools pull-right">
                <a type="button" href="/inbox"data-widget="collapse" class="btn bell"><i class="fa fa-commenting-o"></i></a>
                <button type="button" data-widget="collapse" class="btn bell"><i class="fa fa-bell-o"></i>
                <div class="new_wrapper">
                <span class="badge badge-danger" v-for="chatList1 in chatLists" v-if="chatList1.Count!=0">@{{ chatList1.Count }}</span>
                </div>                
                </button> 
                <button type="button" data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                
                </div>
                <div class="panel-heading">Chats</div>
                
                
                <div class="panel-body" style="padding:0px;">
                    <ul class="list-group">                        
                        <li class="list-group-item" v-bind:class="{ active:chatList.isActive }" v-for="chatList in chatLists" 
                        style="cursor: pointer;" @click="chat(chatList)" v-if="chatList.fullname && chatList.fullname.includes(search)">
                        
                            <img alt="" v-if="chatList.filename" class="img-circle-user" v-bind:src="'{{ asset('') }}/uploads/' + chatList.filename" />
                            <img alt="" v-if="!chatList.filename" class="img-circle-user" v-bind:src="'{{ asset('') }}/uploads/user.png'" />
                            <span class="username username-hide-on-mobile_chat" v-if="chatList.fullname"> @{{ chatList.fullname }} </span>                            
                            <i class="fa fa-circle pull-right_inbox" v-bind:class="{'online': (chatList.online=='Y')}"></i>
                            <span class="badge badge-warning" v-if="chatList.Count!=0">@{{ chatList.Count }}</span>
                        </li>
                        <li class="list-group-item" v-if="socketConnected.status == false">@{{ socketConnected.msg }}</li>
                    </ul>
                    
                </div>
                <div class="input-group">
                    <span class="input-group-btn">
                    <div class="btn btn-default btn-file">
                    <i class="fa fa-search"></i>
                    </div>
                    </span>
                    <input name="search" v-model="search" placeholder="Search Employee.." v-on:keyup="filteredList" type="text" class="form-control"> 
                    
                </div>
            </div>
            <div id="chat_box_container" class="box-style box-right-side"></div>
        </div>
    </div>
    <div class="row">            
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#chat_box_container").hide();
        $("#chat_box_container").show();
        $(".btn-box-tool").click(function(){
            if($(".panel-body").css("display")=="none"){
                $(".panel-body").show();
                $(".box-left-side").height(box_height);
            }else{
                $(".panel-body").hide();
                box_height=$(".box-left-side").height();
                $(".box-left-side").height("30px");
            }
        });
    });
</script>


