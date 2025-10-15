<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('CHANGE OF ADDRESS') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class=" p_justify text-bold">
            {{ __('Other than for an attorney, if the Debtor/Creditor whose address is changing is a party in an
            Adversary Proceeding before the Court, the Change of Address must be filed in the Adversary
            Proceeding as well as in the Bankruptcy Case. If debtor has both a street and mailing address,
            please indicate which address is being updated.') }}
        </p>
       
    </div>
    
    <div class="col-md-1">
        <label for="">{{ __('For:') }}</label>
    </div>
    <div class="col-md-11">
        <p class="">    
            <!-- checked by default -->
            <input type="checkbox" value="On" name="<?php echo base64_encode(' BOX1'); ?>" class="form-control w-auto mr-0 ml-3" checked="true">
            {{ __('Debtor') }}
        </p>
        <div class="row pl-3">
            <div class="col-md-3">
                <label for="">{{ __('New address is for:') }}</label>
            </div>
            <div class="col-md-4">
                <p class="">    
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box1'); ?>" class="form-control w-auto mr-0 ml-3">
                    {{ __('Both Debtors') }}
                </p>
            </div>
            <div class="col-md-5"></div>

            <div class="col-md-3"></div>
            <div class="col-md-4">
                <p class="">    
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2'); ?>" class="form-control w-auto mr-0 ml-3">
                    {{ __('Debtor 1 Only') }}
                </p>
            </div>
            <div class="col-md-5"></div>

            <div class="col-md-3"></div>
            <div class="col-md-4">
                <p class="">    
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3'); ?>" class="form-control w-auto mr-0 ml-3">
                    {{ __('Debtor 2 Only') }}
                </p>
            </div>
            <div class="col-md-5"></div>
        </div>
        <div class=" ml-3">
            <p class="ml-3 mb-2 pl-2">    
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box9'); ?>" class="form-control w-auto mr-1 ml-0">
                {{ __('Check here if you receive court orders and notices by email through the Debtor
                Electronic Bankruptcy Noticing program (DeBN) rather than by U.S. mail to your
                mailing address. Please provide your DeBN account number below (DeBN
                account numbers can be located in the subject title of all emailed court orders and
                notices).') }}
            </p>
            <div class="row">
                <div class="col-md-3">
                    <label class="ml-4">{{ __("Debtor 1's DeBN account number") }}</label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('DEBN1'); ?>" class="form-control">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3">
                    <label class="ml-4">{{ __("Debtor 2's DeBN account number") }}</label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('DEBN2'); ?>" class="form-control mt-1">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3">
                    <label for="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box10'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Attorney [If Applicable:] Name:') }}
                    </label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('attyname'); ?>" class="form-control mt-1">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3">
                    <label for="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box14'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Creditor [If Applicable:] Name:') }}
                    </label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('CRED NAME'); ?>" class="form-control mt-1">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3">
                    <label for="">
                        <span class="text_italic">{{ __('[If applicable]') }}</span> {{ __('Case Name:') }}
                    </label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('Text15'); ?>" class="form-control mt-1">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3">
                    <label for="">
                        <span class="text_italic">{{ __('[If applicable]') }}</span> {{ __('Case No./Adversary Proceeding No.:') }} 
                    </label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="<?php echo base64_encode('Text16'); ?>" class="form-control mt-1">
                </div>
                <div class="col-md-2"></div>
                
                <div class="col-md-3 mt-3">
                    <p>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Street Address') }}
                    </p>
                </div>
                <div class="col-md-3 mt-3">
                    <p>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box11'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Mailing Address') }}
                    </p>
                </div>
                <div class="col-md-6 mt-3"></div>

                <div class="col-md-12">
                    <p class="mb-0">
                    {{ __('New Address') }}: 
                        <input type="text" name="<?php echo base64_encode('ADDRESS1'); ?>" class="form-control width_85percent ml-2">
                    </p>
                    <p class="text-center w-100">
                        {{ __('No. and Street, Apt., P. O. Box or R. D. No.') }}
                    </p>
                </div>

                <div class="col-md-3">
                    <p>
                    {{ __('City') }}: 
                        <input type="text" name="<?php echo base64_encode('ADDRESS2'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                    {{ __('State') }}: 
                        <input type="text" name="<?php echo base64_encode('ST1'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                    {{ __('Zip') }}: 
                        <input type="text" name="<?php echo base64_encode('ZIP1'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-3 mt-3">
                    <p>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box12'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Street Address') }}
                    </p>
                </div>
                <div class="col-md-3 mt-3">
                    <p>
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box13'); ?>" class="form-control w-auto mr-1 ">
                        {{ __('Mailing Address') }}
                    </p>
                </div>
                <div class="col-md-6 mt-3"></div>

                <div class="col-md-12">
                    <p class="mb-0">
                    {{ __('Old Address') }}: 
                        <input type="text" name="<?php echo base64_encode('ADDRESS3'); ?>" class="form-control width_85percent ml-2">
                    </p>
                    <p class="text-center w-100">
                        {{ __('No. and Street, Apt., P. O. Box or R. D. No.') }}
                    </p>
                </div>

                <div class="col-md-3">
                    <p>
                    {{ __('City') }}: 
                        <input type="text" name="<?php echo base64_encode('ADDRESS4'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                    {{ __('State') }}: 
                        <input type="text" name="<?php echo base64_encode('ST2'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                    {{ __('Zip') }}: 
                        <input type="text" name="<?php echo base64_encode('ZIP2'); ?>" class="form-control w-auto ml-2">
                    </p>
                </div>
                <div class="col-md-3"></div>
                
                <div class="col-md-12">
                    <p class="mb-0">
                    {{ __('Telephone Number') }}: (
                        <input type="text" name="<?php echo base64_encode('AREA CODE'); ?>" class="form-control w-auto ml-2">
                        ) 
                        <input type="text" name="<?php echo base64_encode('TEL NO'); ?>" class="form-control width_30percent ml-2">
                    </p>
                </div>
                
                <div class="col-md-10 text-center">
                    <p class="">
                        {{ __('Please include area code') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
    </div>
    <div class="col-md-7">
        <input type="text" name="<?php echo base64_encode('filer signature'); ?>" class="form-control" value="{{$attorny_sign}}">
        <label for="">{{ __('Signature of Filer') }} [<span class="text_italic">{{ __('check filer type below') }}</span>]:</label>
        <p class="mt-2 mb-2">
            <!-- checked by default -->
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class="form-control w-auto mr-1 " checked="true">
            {{ __('Attorney for Debtor') }}
        </p>
        <p class="mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class="form-control w-auto mr-1 ">
            {{ __('Debtor') }} <span class="text-bold text_italic">{{ __('[If joint case and address is for both debtors,
            both debtors must sign.]') }}</span>
        </p>
        <p class="mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6'); ?>" class="form-control w-auto mr-1 ">
            {{ __('Creditor') }}
        </p>
        <p class="mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7'); ?>" class="form-control w-auto mr-1 ">
            {{ __('Attorney') }}
        </p>
    </div>
    
    <div class="col-md-12">
        <div>
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="DTE"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
 
    <div class="col-md-1">
        <p>
            {{ __('pc:') }}
        </p>
    </div>
    <div class="col-md-11">
        <p>
            {{ __('Trustee') }}<br>
            United States Trustee<br>
            {{ __('Creditor (for creditor’s change of address)') }}
        </p>
    </div>
</div>