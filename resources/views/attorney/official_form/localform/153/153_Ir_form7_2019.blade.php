<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">IN THE {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF KANSAS') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('IN RE:') }}</label>
            <x-officialForm.inputText name="Text73" class="" value="{{$onlyDebtor}} and"></x-officialForm.inputText>
            <x-officialForm.inputText name="Text75" class="mt-1" value="{{$spousename}}"></x-officialForm.inputText>
            <label class="float_right">{{ __('DEBTORS') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="CASE NO."
                casenoNameField="CASE NO"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <label for="">{{ __('CHAPTER 13') }}</label>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center underline mt-3 mb-3">{{ __('DEBTOR VERIFICATION OF DIRECT PAYMENTS') }}</h3>
        <p class=" p_justify">{{ __('In accordance with 28 U.S.C. §1746 and Standing Rule 2019-3 of the Bankruptcy Court for the
            Middle District of Louisiana, I declare under penalty of perjury that the following payments
            required by my plan to be made directly by me from my budget to the following listed creditors
            have been made:') }}</p>

        <p class="text-bold">{{ __('DIRECT MORTGAGE PAYMENTS') }}</p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box111" class="" value="Yes" />
            {{ __('None') }}
        </p>
    </div>

    <div class="col-md-2 pt-2">
        <label for="">{{ __('1st Mortgage') }}</label>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.signVertical
            labelText="(Name)"
            signNameField="Text76"
            sign=""
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-2 pt-2 text-center">
        <label class="mt-1">{{ __('Post-Petition:') }}</label>
    </div>

    <div class="col-md-4">

        <?php
            for ($i = 77 ; $i <= 81; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Payment due date: "
                    dateNameField="Text{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 77 ; $i <= 81; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date paid: "
                    dateNameField="Date paid_{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>


    <div class="col-md-2 pt-2 mt-3">
        <label for="">{{ __('2nd Mortgage') }}</label>
    </div>
    <div class="col-md-6 text-center mt-3">
        <x-officialForm.signVertical
            labelText="(Name)"
            signNameField="Text87"
            sign=""
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-4 mt-3"></div>

    <div class="col-md-2 pt-2 text-center">
        <label class="mt-1">{{ __('Post-Petition:') }}</label>
    </div>

    <div class="col-md-4">

        <?php
            for ($i = 82 ; $i <= 86; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Payment due date: "
                    dateNameField="Text{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 82 ; $i <= 86; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date paid: "
                    dateNameField="Date paid_{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>

    <div class="col-md-12">
        <p class="text-bold">{{ __('DOMESTIC SUPPORT OBLIGATIONS') }}</p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box112" class="" value="Yes" />
            {{ __('None') }}
        </p>
    </div>

    <div class="col-md-2 pt-2">
        <label for="">{{ __('Obligee') }}</label>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.signVertical
            labelText="(Name)"
            signNameField="Text88"
            sign=""
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-2 pt-2 text-center">
        <label class="mt-1">{{ __('Post-Petition:') }}</label>
    </div>

    <div class="col-md-4">

        <?php
            for ($i = 93 ; $i <= 97; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Payment due date: "
                    dateNameField="Text{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 11 ; $i <= 15; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date paid: "
                    dateNameField="Date paid_{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>


    <div class="col-md-12">
        <p class="text-bold">{{ __('VEHICLE DIRECT PAYMENTS') }}</p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box113" class="" value="Yes" />
            {{ __('None') }}
        </p>
    </div>

    <div class="col-md-2 pt-2">
        <label for="">{{ __('Secured Creditor') }}</label>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.signVertical
            labelText="(Name)"
            signNameField="Text91"
            sign=""
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-2 pt-2 text-center">
        <label class="mt-1">{{ __('Post-Petition:') }}</label>
    </div>

    <div class="col-md-4">

        <?php
            for ($i = 100 ; $i <= 104; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Payment due date: "
                    dateNameField="Text{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 16 ; $i <= 20; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date paid: "
                    dateNameField="Date paid_{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>


    <div class="col-md-12">
        <p class="text-bold">{{ __('OTHER DIRECT PAYMENTS') }}</p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box114" class="" value="Yes" />
            {{ __('None') }}
        </p>
    </div>

    <div class="col-md-2 pt-2">
        <label for="">{{ __('Secured Creditor') }}</label>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.signVertical
            labelText="(Name)"
            signNameField="Text92"
            sign=""
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-2 pt-2 text-center">
        <label class="mt-1">{{ __('Post-Petition:') }}</label>
    </div>

    <div class="col-md-4">

        <?php
            for ($i = 106 ; $i <= 110; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Payment due date: "
                    dateNameField="Text{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-6">
        <?php
            for ($i = 21 ; $i <= 25; $i++) {
                ?>
            <div class="mt-1">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date paid: "
                    dateNameField="Date paid_{{$i}}"
                    currentDate=""
                ></x-officialForm.dateSingleHorizontal>
            </div>
        <?php
            }
        ?>
    </div>

    <div class="col-md-12">
        <p>{{ __('I declare (or certify, verify, or state) under penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on"
            dateNameField="Executed on"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature (debtor 1):"
                inputFieldName="Text189"
                inputValue="{{$debtor_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature (debtor 2):"
                inputFieldName="Text190"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('I have reviewed the payment documentation submitted by the debtor(s) and certify that the debtor(s):') }}</p>
        <div class="d-flex">
            <div class="pl-4">
                <x-officialForm.inputCheckbox name="Check Box115" class="" value="Yes" />
            </div>
            <div class="pl-3">
                <p> {{ __('have met the requirements for paying direct post-petition payments.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <x-officialForm.inputCheckbox name="Check Box116" class="" value="Yes" />
            </div>
            <div class="pl-3">
                <p> {{ __('have not met the requirements for paying direct post-petition payments.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on"
            dateNameField="Executed on_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney Signature:"
                inputFieldName="Text191"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>
