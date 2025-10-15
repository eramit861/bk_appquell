<div class="row">


    <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor;?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename;?>">
    <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : '';?>">
    <div class="row padd-20">
        <div class=" col-md-6">
            <div class=" section-box">
                <div class=" section-header bg-back text-white">
                    <p class=" font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="section-body padd-20">
                    <div class="row">
                        <div class=" col-md-12">
                            <label>{{ __('District Of') }}</label>
                            <div class=" input-group">
                                <select class="form-control district-select" id="district_name" name="<?php echo base64_encode('Bankruptcy District Information')?>"> @foreach ($district_names as $district_name)
                                    <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-md-6"></div>
        <div class=" col-md-12 mb-3 mt-3">
            <h4>{{ __('Local Form H1007-2d (12/15)') }} </h4>
            <div class=" form-title">
                <h2 class="font-lg-22">{{ __('Debtor’s Verification of Creditor List') }}</h2>
            </div>
        </div>
        <div class=" col-md-12">
            <div class="form-subheading">
                <p class="font-lg-14">
                    {{ __('The undersigned debtor certifies under penalty of perjury that all entities included or to be included in
                    schedules D, E/F, G, and H have been listed in the creditor list submitted with this verification. This includes all
                    my creditors, parties to leases and executory contracts, and codebtors.') }}
                </p>
                <p class="font-lg-14 mt-3">
                    {{ __('I also certify that the names and addresses of the listed entities are true and correct to the best of my
                    knowledge.') }}
                </p>
                <p class="font-lg-14 mt-3">
                    {{ __('I understand that I must file an amended creditor list and pay an amendment fee if there are creditors or parties
                    listed in my schedules who have not been included in this list.') }}
                </p>
            </div>
        </div>
    </div>
    <div class=" col-md-1 mt-3">
        <p>/s/</p>
    </div>
    <div class=" col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('s'); ?>" value="<?php echo $debtor_sign;?>" type="text" placeholder="" class="form-control" readonly>
            <label for="">{{ __('Debtor 1') }}</label>
        </div>
    </div>
    <div class=" col-md-4"></div>
    <div class=" col-md-1 mt-3">
        <p>/s/</p>
    </div>
    <div class=" col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('s_2'); ?>" value="<?php echo $debtor2_sign;?>" type="text" placeholder="" class="form-control" readonly>
            <label for="">{{ __('Debtor 2') }}</label>
        </div>
    </div>
   
    <div class=" col-md-3 mt-3">
        <div class=" input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('Dated'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class=" col-md-4"></div>
    <div class=" col-md-3 mt-3">
        <div class="2 input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('Dated_2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class=" col-md-12 mt-3">
         
    </div>  

</div>
