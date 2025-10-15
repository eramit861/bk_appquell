<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">United States Bankruptcy Court<br>Eastern District of Kentucky</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0 mb-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="In re"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 mb-3">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">VERIFICATION OF MAILING LIST MATRIX</h3>
        <p class="mb-0">
            <span class="pl-4"></span>
            I, 
            <x-officialForm.inputText name="IName" class="width_30percent" value=""></x-officialForm.inputText>
            the petitioner(s) in the above-styled bankruptcy action, declare under penalty of
            perjury that the attached mailing list matrix of creditors and other parties in interest consisting of 
            <x-officialForm.inputText name="Text2" class="width_5percent" value=""></x-officialForm.inputText>
            page(s) is true and correct
            and complete, to the best of my (our) knowledge.
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.inputText name="undefined" class="" value="{{$debtor_sign}}"></x-officialForm.inputText>
        <label for="">Signature of Debtor</label>
    </div>
    
    <div class="col-md-12 mt-3 mb-3">
        <p class="mb-0">
            <span class="pl-4"></span>
            I, 
            <x-officialForm.inputText name="I_2" class="width_30percent" value=""></x-officialForm.inputText>
            ,counsel for the petitioner(s) in the above-styled bankruptcy action, declare that the attached
            Master Address List consisting of
            <x-officialForm.inputText name="Master Address List consisting of" class="width_5percent" value=""></x-officialForm.inputText>
            page(s) has been verified by comparison to Schedules D through H to be complete, to the best of my
            knowledge. I further declare that the attached Master Address List can be relied upon by the Clerk of Court to provide notice to all creditors and
            parties in interest as related to me by the debtor(s) in the above-styled bankruptcy action until such time as any amendments may be made.
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <x-officialForm.inputText name="Text1" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <label for="">Signature of Attorney</label>
    </div>

</div>