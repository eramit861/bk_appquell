<div class="row">

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF LOUISIANA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="Case No:"
            casenoNameField="Text2"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12">
        <h3 class="text-center underline mt-3">{{ __('Domestic Support Obligations') }}</h3>
        <p class="mt-3 mb-0">{{ __('1) How many minor children does debtor-one have and where do the minor children reside?') }}</p>
        <table class="w-100 text-center">
            <tr>
                <td class="p-2"><span class=" underline">{{ __('List by age') }}</span></td>
                <td class="p-2"><span class=" underline">{{ __('Does Child Reside With Debtor-One') }}</span> {{ __('(Y/N)') }}</td>
                <td class="p-2"><span class=" underline">{{ __('If No, Amount of Monthly Child Support Due') }}</span></td>
                <td class="p-2"><span class=" underline text-bold">{{ __('Arrearages') }}</span></td>
            </tr>
            <?php
                for ($i = 1 ; $i <= 4; $i++) {
                    ?>
                <tr>
                    <td class="pt-1"><input name="<?php echo base64_encode('List by age '.$i);?>" type="text" class="form-control w-auto"></td>
                    <td class="pt-1"><input name="<?php echo base64_encode('With DebtorOne YN '.$i);?>" type="text" class="form-control w-auto"></td>
                    <td class="pt-1">$ <input name="<?php echo base64_encode('C_'.$i);?>" type="text" class="form-control w-auto price-field"></td>
                    <td class="pt-1">$ <input name="<?php echo base64_encode('D_'.$i);?>" type="text" class="form-control w-auto price-field"></td>
                </tr>
            <?php
                }
            ?>
        </table>
        <p class="mt-3">{{ __('2) List the name, address, and phone number of the guardian for all minor children listed in item one that do not live
            with the debtor. Include any person or state agency that debtor is ordered to pay child support to, as well as any person
            who has custo dy of the minor children if other than deb tor, regardless of whether there is a child supp ort court order.') }}</p>
    </div>
    <?php
        for ($i = 1 ; $i <= 3; $i++) {
            ?>
        <div class="col-md-4">
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Name"
                    inputFieldName="Name_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Address"
                    inputFieldName="Address 1_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent=""
                    inputFieldName="Address 2_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Phone"
                    inputFieldName="Phone_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
        </div>
    <?php
        }
            ?>

    <div class="col-md-12">
        <p class="mt-3">3) {{ __('Does Debto r-One owe alimon y or maintenance to a spou se, former spouse, or a minor ch ild’s guardian in addition to
            child support? If yes, provide name, address and phone number of party to whom payment is due:') }}
            <input name="<?php echo base64_encode('child support  If yes provide name address and phone number of party to whom payment is due 1');?>" type="text" class="form-control width_20percent">
            <input name="<?php echo base64_encode('child support  If yes provide name address and phone number of party to whom payment is due 2');?>" type="text" class="form-control width_75percent">
        </p>
        <p class="mt-3 mb-0">{{ __('4) How many minor children does debtor-two have and where do the minor children reside?') }}</p>
        <table class="w-100 text-center">
            <tr>
                <td class="p-2"><span class=" underline">{{ __('List by age') }}</span></td>
                <td class="p-2"><span class=" underline">{{ __('Does Child Reside With Debtor-One') }}</span> {{ __('(Y/N)') }}</td>
                <td class="p-2"><span class=" underline">{{ __('If No, Amount of Monthly Child Support Due') }}</span></td>
                <td class="p-2"><span class=" underline text-bold">{{ __('Arrearages') }}</span></td>
            </tr>
            <?php
                        for ($i = 1 ; $i <= 4; $i++) {
                            ?>
                <tr>
                    <td class="pt-1"><input name="<?php echo base64_encode('A_'.$i);?>" type="text" class="form-control w-auto"></td>
                    <td class="pt-1"><input name="<?php echo base64_encode('B_'.$i);?>" type="text" class="form-control w-auto"></td>
                    <td class="pt-1">$ <input name="<?php echo base64_encode('1C_'.$i);?>" type="text" class="form-control w-auto price-field"></td>
                    <td class="pt-1">$ <input name="<?php echo base64_encode('1D_'.$i);?>" type="text" class="form-control w-auto price-field"></td>
                </tr>
            <?php
                        }
            ?>
        </table>
        <p class="mt-3">{{ __('5) List the name, address, and phone number of the guardian for all minor children listed in item four that do not live
            with the debtor. Include any person or state agency that debtor is ordered to pay child support to, as well as any person
            who has custo dy of the minor children if other than deb tor, regardless of whether there is a child supp ort court order.') }}</p>
    </div>

    <?php
        for ($i = 1 ; $i <= 3; $i++) {
            ?>
        <div class="col-md-4">
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Name"
                    inputFieldName="1Name_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Address"
                    inputFieldName="1Address 1_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent=""
                    inputFieldName="1Address 2_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Phone"
                    inputFieldName="1Phone_{{$i}}"
                    inputValue="">
                </x-officialForm.debtorSignVertical>
            </div>
        </div>
    <?php
        }
            ?>

    <div class="col-md-12">
        <p class="mt-3">6) {{ __('Does Debto r-Two owe alimo ny or maintenance to a spo use, former spouse, or a mino r child’s guardian in addition to
            child support? If yes, provide name, address and phone number of party to whom payment is due:') }}
            <input name="<?php echo base64_encode('child support  If yes provide name address and phone number of party to whom payment is due 1_2');?>" type="text" class="form-control width_20percent">
            <input name="<?php echo base64_encode('child support  If yes provide name address and phone number of party to whom payment is due 2_2');?>" type="text" class="form-control width_75percent">
        </p>
        <p>{{ __('I declare under penalty of perjury that the information con tained above is true and correct.') }}</p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature"
            inputFieldName="Text3"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-4 mt-1">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.debtorSignVertical
            labelContent="Signature"
            inputFieldName="Text4"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVertical>
    </div>
</div>
