<div class="row">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1');?>" value="{{$onlyDebtor}}">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2');?>" value="{{$spousename}}">
    <input type="hidden" name="<?php echo base64_encode('Text1');?>" value="{{$caseno}}">
    <input type="hidden" name="<?php echo base64_encode('Text2');?>" value="{{$chapterNo}}">
    <div class="col-md-6">
        <div class="section-box">
            <div class="section-header bg-back text-white">
                <p class="font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
            </div>
            <div class="section-body padd-20">
                <div class="row">
                    <div class="col-md-12">
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

    <div class="col-md-12 padd-20">
        <div class="row">
            <div class="col-md-12">
                <div class="form-title mb-3">
                    <h4>{{ __('Local Bankruptcy Form 9013-1.2') }}</h4>
                    <h2 class="font-lg-22">{{ __('Certificate of Service') }}</h2> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14">{{ __('Complete applicable sections and delete inapplicable sections.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Part 1 -->

    <div class="col-md-12">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                    <h2 class="font-lg-18">{{ __('L.B.R. 9013-1 Certificate of Service of Motion, Notice, and Proposed Order') }}</h2>
                </div>
            </div>
            
            <div class="col-md-12">
                <p>
                {{ __('I certify that on') }} 
                    <input type="text" name="<?php echo base64_encode('I certify that on');?>" class="form-control w-auto mb-1 date_filed" value="{{$currentDate}}">
                    <span class="text-bold">{{ __('month/day/year]') }}</span>, I served a complete copy of
                    <input type="text" name="<?php echo base64_encode('in compliance with the Federal Rules of Bankruptcy Procedure and the Courts Local Rules');?>" class="form-control width_50percent">
                    <span class="text-bold"> {{ __('[document title, e.g, “Motion, Notice, and Proposed Order”]') }}</span> {{ __('on the following parties
                    in compliance with the Federal Rules of Bankruptcy Procedure and the Court’s Local Rules:') }}
                    <input type="text" name="<?php echo base64_encode('Text3');?>" class="form-control">
                    <input type="text" name="<?php echo base64_encode('Text4');?>" class="form-control mt-1">
                    <input type="text" name="<?php echo base64_encode('Text5');?>" class="form-control mt-1">
                    <span class="text-bold">{{ __('[List each party served and the manner of service, e.g., “Attorney Jane Smith, 123 Main St., Denver, CO, 80202”
                    or “Attorney John Smith, via CM/ECF”]') }}</span>
                </p>
            </div>

            <div class="col-md-12">
                <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                    <h2 class="font-lg-18">{{ __('L.B.R. 2002-1 Certificate of Service of Notice') }}</h2>
                </div>
            </div>

            <div class="col-md-12">
                <p>
                {{ __('I certify that on') }} 
                    <input type="text" name="<?php echo base64_encode('I certify that on_2');?>" class="form-control w-auto mb-1 date_filed" value="{{$currentDate}}">
                    <span class="text-bold">{{ __('month/day/year]') }}</span>, {{ __('I served a complete copy of') }}
                    <input type="text" name="<?php echo base64_encode('document title eg Notice on the following parties in the attached Creditor');?>" class="form-control width_50percent">
                    <span class="text-bold"> {{ __('[document title, e.g. “Notice”]') }}</span> {{ __('oon the following parties') }} <span class="text-bold">{{ __('[in the attached Creditor
                    Address Mailing Matrix, which was obtained from the Court’s docket on') }} 
                    <input type="text" name="<?php echo base64_encode('Address Mailing Matrix which was obtained from the Courts docket on');?>" class="form-control w-auto">
                    {{ __('[month/day/year]') }}</span> {{ __('in accordance with 11 U.S.C. § 342(c) and Fed. R. Bankr. P. 2002.') }}
                    <input type="text" name="<?php echo base64_encode('monthdayyear in accordance with 11 USC  342c and Fed R Bankr P 2002 1');?>" class="form-control">
                    <input type="text" name="<?php echo base64_encode('monthdayyear in accordance with 11 USC  342c and Fed R Bankr P 2002 2');?>" class="form-control mt-1">
                    <input type="text" name="<?php echo base64_encode('monthdayyear in accordance with 11 USC  342c and Fed R Bankr P 2002 3');?>" class="form-control mt-1">
                    <span class="text-bold">{{ __('[List each party served and the manner of service or attach a copy of the Creditor Address Mailing Matrix]') }}</span>
                </p>
            </div>

            <div class="col-md-12 mt-3">
                <div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
                    <h2 class="font-lg-18">{{ __('Signature') }}</h2>
                </div>
            </div>

            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Dated"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="col-md-1">
                <label for="">By:</label>
            </div>
            <div class="col-md-5">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Signature"
                    inputFieldName="By"
                    inputValue="{{$attorny_sign}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>

            <div class="col-md-6 mt-1"></div>
            <div class="col-md-2 mt-1">
                <label for="">{{ __('Bar Number (if applicable):') }}</label>
            </div>
            <div class="col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Bar Number if applicable');?>" value="{{$attorney_state_bar_no}}" class="form-control">
            </div>
            
            <div class="col-md-6 mt-1"></div>
            <div class="col-md-2 mt-1">
                <label for="">{{ __('Mailing Address:') }}</label>
            </div>
            <div class="col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Mailing Address');?>" value="{{$attonryAddress1}}, {{$attonryAddress2}}" class="form-control">
            </div>

            <div class="col-md-6 mt-1"></div>
            <div class="col-md-2 mt-1">
                <label for="">{{ __('Telephone number:') }}</label>
            </div>
            <div class="col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Telephone number');?>" value="{{$attorneyPhone}}" class="form-control">
            </div>

            <div class="col-md-6 mt-1"></div>
            <div class="col-md-2 mt-1">
                <label for="">{{ __('Facsimile number:') }}</label>
            </div>
            <div class="col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Facsimile number');?>" value="{{$attorneyFax}}" class="form-control">
            </div>

            <div class="col-md-6 mt-1"></div>
            <div class="col-md-2 mt-1">
                <label for="">{{ __('E-mail address:') }}</label>
            </div>
            <div class="col-md-4 mt-1">
                <input type="text" name="<?php echo base64_encode('Email address');?>" value="{{$attorney_email}}" class="form-control">
            </div>
            
        </div>
    </div>
</div>