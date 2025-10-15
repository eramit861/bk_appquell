<form name="official_frm_106j" id="official_frm_106j" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="106j">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
	<input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106j.pdf'; ?>">
	<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106j.pdf'; ?>">
	<input type="hidden" name="<?php echo base64_encode('Case number#0-106J'); ?>" value="<?php echo $caseno; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106J'); ?>" value="<?php echo $onlyDebtor; ?>">
	<input type="hidden" name="<?php echo base64_encode('Debtor 2-106J'); ?>" value="<?php echo $spousename; ?>">
    <!-- use below varibale for PArt D -->
    <?php $partJ = isset($dynamicPdfData['106j']) && !empty($dynamicPdfData['106j']) ? json_decode($dynamicPdfData['106j'], 1) : null;?>
	<section class="page-section official-form-106j padd-20" id="official-form-106j">
        <div class="container pl-2 pr-0">
            <div class="row">
                <x-officialForm.districList
                    :districtNames="$district_names"
                    :savedData="$savedData"
                    name="Bankruptcy District Information-106J"
                ></x-officialForm.districList>
                <x-officialForm.districListAfterCheckBox
                    :partMain="$partJ"
                    checkBoxName="Check 1#0-106J"
                    dateBoxName="Supplemental income date-106J"
                    dateBoxValueName="Supplemental income date-106J"
                ></x-officialForm.districListAfterCheckBox>
            </div>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                    <h4>{{ __('Schedule J') }}</h4>
                        <h2 class="font-lg-22">{{ __('Schedule J: Your Expenses') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. If
                                two
                                married people are filing together, both are equally responsible for
                                supplying correct
                                information. If more space is needed, attach another sheet to this
                                form.
                                On the top of any additional pages, write your name and case number
                                (if known). Answer every question') }}
                            </strong></p>
                    </div>
                </div>
            </div>
            <x-officialForm.partTitle title="Part 1" subTitle="Describe Your Household"></x-officialForm.partTitle>
            <!-- Row 1 -->
            <x-officialForm.expenses.expensesPart1
                :clentData="$clentData"
                :expenses_info="$expenses_info"
                :partJ="$partJ"
            ></x-officialForm.expenses.expensesPart1>
            <!-- Part 2 -->
            <x-officialForm.partTitle title="Part 2" subTitle="Estimate Your Ongoing Monthly Expenses"></x-officialForm.partTitle>
            <div class="form-border">
                <!-- Row 1 -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group d-inline-block">
                            <label for="">
                                <strong class="d-block">{{ __('Estimate your expenses as of your bankruptcy
                                    filing date unless you are using this form as a supplement in a
                                    Chapter 13 case to report
                                    expenses as of a date after the bankruptcy is filed. If this is
                                    a
                                    supplemental Schedule J, check the box at the top of the form
                                    and
                                    fill in the
                                    applicable date') }} <br>
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
                <x-officialForm.expenses.expensesPart2
                    :clentData="$clentData"
                    :expenses_info="$expenses_info"
                    :totalExpenses="$totalExpenses"
                    :totalExpensesSpouse="$totalExpensesSpouse"
                    :resultExpense="$resultExpense"
                    :line11Total="$line11Total"
                    :monthlyNetIncome="$monthlyNetIncome"
                    :partJ="$partJ"
                    shtype="j"
                ></x-officialForm.expenses.expensesPart2>
            </div>
            <x-officialForm.generatePdfButton title="Generate Schedule J Expenses PDF" divtitle="coles_official-form-106j"></x-officialForm.generatePdfButton>
        </div>
    </section>
</form>
