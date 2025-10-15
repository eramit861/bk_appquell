<div class="row">


    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __('Filer’s Name, Address, Phone, Fax, Email:') }}</label>
        <textarea name="<?php echo base64_encode('Text1');?>" class="form-control " rows="9"></textarea>
    </div>
    <div class="col-md-3 border_1px p-3 br-0 text-center bt-0">
        <img src="{{ asset('assets/img/dist_of_delware_logo.png')}}" alt="logo"  class="verification-master"/>
        <p class="text-bold">
        {{ __('UNITED STATES BANKRUPTCY') }}<br>
            {{ __('COURT DISTRICT OF DELAWARE') }}<br>
            824 N. Market St., Wilmington, DE<br>
            {{ __('19801') }}
        </p>
    </div>
    <div class="col-md-3 border_1px p-3 bl-0 bt-0 br-0">
        
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input name="<?php echo base64_encode('Text2');?>" type="text" class="form-control" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Case No.:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input name="<?php echo base64_encode('Text3');?>" type="text" class="form-control" value="{{$caseno}}">
    </div>
    
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Joint Debtor') }}:<br>{{ __('(if any)') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input name="<?php echo base64_encode('Text5');?>" type="text" class="form-control" value="{{$spousename}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Chapter:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input name="<?php echo base64_encode('Text4');?>" type="text" class="form-control" value="{{$chapterNo}}">
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <h3 class="text-center">
        {{ __('CERTIFICATE OF SERVICE') }}:<br>
            {{ __('NOTICE OF CORRECTED SOCIAL SECURITY NUMBER') }}
        </h3>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class=" p_justify">
            [<span class="text_italic">{{ __('Instructions to debtor(s):') }}</span> {{ __('After sending a Notice of Corrected Social Security Number, file this certificate to
            show service on all creditors and parties in interest, the trustee, and the credit reporting agencies listed on
            the notice form. Attach a list of names and addresses where the notice was sent.]') }}
        </p>
        <p class=" p_justify">
            {{ __('The undersigned declares under penalty of perjury that an amended Statement of Social Security Number or
            Individual Taxpayer Identification Number was submitted to the court and that a Notice of Corrected Social
            Security Number was sent to the following:') }}
        </p>
    </div>

    <div class="col-md-12 border_1px bt-0 bb-0 p-3">
        <p>{{ __('Attach a list of names and addresses of all entities sent the Notice of Corrected Social Security Number.') }}</p>
        <div class="row">
            <?php
                for ($k = 1 ; $k <= 9; $k++) {
                    ?>
            <div class="col-md-4">
                <textarea name="<?php echo base64_encode('A'.$k);?>" class="{{$k}} form-control mt-1" rows="5"></textarea>
            </div>
            <?php
                }
        ?>
        </div>
    </div>

    <div class="col-md-6 border_1px p-3 bt-0 br-0 ">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text7"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 border_1px p-3 bt-0 bl-0 ">
        <input name="<?php echo base64_encode('Text6');?>" type="text" class="form-control">
        <label class=" float_left">{{ __('Signature') }}</label>
        <label class=" float_right">{{ __('(Print name if original signature)') }}</label>
    </div>
    
</div>