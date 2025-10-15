<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">MAILING LIST DECLARATION</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0 mb-3">
        <label for="">Debtor(s)' Name(s)</label>
        <?php $first_name = !empty($spousename) ? $onlyDebtor.' and' : $onlyDebtor; ?>
        <x-officialForm.inputText name="Text1" class="" value="{{$first_name}}"></x-officialForm.inputText>
        <x-officialForm.inputText name="Text2" class="mt-1" value="{{$spousename}}"></x-officialForm.inputText>
    </div>
    <div class="col-md-6 border_1px p-3 mb-3">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text3"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mb-0 mt-3 d-flex">
            <x-officialForm.inputCheckbox name="Check Box10" class="ml-0 mr-3" value="Yes"></x-officialForm.inputCheckbox>
            Check if this is an Amended/Supplemental Mailing List (Include only newly added or changed creditors.)
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <p>
            <span class="pl-4"></span>
            I, 
            <x-officialForm.inputText name="Text4" class="width_30percent" value=""></x-officialForm.inputText>
            , do hereby certify, under penalty of perjury, that the Mailing List, consisting of 
            <x-officialForm.inputText name="Text5" class="width_5percent" value=""></x-officialForm.inputText>
            page(s), is complete, correct and consistent with the debtor(s)' Schedules.
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text6"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.inputText name="Text7" class="" value="{{$debtor_sign}}"></x-officialForm.inputText>
        <label for="">(Debtor)</label>
    </div>
    
    <div class="col-md-6 mt-2">
        <x-officialForm.inputText name="Text8" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <label for="">(Attorney, if applicable)</label>
    </div>
    <div class="col-md-6 mt-2">
        <x-officialForm.inputText name="Text9" class="" value="{{$debtor2_sign}}"></x-officialForm.inputText>
        <label for="">(Joint Debtor)</label>
    </div>

</div>