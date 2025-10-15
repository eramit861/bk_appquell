<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br>NORTHERN DISTRICT OF MISSISSIPPI</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper text-bold">
        <div class="input-group mb-3">
            <label>In re</label>
            <x-officialForm.inputText name="Debtor" class="" value="{{$debtorname}}"></x-officialForm.inputText>
            <x-officialForm.inputText name="Debtor(s)" class="mt-1" value=""></x-officialForm.inputText>
            <label>Debtor(s).</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper text-bold">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case Number"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="mt-2">
          <label>Chapter: 13</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">DEBTOR(S)’ MOTION TO DISMISS CHAPTER 13 CASE</h3>
        <p class="mt-3 mb-3"><span class="pl-4"></span>
            Comes now the Debtor(s) in the above-captioned case and move(s) this Court for an
            order dismissing this case pursuant to 11 U.S.C. § 1307(b). The Debtor(s) represent(s) to the
            Court that this case has not previously been converted under Section 706, 1112 or 1208 of Title
            11 of the United States Code, and that this Motion is being filed and served as required by Fed.
            R. Bankr. P. 9013.
        </p>
        <p><span class="pl-4"></span>
            WHEREFORE, the Debtor(s) request(s) that the Court enter an ex parte order dismissing
            this case, ordering the chapter 13 trustee to file a final report and account, and giving parties-ininterest
            14 days to object to the dismissal pursuant to Local Rule.
        </p>
    </div>
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <label for="">Respectfully Submitted,</label>
        <x-officialForm.inputText name="Signature" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
    </div>
    <div class="col-md-6 mt-3 text-c-red">
        <p class="mb-1">Required Attorney Information:</p>
        <p class="mb-1">Name/Bar #</p>
        <p class="mb-1">Firm</p>
        <p class="mb-1">Attorney for the Debtor(s)</p>
        <p class="mb-1">Address</p>
        <p class="mb-1">Telephone Number </p>
    </div> 
    <div class="col-md-6 mt-3">
        <textarea name="<?php echo base64_encode('Attorney Information')?>" class="form-control mt-3" value="" rows="6">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$atroneyName}}
{{$onlyDebtor}}
{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
</textarea>
    </div>
</div>
