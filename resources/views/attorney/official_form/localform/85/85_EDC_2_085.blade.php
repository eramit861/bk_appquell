<div class="row">

        <div class="col-md-12 mb-3">
            <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br> {{ __('EASTERN DISTRICT OF CALIFORNIA') }}</h3>
        </div>
        <div class="col-md-6 border_1px p-3 br-0">
            <div class="input-grpup">
                <label>{{ __('In re') }}</label>
                <textarea name="<?php echo base64_encode('DbName'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div>
        </div>
        
        <div class="col-md-6 border_1px p-3">
            <div class=""> 
                <x-officialForm.caseNo
                    labelText="{{ __('Case No.') }}"
                    casenoNameField="CaseNo"
                    caseno={{$caseno}}>
                </x-officialForm.caseNo>
            </div>
        </div>
   
        <div class="col-md-12 mt-3">
            <h3 class="text-center">{{ __('CHANGE OF NAME AND/OR ADDRESS') }}</h3>
            <p class="mt-3">{{ __('Please submit one form for each party to the case whose name or address is being changed.') }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <h3 style="color: red">{{ __('Attorneys: Do not use this form to change your own address. Use our e-Filling system instead.') }}</h3>
        </div>
        <div class="col-md-12 mt-3">
            <p><strong>{{ __('Please select all that apply.') }}</strong></p>
        </div>
        <div class="col-md-6">
            <p><strong>{{ __('Changes to Debtor’s Name and/or Address:') }}</strong></p>
            <div class="input-group">
                <input name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" type="checkbox">
                <label for="">{{ __('Change of name for debtor or joint debtor') }}</label>
            </div>
        </div>
        <div class="col-md-6">
            <p><strong>{{ __('Changes to Debtor’s Name and/or Address:') }}</strong></p>
            <div class="input-group">
                <input name="<?php echo base64_encode('Check Box10'); ?>" value="Yes" type="checkbox">
                <label for="">{{ __('Change of name for debtor or joint debtor') }}</label>
            </div>
        </div>
        <div class="col-md-6">
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box6'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Change of address for debtor or joint debtor') }}</label>
        </div>
        </div>
        <div class="col-md-6">
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box9'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Change of noticing or mailing address for a creditor') }}</label>
        </div>
        </div>

        <div class="col-md-6">
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box7'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Change of address for debtors in a case') }}</label>
        </div>
        </div>

        <div class="col-md-6">
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box8'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Change of payment address for creditor') }}</label>
        </div>
        </div>
    
   <!-- NEW -->
        <div class="col-md-12 mt-3 border_1px pt-3 pb-3 bb-0">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>{{ __('OLD ADDRESS:') }}</strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-2">
                        <p><strong>{{ __('Name:') }}</strong></p>
                    </div>
                    <div class="col-md-10">
                        <input name="<?php echo base64_encode('OldName'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-12">
                        <input name="<?php echo base64_encode('OldName2'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Mailing Address:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('OldMail'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Address Line 2:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('OldMail2'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('City, State, Zip:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('OldCity'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Phone Number:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('OldPhone'); ?>" value="" type="text" class="phone-field form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 border_1px pt-3 pb-3">
        <div class="row">
                <div class="col-md-4">
                    <p><strong>{{ __('NEW ADDRESS:') }}</strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-2">
                        <p><strong>{{ __('Name:') }}</strong></p>
                    </div>
                    <div class="col-md-10">
                        <input name="<?php echo base64_encode('NewName'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-12">
                        <input name="<?php echo base64_encode('NewName2'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Mailing Address:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('NewMail'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Address Line 2:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('NewMail2'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('City, State, Zip:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('NewCity'); ?>" value="" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong></strong></p>
                </div>
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Phone Number:') }}</strong></p>
                    </div>
                    <div class="col-md-8">
                        <input name="<?php echo base64_encode('NewPhone'); ?>" value="" type="text" class="phone-field form-control">
                    </div>
                </div>
            </div>
        </div>
   <!-- NEW -->
        <div class="col-md-12 mt-3">
            <p class="mt-3">{{ __('□ Check here if you are a Debtor or Joint Debtor and you receive court orders and notices by e-mail through the 
                Debtor Electronic Bankruptcy Noticing Program (DeBN) rather than by U.S. Mail to your mailing address. Please provide your DeBN 
                account number(s) below. You can find your DeBN account number(s) in the subject title of all e-mailed court orders and notices. 
                To change your e-mail address(es) for the DeBN program, use EDC Form 3-321 (Debtor’s Electronic Noticing Request), select 
                Update to Account Information, and include your new e-mail address at the bottom of the form.') }}</p>
        </div>

        <div class="col-md-12 mt-3">
            <div class="input-group d-flex">
                <label style="width:25%;"><strong>{{ __('Debtor’s DeBN Account No.:') }}</strong></label>
                <input name="<?php echo base64_encode('Text23'); ?>" value="" style="width:20%;" type="text" class="form-control">
                <label style="width:25%;"><strong>{{ __('Joint Debtor’s DeBN Account No.:') }}</strong></label>
                <input name="<?php echo base64_encode('Text24'); ?>" value="" style="width:40%;" type="text" class="form-control">
            </div>
            <div class="input-group d-flex">
                <label style="width:10%;"><strong>{{ __('Dated:') }}</strong></label>
                <input name="<?php echo base64_encode('Text25'); ?>" value="{{$currentDate}}" style="width:20%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                <label style="width:20%;"><strong>Name:</strong></label>
                <input name="<?php echo base64_encode('Text26'); ?>" value="{{$onlyDebtor}}" style="width:50%;" type="text" class="form-control">
            </div>
            <div class="input-group d-flex">
                <label style="width:30%;"></label>
                <label style="width:20%;"><strong>{{ __('Signature:') }}</strong></label>
                <input readonly name="<?php echo base64_encode(''); ?>" value="{{$debtor_sign}}" style="width:50%;" type="text" class="form-control">
            </div>
            <div class="input-group d-flex">
                <label style="width:30%;"></label>
                <label style="width:20%;"><strong>{{ __('Title:') }}</strong></label>
                <input name="<?php echo base64_encode('Text27'); ?>" value="" style="width:50%;" type="text" class="form-control">
            </div>
        </div>
</div>