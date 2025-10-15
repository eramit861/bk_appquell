<div class="modal-content modal-content-div conditional-ques">

    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            <i class="bi bi-bank me-2"></i> {{ $formLabel }}
        </h5>

        <a href="javascript:void(0)" class="close-modal btn-new-ui-default bg-white att-video py-1" data-bs-toggle="modal"
            onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video"
            data-video="{{ $invite_video['en'] }}" data-video2="{{ $invite_video['sp'] }}">
            <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" alt="Video Logo" style="height: 26px;">
        </a>
    </div>
    <form id="creditor_select_for_import_form" name="creditor_select_for_import_form" action="{{ $formRoute }}"
        method="post" novalidate>
        @csrf
        <div class="modal-body">

            <div class="row ">
                @if(!empty($creditors))
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <h6 class="blink text-c-red mb-2 me-3 text-center w-100">
                            <strong>
                                If you wish to import all creditors select the import button on the bottom of the pop up
                            </strong>
                        </h6>
                        <div class="float_right mb-2 d-flex-ai-center">
                            <span class="section-edit-div text-success cursor-pointer me-2" id="selectAllBtn"
                                style="font-style: initial;">Select&nbsp;All&nbsp;Creditor(s)</span>
                            <span class="section-edit-div text-danger cursor-pointer" id="deselectAllBtn"
                                style="font-style: initial;">Deselect&nbsp;All&nbsp;Creditor(s)</span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @foreach($creditors as $type => $creditorData)
                    <div class="light-gray-div d-block {{ $type == 'unsecured' ? 'mb-0' : '' }}">
                        <h2>{{ ArrayHelper::getDebtTypeLabels($type) }}</h2>
                        <div class="row  ">
                            @if(!empty($creditorData))
                                @php $i = 1; @endphp
                                @foreach($creditorData as $creditorIndex => $creditorInfo)
                            <div class="col-12 col-md-3">
                                <div class="label-div mb-2">
                                    <div class="input-group bg-unset mb-0">
                                        <div class="mb-0 p-1 text-bold w-100 px-2 creditor-block"
                                            data-creditor-checkbox>
                                            <input type="checkbox" class="d-none parent-checkbox"
                                                name="{{ $type }}[{{ $creditorIndex }}]" checked value="1">
                                            <p class="mb-0">{{ Helper::validate_key_value('name', $creditorInfo) }}
                                            </p>
                                            <p class="mb-0">{{ Helper::validate_key_value('address', $creditorInfo) }}
                                            </p>
                                            <p class="mb-0">{{ Helper::validate_key_value('misc', $creditorInfo) }}
                                            </p>

                                            @if(isset($creditorInfo['noticingPartyData']) && !empty($creditorInfo['noticingPartyData']))
                                            @if($type == 'domestic_support')
                                            <p class="mb-0 underline mt-2">Noticing Party:</p>
                                            @endif
                                            @foreach($creditorInfo['noticingPartyData'] as $partyIndex => $partyData)
                                            <div class="np-card mb-2 mt-1 p-1">
                                                <input type="checkbox" class="d-none np-checkbox"
                                                    name="{{ $type }}_np[{{ $creditorIndex }}][{{ $partyIndex }}]" checked value="1">
                                                <p class="fs-12px mb-0 underline">
                                                    {{ Helper::validate_key_value('label', $partyData) }}</p>
                                                <p class="fs-12px mb-0">
                                                    {{ Helper::validate_key_value('name', $partyData) }}</p>
                                                <p class="fs-12px mb-0">
                                                    {{ Helper::validate_key_value('address', $partyData) }}</p>
                                                <p class="fs-12px mb-0">
                                                    {{ Helper::validate_key_value('misc', $partyData) }}</p>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $i++; @endphp
                                @endforeach
                            @else
                            <div class="col-12 col-md-12">
                                <div class="label-div mb-2">
                                    <div class="input-group bg-unset mb-0">
                                        <label class="mb-0">
                                            No creditor(s) found.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    @endforeach
                </div>
                @else
                <div class="col-12">
                    <div class="outline-gray-border-area">
                        <strong class="subtitle border-0">No creditor(s) found.</strong>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class="modal-footer border-0 pt-2">
            <div class="bottom-btn-div">
                <button type="button"
                    class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 {{ !empty($creditors) ? 'me-3' : '' }}"
                    onclick="$.facebox.close();cleanImportPopupHTML();">Close</button>
                <button type="button" onclick="submitCreditorForm(0)"
                    class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 {{ !empty($creditors) ? 'me-3' : 'hide-data' }}">{{ $submitLabel }}</button>
                <button type="button" onclick="submitCreditorForm(1)"
                    class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 {{ !empty($creditors) ? '' : 'hide-data' }}">{{ $submitWithBalanceLabel }}</button>
            </div>
        </div>
    </form>

</div>
<script>
    $(document).ready(function() {

        function updateLabelState(checkbox) {
            const $checkbox = $(checkbox);
            const $container = $checkbox.closest('.input-group');

            if ($checkbox.is(':checked')) {
                $container.addClass('label-selected').removeClass('label-not-selected');

                // Check all child np-checkboxes
                $container.find('.np-checkbox').prop('checked', true).each(function() {
                    updateNpCardState(this);
                });
            } else {
                $container.addClass('label-not-selected').removeClass('label-selected');

                // Uncheck all child np-checkboxes
                $container.find('.np-checkbox').prop('checked', false).each(function() {
                    updateNpCardState(this);
                });
            }
        }


        function updateNpCardState(checkbox) {
            const $checkbox = $(checkbox);
            const $card = $checkbox.closest('.np-card');
            if ($checkbox.is(':checked')) {
                $card.addClass('np-label-selected').removeClass('np-label-not-selected');
            } else {
                $card.addClass('np-label-not-selected').removeClass('np-label-selected');
            }
        }

        function updateButtonVisibility() {
            const $checkboxes = $('#creditor_select_for_import_form input[type="checkbox"]:not(.np-checkbox)');
            const total = $checkboxes.length;
            const checked = $checkboxes.filter(':checked').length;

            if (checked === total) {
                $('#selectAllBtn').hide().removeClass('me-2');
                $('#deselectAllBtn').show();
            } else if (checked === 0) {
                $('#selectAllBtn').show().removeClass('me-2');
                $('#deselectAllBtn').hide();
            } else {
                $('#selectAllBtn').show().addClass('me-2');
                $('#deselectAllBtn').show();
            }
        }

        // When any checkbox changes
        $('#creditor_select_for_import_form').on('click', 'input[type="checkbox"]', function() {
            if ($(this).hasClass('np-checkbox')) {
                updateNpCardState(this);
            } else {
                updateLabelState(this);
                updateButtonVisibility();
            }
        });

        $(document).off('click', '.np-card');
        // Handle np-card click
        $(document).on('click', '.np-card', function(e) {
            if ($(e.target).is('input')) return;

            const $card = $(this);
            const $npCheckbox = $card.find('.np-checkbox');
            const $parentCheckbox = $card.closest('.input-group').find('.parent-checkbox').first();

            if ($parentCheckbox.is(':checked')) {
                $npCheckbox.trigger('click');
            } else {
                $.systemMessage('Please select the creditor first', 'alert--danger', true);
            }
        });

        $(document).off('click', '.creditor-block');
        // Handle creditor block click
        $(document).on('click', '.creditor-block', function(e) {
            if ($(e.target).is('.np-card') || $(e.target).closest('.np-card').length > 0 || $(e.target)
                .is('input')) {
                return; // Prevent toggle if np-card is clicked
            }

            const $checkbox = $(this).find('.parent-checkbox');
            $checkbox.trigger('click');
        });

        $('#selectAllBtn').on('click', function() {
            $('.parent-checkbox').prop('checked', true).each(function() {
                updateLabelState(this);
            });

            $('.np-checkbox').prop('checked', true).each(function() {
                updateNpCardState(this);
            });

            updateButtonVisibility();
        });

        $('#deselectAllBtn').on('click', function() {
            $('.parent-checkbox').prop('checked', false).each(function() {
                updateLabelState(this);
            });

            $('.np-checkbox').prop('checked', false).each(function() {
                updateNpCardState(this);
            });

            updateButtonVisibility();
        });

        // Initialize state
        $('input.parent-checkbox').each(function() {
            updateLabelState(this);
        });

        $('input.np-checkbox').each(function() {
            updateNpCardState(this);
        });

        updateButtonVisibility();

        // === jQuery validation (unchanged) ===
        $("#creditor_select_for_import_form").validate({
            errorPlacement: function(error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            },
        });


    });

    function submitCreditorForm(forValue) {
        const form = document.getElementById("creditor_select_for_import_form");

        if (forValue === 1) {
            let actionUrl = form.getAttribute("action");

            // Check if action already has query params
            if (actionUrl.includes("?")) {
                actionUrl += "&creditorWithBalance=1";
            } else {
                actionUrl += "?creditorWithBalance=1";
            }

            form.setAttribute("action", actionUrl);
        }

        form.submit();
    }
</script>
