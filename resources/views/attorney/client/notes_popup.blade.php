@php
$isIntakeClient = isset($isIntakeClient) ? $isIntakeClient : false ;
if ($isIntakeClient) {
    $client_id = '';
} //'Concierge Service'
$label = (isset($isConciergeClient) && $isConciergeClient == 1) ? "Notes Added by Concierge Service:" : "Notes Added by Attorney/Law Firm:";
$noMessageLabel = "No messages";
$subjectPlaceholder = "Write message subject..";
$messagePlaceholder = "Write a message..";
if ($isAdmin || $isIntakeClient) {
    $label = "Notes";
    $noMessageLabel = "No notes";
    $subjectPlaceholder = "Write note subject..";
    $messagePlaceholder = "Write a note..";
}
$subjectValue = "";
if ($isIntakeClient) {
    $subjectValue = "Initial Client Intake Notes";
}

$video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_NOTES_ADDED_BY_ATTORNEY_VIDEO);
$route = route('add_attorney_notes');
if ($isAdmin) {
    $route = route('update_notes');
}
if ($isIntakeClient) {
    $route = route('attorney_short_form_notes_save');
}
@endphp


<div class=" messagePopup m-0 information-area ">
    <div class="modal-content modal-content-div">
        <div class="modal-header align-items-center py-2 head">
            <h5 class="modal-title d-flex align-items-center w-100 text-c-white" id="invitemodalLabel">
                {{ $label }}
            </h5>
            @if(!$isAdmin && !$isIntakeClient)
                <a href="javascript:void(0)" class="close-modal btn-new-ui-default float-right bg-white att-video py-1 me-2 notes-popup-att-video" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] ?? '' }}" data-video2="{{ $video['sp'] ?? '' }}">
                    <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}"  style="height: 26px;" alt="Video Logo">
                </a>
            @endif
        </div>
        <div class="modal-body body p-0">
            <div class="card-body b-0-i">
                @if(!empty($notes))
                    @php $i = 1; @endphp
                    @foreach($notes as $key => $data)
                        @php
                            $subject = (isset($data['subject']) && !empty($data['subject'])) ? "Subject: ".$data['subject'] : 'Subject: (no subject)' ;
                        @endphp
                @if($isAdmin)
                    @if(($data['added_by_id'] == 1) || empty($data['added_by_id']))
                        <div class="row adminMessage w-100">
                            <div class="col-0 col-sm-1"></div>
                            <div class="col-10">
                                <div class="messageBubble">
                                    <p class="messageSubject m-0" onclick="toggleMessageView({{ $i }})" >{{ $subject }}</p> 
                                    <p class="message_no_{{ $i }} hidden m-0 messageBody">{!! nl2br($data['note']) !!} </p>
                                    @if(!empty($data['attachment_file']))
                                        @php $filepath = '/'.$data['attachment_file']; @endphp
                                        <p class="m-0"><a class="text-decoration-underline font-weight-bold  f-12" href="{{ $filepath }}" download ><i  class="fa fa-paperclip" aria-hidden="true"></i> Download attatchment</a></p>
                                    @endif
                                </div>
                                <p class="w-100 mb-0"><i><span class="addedOn addedOnRight">{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</span></i></p>
                                <div class="tail"></div>
                            </div>
                            <div class="col-1">
                                <label class="profileBubble bg-none"><img alt="icon" width="41" height="36" src="{{ asset('assets/img/bk1.png') }}" /></label>
                            </div>
                        </div>
                    @endif
                    @if($data['added_by_id'] > 1)
                        <div class="row clientMessage">
                            <div class="col-1 justify-content-center">
                                <label class="profileBubble">{{ substr('C', 0, 1) }}</label>
                            </div>
                            <div class="col-10">
                                <div class="messageBubble ">
                                    <p class="messageSubject m-0" onclick="toggleMessageView({{ $i }})" >{{ $subject }}</p> 
                                    <p class="message_no_{{ $i }} hidden m-0 messageBody">{!! nl2br($data['note']) !!}</p>
                                </div>
                                <p class="w-100 mb-0"><i><span class="addedOn addedOnLeft">{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</span></i></p>                        
                                <div class="tail"></div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    @endif
                @endif

                @if(!$isAdmin)
                    @if($data['added_by_id'] > 1)
                        <div class="row adminMessage w-100">
                            <div class="col-0 col-sm-1 p-0"></div>
                            <div class="col-10 col-sm-10">
                                <div class="messageBubble">
                                    <p class="messageSubject m-0" onclick="toggleMessageView({{ $i }})" >{{ $subject }}</p> 
                                    <p class="message_no_{{ $i }} hidden m-0 messageBody">{!! nl2br($data['note']) !!} </p>
                                </div>
                                <p class="w-100 mb-0"><i><span class="addedOn addedOnRight">{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</span></i></p>
                                <div class="tail"></div>
                            </div>
                            <div class="col-2 col-sm-1">
                                @if($isAdmin)
                                    <label class="profileBubble bg-none"><img alt="icon" width="41" height="36" src="{{ asset('assets/img/bk1.png') }}" /></label>
                                @else
                                    <label class="profileBubble">{{ substr('Y', 0, 1) }}</label>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if(($data['added_by_id'] == 1) || empty($data['added_by_id']))
                        <div class="row clientMessage">
                            <div class="col-1 justify-content-center">
                                @if($isAdmin)
                                    <label class="profileBubble">{{ substr('Y', 0, 1) }}</label>
                                @else
                                    <label class="profileBubble bg-none"><img alt="icon" width="41" height="36" src="{{ asset('assets/img/bk1.png') }}" /></label>
                                @endif
                            </div>
                            <div class="col-10">
                                <div class="messageBubble ">
                                    <p class="messageSubject m-0" onclick="toggleMessageView({{ $i }})" >{{ $subject }}</p> 
                                    <p class="message_no_{{ $i }} hidden m-0 messageBody">{!! nl2br($data['note']) !!} </p>
                                    @if(!empty($data['attachment_file']))
                                        @php $filepath = '/'.$data['attachment_file']; @endphp
                                        <p class="m-0"><a class="text-decoration-underline font-weight-bold  f-12" href="{{ $filepath }}" download ><i  class="fa fa-paperclip" aria-hidden="true"></i> Download attatchment</a></p>
                                    @endif
                                </div>
                                <p class="w-100 mb-0"><i><span class="addedOn addedOnLeft">{{DateTimeHelper::dbDateToDisplay($data['created_at'],true)}}</span></i></p>                        
                                <div class="tail"></div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    @endif
                @endif

                        @php $i++; @endphp
                    @endforeach
                @else
                    <div class="noMessage"> 
                        <img src="{{url('assets/img/chat.svg')}}" alt="chat"/>
                        <label>{{ $noMessageLabel }}</label>
                    </div>
                @endif
                <div class="bottom"></div>
            </div>
        </div>
        <div class="col-12 foot light-gray-div mb-0 br-0-i bl-0-i">
            <form id="add_form" enctype="multipart/form-data" action="{{$route}}" method="post">
                @csrf
                <div class="pt-3 d-flex align-items-center">
                    <div class="sendSectionIcon">
                        @if($isAdmin)
                            <label class="profileBubble admin-profile-icon bg-none mr-2"><img alt="icon" width="41" height="36" src="{{ asset('assets/img/bk1.png') }}" /></label>
                        @else
                            <label class="profileBubble mr-2">{{ substr('Y', 0, 1) }}</label>
                        @endif
                    </div>
                    <div class="mx-3 w-100 label-div mb-0">
                        <div class="form-group mb-0">
                        <div class="input-group bg-unset mb-0">
                            <input required type="text" class="form-control mb-2" name="category" placeholder="{{ $subjectPlaceholder }}" value="{{ $subjectValue }}" >
                        </div>
                        </div>
                        <div class="form-group mb-0">
                        <div class="input-group bg-unset ">
                            <textarea required rows="3" class="form-control h-unset" id="message" name="note"  placeholder="{{ $messagePlaceholder }}"></textarea>
                        </div>
                        </div>
                        <div class="form-group">
                        <input type="hidden" name="client_id" value="{{ $client_id }}">
                        @if($isAdmin)
                            <input type="file" name="attachment_file" class="attach-file mt-2"/>
                        @endif
                        </div>
                        @if($isIntakeClient)
                            <input type="hidden" name="questionnaire_id" value="{{ $questionnaire_id ?? '' }}">
                        @endif
                    </div>
                    <div class="">
                        <button type="submit" class="ml-2 print-hide submitButton cursor-pointer btn-new-ui-default px-1">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Include optimized CSS file --}}
<link href="{{ asset('assets/css/attorney/notes-popup.css') }}" rel="stylesheet">

<script>
    markShownNotes = function(client_id){
        laws.ajax('<?php echo route('mark_notes_as_shown'); ?>', { client_id:client_id }, function (response) {
                if(isJson(response)){
                var res = JSON.parse(response);
                    if (res.status == 0) {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    }else if(res.status == 1){
                        $.systemMessage(res.msg, 'alert--success', true);
                        $.facebox.close();
                    }
                } 
        });
    }

    toggleMessageView = function(index){
        var $message = $('.message_no_' + index);

        // Toggle visibility using CSS classes
        if ($message.hasClass('hidden')) {
            $message.removeClass('hidden').addClass('visible');
        } else {
            $message.removeClass('visible').addClass('hidden');
        }
    }

    $(document).ready(function(){
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
