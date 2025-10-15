@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")
<style type="text/css">
   
		.right_chat {width: 40%;}

.right_column {width: 100%;}
.pcoded-content {
    padding: 6px 30px;
}
#client_container li{
    cursor:pointer;
}
.chat_new {display: flex;}
.text-details.header {
    height: 65px;
    width: 100%;
    background-color: #16151f;
    display: flex;
    align-items: center;
    
}
.flex-content{
    display: flex !important;
    flex-direction: column;
}
.home-chat {
    /* min-height: calc(100vh - 200px); */
    height: calc(100vh - 190px);
    overflow: auto;
    background-color: #fff;
    padding: 18px 9px;
}
.footer {
    background-color: #fff;
    padding: 12px 29px;
    display: flex;
}
.chat_point {
    flex: 1;
    margin-right:12px;
}

i.fa.fa-paper-plane,
i.fa.fa-paperclip {
    font-size: 18px;
    color: #fff;
    width: 38px;
    height:38px;
    background-color: #012cae;
    /* background-color: #3f5ebb; */
    border-radius: 100%;
    line-height: 36px;
    text-align: center;
    margin: 6px 3px;

}
i.fa.fa-paper-plane {
    /* font-size: 34px; */
    /* color: #012cae; */
    background-color: #3f5ebb;
}
span.message-date.meassage_data{
    margin-top:6px;
    font-size:10px;
}
.message-content.recieve_msg{
    background-color: #012cae;
    color: white;
}
.message-content {
    padding: .5rem ;
    background-color: #f5f6fa;
    color: #8094ae;
    margin-left: 1.25rem;
    /* border-radius: 1.25rem; */
    text-align: left;
    display: inline-block;
    max-width: 25rem;
    font-size:13px;
    word-break: break-all;
    /* border: 3px solid #012cae; */

    /* border: 3px solid #0c8372; */
}
.message-content h6 {
    font-size: 17px;
}
.message-options {
    text-align: left;
}
.active_user.wrapper_cli {
    text-align: right;
    justify-content: flex-end;
    display: flex;
}
.client_attachment{
    width: 200px;
    height: 200px;
    object-fit: cover;
}
.right_column{
    display:none;
}
.wrapper_cli {
    margin-bottom: 35px;
}
.chat_point textarea {
    height: 47px;
    resize: none;
    width: 100%;
    background-color: #fff;
    border-radius: 9px;

}
.footer button.button-list.top_new {
    float: right;
    vertical-align: super;
}
.right_chat ul li {
    margin-bottom: 0;
    padding: 0px 0;
    border-bottom: 1px solid #f3f3f3;
}
.imge_wrappe {
   padding:.5rem;
}
.imge_wrappe.active {
    border-color: rgb(10, 127, 110);
    background-color:#012cae;

    /* border: 3px solid #0c8372; */
}
.item_t {
    position: relative;
    display: inline-block;
}
.imge_wrappe.active span.client_name, .imge_wrappe.active p {
    color: #fff!important;
    opacity: 1;
}
.imge_wrappe span.client_name{
    color: black!important;
    opacity: 1;
}
.imge_wrappe p {
    color: black!important;
    opacity: 1;
}
.lite_ew p {
    margin-bottom: 0;
    font-size: 12px;
    color: #fff;
}
.lite_ew h4 {
    font-size: 14px;
    margin-bottom: 0;
    color: #fff;
}
.right_chat {
    background-color: #fff;
    box-shadow: 0 2px 4px rgb(15 34 58 / 12%);
    min-width: 200px;
    max-width: 264px;
   
}
.lite_ew {
    margin-left:12px;
}
.item_t img {
    width: 37px;
}
.imge_wrappe span{
    margin-left:10px;
}
.user-status {
    width: 10px;
    height: 10px;
    background-color: #adb5bd;
    border-radius: 50%;
    border:2px solid #fff;
    position: absolute;
    right: 0;
    left: auto;
    bottom: 0;
    background: red;
}
.right_chat ul li img {
    width: 30px;
    height:30px;
}
.avatar.avatar-sm img {
    width:40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 0 0 0.5rem #fff;
}
.right_chat ul {
    list-style: none;
}
/* .imge_wrappe {
    padding: 9px 0;
} */
.right_chat ul {
    padding: 0;
}
.chats_container {
    background-color: #16151f;
    height: 65px;
}
.chats_container h2 {
   font-size: 17px;
    color: #fff;
    text-align: center;
    line-height: 54px;
}
span.message-date.meassage_data {
    float: right;
}
.message_first {
    display: flex;
}
.footer {
    background-color: #efefef;
    
}

.data_line {
    display: flex;
    align-items: flex-start;
}
.first_data p {
    margin-bottom: 0;
}
.first_data p {
    color: #fff;
    margin-left: 10px;
    font-size: 12px;
}
ul.over-flow {
    height: calc(100vh - 200px);
    /* display: inline-block; */
    overflow: auto;
}
 
/* ul.over-flow::-webkit-scrollbar {
    width: 8px;
}
 
ul.over-flow::-webkit-scrollbar-track {
    background-color: #ebebeb;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

ul.over-flow::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #b7b3b3; 
} */
.badge{
    background-color:#012cae;
    color:white!important;
    width: 25px;
    height:25px;
    line-height: 19px;
    border-radius: 100%;
}
i.fa.fa-comments {
    color: #0400ac;
    font-size: 131px;
    width: 100%;
}
.facomments_point.right_col_dummy {
    background-color: #f7f7f7;
}

.facomments_point {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.message-content.recieve_msg a{
    color:white;
}

.message-content.recieve_msg a:hover{
    color:#7983ef;
}

#snackbar{
    color: #004085;
    background-color: #cce5ff;
    border-color: #b8daff;
}

#snackbar h2 {
    font-size: 15px;
    padding: 8px;
    margin: 0;
}
/* The snackbar - position it at the bottom and in the middle of the screen */
#snackbar {
  visibility: hidden; /* Hidden by default. Visible on click */
  min-width: 215px; /* Set a default minimum width */
  margin-left: -125px; /* Divide value of min-width by 2 */
  color: #fff; /* White text color */
  text-align: center; /* Centered text */
  border-radius: 2px; /* Rounded borders */
  padding: 8px; /* Padding */
  position: fixed; /* Sit on top of the screen */
  z-index: 1; /* Add a z-index if needed */
  right: 0px; /* Center the snackbar */
  top: 76px; /* 30px from the bottom */
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
  from {right: -30px; opacity: 0;}
  to {right:0px; opacity: 1;}
}

@keyframes fadein {
  from {right: -30px; opacity: 0;}
  to {right: 0px; opacity: 1;}
}

/* @-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
} */
	</style>

<div class="chat_new">
   
<div id="snackbar"> <h2>{{ __("We're trying to reconnect again!") }}</h2></div>
                        <div class="right_chat">
                            <div class ="chats_container">
                                <h2>{{ __('Chats') }}</h2> 
                            </div>
                            <ul class="m-0 chat-ul" style="height:1px;">
                                <li id="client_{{ Helper::client_chat_global()['admin']->id }}">
                                    <div class="imge_wrappe" style="padding:0px;" data-id="{{ Helper::client_chat_global()['admin']->id }}" data-name="{{ Helper::client_chat_global()['admin']->name }}">
                                        <div class="data_line">
                                            
                                            <div class ="first_data w-100">
                                                <div class="d-flex justify-content-between">
                                                    <span class="client_name"></span>
                                                    <span class="badge" id="admin_badgei" data-id="{{ Helper::client_chat_global()['admin']->id }}"></span>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div> 
                                </li>
                            </ul>




       

                            <div class="form-group">
                            <input type="text" placeholder="{{ __('Search a client to chat') }}" class="autocompate_chat_clients form-control">
                            </div>
                            <ul class="over-flow" id="client_container">
                               
                            </ul>
                        </div>
                        <div class="facomments_point right_col_dummy"><i class="fa fa-comments" aria-hidden="true"></i></div>
                        <div class="right_column">
                            <div class="text-details header">
                                <div class="item_t">
                                <img src="{{ asset('assets/images/user/user.png') }}" alt="User" />
                                </div>
                                <div class="lite_ew ">
                                    <h4 id="otherUserName"></h4>
                                </div>
                            </div>
                            <div class="home-chat" id="message_container">
                               
                            </div>
                           
                               
                            <div class="footer">
                                <div class="chat_point">
                                    <textarea id="sendMessageInput" maxlength="1000" onkeypress="return AvoidSpace(event)" class="form-control" placeholder="{{ __('Type here...') }}"></textarea>

                                </div>
                                <i class="fa fa-paper-plane" id="sendMessageButton" aria-hidden="true"></i>
                                <form id="attachment_form" enctype="multpart/form-data">
                                   
                                <input type="file" hidden name="attachment" id="send_attachment" accept="image/*"/> 
                                    <input type="text" value="{{Auth::user()->id}}" hidden name="from_user_id" id="from_user_id" /> 
                                    <input type="text" hidden name="to_user_id" id="to_user_id" /> 

                                    @csrf

                                </form> 

                                    <i class="fa fa-paperclip" title="Upload attachment" style="cursor:pointer;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                                $clientId = $_GET['id'] ?? '';
                    if ($clientId > 0) {?>
                                        <script>
                                        var clientId = '<?php echo $clientId; ?>';
                                        
                                        
                                            $(function() {
                                                laws.displayProcessing("Processing...");
                                                setTimeout(function() {
                                                $.systemMessage.close();
                                                $("li#client_" + clientId+' > .imge_wrappe').click();
                                            }, 1000);
                                            });                               
                                        </script>
                                        <?php
                    }
                    ?>

                    


<script>
    
$(document).on('input', ".autocompate_chat_clients", function(e) {
$(this).autocomplete({
    'classes': {
        "ui-autocomplete": "custom-ui-autocomplete"
    },
    'source': function(request, response) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: '<?php echo route("attorney_client_search"); ?>',
            data: {
                keyword: encodeURIComponent(request['term'])
            },
            dataType: 'json',
            type: 'post',
            success: function(json) {
				json = json.data;
                response($.map(json, function(item) {
                    return {
                        label: item['client_name'],
                        client_id: item['client_id']
                    };
                }));
            },
        });
    },
    select: function(event, ui) {
        $(this).val(ui.item.label);
        var n =$(this).attr('name');
       // ui.item.label
       $("li#client_" + ui.item.client_id+' > .imge_wrappe').click();
       var url = "clientchat?id="+ui.item.client_id;
       window.location.href = url;
    }
  });
});

</script>

@endsection
