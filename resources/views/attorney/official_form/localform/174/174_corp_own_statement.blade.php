<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br><x-officialForm.inputText name="UNITED STATES BANKRUPTCY COURT" class="w-auto" value="Northern"></x-officialForm.inputText> 
        District Of <x-officialForm.inputText name="District Of" class="w-auto" value="Mississippi"></x-officialForm.inputText></h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
        <div class="input-group mb-3">
            <label>In re</label>
            <x-officialForm.inputText name="In re" class="" value="{{$debtorname}}"></x-officialForm.inputText> 
            <label class="float_right text_italic">Debtor</label>
        </div>
       <div class="mt-2">
          <p class="mb-3">(when applicable, adversary caption should be used as set out below)</p>
          <x-officialForm.inputText name="Plainttff" class="" value=""></x-officialForm.inputText> 
          <label class="float_right text_italic mb-2">Plaintiff</label>
       </div>
       <div class="mt-3">
          <x-officialForm.inputText name="Defendant" class="" value=""></x-officialForm.inputText> 
          <label class="float_right text_italic">Defendant</label>
       </div>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Adv. Proc. No."
                casenoNameField="Adv Proc No"
                caseno="">
            </x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">CORPORATE OWNERSHIP STATEMENT</h3>
        <p class="mt-3 mb-3"><span class="pl-4"></span>
            Pursuant to Federal Rules of Bankruptcy Procedure 1007(a)(l) and/or 7007.l and to
            enable Judges to more effectively evaluate possible disqualification or recusal issues, the undersigned counsel for 
            <x-officialForm.inputText name="undersigned counsel for" class="width_40percent" value=""></x-officialForm.inputText> 
            in the above captioned action, certifies that the following is a (are) corporation(s), other than the
            debtor or a governmental unit, that directly or indirectly own( s) 10% or more of any class of the
            corporation's(s') equity interests, or states that there are no entities to report.
        </p>
    </div>
    <div class="col-md-6 mt-3">
    <x-officialForm.inputText name="corporationss equity interests or states that there are no entities to report 1" class="mt-1" value=""></x-officialForm.inputText> 
    <x-officialForm.inputText name="corporationss equity interests or states that there are no entities to report 2" class="mt-1" value=""></x-officialForm.inputText> 
    <x-officialForm.inputText name="corporationss equity interests or states that there are no entities to report 3" class="mt-1" value=""></x-officialForm.inputText> 
    <p class="mt-2"> 
        <x-officialForm.inputCheckbox name="Check Box11" class="" value="Yes"></x-officialForm.inputCheckbox> None [<span class="text_italic"> Check if applicable </span>]
    </p>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATE:"
            dateNameField="Text12"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Attorney or Litigant"
            inputFieldName="Text27"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Counsel for"
                inputFieldName="Counsel for"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-2">
            <label>Address, telephone number, Bar number</label>
            <textarea name="<?php echo base64_encode('Text13')?>" class="form-control mt-1" value="{{$debtorname}}" rows="4">{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_state_bar_no}}</textarea>
        </div>
    </div>
</div>
