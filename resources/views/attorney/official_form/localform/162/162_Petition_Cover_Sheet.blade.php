<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>Eastern District of Michigan<br>
            <input type="text" name="<?php echo base64_encode('Eastern District of Michigan');?>" class="form-control w-auto">
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3 underline">{{ __('BANKRUPTCY PETITION COVER SHEET') }}</h3>
        <p class="mb-2">
            {{ __('(The debtor must complete and file this form with the petition in every bankruptcy case. Instead of filling in the boxes on the
            petition requiring information on prior and pending cases, the debtor may refer to this form.)') }}
        </p>
        <p class="text-center text-bold">{{ __('Part 1') }}</p>
        <p class="mb-2">
            {{ __('“Companion cases,” as defined in L.B.R. 1073-1(b), are cases involving any of the following: (1) The same debtor; (2) A corporation and any majority
            shareholder thereof; (3) Affiliated corporations; (4) A partnership and any of its general partners; (5) An individual and his or her general partner; (6)
            An individual and his or her spouse; or (7) Individuals or entities with any substantial identity of financial interest or assets') }}
        </p>
        <div class="d-flex">
        {{ __('Has a “companion case” to this case ever been filed at any time in this district or any other district?') }}
            <div class="">
            <span class="pl-4">
            {{ __('Yes') }} <input type="checkbox" name="<?php echo base64_encode('Check Box2');?>" value="Yes" class="form-control w-auto height_width_content">
            </span>
            <span class="pl-4">
            {{ __('No') }} <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto height_width_content pl-4">
            </span>
        </div>

        </div>
        <p class="text-bold">{{ __('(If yes, complete Part 2.)') }}</p>
        <p class="text-center text-bold">{{ __('Part 2') }}</p>
        <p class="text-bold">{{ __('For each companion case, state in chronological order of cases: (Attach supplemental sheets if necessary.)') }}</p>
        <table class="w-100">
            <tr>
                <td></td>
                <td class="pl-3">{{ __('First Case') }}</td>
                <td class="pl-3">{{ __('Second Case') }}</td>
                <td class="pl-3">{{ __('Third Case') }}</td>
            </tr>
            <tr>
                <td>{{ __('Name on petition') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 1');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 1');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 1');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Relationship to this case') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 2');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 2');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 2');?>" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 3');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 3');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 3');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Case Number') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 4');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 4');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 4');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Chapter') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 5');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 5');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 5');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Date filed') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 6');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 6');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 6');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('District') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 7');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 7');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 7');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Division') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 8');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 8');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 8');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Judge') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 9');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 9');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 9');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Status/Disposition') }}</td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('First Case 10');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Second Case 10');?>" class="form-control"></td>
                <td class="pl-3"><input type="text" name="<?php echo base64_encode('Third Case 10');?>" class="form-control"></td>
            </tr>
        </table>
        <p class="pt-2">{{ __('(Pending, confirmed & still open, confirmed & closed, dismissed before/after confirmation, discharged, etc.)') }}</p>
        <p class="text-bold">{{ __('If the present case is a Chapter 13 case, state for each companion case:') }}</p>
        <table class="w-100">
            <tr>
                <td>{{ __('Attorney') }}</td>
                <td class="pl-3 pr-2"><input type="text" name="<?php echo base64_encode('If the present case is a Chapter 13 case state for each companion case');?>" class="form-control"></td>
                <td class="pl-3 pr-2"><input type="text" name="<?php echo base64_encode('undefined');?>" class="form-control"></td>
                <td class="pl-3 pr-2"><input type="text" name="<?php echo base64_encode('undefined_5');?>" class="form-control"></td>
            </tr>
            <tr>
                <td>{{ __('Legal fee') }}</td>
                <td class="pl-3">
                    <x-officialForm.priceFieldInput
                    inputFieldName="undefined_2"
                    inputValue="">
                    </x-officialForm.priceFieldInput>
                </td>
                <td class="pl-3">
                    <x-officialForm.priceFieldInput
                    inputFieldName="undefined_4"
                    inputValue="">
                    </x-officialForm.priceFieldInput>
                </td>
                <td class="pl-3">
                    <x-officialForm.priceFieldInput
                    inputFieldName="undefined_6"
                    inputValue="">
                    </x-officialForm.priceFieldInput>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-3 pt-2 pr-0">
                <p class="mb-0">{{ __('Proposed legal fee in this case') }}</p>
            </div>
            <div class="col-md-3 pl-0">
                <x-officialForm.priceFieldInput
                    inputFieldName="undefined_3"
                    inputValue="">
                </x-officialForm.priceFieldInput>
            </div>
            <div class="col-md-6"></div>
        </div>
        <p class="mb-1 pt-2">{{ __('Changes in circumstances which lead the debtor to reasonably believe that the current plan will be successful.') }}</p>
        <input type="text" name="<?php echo base64_encode('Changes in circumstances which lead the debtor to reasonably believe that the current plan will be successful 1');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Changes in circumstances which lead the debtor to reasonably believe that the current plan will be successful 2');?>" class="form-control mt-1">
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-center text-bold">{{ __('Part 3 - In a Chapter 13 Case Only') }}</p>
        <p>{{ __('The Debtor(s) certify, re: 11 U.S.C.§ 1328(f):') }}</p>
        <p class="text-bold"><span class="pl-4"></span>{{ __('[indicate which]') }}</p>
        <p class="pl-4"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto height_width_content">
            {{ __('Debtor(s) received a discharge issued in a case filed under Chapter 7, 11, or 12 during the 4-years before filing this case.') }}
        </p>
        <p class="pl-4"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control w-auto height_width_content">
            {{ __('Debtor(s) did') }} <span class="text-bold"> {{ __('not') }} </span> {{ __('receive a discharge issued in a case filed under Chapter 7, 11, or 12 during the 4-years before filing this case') }}
        </p>
        <p class="pl-4"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control w-auto height_width_content">
            {{ __('Debtor(s) received a discharge in a Chapter 13 case filed during the 2-years before filing this case.') }}
        </p>
        <p class="pl-4"><span class="pl-4"></span>
            <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control w-auto height_width_content">
            {{ __('Debtor(s) did') }} <span class="text-bold"> {{ __('not') }} </span> {{ __('receive a discharge in a Chapter 13 case filed during the 2-years before filing this case') }}
        </p>
        <p>{{ __('I declare under penalty of perjury that I have read this form and that it is true and correct to the best of my information and belief..') }}</p>
    </div>

    <div class=" col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="I declare under penalty of perjury that I have read this form and that it is true and correct to the best of my information and belief"
            inputValue={{$onlyDebtor}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class=" col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue={{$onlyDebtor}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class=" col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor’s Attorney"
            inputFieldName="Debtors Attorney"
            inputValue={{$attorney_name}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
</div>
