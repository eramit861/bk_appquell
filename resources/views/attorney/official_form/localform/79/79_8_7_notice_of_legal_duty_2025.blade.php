<div class="row">
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">NOTICE OF YOUR LEGAL DUTY</h3>
    </div>

    <div class="col-md-12 mb-3">
        <h3 class="text-center underline">RE: 2024 & 2025 TAX REFUNDS</h3>
    </div>

    <p class="text-center text-bold col-md-12">YOU MUST FILE A TIMELY TAX RETURN</p>

    <p class="col-md-12 p_justify">11 U.S.C. §523(a)(1)(B) authorizes the United States Bankruptcy Court to revoke your discharge if you do not file a timely tax return. You <strong>must provide a copy</strong> of your 2023 & 2024 tax return to your Trustee.</p>

    <h3 class="text-center text-bold col-md-12">YOU MUST TURN OVER YOUR 2024 & 2025 TAX REFUNDS TO YOUR BANKRUPTCY TRUSTEE</h3>

    <p class="p_justify col-md-12">Pursuant to 11 U.S.C. §541(a)(1), your bankruptcy estate is entitled to <strong class="underline">all</strong> your legal and equitable interests
        in property as of the commencement of the case. This includes your Federal and State tax refunds for the
        year 2024 & 2025 if you did not receive them before filing your bankruptcy. Failure to comply with this
        provision is grounds for revocation of your discharge and the imposition of criminal penalty (see below).
        Receipt of a bankruptcy discharge <strong>does not</strong> relieve you of this obligation.</p>

    <h3 class="text-center text-bold col-md-12">CONCEALMENT OF ASSETS IS A CRIME</h3>

    <p class="p_justify col-md-12">Under 18 U.S.C. §152, concealment of assets, such as a tax refund, by the Debtor is a felony punishable by as much as five years’ imprisonment.</p>
    <div class="col-md-12">
    <input type="text" name="<?php echo base64_encode('text1'); ?>" value="" class="form-control col-md-12">
    </div>

    <h3 class="text-center text-bold col-md-12 mt-3">ACKNOWLEDGEMENT OF TRUSTEE’S INSTRUCTIONS REGARDING TAX REFUNDS</h3>

    <p class="p_justify col-md-12">I hereby acknowledge that I understand that I must provide the Trustee with a copy of my 2024 & 2025
        federal and state tax returns and must, immediately upon receipt, turn over to the Trustee any and all tax refund
        checks for tax year 2024 & 2025 as well as any other tax refunds for other tax years prior to 2024 for which I am
        entitled to a refund but had not received the refund prior to the filing of my bankruptcy.</p>

    <p class="p_justify col-md-12">By signing this acknowledgement, I am indicating that I understand that these tax refunds are property of
        the bankruptcy estate and subject to administration on behalf of my creditors. I understand that receipt of a
        bankruptcy discharge does not relieve me of this obligation.</p>

        <div class="col-md-12 row">
    <div class="col-md-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Case Number"
                inputFieldName="text2"
                inputValue="{{$caseno}}">
            </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-4 pt-2">
        <input id="checkbox1" type="checkbox" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
    <label for="checkbox1">I am not required to file tax returns.</label>
    </div>
</div>
   
    <div class="row col-md-12">
        <div class="col-md-3 mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 1 Signature"
                inputFieldName="text3"
                inputValue="{{$debtor_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="col-md-3 mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name"
                inputFieldName="text4"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="col-md-3 mt-3">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="text5"
                currentDate="{{$currentDate}}">
            </x-officialForm.dateSingle>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-3 mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 2 Signature"
                inputFieldName="text6"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="col-md-3 mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name"
                inputFieldName="text7"
                inputValue="{{$spousename}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="col-md-3 mt-3">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="text8"
                currentDate="{{$currentDate}}">
            </x-officialForm.dateSingle>
        </div>
    </div>

</div>

