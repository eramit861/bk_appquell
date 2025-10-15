<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br>FOR THE NORTHERN DISTRICT OF WEST VIRGINIA</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
        <div class="input-group">
            <label>IN RE: </label>
            <textarea name="<?php echo base64_encode('Text30')?>" value="" class=" form-control" rows="2">{{$debtorname}}</textarea>
            <p class="mb-0 text-center">Debtors</p>
        </div>
       <div class="nt-1">
          <textarea name="<?php echo base64_encode('Text31')?>"  value="" class=" form-control" rows="2"></textarea>
          <p class="mb-0 text-center">Plaintiff</p>
          <label for="">v.</label>
       </div>
       <div class="mt-1">
          <textarea name="<?php echo base64_encode('Text32')?>" value="" class=" form-control" rows="2"></textarea>
          <p class="mb-0 text-center">Defendant</p>
       </div>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="BK NO."
            casenoNameField="Text33"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="AP NO."
                casenoNameField="Text34"
                caseno="">
            </x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">CORPORATE OWNERSHIP STATEMENT [RULES 1007(a)(1) & 7007.1]</h3>
        <p class="mt-3 mb-3">
            Pursuant to Federal Rules of Bankruptcy Procedures 1007(a)(1) and 7007.1 and to enable the
            Judge to evaluate possible disqualification or recusal, the undersigned counsel for  
            <x-officialForm.inputText name="Text35" class="w-auto" value=""></x-officialForm.inputText>
            <x-officialForm.inputText name="Text36" class="width_30percent" value=""></x-officialForm.inputText>
            in the above-captioned action certifies that the following is a (are)
            corporation(s), other than the debtor or a governmental unit, that directly or indirectly own(s)
            10% or more of any class of the corporation’s (s’) equity interests, <span class="text-bold"> OR </span> states that there are no
            entities to report under FRBP 1007(a)(1) or 7007.1:
        </p>
        <p><x-officialForm.inputCheckbox name="Check Box37" class="" value="Yes"></x-officialForm.inputCheckbox>None [<span class="text_italic"> heck if applicable </span>]</p>
    </div>
   
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.inputText name="Counsel for" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Counsel for"
                inputFieldName="undefined"
                inputValue="{{$attorney_name}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
</div>
