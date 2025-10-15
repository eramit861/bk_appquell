<div class="row m-1">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">Contact Information Sheet</h3>
    </div>

    <p class="p_justify text-bold col-md-12">Please complete and return this information sheet with your documents.</p>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('Case No.:') }}</label>
    </div>
    
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text1'); ?>" value="{{$caseno}}" class="form-control w-auto">
    </div>

    <div class="col-md-12 mt-4 row">
    <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Debtor 1 Name:</div>
    <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text2'); ?>" value="{{$onlyDebtor}}" class="form-control w-auto"></div>
    <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Primary Phone:</div>
    <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text3'); ?>" value="{{$debtorPhoneHome}}" class="form-control w-auto"></div>
    <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Work Phone:</div>
    <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text4'); ?>" value="" class="form-control w-auto"></div>
    <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center">Email Address:</div>
    <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bl-0"><input type="text" name="<?php echo base64_encode('text5'); ?>" value="{{$debtor_email}}" class="form-control w-auto"></div>
    </div>

    <div class="col-md-12 mt-4 row">
        <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Debtor 2 Name:</div>
        <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text6'); ?>" value="{{$spousename}}" class="form-control w-auto"></div>
        <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Primary Phone:</div>
        <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text7'); ?>" value="{{$spousePhoneHome }}" class="form-control w-auto"></div>
        <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center bb-0">Work Phone:</div>
        <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bb-0 bl-0"><input type="text" name="<?php echo base64_encode('text8'); ?>" value="" class="form-control w-auto"></div>
        <div class="border_1px col-md-3 px-3 py-1 d-flex align-items-center">Email Address:</div>
        <div class="border_1px col-md-9 px-3 py-1 d-flex align-items-center bl-0"><input type="text" name="<?php echo base64_encode('text9'); ?>" value="" class="form-control w-auto"></div>
    </div>

</div>