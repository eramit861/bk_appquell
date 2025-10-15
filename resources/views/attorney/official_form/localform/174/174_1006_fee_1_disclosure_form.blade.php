
    
    <input type="hidden" name="<?php echo base64_encode('First Name'); ?>" value="{{$debtorFirstName}}">
    <input type="hidden" name="<?php echo base64_encode('Middle Name'); ?>" value="{{$debtorMiddleName}}">
    <input type="hidden" name="<?php echo base64_encode('Last Name'); ?>" value="{{$debtorLastName}}">
    <input type="hidden" name="<?php echo base64_encode('Spouse, if filing First Name'); ?>" value="{{$spouseFirstName}}">
    <input type="hidden" name="<?php echo base64_encode('Middle Name_2'); ?>" value="{{$spouseMiddleName}}">
    <input type="hidden" name="<?php echo base64_encode('Last Name_2'); ?>" value="{{$spouseLastName}}">
    <input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">

    <div class="row">
        <div class="frm106sum col-md-7">
            <div class="section-box">

                <div class="section-header bg-back frm106sum text-white">
                    <p class="frm106sum font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>

                <div class="frm106sum section-body padd-20">
                    <div class="frm106sum row">



                        <div class="frm106sum col-md-12">
                            <div class="input-group">
                                <label for="">{{ __('United States Bankruptcy Court for the') }}</label>

                                <select class="form-control frm106sum district-select"
                                    name="<?php echo base64_encode('Bankruptcy District Information-106SUM');?>"
                                    id="district_name">
                                    @foreach ($district_names as $district_name)
                                    <option
                                        <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?>
                                        value="{{$district_name->district_name}}" class="form-control">
                                        {{$district_name->district_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="frm106sum col-md-5">
            <div class="frm106sum amended">
                <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes">
                <label>{{ __('Check if this is an amended filing') }}</label>
            </div>
        </div>

        <div class="col-md-12 p-3">
            <h3 class="underline text-center">Disclosure of Pre-Petition Fees Paid by Debtor to Debtor’s Counsel</h3>
            <p class="mt-3">
                Pursuant to Miss. Bankr. L. R. 1006-1(b)(1), I certify that I am the attorney for the above-named
                debtor(s), and that fees paid to me before the filing of the application to pay filing fees
                in installments in connection with the above-referenced bankruptcy case are as follows:
            </p>
            <div class="row">
                <div class="col-md-6 pl-4">
                    <p class="mb-2 pt-2 pl-4"> Filing fee for voluntary petition,  I have received</p>
                    <p class="mb-0 pt-2 pl-4">Compensation for legal services, I have received</p>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <x-officialForm.priceFieldInput
                            inputFieldName="Filing Fee"
                            inputValue=""
                            extraClass="w-auto">
                        </x-officialForm.priceFieldInput>
                    </div>
                    <div class="">
                        <x-officialForm.priceFieldInput
                            inputFieldName="Compensation"
                            inputValue=""
                            extraClass="w-auto">
                        </x-officialForm.priceFieldInput>
                    </div>
                </div>
            </div>
          
        </div>
        <div class="col-md-12">
            <h3 class="text-center underline">Certification</h3>
            <p class="mt-3">I, the attorney for the debtor(s) declare under penalty of perjury that the foregoing is true and correct</p>
        </div>
        <div class="col-md-6 mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Attorney for Debtor(s)"
                inputFieldName=""
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Printed Name"
                    inputFieldName="Printed Name"
                    inputValue="{{$attorney_name}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Address Line 1"
                    inputFieldName="Address Line 1"
                    inputValue="{{$attonryAddress1}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Address Line 2"
                    inputFieldName="Address Line 2"
                    inputValue="{{$attonryAddress2}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="City, State, and Zip Code"
                    inputFieldName="City State and Zip Code"
                    inputValue="{{$attorney_city}}, {{$attorney_state}}, {{$attorney_zip}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="Telephone Number"
                        inputFieldName="Telephone Number"
                        inputValue="{{$attorneyPhone}}">
                   </x-officialForm.debtorSignVerticalOpp>
                </div>
                <div class="col-md-6">
                <x-officialForm.debtorSignVerticalOpp
                        labelContent="MS Bar Number"
                        inputFieldName="MS Bar Number"
                        inputValue="{{$attorney_state_bar_no}}">
                   </x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
        </div>
        <div class="col-md-6  mt-3">
            <x-officialForm.dateSingleHorizontal
                labelText="Date "
                dateNameField="MMDDYYYY"
                currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
            <div class="pl-5">
                <p class="mb-0">MM/DD/YYYY</p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p>
                Miss. Bankr. L.R. 1006-1(b)(1) requires debtor’s counsel to complete and file this form concurrently with the filing
                of the application to pay filing fee in installments.
            </p>
        </div>
    </div>

            
        