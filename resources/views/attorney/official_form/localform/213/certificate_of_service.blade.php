
<h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
    {{ __('WESTERN DISTRICT OF NEW YORK') }}</h3>
    <div class="row my-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text1"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
            <div class="row mt-4">
                <div class="col-md-3 pt-3">
                    <label>{{ __('Chapter:') }}</label>
                </div>
                <div class="col-md-9">
                    <select name="<?php echo base64_encode('Combo Box4'); ?>" class="form-control width_auto mt-2">
                        <option value=""></option>
                        <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                        <option value="9">9</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4 mb-4">
        <h3>{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>
    <p>
    {{ __('I') }},
        <input name="<?php echo base64_encode('Text7.0'); ?>" type="text" value="{{$attorney_name}}" class="form-control width_24percent">
        {{ __('certify that on') }},
        <input name="<?php echo base64_encode('Text7.1.0'); ?>" type="text" value="{{$currentDate}}" class="form-control date_filed w-auto">,
        {{ __('I served true and correct copies of') }}
        <input name="<?php echo base64_encode('Text7.1.1.0'); ?>" type="text" value="" class="form-control width_35percent mt-2">
        {{ __('on the following parties in the manner specified for each party below:') }}
    </p>
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <p>{{ __('Name and Address of Party') }}*</p>
        </div>
        <div class="col-md-6 mb-3">
            <span>{{ __('Method of Service') }}</span>
            <p>{{ __('(If by mail, describe the mode of mailing)') }}</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text7.1.1.1.0"
            currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6 mb-3">
            <input name="<?php echo base64_encode('Text7.1.1.1.1'); ?>" type="text" value="{{$attorny_sign}}" class="form-control">
        </div>
        <div class="col-md-12">
        <p class="mt-3">* {{ __('If a corporation, note name of officer, director or managing agent. See Federal Rules of Bankruptcy Procedure 7003, 7004,
            9013 and 9014 and additional rules, as applicable, for service requirements') }}.</p>
        </div>
    </div>