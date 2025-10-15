<div class="row">
    <div class="col-md-12 mt-3 text-center">
        <h3>{{ __('CHAPTER 7 DEBTOR DOCUMENT CHECKLIST') }}</h3>
    </div>

    <div class="col-md-2 mt-3 text-bold">
        <label class="mt-2">{{ __('DEBTOR(S) NAME(S):') }}</label>
    </div>
    <div class="col-md-10 mt-3">
        <input type="text" name="<?php echo base64_encode('Debtors Names');?>" value="{{$onlyDebtor}}" class="form-control">
    </div>

    <div class="col-md-2 mt-3 text-bold">
        <label class="mt-2">{{ __('CASE NUMBER:') }}</label>
    </div>
    <div class="col-md-2 mt-3">
        <input type="text" name="<?php echo base64_encode('Case Number');?>" value="{{$caseno}}" class="form-control w-auto">
    </div>
    <div class="col-md-3 mt-3 text-bold">
        <label class="mt-2">{{ __('MEETING OF CREDITORS/341 HEARING DATE:') }}</label>
    </div>
    <div class="col-md-5 mt-3">
        <input type="text" name="<?php echo base64_encode('Meeting of Creditors/341 Hrg Date');?>" class="form-control w-auto">
    </div>

    <div class="col-md-12 mt-3">
        <p class="p_justify text-bold">
            {{ __('The following documents must be sent to your Chapter 7 trustee. Unless the Chapter 7 trustee
            requests otherwise, this completed form and the requested documents shall be sent via U.S. Mail,
            postmarked no later than 14 days before the Meeting of Creditors/341 Hearing Date. For any
            unavailable document, provide a written explanation regarding your efforts to obtain copies of the
            document.') }}
        </p>
        <p class="p_justify text-bold">
            {{ __('If represented by an attorney, all debtors should discuss their responses with their attorneys before
            sending to the trustee.') }}
        </p>
        <p class="p_justify text-bold">
            {{ __('UNLESS INDICATED, PROVIDE COPIES ONLY (DOCUMENTS WILL NOT BE RETURNED)') }}
        </p>

        <p class="p_justify">
            <span class="text-bold underline">{{ __('N/A') }}</span> <span class="text-bold underline pl-3 pr-3">{{ __('Enclosed') }}</span> {{ __('(please mark a box for each item)') }}
        </p>
        <div class=" table_sect p_justify">
            <table class="w-100">
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box2');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">1.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            <span class="text-bold">{{ __('ORIGINAL') }}</span>
                             {{ __('completed and signed Chapter 7 Debtor Questionnaire
                            (attached).') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">2.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            <span class="text-bold">{{ __('ORIGINAL') }}</span>
                            {{ __('completed “Domestic Support Form” (attached).') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">3.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __("If your 341(a) meeting of creditors is being conducted telephonically or by video
                            conference, valid photo identification and proof of Social Security Number must be
                            provided to your Trustee in accordance with the United States Trustee’s policy for
                            Region 14.") }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">4.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Two most recently filed tax returns, both federal and state.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box9');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box10');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">5.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Tax returns (both federal and state) for the tax year that includes the date of your
                            bankruptcy filing when they have been filed with the appropriate taxing authorities.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box11');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box12');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">6.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Statements for every FINANCIAL ACCOUNT held in your name, or on your
                            behalf, for the three (3) complete months before the date of your bankruptcy filing,
                            and the statement(s) that cover the date of your bankruptcy filing (four months total).
                            FINANCIAL ACCOUNT includes bank accounts, credit union accounts, prepaid
                            debit card accounts, cash app accounts, money market accounts, brokerage
                            accounts, and any other deposit or investment accounts. If statements are issued only
                            on a quarterly basis, please provide the most recent statement(s) that you received
                            before the date of your bankruptcy filing and the statement that covers the date of
                            your bankruptcy filing.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box13');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box14');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">7.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Statements for every retirement account held in your name, or on your behalf, for
                            the three (3) complete months before the date of your bankruptcy filing, and the
                            statement(s) that cover the date of your bankruptcy filing (four months total). If
                            statements are issued only on a quarterly or annual basis, please provide the most
                            recent statement(s) that you received before the date of your bankruptcy filing.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box15');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box16');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">8.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Most recent statement for all whole life insurance policies and annuities that you own.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box17');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box18');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">9.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Pay stubs or other income verification covering the pay periods before and
                            immediately following the date of your bankruptcy filing.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box19');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box20');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">10.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('Most recent loan statement for any loan secured by real property held in your name or on your behalf.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box21');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box22');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">11.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('If you are making payments on a car loan (including a title loan or registration loan),
                            the most recent statement for the loan.') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box23');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box24');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">12.</td>
                    <td class="p-2">
                        <p class="">
                            {{ __('Certificates of Title for all vehicles (copies only). If you do not have the Certificates
                            of Title, please provide either (i) a print-out of a motor vehicle record or title status
                            obtained from the Motor Vehicle Department (either in person or online) showing
                            the title issuance date or (ii) a copy of your vehicle registration, showing the full
                            VIN number.') }}
                        </p>
                        <p class="mb-0 text-bold text_italic">
                        {{ __('A Vehicle Title Status can be obtained for FREE at') }} <a href="" class=" text-c-blue">{{ __('www.azmvdnow.gov') }}</a>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box25');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box26');?>" value="Yes" class="form-control w-auto">
                    </td>
                    <td class="p-2">13.</td>
                    <td class="p-2">
                        <p class="mb-0">
                            {{ __('If you have been divorced within the past two years, a copy of your divorce
                            decree and/or property settlement agreement.') }}
                        </p>
                    </td>
                </tr>
            </table>

        </div>
        
    </div>

</div>