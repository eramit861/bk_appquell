<div class="row">
    <div class="col-md-6 col-12">
        <div class="light-gray-div mt-2">
            <div class="light-gray-box-form-area">
                <h2 class="align-items-center">
                    <span class="">Not Logged In Client(s)</span>
                </h2>
                <a href="javascript:void(0)" onclick="openTemplatePreview(1)" class="ml-2 att-edit-div blue-section-btn">
                    <span class="text-bold">
                        <i class="bi bi-eye"></i> Preview
                    </span>
                </a>
                <form id="automated_notification_template_setup_form_for_not_logged_in_user"
                    action="{{ route('automated_notification_template_setup') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="body" value="{{ \App\Models\NotificationTemplate::NOTLOGGEDINUSER }}">

                    <div class="row gx-3 set-mobile-col">
                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">From</label>
                                    <input required type="text" disabled readonly
                                        value="{{ $filtered_mail ?? '' }}"
                                        class="form-control"
                                        placeholder="From email">
                                    <small class="text-muted d-block">Clients will receive emails from this address.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Subject</label>
                                    <input required name="subject" type="text" id="subject_not_logged"
                                        value="{{ old('subject', collect($templates)->where('noti_tenp_body', \App\Models\NotificationTemplate::NOTLOGGEDINUSER)->first()['noti_tenp_subject'] ?? '') }}"
                                        class="input_capitalize form-control {{ $errors->has('subject') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Subject">
                                </div>
                                @if ($errors->has('subject'))
                                    <p class="help-block text-danger">{{ $errors->first('subject') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div mb-0">
                                <div class="form-group mb-0">
                                    <label for="">Time Frame</label>
                                    <div class="radio-group mt-2">
                                        <?php
                                        $notLoggedTemplate = collect($templates)->where('noti_tenp_body', \App\Models\NotificationTemplate::NOTLOGGEDINUSER)->first();
                                        $notLoggedTimeFrame = $notLoggedTemplate['time_frame'] ?? old('time_frame');
                                        ?>
                                        <input type="radio" required name="time_frame" id="time_frame_1_not_logged"
                                            value="1" {{ $notLoggedTimeFrame == '1' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_1_not_logged"
                                            onclick="selectRadio('time_frame_1_not_logged')">Weekly</span>

                                        <input type="radio" required name="time_frame" id="time_frame_2_not_logged"
                                            value="2" {{ $notLoggedTimeFrame == '2' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_2_not_logged"
                                            onclick="selectRadio('time_frame_2_not_logged')">Biweekly</span>

                                        <input type="radio" required name="time_frame" id="time_frame_3_not_logged"
                                            value="3" {{ $notLoggedTimeFrame == '3' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_3_not_logged"
                                            onclick="selectRadio('time_frame_3_not_logged')">Every Three Weeks</span>

                                        <input type="radio" required name="time_frame" id="time_frame_4_not_logged"
                                            value="4" {{ $notLoggedTimeFrame == '4' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_4_not_logged"
                                            onclick="selectRadio('time_frame_4_not_logged')">Monthly</span>
                                    </div>
                                    @if ($errors->has('time_frame'))
                                        <p class="help-block text-danger">{{ $errors->first('time_frame') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div
                                class="bottom-btn-div align-items-md-center align-items-start d-flex flex-md-row flex-column">
                                <button type="submit" class="btn-new-ui-default cursor-pointer mb-3 mt-sm-0 mt-1">Click
                                    here to Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="light-gray-div mt-2">
            <div class="light-gray-box-form-area">
                <h2 class="align-items-center">
                    <span class="">Questionnaire not completed Client(s)</span>
                </h2>
                <a href="javascript:void(0)" onclick="openTemplatePreview(2)"
                    class="ml-2 att-edit-div blue-section-btn">
                    <span class="text-bold">
                        <i class="bi bi-eye"></i> Preview
                    </span>
                </a>
                <form id="automated_notification_template_setup_form_for_logged_in_user"
                    action="{{ route('automated_notification_template_setup') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="body" value="{{ \App\Models\NotificationTemplate::LOGGEDINUSER }}">

                    <div class="row gx-3 set-mobile-col">
                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">From</label>                                    
                                    <input required type="text" disabled readonly
                                        value="{{ $filtered_mail ?? '' }}"
                                        class="form-control"
                                        placeholder="From email">
                                    <small class="text-muted d-block">Clients will receive emails from this address.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="label-div">
                                <div class="form-group mb-0">
                                    <label for="">Subject</label>
                                    <input required name="subject" type="text" id="subject_logged"
                                        value="{{ old('subject', collect($templates)->where('noti_tenp_body', \App\Models\NotificationTemplate::LOGGEDINUSER)->first()['noti_tenp_subject'] ?? '') }}"
                                        class="input_capitalize form-control {{ $errors->has('subject') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Subject">
                                </div>
                                @if ($errors->has('subject'))
                                    <p class="help-block text-danger">{{ $errors->first('subject') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div mb-0">
                                <div class="form-group mb-0">
                                    <label for="">Time Frame</label>
                                    <div class="radio-group mt-2">
                                        <?php
                                        $loggedTemplate = collect($templates)->where('noti_tenp_body', \App\Models\NotificationTemplate::LOGGEDINUSER)->first();
                                        $loggedTimeFrame = $loggedTemplate['time_frame'] ?? old('time_frame');
                                        ?>
                                        <input type="radio" required name="time_frame" id="time_frame_1_logged"
                                            value="1" {{ $loggedTimeFrame == '1' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_1_logged"
                                            onclick="selectRadio('time_frame_1_logged')">Weekly</span>

                                        <input type="radio" required name="time_frame" id="time_frame_2_logged"
                                            value="2" {{ $loggedTimeFrame == '2' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_2_logged"
                                            onclick="selectRadio('time_frame_2_logged')">Biweekly</span>

                                        <input type="radio" required name="time_frame" id="time_frame_3_logged"
                                            value="3" {{ $loggedTimeFrame == '3' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_3_logged"
                                            onclick="selectRadio('time_frame_3_logged')">Every Three Weeks</span>

                                        <input type="radio" required name="time_frame" id="time_frame_4_logged"
                                            value="4" {{ $loggedTimeFrame == '4' ? 'checked' : '' }}
                                            style="display: none;">
                                        <span class="attribute_bubble radio-label time_frame_4_logged"
                                            onclick="selectRadio('time_frame_4_logged')">Monthly</span>
                                    </div>
                                    @if ($errors->has('time_frame'))
                                        <p class="help-block text-danger">{{ $errors->first('time_frame') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="bottom-btn-div align-items-md-center align-items-start d-flex flex-md-row flex-column">
                                <button type="submit"
                                    class="btn-new-ui-default cursor-pointer mb-3 mt-sm-0 mt-1">Click here to
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    openTemplatePreview = function(templateType) {
        var ajaxurl = "<?php echo route('automated_notification_template_preview'); ?>";
        laws.ajax(ajaxurl, {templateType: templateType}, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                laws.updateFaceboxContent(res.html, 'large-fb-width bg-unset min-w-750px');
                
                // Add event listener for facebox close to clean up HTML
                $(document).on('afterClose.facebox', function() {
                    $('#facebox .content').empty();
                });
            }
        });
    }
</script>