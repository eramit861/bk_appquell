<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">United States Bankruptcy Court<br>District of Maine</h3>
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
        <h3 class="text-center">CERTIFICATION OF CREDITOR MATRIX</h3>
        <p class="mb-0">
            <span class="pl-4"></span>
            I hereby certify that the attached matrix, consisting of
            <x-officialForm.inputText name="Text1" class="width_5percent" value=""></x-officialForm.inputText>
            pages, includes the names and addresses of all creditors listed on the debtor's schedules.
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
        <x-officialForm.inputText name="Text2" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <label for="">Signature of Attorney</label>
    </div>

</div>