<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT <br>
        EASTERN DISTRICT OF NORTH CAROLINA<br>
        <x-officialForm.inputText name="DIVISION" class="w-auto" value=""></x-officialForm.inputText> DIVISION
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label>IN THE MATTER OF:</label>
            <textarea name="<?php echo base64_encode('Text24')?>" class="form-control" rows="2">{{$debtorname}}</textarea>
            <label>Debtor(s)</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="CASE NUMBER:"
            casenoNameField="Text23"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">SCHEDULE C - 2 - PROPERTY CLAIMED AS EXEMPT</h3>
        <p class="mt-3"><span class="pl-4"></span>
            I, <x-officialForm.inputText name="I" class="width_30percent" value=""></x-officialForm.inputText> , claim the following property as exempt pursuant to 11 U.S.C. § 522 and the Federal bankruptcy law or
            the laws of a State other than North Carolina, and nonbankruptcy Federal law: <span class="text_italic text-bold"> (Attach additional sheets if necessary)</span>.
        </p> 
        <p>
            <x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes"></x-officialForm.inputCheckbox>
            Check if debtor claims a homestead exemption that exceeds $125,000.
        </p>
        <div class="table_sect table table_sect_head_border th">
            <table class="w-100">
                <tr>
                    <th class="underline p-2">Description of Property</th>
                    <th class="underline p-2">Specify Law<br> Providing Each<br>Exemption</th>
                    <th class="underline p-2">Value of <br> Claimed <br> Exemption</th>
                    <th class="underline p-2">Current<br> Market Value of Property<br>Without Deducting Exemption</th>
                </tr>
                <tr>
                    <td class="p-2"><textarea name="<?php echo base64_encode('Text19')?>" value="{{$onlyDebtor}}" class="form-control" rows="9" cols=""></textarea></td>
                    <td class="p-2"><textarea name="<?php echo base64_encode('Text20')?>" value="{{$onlyDebtor}}" class="form-control" rows="9" cols=""></textarea></td>
                    <td class="p-2"><textarea name="<?php echo base64_encode('Text21')?>" value="{{$onlyDebtor}}" class="form-control" rows="9" cols=""></textarea></td>
                    <td class="p-2"><textarea name="<?php echo base64_encode('Text22')?>" value="{{$onlyDebtor}}" class="form-control" rows="9" cols=""></textarea></td>
                </tr>
            </table>
            <p class="mt-2 mb-2"><span class="pl-4"></span>
                I declare that the following are the dates and addresses of my domicile during the 730 days preceding the date of the filing of the bankruptcy petition:
            </p>
            <table class="w-100">
                <tr>
                    <th class="underline text-center p-2">Dates</th>
                    <th class="underline text-center p-2">Addresses</th>
                </tr>
                <tr>
                    <td class="p-2"><textarea name="<?php echo base64_encode('DatesRow1')?>" value="" class="form-control" rows="6" cols=""></textarea></td>
                    <td class="p-2"><textarea name="<?php echo base64_encode('AddressesRow1')?>" value="" class="form-control" rows="6" cols=""></textarea></td>
                </tr>
            </table>
        </div>
        <p class="mt-2">
            <span class="pl-4"></span>
            I declare that to the extent that any exemption I have claimed appears on its face to exceed the amount allowed by the applicable
            statute, I claim only the maximum amount allowed by statute.
        </p>
        <h3 class="mt-3 mb-3 text-center">
            UNSWORN DECLARATION UNDER PENALTY OF PERJURY<br>
            ON BEHALF OF INDIVIDUAL TO SCHEDULE C-2 - PROPERTY CLAIMED AS EXEMPT
        </h3>
        <p class="mt-1">
            I, <x-officialForm.inputText name="I_2" class="width_30percent" value=""></x-officialForm.inputText> ,
            declare under penalty of perjury that I have read the foregoing
            Schedule -C-2 - Property Claimed as Exempt, consisting of
            <x-officialForm.inputText name="Schedule C2  Property Claimed as Exempt consisting of" class="w-auto mt-1" value=""></x-officialForm.inputText>
            sheets, and that they are true and correct to the best of my knowledge, information and belief.
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on:"
            dateNameField="Executed on"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>
