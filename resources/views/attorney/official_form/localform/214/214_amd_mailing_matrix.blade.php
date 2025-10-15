<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('EASTERN DISTRICT OF NORTH CAROLINA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
        <div class="input-group">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('debtors')?>" class="form-control" rows="2" cols="">{{$onlyDebtor}}</textarea>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
        <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="case"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">{{ __('AMENDMENT TO MAILING MATRIX') }}</h3>
        <p class="mt-3">{{ __('Now comes the above captioned debtor(s) and hereby amend(s) the creditor mailing matrix to delete the following creditor(s)/party(s):') }}</p>
        <div class="table_sect table table_sect_head_border th">
            <table class="w-100">
                <tr>
                    <th class="p-2 w-40">{{ __('Name and Address of Creditor') }}</th>
                    <th class="p-2 w-60">{{ __('Basis for Deletion') }}</th>
                </tr>
                <?php
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                <tr>
                    <td class="p-1"><x-officialForm.inputText name="Name{{$i}}" class="" value=""></x-officialForm.inputText></td>
                    <td class="p-1"><x-officialForm.inputText name="Deletion{{$i}}" class="" value=""></x-officialForm.inputText></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Signed:') }}"
            inputFieldName="sign"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
</div>
