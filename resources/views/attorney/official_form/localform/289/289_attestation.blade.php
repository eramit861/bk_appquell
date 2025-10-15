<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
        {{ __('COVID-19 Vaccination Status Attestation') }}<br>
            {{ __('For Admitted Counsel and Employees & Contractors of Their Offices') }}<br>
            {{ __('Appearing in Person for Proceedings Before the') }}<br>
            {{ __('United States Bankruptcy Court') }}<br>
            {{ __('Eastern District of Virginia') }}
        </h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class=" p_justify">
        {{ __('All admitted counsel and employees and contractors of their offices entering our Courthouses or Court facilities who
            will appear for a scheduled, live, in person proceeding before the United States Bankruptcy Court on or after') }}
            <span class="text-bold">{{ __('September 1, 2021,') }}</span> {{ __('must submit this vaccination self-attestation form concerning their COVID-19 vaccination status
            in advance of the entering the Courthouse or Court facility. You do not need to provide any medical information on
            this form, nor any explanation concerning your decision to receive or not to receive a COVID-19 vaccine. Completed
            forms must be emailed to vaeb_counsel_attestation@vaeb.uscourts.gov. When possible, such forms should be
            submitted at least two (2) business days prior to entering our Courthouses and Court facilities.') }}
        </p>
        <p class=" p_justify">
            {{ __('Admitted counsel who do not have any live, in person proceedings scheduled before the United States Bankruptcy
            Court do not need to submit a vaccination attestation form unless and until a live, in person proceeding is scheduled
            by the presiding judge for which admitted counsel and employees and contractors of their offices will appear. A
            completed vaccination attestation form must be submitted in advance of entering our Courthouses or Court facilities
            on or after September 1, 2021.') }}
        </p>
        <p class=" p_justify">
            {{ __('If you believe you are entitled to an exemption from vaccination, you will need to request it in writing. Individuals who
            are not vaccinated and have not received an exemption, as well as those who decline to disclose their vaccination
            status, will be required to undergo COVID-19 testing and wear a mask when present in our Courthouses and Court
            facilities, as outlined in Standing Order 21-16. Individuals granted an exemption must similarly undergo COVID-19
            testing and wear a mask in our Courthouses and Court facilities, though as outlined in Standing Order 21-16, different
            requirements may apply to those who are granted an exemption.') }}
        </p>
        
        <p>
        {{ __('Name') }}:
            <input type="text" name="<?php echo base64_encode('Text1'); ?>" class="form-control width_50percent mr-0 ml-3">
        </p>

        <p>
        {{ __('Classification') }}:
            <input type="checkbox" name="<?php echo base64_encode('Check Box2'); ?>" class="form-control w-auto mr-0 ml-3" value="Yes">
            {{ __('Attorney') }}
            <input type="checkbox" name="<?php echo base64_encode('Check Box3'); ?>" class="form-control w-auto mr-0 ml-3" value="Yes">
            {{ __('Law Firm Employee/Contractor') }}
        </p>
        <p class="text-bold">
            {{ __('Please choose one of the following options:') }}
        </p>
    </div>
    
    <div class="col-md-12 pl-4">
        <div class="d-flex">
            <div class="width_5percent">
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box4'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('1.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                    {{ __('I am fully vaccinated (being “fully vaccinated” means that two weeks have passed after receiving the
                    second dose of a two-dose vaccine (Pfizer or Moderna) or after receiving the single-dose vaccine
                    (Johnson & Johnson)).') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="width_5percent">
                <p class=" mt-2">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box5'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('2.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                {{ __('I received my second dose of the Pfizer or Moderna vaccine or my single dose of the Johnson &
                    Johnson vaccine less than two weeks ago on') }} <input type="text" name="<?php echo base64_encode('Text10'); ?>" class="form-control w-auto">{{ __('.
                    (date)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="width_5percent">
                <p class=" mt-2">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box6'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('3.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                {{ __('I received my first dose of the Pfizer or Moderna vaccine, and my second appointment is scheduled
                    for') }} <input type="text" name="<?php echo base64_encode('Text11'); ?>" class="form-control w-auto">{{ __('.
                    (date)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="width_5percent">
                <p class=" mt-2">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box7'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('4.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                {{ __('I have not yet been vaccinated, but I have scheduled an appointment to receive my first dose of
                    vaccine on') }} <input type="text" name="<?php echo base64_encode('Text12'); ?>" class="form-control w-auto">{{ __('.
                    (date)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="width_5percent">
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box8'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('5.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                    {{ __('I have not been vaccinated.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="width_5percent">
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('Check Box9'); ?>" class="form-control height_fit_content w-auto" value="Yes">
                    {{ __('6.') }}
                </p>
            </div>
            <div class="w-100">
                <p class="mb-2">
                    {{ __('I decline to disclose my vaccination status.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <p class="p_justfiy">
            {{ __('I understand that I am required to provide accurate information on this form. I hereby affirm that I have accurately
            and truthfully answered the above question. I also understand that if I stated that I am fully or partially vaccinated,
            the Court may request documentation of my vaccination status (e.g., a copy of my vaccine card or other similar official
            document confirming vaccination status).') }}
        </p>
    </div>

    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('TextBox0'); ?>" class=" form-control" value="{{$attorny_sign}}">
        <label for="">{{ __('Electronic or Ink Signature') }}</label>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text13"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    

</div>