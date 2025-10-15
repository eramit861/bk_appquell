<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF MARYLAND') }}</h3>
    </div>
    
    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('IN THE CIRCUIT COURT FOR') }}
            <br>
            <input type="text" class="w-auto form-control" name="<?php echo base64_encode("Text2"); ?>"> 
            {{ __('MARYLAND') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label>{{ __('IN RE:') }}</label>
            <textarea name="<?php echo base64_encode("Text4"); ?>" value="" class=" form-control" rows="3" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            <label class="pl-4">vs.</label>
            <textarea name="<?php echo base64_encode("Text5"); ?>" value="" class=" form-control" rows="3" style="padding-right:5px;"><?php echo ''; ?></textarea>
        </div> 
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Civil No."
                casenoNameField="Text3"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('NOTICE OF FILING OF CASE IN BANKRUPTCY COURT') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="mb-1">
        {{ __('You are hereby notified of the filing of a case in the') }} 
            <select name="<?php echo base64_encode("Dropdown7"); ?>" class="form-control w-auto">
                <option value="Baltimore Division">{{ __('Baltimore Division') }}</option>
                <option value="Greenbelt Division">{{ __('Greenbelt Division') }}</option>
                <option value="Salisbury Division">{{ __('Salisbury Division') }}</option>
            </select>
            {{ __('Division of the United
            States Bankruptcy Court for the District of Maryland for the following debtor:') }}
        </p>
        <p class="mb-2">
            <input type="text" name="<?php echo base64_encode("Text8"); ?>" class="form-control width_90percent"> .
        </p>
        <p class="">
        {{ __('The bankruptcy case no. is') }} 
            <input type="text" name="<?php echo base64_encode("Text9"); ?>" class="form-control w-auto" value="{{$caseno}}">
            . {{ __('It is a case under Chapter') }} 
            <input type="text" name="<?php echo base64_encode("Text10"); ?>" class="form-control w-auto" value="{{$chapterNo}}">
            {{ __('filed on') }}
            <input type="text" name="<?php echo base64_encode("Text11"); ?>" class="form-control w-auto">    
            {{ __('. The case is now pending.') }}
        </p>
    </div>

    <div class="col-md-5 border_top_1px mt-4 pt-2">
        <label for="">{{ __('Attorney for the debtor') }}</label>
        <div class="row">
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Name:') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text12"); ?>" class="form-control" value="{{$attorney_name}}">
            </div>
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Address:') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text1"); ?>" class="form-control" value="{{$attonryAddress1}}">
            </div>
            <div class="col-md-12 mt-2">
                <input type="text" name="<?php echo base64_encode("Text6"); ?>" class="form-control" value="{{$attonryAddress2}}">
            </div>
            <div class="col-md-12 mt-2">
                <input type="text" name="<?php echo base64_encode("Text7"); ?>" class="form-control" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}">
            </div>
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Tel No.') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text14"); ?>" class="form-control" value="{{$attorneyPhone}}">
            </div>
        </div>
    </div>
    <div class="col-md-2 mt-4 text-center">
        <label class="text-bold">{{ __('OR') }}</label>
    </div>
    <div class="col-md-5 border_top_1px mt-4 pt-2">
        <label for="">{{ __('Debtor, if without counsel') }}</label>
        <div class="row">
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Name:') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text13"); ?>" class="form-control">
            </div>
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Address:') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text15"); ?>" class="form-control">
            </div>
            <div class="col-md-12 mt-2">
                <input type="text" name="<?php echo base64_encode("Text16"); ?>" class="form-control">
            </div>
            <div class="col-md-12 mt-2">
                <input type="text" name="<?php echo base64_encode("Text17"); ?>" class="form-control">
            </div>
            <div class="col-md-3 pt-2 mt-2">
                <label for="">{{ __('Tel No.') }}</label>
            </div>
            <div class="col-md-9 mt-2">
                <input type="text" name="<?php echo base64_encode("Text18"); ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <label class="text-bold">{{ __('OR') }}</label>
    </div>

    <div class="col-md-5 mt-3">
        <p class="pt-2">{{ __('Attorney for petitioning creditor') }}</p>
        <p class="">{{ __('Tel. No.') }}</p>
        <p class="">{{ __('Address') }}:</p>
    </div>
    <div class="col-md-7 mt-3">
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
    </div>

    <div class="col-md-5">
        <p class="pt-2">{{ __('Petitioning creditor') }}</p>
    </div>
    <div class="col-md-7">
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
        <input type="text" name="<?php echo base64_encode(""); ?>" class="form-control bg-none" disabled>
    </div>
    
    <div class="col-md-12 mt-3 text-center">
        <h3 class="">{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>

    <div class="col-md-12 mt-3 p_justify">
        <p>
        {{ __('I hereby certify that on the') }} 
            <input type="text" name="<?php echo base64_encode("Text19"); ?>" value="{{$currentMonth}}" class="form-control w-auto mt-1">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode("Text20"); ?>" value="{{$currentDay}}" class="form-control width_5percent mt-1">
             , 20
            <input type="text" name="<?php echo base64_encode("Text21"); ?>" value="{{$currentYearShort}}" class="form-control width_5percent  mt-1">
            , {{ __('I reviewed the Court’s
            CM/ECF system and it reports that an electronic copy of the') }} 
            <input type="text" name="<?php echo base64_encode("Text22"); ?>" value="{{$currentDate}}" class="form-control w-auto mt-1">
            {{ __('will be served electronically by the Court’s CM/ECF system on the following:') }}
        </p>
    </div>

    <div class="col-md-1 mt-3"></div>
    <div class="col-md-10 mt-3">
        <p class="mb-0">{{ __('Name of Trustee, Chapter 7/13') }}</p>
        <input type="text" name="<?php echo base64_encode("Text23"); ?>" class="form-control">
        <p class="mt-2 mb-0">{{ __('Name of Attorney') }}</p>
        <input type="text" name="<?php echo base64_encode("Text24"); ?>" class="form-control mt-2" value="{{$attorney_name}}">
        <p class="mt-2 mb-0">{{ __('Name of Attorney') }}</p>
        <input type="text" name="<?php echo base64_encode("Text25"); ?>" class="form-control mt-2" value="{{$attorney_name}}">
    </div>
    <div class="col-md-1 mt-3"></div>
    
    <div class="col-md-12 mt-3">
        <p>
        {{ __('I hereby further certify that on the') }} 
            <input type="text" name="<?php echo base64_encode("Text26"); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode("Text27"); ?>" value="{{$currentDay}}" class="form-control width_5percent">
             , 20
            <input type="text" name="<?php echo base64_encode("Text28"); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            , {{ __('a copy of the') }}
            <input type="text" name="<?php echo base64_encode("Text34"); ?>" value="" class="form-control w-auto">
            {{ __('was also mailed first class, postage prepaid to:') }}
        </p>
    </div>

    <div class="col-md-1 mt-3"></div>
    <div class="col-md-10 mt-3">
        <textarea name="<?php echo base64_encode("Text31"); ?>" class="form-control" rows="4"></textarea>
        <textarea name="<?php echo base64_encode("Text32"); ?>" class="form-control mt-2" rows="4"></textarea>
        <textarea name="<?php echo base64_encode("Text33"); ?>" class="form-control mt-2" rows="4"></textarea>
    </div>
    <div class="col-md-1 mt-3"></div>

    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature"
            inputFieldName="Text29"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVertical>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent=""
                inputFieldName="Text30"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>