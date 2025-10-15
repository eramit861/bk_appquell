<div class="row">

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __("Filer's Name, Address, Phone, Fax, Email:") }}</label>
        <textarea name="<?php echo base64_encode('Filer');?>" class="form-control " rows="9">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>
    <div class="col-md-3 border_1px p-3 br-0 text-center">
        <img src="{{ asset('assets/img/dist_of_hawaii_logo.jpg')}}" alt="logo" />
        <p class="text-bold">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('DISTRICT OF HAWAII') }}<br>
            1132 Bishop Street, Suite 250<br>
            {{ __('Honolulu, Hawaii 96813') }}
        </p>
    </div>
    <div class="col-md-3 border_1px p-3 bl-0">
        <label class="float_right">{{ __('H1017-1 b (4/22)') }}</label>
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Debtor');?>" class="form-control" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Case No.:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Case Number');?>" class="form-control" value="{{$caseno}}">
    </div>
    
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">Joint Debtor:<br>{{ __('(if any)') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Joint Debtor');?>" class="form-control" value="{{$spousename}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class="">{{ __('Chapter 7') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
    </div>
    
    <div class="col-md-7 border_1px p-3 bt-0 br-0 bb-0 text-center">
        <h3>
            {{ __('DEBTOR’S MOTION TO DISMISS CHAPTER 7 CASE;') }}<br>
            {{ __('NOTICE OF HEARING') }}
        </h3>
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <div>
            <label class=" text_italic">{{ __('Hearing Date:') }}</label>
        </div>
        <div class="mt-3">
            <label class=" text_italic">{{ __('Time:') }}</label>
        </div>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <div>
            <input type="text" name="<?php echo base64_encode('hib_1017-1b_1');?>" class="form-control">
        </div>
        <div class="mt-1">
            <input type="text" name="<?php echo base64_encode('hib_1017-1b_2');?>" class="form-control">
        </div>
    </div>

    <div class="col-md-7 border_1px p-3 bt-0 br-0 text-center">
        <h4>
            {{ __('Hearing to be held remotely using Zoom audio.') }}<br>
            Go to Zoomgov.com or phone at (833) 568-8864 (toll-free).<br>
            {{ __('Meeting ID: 161 789 3766, Passcode 1132.') }}
        </h4>
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Objections due:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input type="text" name="<?php echo base64_encode('hib_1017-1b_3');?>" class="form-control">
    </div>

    <div class="col-md-12 border_1px p-3 bt-0">
        <p class=" p_justify mb-2">
            {{ __('The Debtor hereby moves to dismiss this bankruptcy case under 11 U.S.C. § 707(a) for the following reason(s).') }}
        </p>
        <textarea name="<?php echo base64_encode('hib_1017-1b_4');?>" class="form-control" rows="8"></textarea>
    </div>

    <div class="col-md-12 border_1px p-3 bt-0 bb-0">
        <p class="p_justify">
            {{ __('NOTICE IS HEREBY GIVEN that a hearing on this motion has been scheduled for the date and time above.') }}
        </p>
        <p class="p_justify text-bold">
            <span class="underline">{{ __('Your rights may be affected.') }}</span>
             {{ __('You should read the motion or application and the accompanying papers
            carefully and discuss them with your attorney if you have one in this bankruptcy case. (If you do not have
            an attorney, you may wish to consult one.)') }}
        </p>
        <p class="p_justify">
            If you do not want the court to grant the motion, or if you want the court to consider your views, then you or
            your attorney must file a statement explaining your position <span class="underline text-bold">{{ __('not later than 14 days before the hearing date.') }}</span>
            Responses must be filed with the court at: <span class="text-bold">United States Bankruptcy Court, District of Hawaii, Suite 250,
            Honolulu, HI 96813,<span> {{ __('and sent to the moving party at the address in the upper left corner of this document.') }}
        </p>
        <p class="p_justify">
            If you mail your response to the court for filing, you must mail it early enough so the court will <span class="text-bold">{{ __('receive') }}</span> {{ __('it on or
            before the deadline stated above.') }}
        </p>
        <p class="p_justify mb-0">
            {{ __('If you or your attorney do not take these steps, the court may decide that you do not oppose the motion and
            may cancel the hearing. If the hearing is canceled, the court may grant the relief if the moving party
            promptly files a declaration and request for entry of an order [local form H9021-1].') }}
        </p>
    </div>

    <div class="col-md-4 border_1px p-3 bt-0 br-0 ">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="hib_1017-1b_5"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('hib_1017-1b_6');?>" name="" value="{{$attorney_name}}" class="form-control">
        <label for="">{{ __('Debtor/Attorney') }}</label>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 bl-0 ">
        <input type="text" name="<?php echo base64_encode('hib_1017-1b_7');?>" name="" value="{{$spousename}}" class="form-control">    
        <label for="">{{ __('Joint Debtor/Attorney') }}</label>
    </div>
    
</div>