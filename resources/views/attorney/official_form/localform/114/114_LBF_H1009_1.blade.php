<div class="row">


    <input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor;?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename;?>">
    <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : '';?>">
    <div class="row padd-20 w-100">
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
        <div class=" col-md-12 mt-3">
            <h4>{{ __('Local Form H1009-1 (12/20)') }}</h4>
            <div class=" form-title">
                <h2 class="font-lg-22">Local Form H1009-1 (12/20)</h2>
            </div>
        </div>
    </div>
    
    <div class=" col-md-12">
        <p>
            <span class="text-bold">{{ __('Part 1: Amendments') }}</span>
            {{ __('(attach amended documents to this cover sheet)') }}
        </p>
    </div>  
    
    <div class=" col-md-6">
        <p class=" text_italic">
            {{ __('Check all of the following that are being amended.') }}
        </p>
        <p>
            Schedules: 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box1');?>" value="Yes">
            A/B 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box2');?>" value="Yes">
            C 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box3');?>" value="Yes">
            G 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box4');?>" value="Yes">
            H 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box5');?>" value="Yes">
            I 
            <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box6');?>" value="Yes">
            {{ __('J') }}
        </p>
        <p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box9');?>" value="Yes">
            {{ __('Statement of Financial Affairs') }}
        </p>
        <p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box10');?>" value="Yes">
            {{ __('Chapter 7 Statement of Intention') }}
        </p>
        <p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box11');?>" value="Yes">
            {{ __('Chapter 7 Statement of Current Monthly Income (122A-1)') }}
        </p>
        <p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box12');?>" value="Yes">
            {{ __('Chapter 7 Means Test Calculation (122A-2)') }}
        </p>
    </div>  
    
    <div class=" col-md-6">
        <div class=" border_1px p-3">
            <p  class=" w-100 text-bold underline text-center">
            {{ __('Amendments requiring $32 filing fee') }}
            </p>
            <p class="pl-5">
                Schedules: 
                <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box7');?>" value="Yes">
                D 
                <input type="checkbox" class="form-control w-auto ml-3" name="<?php echo base64_encode('Check Box8');?>" value="Yes">
                {{ __('E/F') }}
            </p>
            <p>
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box18');?>" value="Yes">
                Creditor List – <span class="text_italic">{{ __('no fee required for amended list if:') }}</span>
            </p>
            <ul class="dot_list pl-4 ml-3">
                <li class="text_italic">{{ __('only updating an address or') }}</li>
                <li class="text_italic">{{ __('only adding a creditor’s attorney') }}</li>
            </ul>
        </div>

    </div>  

    <div class=" col-md-12">
        <p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box13');?>" value="Yes">
            {{ __('Chapter 13 Statement of Current Monthly Income (122C-1) and Calculation of Disposable Income (122C-2)') }}
        </p>
        <div class="row">
            <div class="col-md-2">
                <p>
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box14');?>" value="Yes">
                    {{ __('Other:') }}
                </p>
            </div>
            <div class="col-md-10">
                <textarea name="<?php echo base64_encode('Text15');?>" id="" class="form-control " rows="3"></textarea>
            </div>
        </div>
    </div> 

    <div class=" col-md-12 mt-3">
        <p>
            <span class="text-bold">{{ __('Part 2: Declaration') }}</span>
        </p>
        <p>
        {{ __('Under penalty of perjury, the undersigned declares that I have read the documents filed with this declaration
            and that they are true and correct.') }} <span class="text_italic">{{ __('[If filing electronically through ECF, a') }} <span class="text-bold"> {{ __('Declaration re: Electronic Filing') }}</span> {{ __('with
            original signatures must be submitted on paper not later than 7 days after filing the amendments.]') }}</span>
        </p>
    </div>  

    <div class=" col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 1"
            inputFieldName="s"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Dated"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>  
    <div class="col-md-2"></div>
    <div class=" col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 2"
            inputFieldName="s_2"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Dated_2"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>  
    <div class="col-md-2"></div>

    <div class=" col-md-12 mt-3">
        <p>
            <span class="text-bold">{{ __('Part 3: Certificate of Service') }}</span>
            {{ __('(attach a list of names and addresses where notice was sent)') }}
        </p>
        <p>
            {{ __('The undersigned certifies:') }}
        </p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box16');?>" value="Yes">
            {{ __('Notice of the amendments has been served on all creditors and parties in interest on the attached service
            list. (If exemptions or exemption amounts have been amended, a copy of Schedule C has been served on all
            creditors and parties in interest.)') }} 
        </p>
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box17');?>" value="Yes">
            {{ __('A copy of the Notice of Bankruptcy Case, Meeting of Creditors, & Deadlines has been served on the
            additional creditors and parties in interest identified on the attached service list.') }}
        </p>
    </div>  

    <div class=" col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated_3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>  
    <div class="col-md-2"></div>
    <div class=" col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent=""
            inputFieldName="s_3"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>  
    <div class="col-md-2"></div>

</div>
