<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br>EASTERN DISTRICT OF NORTH CAROLINA<br>
            <select class="form-control w-auto" name="<?php echo base64_encode('form1[0].#subform[0].Division[0]')?>">
                <option value=""></option>
                <option value="Fayetteville">Fayetteville</option>
                <option value="Greenville">Greenville</option>
                <option value="New Bern">New Bern</option>
                <option value="Raleigh">Raleigh</option>
                <option value="Wilmington">Wilmington</option>
                <option value="Wilson">Wilson</option>
            </select> Division
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-3 pt-2">
                <label>In RE:</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="form1[0].#subform[0].TextField1[0]" class="" value="{{$debtorname}}"></x-officialForm.inputText>
            </div>
            <div class="col-md-3 pt-2 mt-1">
                <label>Debtors:</label>
            </div>
            <div class="col-md-9 mt-1">
                <x-officialForm.inputText name="form1[0].#subform[0].TextField11[0]" class="" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Bankruptcy Case No."
            casenoNameField="form1[0].#subform[0].TextField2[0]"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="row">
            <div class="col-md-4 mt-2 pt-2">
                <label>Chapter:</label>
            </div>
            <div class="col-md-8 mt-2">
                <select class="form-control w-auto" name="<?php echo base64_encode('form1[0].#subform[0].DropDownList1[0]')?>">
                    <option value=""></option>
                    <option value="7">7</option>
                    <option value="11">11</option>
                    <option value="13">13</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">CERTIFICATE OF SERVICE</h3>
        <p class="mt-3">I,
            <x-officialForm.inputText name="form1[0].#subform[0].Name1[0]" class="width_30percent" value=""></x-officialForm.inputText> , of the law firm of 
            <x-officialForm.inputText name="form1[0].#subform[0].TextField13[0]" class="width_30percent" value=""></x-officialForm.inputText>,certify:
        </p> 
        <p><span class="pl-4"></span>That I am, and at all times hereinafter mentioned was, more than eighteen (18) years of age:</p>
        <p><span class="pl-4"></span>
            That on <x-officialForm.inputText name="form1[0].#subform[0].DateTimeField2[0]" class="w-auto" value=""></x-officialForm.inputText> , I electronically filed the foregoing  
            <x-officialForm.inputText name="form1[0].#subform[0].TextField14[0]" class="w-auto" value=""></x-officialForm.inputText> 
            with the Clerk of the Court using the CM/ECF system which will send notification of such filing to the parties listed below.
            I further certify that I have mailed the document to the non CM/ECF participants as set out below by first class/certified mail.
        </p>
        <p><span class="pl-4 mt-3"></span>I certify under penalty of perjury that the foregoing is true and correct.</p>
    </div>
    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="form1[0].#subform[0].DateTimeField1[0]"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Name"
            inputFieldName="Text1"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="row mt-2">
            <div class="col-md-3">
            <label>Address</label>
            </div>
            <div class="col-md-9">
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].TextField12[0]')?>"  class="form-control" rows="3" cols="">{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-8 mt-3">
        <p class="text-bold underline">RECIPIENTS:</p>
        <p>Name & Address of Recipient(s), & type of Service (CM/ECF, U.S. Mail or Certified)</p>
        <x-officialForm.inputText name="form1[0].#subform[0].TextField3[0]" class="" value=""></x-officialForm.inputText> 
        <x-officialForm.inputText name="form1[0].#subform[0].TextField15[0]" class=" mt-1" value=""></x-officialForm.inputText> 
    </div>
    <div class="col-md-4 mt-3"></div>
</div>
