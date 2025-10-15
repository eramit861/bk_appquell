<?php
$route = route('admin_simpletext_messages_send');
if (isset($senderName) && !empty($senderName)) {
    $route = route('attorney_simpletext_messages_send');
}
?>

<div class="modal-dialog modal-xl messagePopup m-0 information-area ">
    <div class="modal-content modal-content-div">
        <div class="modal-header align-items-center py-2 head">
            <h5 class="modal-title d-flex align-items-center w-100 text-c-white" id="invitemodalLabel">
                <i class="fas fa-envelope me-2"></i> {{$name??'Messages'}}
            </h5>
        </div>
        <div class="modal-body body p-0">
            <div class="card-body b-0-i">
                <?php if (!empty($content)) { ?>
                <?php $i = 1;
                    $content = array_reverse($content);
                    foreach ($content as $key => $data) {  ?>
                <?php //$messageFor = $data['directionType']=='MO' ? 'adminMessage' : 'clientMessage';?>
                <?php if ($data['directionType'] != 'MO') { ?>
                    <div class="row adminMessage">
                        <div class="col-0 col-md-1"></div>
                        <div class="col-9 col-md-10">
                            <div class="messageBubble">
                                <?php echo nl2br($data['text']); ?>
                            </div>
                            <p class="w-100 mb-0"><i><span class="addedOn addedOnRight">{{DateTimeHelper::dbDateToDisplay($data['timestamp'],true)}}</span></i></p>
                            <div class="tail"></div>
                        </div>
                        <div class="col-2 col-md-1">
                            <?php if (isset($senderName)) {
                                $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', Auth::user()->id)->first();
                                $attorney_company = !empty($attorney_company) ? $attorney_company : [];
                                $company_logo = (isset($attorney_company) && !empty($attorney_company['company_logo'])) ? $attorney_company['company_logo'] : '';
                                if (!empty($company_logo)) {
                                    ?>
                                <label class="profileBubble bg-none"><img width="41" height="36" alt="user" src="<?php echo asset('assets/img/bk1.png');?>" /></label>
                                <?php } else {
                                    $first_character_sender_name = mb_substr($senderName, 0, 1);?>
                                    <label class="profileBubble">{{$first_character_sender_name}}</label>
                                    <?php } ?>
                            <?php } else { ?>
                            <label class="profileBubble bg-none"><img width="41" height="36" alt="user" src="<?php echo asset('assets/img/bk1.png');?>" /></label>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($data['directionType'] == 'MO') { ?>
                    <div class="row clientMessage">
                        <div class="col-1 justify-content-center">
                            <label class="profileBubble"><?php echo substr($name, 0, 1); ?></label>
                        </div>
                        <div class="col-10">
                            <div class="messageBubble ">
                                <?php echo nl2br($data['text']); ?>
                            </div>
                            <p class="w-100 mb-0"><i><span class="addedOn addedOnLeft">{{DateTimeHelper::dbDateToDisplay($data['timestamp'],true)}}</span></i></p>                        
                            <div class="tail"></div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                <?php } ?>
                <?php ?>
                <?php $i++;
                    }
                } else { ?>
                    <div class="noMessage"> 
                        <img src="{{url('assets/img/chat.svg')}}" alt="user"/>
                        <label>No messages</label>
                    </div>
                <?php } ?>
                <div class="bottom"></div>
            </div>
        </div>
        <div class="col-12 foot light-gray-div mb-0">
            <form id="add_form" enctype="multipart/form-data" action="{{$route}}" method="post">
                @csrf
                <div class="form-group pt-3 row ">
                    <div class="col-12 col-sm-10">
                        <div class="label-div mb-0">
                            <textarea required rows="3" class="form-control h-unset" id="message" name="message" placeholder="Write a message.."></textarea>
                        </div>
                        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                    </div>
                    <div class="col-12 col-sm-2">
                        <button type="submit" class="print-hide submitButton btn-new-ui-default ">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('.content').animate({scrollTop:$('.body').height()}, 'fast');
        $("#add_form").validate({
            errorPlacement: function (error, element) {
                if($(element).parents(".form-group").next('label').hasClass('error')){
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }else{
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            },
        });
    });
</script>
<style>
.large-fb-width{
    height: unset;
}
label.error {color: red;font-style: italic;  }
th{
border-top: 1px solid #eaeaea;
border-bottom: 1px solid #eaeaea;
color: #414141;
}
table thead {
background-color: #EDEEF0;
} 
table thead th{
padding: 5px 10px 5px 10px;
}
table tbody td{
padding: 5px 10px 5px 10px;
}
table tbody td{
border-top: 1px solid #eaeaea;
}
.admin-msg{background-color:#fafafa;}
.my-msg{text-align:right;}

.id-control{
padding: 3px 12px;
}
#facebox .content.fbminwidth {
min-width: 650px;
max-width: 850px;
min-height: 150px;
}
.card .card-block, .card .card-body {
padding: 30px 15px;
}
.update{
color: #012cae;
cursor: pointer;
}

#facebox .content {
    padding-top: 0;
    padding-bottom: 0;
    border-radius: 6px;
    overflow-y: scroll !important;
    scrollbar-width: none !important; /* Firefox */
    -ms-overflow-style: none !important; /* IE 11 */
}
#facebox .content::-webkit-scrollbar {
    display: none !important; /* Chrome, Safari, Edge */
}

.messagePopup{
    /* padding: 0rem 1rem; */
}
.messagePopup .head{
    background: rgb(0,22,87);
    background: linear-gradient(90deg, rgba(0,22,87,1) 11%, rgba(14,66,223,1) 100%);
    padding: 0rem 1.5rem;
    border-radius: 0.25rem 0.25rem 0rem 0rem;
}
.messagePopup .head h4{
    color: #ffffff;
}
.messagePopup .body{
    /* background: #ffffff; */
    padding: 1rem 1.5rem;
}
.messagePopup .body .profileBubble{
    text-align: center;
    background: #e3e3e3;
    border-radius: 50%;
    font-size: 20px;
    font-weight: 600;
    height: 45px;
    width: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.messagePopup .body .messageBubble{
    padding: 0.75rem 1rem;
    width: auto;
    display: inline-block;
    position: relative;
}
.messagePopup .body .adminMessage{
    margin-top: 0.75rem;
}
.messagePopup .body .clientMessage{
    margin-top: 0.75rem;
}
.messagePopup .body .adminMessage .messageBubble{
    background: #f4f5f7;
    float: right;
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    border-radius: 10px 0px 10px 10px;
    word-wrap: anywhere;
}
.messagePopup .body .clientMessage .messageBubble{
    background: #ebf2fc;
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    border-radius: 0px 10px 10px 10px;
}


.messagePopup .body .tail{
    height: 18px;
    width: 18px;
    position: absolute;
    border-radius: 50%;
    &:before{
        height: 9px;
        width: 9px;
        content: '';
        display: block;
        border-radius: 50%;
        position: absolute;
    }
}
.messagePopup .body .adminMessage .tail{
    background: #f4f5f7;
    right: 7px;
    top: 12px;
    &:before{
        height: 9px;
        background: #f4f5f7;
        right: -10px;
        top: 0px;
    }
}

.messagePopup .body .clientMessage .tail{
    background: #ebf2fc;
    left: 7px;
    top: 12px;
    &:before{
      height: 9px;
      background: #ebf2fc;
      left: -10px;
      top: 0px;
    }
}

.messagePopup .body .noMessage{
    text-align: center;
    width: 100%;
}
.messagePopup .body .noMessage img{
    opacity: 0.1;
    height: 100px;
    width: 100px;
}
.messagePopup .body .noMessage label{
    width: 100%;
    font-weight: 600;
    color: #6a6969;
}
.messagePopup .body .addedOn{
    color: #6a6969;
    font-size:12px;
}
.messagePopup .body .addedOn.addedOnLeft{
    position: absolute;
    bottom: -6px;
    left: 15px;
}
.messagePopup .body .addedOn.addedOnRight{
    position: absolute;
    bottom: -6px;
    right: 15px;
}
.messagePopup .foot{
    background: #eaf1fb;
    padding: 0rem 1.5rem;
    border-radius: 0rem 0rem 0.25rem 0.25rem ;
}
.messagePopup .foot .submitButton{
    background: #0e42df;
    color: #ffffff;
    border: none;
    border-radius: 0.4rem ;
    float: right;
    padding: 10px 18px;
    font-weight: 600;
}

.head, .foot {
    position: -webkit-sticky;
    position: sticky;
    background-color: white;
    z-index: 1000;
    border-bottom: 1px solid #eaeaea;
    padding: 1rem;
}
.head {
    top: 0;
}
.foot {
    bottom: 0;
}
.messagePopup .body .profileBubble.bg-none{
    background-color: #ffffff;
    border: 2px solid #012cae;
}

.messagePopup .body .profileBubble  img{
    padding: 5px;
    
}
</style>
