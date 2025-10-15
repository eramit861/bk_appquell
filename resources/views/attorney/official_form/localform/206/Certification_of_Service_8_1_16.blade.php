<div class="row">
    <div class="col-md-6 border_1px p-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW JERSEY') }}</h3>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <label class="text-bold">{{ __('Caption in Compliance with D.N.J. LBR 9004-1(b)') }}</label>
        <textarea name="<?php echo base64_encode('1.1'); ?>" class="form-control" rows="7">{{$attorneydetails}}</textarea>
    </div>
    <div class="col-md-6 p-3"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <div class="input-grpup ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('1.2'); ?>" value="" class="form-control" rows="7" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div> 
    </div>
    <div class="col-md-6 p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="1.3"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="1.4"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Adv. No.:"
                casenoNameField="1.5"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Hearing Date:"
                casenoNameField="1.6"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Judge:"
                casenoNameField="1.7"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CERTIFICATION OF SERVICE') }}</h3>
        <div class="d-flex mt-3">
            <label for="">1.</label>
            <div class="pl-3 w-100">
                <p>
                    I,
                    <input name="<?php echo base64_encode('1.8');?>" type="text" class="form-control width_30percent" value="{{$attorney_name}}">
                    :
                </p>
                <p class="pl-3">
                    <input name="<?php echo base64_encode('cb1');?>" value="Yes" type="checkbox" class="form-control width_auto" checked="true">
                    {{ __('represent') }} 
                    <input name="<?php echo base64_encode('1.9');?>" type="text" class="form-control width_30percent" value="<?php echo $debtorname ?? ''; ?>">
                    {{ __('in this matter.') }}
                </p>
                <p class="pl-3">
                    <input name="<?php echo base64_encode('cb2');?>" value="Yes" type="checkbox" class="form-control width_auto">
                    {{ __('am the secretary/paralegal for') }} 
                    <input name="<?php echo base64_encode('1.10');?>" type="text" class="form-control width_30percent">
                    ,{{ __('who represents') }}
                    <input name="<?php echo base64_encode('1.11');?>" type="text" class="form-control width_30percent">
                    {{ __('in this matter.') }}
                </p>
                <p class="pl-3">
                    <input name="<?php echo base64_encode('cb3');?>" value="Yes" type="checkbox" class="form-control width_auto">
                    {{ __('am the') }} 
                    <input name="<?php echo base64_encode('1.12');?>" type="text" class="form-control width_30percent">
                    {{ __('in this case and am representing myself.') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <label for="">2.</label>
            <div class="pl-3 w-100">
                <p>
                {{ __('On') }}
                    <input name="<?php echo base64_encode('1.13');?>" type="text" class="form-control width_auto date_filed" value="{{$currentDate}}">
                    {{ __(', I sent a copy of the following pleadings and/or documents to the parties listed in the chart below.') }}
                </p>
                <textarea name="<?php echo base64_encode('1.14');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <label for="">3.</label>
            <div class="pl-3">
                <p>
                    {{ __('I certify under penalty of perjury that the above documents were sent using the mode of service indicated.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="1.15"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="1.16"
            inputValue="{{$attorny_sign}}   "
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <table class="w-100">
            <tr>
                <th class="p-2">{{ __('Name and Address of Party Served') }}</th>
                <th class="p-2">{{ __('Relationship of Party to the Case') }}</th>
                <th class="p-2">{{ __('Mode of Service') }}</th>
            </tr>
            <?php
                for ($k = 1 ; $k <= 5; $k++) {
                    ?>
                <tr>
                    <td class="p-2">
                        <textarea name="<?php echo base64_encode('2.A'.$k);?>" class="form-control" rows="7"></textarea>
                    </td>
                    <td class="p-2">
                        <textarea name="<?php echo base64_encode('2.B'.$k);?>" class="form-control" rows="7"></textarea>
                    </td>
                    <td class="p-2">
                        <div class="">
                            <p>
                                <input name="<?php echo base64_encode('CA'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Hand-delivered') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CB'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Regular mail') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CC'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Certified mail/RR') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CD'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                Other
                                <input name="<?php echo base64_encode('2.C'.$k);?>" type="text" class="form-control width_auto">
                            </p>
                            <p class="mb-0">
                                {{ __('(As authorized by the Court or by rule. Cite the rule if applicable)') }}
                            </p>
                        </div>
                    </td>
                </tr>
            <?php
                }
        ?>
            <?php
            for ($k = 6 ; $k <= 10; $k++) {
                ?>
                <tr>
                    <td class="p-2">
                        <textarea name="<?php echo base64_encode('3.A'.$k);?>" class="form-control" rows="7"></textarea>
                    </td>
                    <td class="p-2">
                        <textarea name="<?php echo base64_encode('3.B'.$k);?>" class="form-control" rows="7"></textarea>
                    </td>
                    <td class="p-2">
                        <div class="">
                            <p>
                                <input name="<?php echo base64_encode('CA'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Hand-delivered') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CB'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Regular mail') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CC'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                {{ __('Certified mail/RR') }}
                            </p>
                            <p>
                                <input name="<?php echo base64_encode('CD'.$k);?>" value="Yes" type="checkbox" class="form-control width_auto">
                                Other
                                <input name="<?php echo base64_encode('3.C'.$k);?>" type="text" class="form-control width_auto">
                            </p>
                            <p class="mb-0">
                                {{ __('(As authorized by the Court or by rule. Cite the rule if applicable)') }}
                            </p>
                        </div>
                    </td>
                </tr>
            <?php
            }
        ?>
        </table>
    </div>

</div>