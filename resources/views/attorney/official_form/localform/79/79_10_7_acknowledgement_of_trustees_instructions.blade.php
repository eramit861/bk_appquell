<h3 class="underline col-md-12 text-center">READ AND SIGN THIS DOCUMENT</h3>

<h3 class="col-md-12 text-center mt-3">Acknowledgment of Trustee's Instructions</h3>
<h3 class="col-md-12 text-center">Re: 2022 and 2021 TAX RETURNS & REFUNDS</h3>


<p class="col-md-12 text-center mt-3">Trustee will request 2022 tax returns upon filing in 2023 if your case is still open at end of this year.
You will receive a reminder via email or mail</p>

<p>Chapter 7 Bankruptcy Case No. <input class="form-control w-auto" value="{{$caseno}}" type="text" name="<?php echo base64_encode('Text1'); ?>">, District of Arizona</p>

<p>I/We hereby acknowledge my/our Trustee's instructions regarding my/our 2022 and 2021 Federal and State income tax returns and refunds.</p>

<p><span class="text-bold">TAX RETURNS :</span> I/We understand and hereby acknowledge that I/We must immediately, upon filing with the
tax authorities, turn over to the Trustee copies of Federal and State tax returns for the year 2022 / 2021 <span class="underline">and earlier years</span>, if applicable.</p>

<p class="text-bold">TAX REFUNDS:</p>
<p class="sub-child">• I/We understand and hereby acknowledge that I/We must immediately, upon receipt, turn over to the Trustee all tax refunds for the year 2022 / 2021 <span class="underline">and earlier years</span> if received after filing bankruptcy.</p>
<p class="sub-child">• I/ We understand that by signing this document, I/ We acknowledge these tax refunds to be assets of the bankruptcy estate, subject to administration on behalf of my/our creditors.</p>
<p class="sub-child">• I/We further give our approval to the Internal Revenue Service, Special Procedures, to send the federal refund check for the above-specified years directly to the Trustee, Trudy A. Nowak.</p>

<p>
    <span class="text-bold">DEBTOR(S)' PRORATED REFUNDS FROM FILING DATE TO DEC 31 :</span>
    If applicable, the trustee will
send the debtor(s) a pro-rata share of all tax refunds she receives. The bankruptcy estate is entitled to a
percentage of the refunds (# of days in the year up to the filing date of the bankruptcy, divided by 365). The
debtor(s) are entitled to a percentage of the refunds (# of days from the filing date until December 31st, divided
by 365), less any outstanding non-exempt assets due to the estate.</p>

<p class="col-md-3">Dated:<input class="form-control w-auto date_filed" placeholder="MM/DD/YYYY" value="{{$currentDate}}" type="text" name="<?php echo base64_encode('Text2'); ?>"></p>

<div class="col-md-3 mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor's Signature"
                inputFieldName="Text3"
                inputValue="{{$debtor_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
</div>

<div class="col-md-3 mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor's Signature"
                inputFieldName="Text4"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
</div>