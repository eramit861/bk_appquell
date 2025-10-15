<div class="row">

    <div class="district78 col-md-12 border_1px">
        <div class="row">
            <div class="district78 col-md-12 text-center p-3" >
                <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF ALASKA') }}</h3> 
            </div>  
            <div class="district78 col-md-6 p-3 border_1px bl-0 bb-0 ">
                <x-officialForm.inReDebtorCustom
                    debtorNameField="Text1"
                    debtorname={{$debtorname}}
                    rows="2">
                </x-officialForm.inReDebtorCustom>
            </div>
            <div class="district78 col-md-6 border_top_1px pl-0 pr-0" >
                <div class="p-3">
                    <x-officialForm.caseNo
                            labelText="Case No."
                            casenoNameField="CASE NO"
                            caseno={{$caseno}}>
                    </x-officialForm.caseNo>
                    <div class="mt-2">
                        <label for="">{{ __('CHAPTER 7') }}</label>
                    </div>
                </div>
                <div class="district78 col-md-12 text-center pt-2 pb-2 p-3" style="border-top:1px solid #000;">
                    <h3>{{ __('DECLARATION REGARDING') }}<br>CHAPTER 7 ELECTRONIC FILING<br>{{ __('(SELF-REPRESENTED INDIVIDUAL)') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('I(we), the undersigned Debtor(s), hereby declare under penalty of perjury under the laws of the United States that:') }}</p>

        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('The information provided in the following documents filed using the Court’s Electronic Filing program for self-
                    represented debtors, if they have been submitted as part of the case opening petition package, is true and correct to
                    the best of my(our) knowledge and belief:') }}</p>
                <div class="d-flex">
                    <div class=" w-50 pr-3">
                        <p class="mb-2">{{ __('Voluntary Petition for Individuals Filing for Bankruptcy (Official Form B101)') }}</p>
                        <p class="mb-2">{{ __('Initial Statement About an Eviction Judgment Against You (Official Form B101A)') }}</p>
                        <p class="mb-2">{{ __('Schedules A - J, Summary of Schedules, Declaration About an Individual Debtor’s Schedules (Official Forms B106A-J, B106Sum, B106Decl)') }}</p>
                        <p class="mb-2">{{ __('Your Statement of Financial Affairs for Individuals Filing for Bankruptcy (Official Form B107)') }}</p>
                    </div>
                    <div class=" w-50 pl-3">
                        <p class="mb-2">{{ __('Statement of Intention for Individuals Filing Under Chapter 7 (Official Form B108)') }}</p>
                        <p class="mb-2">{{ __('Chapter 7 Statement of Your Current Monthly Income (Official Form B122A-1)') }}</p>
                        <p class="mb-2">{{ __('Statement of Exemption from Presumption of Abuse Under § 707(b)(2) (Chapter 7 Only) (Official Form B122A-1Supp)') }}</p>
                        <p class="mb-2">{{ __('Chapter 7 Means Test Calculation (Official Form B122A-2)') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-1">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="">{{ __('I(we) have read and understand the above-referenced document(s) filed electronically as part of the case opening
                    petition package (“Voluntary Petition”).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="">{{ __('I(we) have authorized the electronic filing of the Voluntary Petition with the United States Bankruptcy Court.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="">{{ __('I(we) verify my(our) master mailing list of creditors is true and correct to the best of my(our) knowledge. I(we) take all
                    responsibility for any errors or omissions in my(our) master mailing list.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="">{{ __('I(we) understand that making a false statement, concealing property, or obtaining money or property by fraud in
                    connection with a bankruptcy case can result in fines up to $250,000, or imprisonment for up to 20 years, or both. 18
                    U.S.C. §§ 152, 1341, 1519, and 3571.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('To be checked and applicable only if the petitioner(s) is(are) an individual (or individuals) whose debts are primarily
                    consumer debts as that termed is defined under 11 U.S.C. § 101(8):') }}</p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('checkbox1');?>" value="On" class="form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="">{{ __('I(we) am(are) aware that I(we) may proceed under chapter 7, 11, 12, or 13 of Title 11 United States Code; I(we)
                            understand the relief available under each such chapter; I(we) choose to proceed under chapter 7; and I(we)
                            request relief in accordance with chapter 7.') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-2 text_italic mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
        <div class="mt-2">
            <x-officialForm.dateSingle
                labelText="Date:"
                dateNameField="Date_2"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>

    <div class="col-md-5 text_italic text-center mt-3">
        <x-officialForm.signVertical
            labelText="Debtor's Printed Name "
            signNameField="Debtors Printed Name"
             sign="{{$onlyDebtor}}">
        </x-officialForm.signVertical>
        <div class="mt-2">
            <x-officialForm.signVertical
                labelText="Joint Debtor's Printed Name"
                signNameField="Joint Debtors Printed Name"
                    sign="{{$spousename}}">
            </x-officialForm.signVertical>
        </div>
    </div>

    
    <div class="col-md-5 text_italic text-center mt-3">
        <x-officialForm.signVertical
            labelText="Debtor's Signature "
            signNameField="Text3"
             sign="{{$debtor_sign}}">
        </x-officialForm.signVertical>
        <div class="mt-2">
            <x-officialForm.signVertical
                labelText="Joint Debtor's Signature"
                signNameField="Text4"
                    sign="{{$debtor2_sign}}">
            </x-officialForm.signVertical>
        </div>
    </div>
    
</div>
