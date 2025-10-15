<div class="row">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1');?>" value="{{$onlyDebtor}}">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2');?>" value="{{$spousename}}">
    <input type="hidden" name="<?php echo base64_encode('Text1');?>" value="{{$caseno}}">
    <input type="hidden" name="<?php echo base64_encode('Text2');?>" value="{{$chapterNo}}">
    <div class="88_d2 col-md-6">
        <div class="section-box">
            <div class="section-header bg-back text-white">
                <p class="font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
            </div>
            <div class="section-body padd-20">
                <div class="row">
                    <div class="88_d2 col-md-12">
                        <label>{{ __('District Of') }}</label>
                        <div class="input-group">
                            <select class="form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
                                <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="88_d2 col-md-12 padd-20">
        <div class="row">
            <div class="88_d2 col-md-12">
                <div class="form-title mb-3">
                    <h4>{{ __('Local Bankruptcy Form 1007-6.1') }}</h4>
                    <h2 class="font-lg-22">{{ __('Statement Under Penalty of Perjury Concerning Payment Advices') }}</h2> 
                </div>
            </div>
            <div class="88_d2 col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14">{{ __('Complete the applicable sections and check the applicable boxes.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Part 1 -->

    <div class="88_d2 col-md-12">
        <div class="row align-items-center">
            <div class="88_d2 col-md-12">
                <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                    <h2 class="font-lg-18">{{ __('Statement') }}</h2>
                </div>
            </div>
            
            <div class="88_d2 col-md-12">
                <p>
                    I, <input type="text" name="<?php echo base64_encode('I');?>" class="form-control width_30percent" value="{{$spousename}}"> <span class="text-bold">[name]<sup>1</sup></span> {{ __('state as follows:') }}
                </p>
                <p>
                    {{ __('I did not file with the court copies of some or all payment advices or other evidence of payment received within 60 days
                    before the date of the filing of the petition from any employer because:') }}
                </p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4');?>" class="form-control w-auto spouse_not_payment_received">
                    </div>
                    <div class="w-100">
                        <p>{{ __('I was not employed during the period immediately preceding the filing of the above-referenced case:') }}</p>
                        <input type="text" name="<?php echo base64_encode('Text3');?>" class="form-control">
                        <p class="text-bold">{{ __('[insert the dates you were not employed].') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5');?>" class="form-control w-auto spouse_payment_received">
                    </div>
                    <div class="">
                        <p>
                            {{ __('I was employed during the period immediately preceding the filing of the above referenced case but did not
                            receive any payment advices or other evidence of payment from my employer within 60 days before the date of
                            the filing of the petition.') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6');?>" class="form-control w-auto">
                    </div>
                    <div class="">
                        <p>
                            {{ __('I am self-employed and do not receive any evidence of payment from an employer.') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8');?>" class="form-control w-auto mt-2">
                    </div>
                    <div class=" w-100">
                        <p class="mb-0">
                            Other: <input type="text" name="<?php echo base64_encode('Other');?>" class="form-control width_90percent">
                        </p>
                        <p class="text-bold">{{ __('[please provide explanation].') }}</p>
                    </div>
                </div>
            </div>

            <div class="88_d2 col-md-12">
                <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                    <h2 class="font-lg-18">{{ __('Verification of Debtor') }}</h2>
                </div>
            </div>

            <div class="88_d2 col-md-12">
                <p>{{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}</p>
            </div>

            <div class="88_d2 col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Dated"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="88_d2 col-md-1">
                <label for="">By:</label>
            </div>
            <div class="88_d2 col-md-5">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Signature of Debtor"
                    inputFieldName="By"
                    inputValue={{$debtor2_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>

            <div class="88_d2 col-md-6 mt-1"></div>
            <div class="88_d2 col-md-2 mt-1">
                <label for="">{{ __('Mailing Address:') }}</label>
            </div>
            <div class="88_d2 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Mailing Address');?>" class="form-control" value="{{$spouseaddress}}, {{$spouseCity}} {{$spouseState}}, {{$spousezip}}">
            </div>

            <div class="88_d2 col-md-6 mt-1"></div>
            <div class="88_d2 col-md-2 mt-1">
                <label for="">{{ __('Telephone number:') }}</label>
            </div>
            <div class="88_d2 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Telephone number');?>" class="form-control" value="{{$spousePhoneHome}}">
            </div>

            <div class="88_d2 col-md-6 mt-1"></div>
            <div class="88_d2 col-md-2 mt-1">
                <label for="">{{ __('Facsimile number:') }}</label>
            </div>
            <div class="88_d2 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Facsimile number');?>" class="form-control">
            </div>

            <div class="88_d2 col-md-6 mt-1"></div>
            <div class="88_d2 col-md-2 mt-1">
                <label for="">{{ __('E-mail address:') }}</label>
            </div>
            <div class="88_d2 col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Email address');?>" class="form-control">
            </div>

            <div class="88_d2 col-md-6 mt-1">
                <textarea class="form-control bg-none" disabled rows="4"></textarea>
            </div>
            <div class="88_d2 col-md-6 mt-1"></div>

            <div class="88_d2 col-md-12 mt-1">
                <p><sup>1 </sup> {{ __('A separate form must be completed and signed by each debtor.') }}</p>
            </div>
            
        </div>
    </div>
</div>