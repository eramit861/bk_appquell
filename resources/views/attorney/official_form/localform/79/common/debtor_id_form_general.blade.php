<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">DECLARATION VERIFYING DEBTOR IDENTITY AND SOCIAL SECURITY NUMBER</h3>
    </div>

    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('BANKRUPTCY CASE NUMBER:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text1'); ?>" value="{{$caseno}}" class="form-control w-auto">
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <p class="p_justify text-bold">DEBTOR 1</p>
        <p class="p_justify text-bold">I declare that the following statements are true and correct to the best of my knowledge under penalty of perjury:</p>

        <p class="sub-child text-bold p_justify">1. My name is <input type="text" name="<?php echo base64_encode('text2'); ?>" value="{{$onlyDebtor}}" class="form-control w-auto">. I am the debtor (Debtor 1) in the above referenced bankruptcy case.</p>
        <p class="sub-child text-bold p_justify">2. Attached to this Declaration is a true and correct copy of my government issued photo identification. The
            name on my photo identification is the same name I used in my bankruptcy petition in the above referenced bankruptcy case.
        <p>
        <p class="sub-child text-bold p_justify">3. Attached to this Declaration is a true and correct copy of proof of my Social Security Number. The social
            security number on this document is the same social security number that I used in my bankruptcy petition for the above referenced bankruptcy case.</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor 1"
            inputFieldName="text3"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="text4"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>

    <p class="p_justify text-bold mt-3 col-md-12">*ATTACH LEGIBLE <u>COPIES</u> OF YOUR PHOTO ID AND PROOF OF SOCIAL SECURITX NUMBER (color preferred)*</p>

    <h3 class="text-center border_top_1px border_bottom_1px py-1  col-md-12">BELOW FOR JOINT CASES ONLY</h3>

    <!-- Debtor 2 -->

    <div class="col-md-12 mt-3 mb-3">
        <p class="p_justify text-bold">DEBTOR 2</p>
        <p class="p_justify text-bold">I declare that the following statements are true and correct to the best of my knowledge under penalty of perjury:</p>

        <p class="sub-child text-bold p_justify">1. My name is <input type="text" name="<?php echo base64_encode('text5'); ?>" value="{{$spousename}}" class="form-control w-auto">. I am the debtor (Debtor 1) in the above referenced bankruptcy case.</p>
        <p class="sub-child text-bold p_justify">2. Attached to this Declaration is a true and correct copy of my government issued photo identification. The
            name on my photo identification is the same name I used in my bankruptcy petition in the above referenced bankruptcy case.
        <p>
        <p class="sub-child text-bold p_justify">3. Attached to this Declaration is a true and correct copy of proof of my Social Security Number. The social
            security number on this document is the same social security number that I used in my bankruptcy petition for the above referenced bankruptcy case</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor 2"
            inputFieldName="text6"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="text7"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>

    <p class="p_justify text-bold mt-3 col-md-12">*ATTACH LEGIBLE <u>COPIES</u> OF YOUR PHOTO ID AND PROOF OF SOCIAL SECURITX NUMBER (color preferred)*</p>

</div>