<div class="row">
    
    <div class="col-md-12 border_1px p-3 bb-0">
        <p>{{ __('Mont. LBF 6. NOTICE OF CONTINUANCE OF § 341(a) MEETING OF CREDITORS.') }}</p>
        <p class="mb-2">{{ __('[Mont. LBR 2003-4]') }}</p>
        <textarea name="<?php echo base64_encode('Text83');?>" class="form-control" rows="7"></textarea>
        <label for="">{{ __('(Attorney for Debtor(s))') }}</label>
    </div>
    <div class="col-md-12 border_1px p-3 bb-0 text-center">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE DISTRICT OF MONTANA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text85"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text84"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <h3 class="mt-3 text-center">
            {{ __('NOTICE OF CONTINUANCE OF §
            341(a) MEETING OF CREDITORS') }}
        </h3>
    </div>

    <div class="col-md-12">
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('On the application of the Debtor(s) in the above-entitled case, notice is hereby given of the
            continuance of the § 341(a) meeting of creditors which is presently scheduled for the') }}
            <input type="text" name="<?php echo base64_encode('Text86');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }}
            <input type="text" name="<?php echo base64_encode('Text87');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text88');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            , {{ __('at the hour of') }} 
            <input type="text" name="<?php echo base64_encode('Text89');?>" value="" class="form-control w-auto">
            {{ __('o’clock') }} 
            <input type="text" name="<?php echo base64_encode('Text90');?>" value="" class="form-control w-auto">
            {{ __('.m. For good cause, the
            Office of United States Trustee has granted a continuance of such meeting, and the § 341(a)
            meeting of creditors in this case shall now be held on the') }}
            <input type="text" name="<?php echo base64_encode('Text91');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }}
            <input type="text" name="<?php echo base64_encode('Text92');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text93');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            {{ __('at the hour of') }} 
            <input type="text" name="<?php echo base64_encode('Text95');?>" value="" class="form-control w-auto">
            {{ __('o’clock') }}, 
            <input type="text" name="<?php echo base64_encode('Text94');?>" value="" class="form-control w-auto">
            {{ __('.m., at the location checked below:') }}
        </p>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('Check Box96');?>" class="form-control w-auto height_fit_content" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('U.S. Attorney’s Conference Room, 2nd Floor, Missouri River Federal
                    Courthouse, 125 Central Avenue West, Great Falls, Montana') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('Check Box97');?>" class="form-control w-auto height_fit_content" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('Third Floor, Mike Mansfield Federal Building and Courthouse, 400 North
                    Main, Butte, Montana') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('Check Box98');?>" class="form-control w-auto height_fit_content" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('Fifth Floor Courtroom, James Battin Federal Building, 316 North 26th St.,
                    Billings, Montana') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('Check Box99');?>" class="form-control w-auto height_fit_content" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('201 East Broadway, Russell Smith Federal Courthouse, Missoula, Montana') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('Check Box100');?>" class="form-control w-auto height_fit_content" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('Third Floor of the Justice Center, 920 South Main, Kalispell, Montana.') }}</p>
            </div>
        </div>
        <p class="mt-3">
        {{ __('DATED this') }}
            <input type="text" name="<?php echo base64_encode('Text101');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }}
            <input type="text" name="<?php echo base64_encode('Text102');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text103');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
        </p>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor(s)/Attorney for Debtor(s)"
            inputFieldName="Text104"
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12">
        <h3 class="mt-3 mb-3 underline text-center">{{ __('CERTIFICATE OF SERVICE') }}</h3>
        <p class="mt-3">
        {{ __('I, the undersigned, do hereby certify under penalty of perjury that on the') }} 
            <input type="text" name="<?php echo base64_encode('Text107');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }}
            <input type="text" name="<?php echo base64_encode('Text105');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text106');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            {{ __(', a copy of the foregoing was served by electronic means
            pursuant to LBR 9013-1(d)(2) on the parties noted in the Court’s ECF transmission facilities and/or
            by mail on the following parties:') }}
        </p>        
    </div>
    
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="[Name of person certifying the mailing]"
            inputFieldName="Text108"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <p class="p_justify">
            {{ __('[Must comply with Mont. LBR 9013-1(d)(2), by reflecting the name and address of each party
            served, and by being signed “under penalty of perjury” and by identifying the document served.]') }}
        </p>
    </div>

</div>