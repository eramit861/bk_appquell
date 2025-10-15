<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF CONNECTICUT') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label>{{ __('Name(s) of Debtor(s) listed on the bankruptcy case:') }}</label>
            <textarea name="<?php echo base64_encode("TextBox0"); ?>" value="" class=" form-control" rows="3" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div> 
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case Number."
                casenoNameField="TextBox1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="row mt-2">
            <div class="col-md-3 pr-0">
                <label>{{ __('Adversary Proceeding No:') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('TextBox2'); ?>"  placeholder="" type="text" value="" class="w-auto form-control">
            </div>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="TextBox3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mb-3 mt-3">
        <h3>
            {{ __('CHANGE OF MAILING ADDRESS FOR DEBTOR,') }} <br>{{ __('CREDITOR or OTHER PARTY IN INTEREST') }}
        </h3>
    </div>
    
    <div class="col-md-12">
        <p>
        {{ __('This change of mailing address is submitted by') }}: <span class="text_italic">{{ __('(Mark only one)') }}</span>
        </p>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                <p>
                    <!-- checked by default -->
                    <input type="checkbox" value="YES" name="<?php echo base64_encode('CheckBox0');?>" class="form-control w-auto" checked="true">
                    {{ __('Debtor') }}
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <input type="checkbox" value="YES" name="<?php echo base64_encode('CheckBox1');?>" class="form-control w-auto">
                    {{ __('Joint Debtor') }}
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <input type="checkbox" value="YES" name="<?php echo base64_encode('CheckBox2');?>" class="form-control w-auto">
                    {{ __('Creditor') }}
                </p>
            </div>
            <div class="col-md-3">
                <p>
                    <input type="checkbox" value="YES" name="<?php echo base64_encode('CheckBox3');?>" class="form-control w-auto">
                    {{ __('Other') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox4');?>" class="form-control">
    </div>

    <div class="col-md-12">
        <label class="float_right text_italic">{{ __('(Party in interest, plaintiff, defendant, professional retained by the estate, etc.)') }}</label>
    </div>

    <div class="col-md-2 mt-3">
        <label for="">{{ __('Full Name:') }}</label>
    </div>

    <div class="col-md-10 mt-3">
        <input type="text" name="<?php echo base64_encode('TextBox5');?>" value="{{$onlyDebtor}}" class="form-control">
    </div>

    <div class="col-md-12 text-center mt-2">
        <label class="text_italic">{{ __('Separate forms must be completed for each requestor updating their address.') }}</label>
    </div>
    
    <div class="col-md-12 mt-3 border_1px p-3">
        <div class="row">
            <div class="col-md-2">
                <label for="">{{ __('List the address previously provided to the Court:') }}</label>
            </div>        
            <div class="col-md-8">
                <div>
                    <x-officialForm.signVertical
                        labelText="Street Address - Line 1"
                        signNameField="TextBox6"
                        sign="{{$clientAddress1}}"
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="Street Address - Line 2"
                        signNameField="TextBox7"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="ATTN: Line (if applicable, for Creditor)"
                        signNameField="TextBox8"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="City, State and Zip Code"
                        signNameField="TextBox9"
                        sign="{{$clientCity}} {{$clientState}}, {{$clientZip}}"
                    ></x-officialForm.signVertical>
                </div>
            </div>        
            <div class="col-md-2"></div> 
        </div>       
    </div>

    <div class="col-md-12 bt-0 border_1px p-3">
        <div class="row">
            <div class="col-md-2">
                <label for="">{{ __('List the new address:') }}</label>
            </div>        
            <div class="col-md-8">
                <div>
                    <x-officialForm.signVertical
                        labelText="(new) Street Address - Line 1"
                        signNameField="TextBox10"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="(new) Street Address - Line 2"
                        signNameField="TextBox11"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="(new) ATTN: Line (if applicable, for Creditor)"
                        signNameField="TextBox12"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.signVertical
                        labelText="(new) City, State and Zip Code"
                        signNameField="TextBox13"
                        sign=""
                    ></x-officialForm.signVertical>
                </div>
            </div>        
            <div class="col-md-2"></div> 
        </div>       
    </div>

    <div class="col-md-5 mt-3">
        <x-officialForm.signVertical
            labelText="Filer's printed full name"
            signNameField="TextBox14"
            sign="{{$onlyDebtor}}"
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-7 mt-3">
        <x-officialForm.signVertical
            labelText="Title of corporate officer, partner, or agent (if applicable)"
            signNameField="TextBox15"
            sign=""
        ></x-officialForm.signVertical>
    </div>

    <div class="col-md-5 mt-3">
        <x-officialForm.signVertical
            labelText="Filer's signature"
            signNameField="TextBox16"
            sign="{{$debtor_sign}}"
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="TextBox17"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-1 mt-3"></div>


</div>