@php
    // Initialize and validate current spouse employer data
    $currentEmployerData = Helper::validate_key_value('currentEmployerSpouse', $income_info);
    $currentEmployerData = !empty($currentEmployerData) ? $currentEmployerData : [];
    
    // Cache employment status for performance
    $isEmployed = count($currentEmployerData) > 0;
@endphp
<div class="part-a outline-gray-border-area">
    <div class="light-gray-div">
        <div class="light-gray-box-form-area">
            <h2 class="  align-items-center ">
                <span class="">{{ $spousename }} Employer Information </span>                    
            </h2>
            <div class="row gx-3 set-mobile-col">
                <div class="col-md-12 ">
                    <div class="outline-gray-border-area" >
                        <div class="section-title-div mb-4 mt-2">
                            <h3 class=""> 
                                Spouse is: 
                                @if($isEmployed)
                                    <span class='font-weight-normal text-success'>Employed</span>
                                @else
                                    <span class='font-weight-normal text-danger'>Not Employed</span>
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                {{-- Current Spouse Employer Information Section --}}
                @if($isEmployed)
                    @include("client.questionnaire.income.ajax_summary.employer_summary_only_att_side",[ 'currentEmployerData' => $currentEmployerData ])
                @endif
                
                {{-- Previous Spouse Employer Information Section --}}
                @php
                    $previousEmployerData = Helper::validate_key_value('previousEmployerSpouse', $income_info);
                    $hasPreviousEmployers = !empty($previousEmployerData) && count($previousEmployerData) > 0;
                @endphp
                
                @if($hasPreviousEmployers)
                <div class="col-md-12 ">
                    <div class="outline-gray-border-area" >
                        <div class="section-title-div mb-4 mt-0">
                            <h3 class=""> 
                                Previous W-2 Employers Within Current CMI
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 outline-gray-border-area">
                    @foreach($previousEmployerData as $key => $data)
                        <div class="light-gray-div">
                            <div class="light-gray-box-form-area">
                                <h2 class="font-weight-bold label-heading align-items-center ">
                                    <div class=" circle-number-div">{{ $key + 1 }}</div>
                                    <span class="item-label">Previous Employer: </span>                    
                                </h2>
                                <div class="row gx-3 set-mobile-col">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold">Name of employer: <span class="font-weight-normal">{{ Helper::validate_key_value('employer_name', $data) }}</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="font-weight-bold text-c-light-blue">Start Date: <span class="font-weight-normal">{{ Helper::validate_key_value('start_date', $data) }}</span></label>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="font-weight-bold text-c-light-blue">End Date: <span class="font-weight-normal">{{ Helper::validate_key_value('end_date', $data) }}</span></label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="font-weight-bold">Pay Frequency:
                                            <span class="font-weight-normal">{{ Helper::getPayFrequencyLabel(Helper::validate_key_value('frequency', $data)) }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
