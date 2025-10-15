@php
    $reviewUrl = $attorney_company->attorney_review_url ?? '';
    $find_us = Helper::validate_key_value('find_us', $details);
    $eAA = \App\Helpers\ArrayHelper::getEmergencyAssessmentArray();
    $findUsArray = \App\Helpers\ArrayHelper::getFindUsArray();
@endphp

@if(!empty($find_us))
    @php
        $find_us = json_decode($find_us, true);
        $dataFor = 'discover-us-info';
        $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
    @endphp

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="light-gray-div">
                <h2>Find Us Information</h2>
                <div class="intake-edit-div">
                    <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}" onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                        <span class="text-bold" style="min-width: 80px !important;"> <i class="bi bi-clock-history"></i> History </span>
                    </a>
                    <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')" class="ml-2 edit edit-section-btn">
                        <span class="text-bold" style="min-width: 80px !important;"><i class="bi bi-pencil-square"></i> Edit </span>
                    </a>
                </div>
                
                <div class="row gx-3 {{ $dataFor }} summary-div">
                    @if(!empty($find_us) && is_array($find_us))
                        <div class="col-md-12">
                            <p class="">
                                <span class="fw-bold">How did you find {{ $attorney_company->company_name }}: </span>
                                @php
                                    $howFindUs = [];
                                    foreach ($find_us as $key => $status) {
                                        if ($status == 1) {
                                            $howFindUs[] = Helper::validate_key_value($key, $findUsArray);
                                        }
                                    }
                                @endphp
                                {{ implode(', ', $howFindUs) }}
                            </p>
                        </div>
                    @endif

                    <div class="col-md-12 {{ array_key_exists(14, $find_us) }}">
                        <div class="d-flex align-items-center mb-3">
                            <span class="fw-bold">If referred by some not listed, what is their name:</span>&nbsp;
                            <p class="m-0">{{ Helper::validate_key_value('find_us_referred_by', $details) }}</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-flex align-items-center mb-3">
                            <span class="fw-bold">Have you read our Google reviews:</span>&nbsp;
                            <p class="m-0">{{ $details['google_reviews'] == 1 ? 'Yes / Some' : 'No' }}</p>
                            
                            @if(!empty($reviewUrl))
                                <div class="ml-auto" 
                                     {{ (Helper::validate_key_value('google_reviews', $details, 'radio') == 0 && isset($is_print)) ? 'style="display: block;"' : 'style="display: none;"' }}>
                                    <button type="button" class="btn-submit-success blink mb-0" onclick="window.open('{{ $reviewUrl }}', '_blank');">
                                        <i class="bi bi-star-fill me-2"></i> Click to see {{ $attorney_company->company_name }} reviews
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="">
                            <span class="fw-bold">Zoom Video Conference Experience: </span> {{ $details['zoom_exp'] == 1 ? 'Comfortable with Zoom' : 'Need Help with Zoom' }}
                        </p>
                    </div>
                </div>
                <div class="row gx-3 {{ $dataFor }} edit-div hide-data">
                    <div class="col-12">
                        <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                              action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                              method="post" 
                              novalid>
                            @csrf
                            <div class="mb-3">
                                @include('intake_form.questions.discover_us', ['formData' => $finalDetails, 'is_print' => $is_print])
                            </div>
                            <div class="bottom-btn-div px-0">
                                <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                                        onclick="closeIntakeForm('{{ $dataFor }}')"> Close
                                </button>
                                <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                                        onclick="submitIntakeForm('{{ $dataFor }}')"> Save Find Us Info
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif