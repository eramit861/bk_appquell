<form name="official_frm_106j-2" id="official_frm_106j-2" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="106j-2">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
	<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106j2.pdf'; ?>">
	<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106j2.pdf'; ?>">
	<input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
    <!-- use below varibale for PArt D -->
 <?php $partJ2 = isset($dynamicPdfData['106j_2']) && !empty($dynamicPdfData['106j_2']) ? json_decode($dynamicPdfData['106j_2'], 1) : null;
    ?>
<section class="page-section official-form-106j-2 padd-20" id="official-form-106j-2">
    <div class="container pl-2 pr-0">
        <div class="row">
            <x-officialForm.districList
                :districtNames="$district_names"
                :savedData="$savedData"
                name="Bankruptcy District Information"
            ></x-officialForm.districList>
            <x-officialForm.districListAfterCheckBox
                :partMain="$partJ2"
                checkBoxName="Check 1"
                shtype="j2"
                dateBoxName="Supplemental income date"
                dateBoxValueName="Supplemental income date"
            ></x-officialForm.districListAfterCheckBox>
        </div>
        <div class="row padd-20">
            <div class="col-md-12 mb-3">
                <div class="form-title">
                    <h4>{{ __('Schedule J-2') }}</h4>
                    <h2 class="font-lg-22">{{ __('Schedule J-2: Expenses for Separate Household of Debtor 2') }}
                    </h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14"><strong>{{ __('Use this form for Debtor 2’s separate household expenses ONLY IF Debtor 1 and Debtor 2 maintain separate households. If Debtor 1 and
                            Debtor 2 have one or more dependents in common, list the dependents on both Schedule J and this form. Answer the questions on this form
                            only with respect to expenses for Debtor 2 that are not reported on Schedule J. Be as complete and accurate as possible. If more space is
                            needed, attach another sheet to this form. On the top of any additional pages, write your name and case number (if known). Answer every
                            question.') }}
                        </strong></p>
                </div>
            </div>
        </div>
        <x-officialForm.partTitle title="Part 1" subTitle="Describe Your Household"></x-officialForm.partTitle>
        <x-officialForm.expenses.spouseExpensesPart1 :expenses_info="$expenses_info" :partJ="$partJ2"
        ></x-officialForm.expenses.spouseExpensesPart1>
        <x-officialForm.partTitle title="Part 2" subTitle="Estimate Your Ongoing Monthly Expenses"></x-officialForm.partTitle>
        <div class="form-border">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="input-group d-inline-block">
                        <label for="">
                            <strong class="d-block">Estimate your expenses as of your bankruptcy
                                filing date unless you are using this form as a supplement in a
                                Chapter 13 case to report
                                expenses as of a date after the bankruptcy is filed. If this is
                                a
                                supplemental Schedule J, check the box at the top of the form
                                and
                                fill in the
                                applicable date <br>
                                {{ __('Include expenses paid for with non-cash government assistance if
                                you
                                know the value of
                                such assistance and have included it on Schedule I: Your Income
                                (Official Form 106I.)') }}
                            </strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 mb-3">
                    <div class="column-heading">{{ __('Your expenses') }}</div>
                </div>
            </div>
            <x-officialForm.expenses.spouseExpensesPart2
                :expenses_info="$expenses_info"
                :totalExpensesSpouse="$totalExpensesSpouse"
                :partJ="$partJ2"
                shtype="j2"
            ></x-officialForm.expenses.spouseExpensesPart2>
        </div>
        <x-officialForm.generatePdfButton title="Generate Schedule J-2 (Expenses) PDF" divtitle="coles_official-form-106j-2"></x-officialForm.generatePdfButton>
    </div>
</section>
</form>
