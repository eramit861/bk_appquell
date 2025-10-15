<div class="row">


    <input type="hidden" name="<?php echo base64_encode('Debtor'); ?>" value="<?php echo $onlyDebtor;?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename;?>">
    <input type="hidden" name="<?php echo base64_encode('Case No'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : '';?>">
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
            <h4>{{ __('Local Form H1074b (4/16)') }}</h4>
            <div class=" form-title">
                <h2 class="font-lg-22">{{ __('Designation of Responsible Individual') }}</h2>
            </div>
        </div>
        <div class=" col-md-12">
            <div class="form-subheading">
                <p>
                    {{ __('The debtor is a corporation, partnership, or limited liability company, and designates the following as its
                    responsible individual pursuant to LBR 1074-1(b).') }}
                </p>
                <p class=" p_justify text_italic">
                    {{ __('[Note: 1) If the individual does not reside in the District of Hawaii, attach this designation to a motion for court approval;
                    2) If there is more than one responsible individual being designated, attach an additional designation and a statement
                    specifying each individual’s responsibilities.]') }}
                </p>
            </div>
        </div>

        <div class="col-md-2 pt-1">
            <label class="">{{ __('Name:') }}</label>
        </div>
        <div class="col-md-10">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]1');?>" class="form-control">
        </div>
        <div class="col-md-2 mt-1 pt-1">
            <label class="">{{ __('Position:') }}</label>
        </div>
        <div class="col-md-10 mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]2');?>" class="form-control">
        </div>
        <div class="col-md-2 mt-1 pt-1">
            <label class="">{{ __('Address:') }}</label>
        </div>
        <div class="col-md-10 mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]3');?>" class="form-control">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]4');?>" class="form-control mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]5');?>" class="form-control mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]6');?>" class="form-control mt-1">
        </div>
        <div class="col-md-2 mt-1 pt-1">
            <label class="">{{ __('Phone:') }}</label>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]7');?>" class="form-control">
        </div>
        <div class="col-md-2 mt-1 pt-1">
            <label class="">{{ __('Email:') }}</label>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" name="<?php echo base64_encode('H1074b_resp_ind[2016mar16]Email');?>" class="form-control">
        </div>

        <div class="col-md-12 mt-3">
            <h3 class="text-center">{{ __('CONSENT') }}</h3>
            <p class=" p_justify">{{ __('The undersigned consents to this designation as the individual responsible for performing the duties of the
                debtor in this bankruptcy case.') }}</p>
        </div>
        
        <div class="col-md-6 ">
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Dated"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="text-center">
                <input type="text" name="<?php echo base64_encode('Sign');?>" class="form-control">
                <label class="float_left">{{ __('Responsible Individual') }}</label>
            </div>
        </div>
    </div>   

</div>
