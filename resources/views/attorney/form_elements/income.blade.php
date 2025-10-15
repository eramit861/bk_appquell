@php
    // Initialize income data variables and cache frequently used values
    $incomedebtoremployer = $income_info['incomedebtoremployer'];
    $debtorspouseemployer = $income_info['debtorspouseemployer'];
    $debtormonthlyincome = $income_info['debtormonthlyincome'];
    $debtorspousemonthlyincome = $income_info['debtorspousemonthlyincome'];
    $net_average_income = [];

    // Import required models
    use App\Models\IncomeDebtorMonthlyIncome;
    use App\Models\IncomeDebtorSpouseMonthlyIncome;
    
    // Cache frequently used helper values for performance
    $clientTypeMarried = Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED;
    $hasSpouseIncome = $client_type != 1 && !empty($debtorspousemonthlyincome);
@endphp



{{-- Main Income Calculation Container --}}
<div class="current_income part-a">
	<div class="row">
		{{-- Employer Information Section --}}
		<div class="col-md-6 emp_info_debtor">
			<!--  Debtor's Employer Information.  -->
			@include("attorney.form_elements.emp_info_debtor")
		</div>
		@if($hasSpouseIncome)
		<div class="col-md-6 emp_info_spouse">
			<!--  Spouse's Employer Information.  -->
			@include("attorney.form_elements.emp_info_spouse")
		</div>
		@endif

		{{-- Debtor Income Calculation Section --}}
		@php
            // Calculate debtor income and deductions
            $isDWagesOn = Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome);
            $gross_average_per_month = $isDWagesOn == 1 && is_array($debtormonthlyincome['debtor_gross_wages_month']) ? current($debtormonthlyincome['debtor_gross_wages_month']) : 0.00;
            $Taxes = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_for_security']) ? $debtormonthlyincome['paycheck_for_security'] : 0.00;
            $mandatory_contribution = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_mandatory_contribution']) ? $debtormonthlyincome['paycheck_mandatory_contribution'] : 0.00;
            $voluntary_contribution = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_voluntary_contribution']) ? $debtormonthlyincome['paycheck_voluntary_contribution'] : 0.00;
            $insurances = $isDWagesOn == 1 && isset($debtormonthlyincome['automatically_deduction_insurance']) ? $debtormonthlyincome['automatically_deduction_insurance'] : 0.00;
            $domestic_support = $isDWagesOn == 1 && isset($debtormonthlyincome['domestic_support_obligations']) ? $debtormonthlyincome['domestic_support_obligations'] : 0.00;
            $union_dues = $isDWagesOn == 1 && isset($debtormonthlyincome['union_dues_deducted']) ? $debtormonthlyincome['union_dues_deducted'] : 0.00;
            $required_repayment = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_required_repayment']) ? $debtormonthlyincome['paycheck_required_repayment'] : 0.00;
            $otherDeductions11 = Helper::validate_key_value('otherDeductions11', $debtormonthlyincome, 'radio');
            $other_deduction = (($isDWagesOn == 1) && ($otherDeductions11 == 1) && isset($debtormonthlyincome['other_deduction'])) ? $debtormonthlyincome['other_deduction'] : 0.00;
            $other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;
            $totaldeduction = ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction);
            $debtor_net_average_income = ((float)$gross_average_per_month - ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction));
            $avgMonthlyGross = $isDWagesOn == 1 && is_array($debtormonthlyincome['debtor_gross_wages_month']) ? number_format((float)current($debtormonthlyincome['debtor_gross_wages_month']), 2, '.', '') : 0.00;
            $debtorTotalAverageW2GrossIncome = $avgMonthlyGross;
            $totalAverageIncomeFromOtherSources = 0;
        @endphp
		<div class="col-6 outline-gray-border-area my-3 current_monthly_income">
			<div class="light-gray-div">
				<div class="light-gray-box-form-area">
					<h2 class="align-items-center ">
						<span class="">{{ $debtorname }} Current Monthly Income Calculation </span>                    
					</h2>
					<div class="row gx-3 set-mobile-col">
						
						<div class="col-md-12">
							<label class="font-weight-bold text-c-blue">(W-2 Income)</label>
						</div>
						
						<div class="col-xxl-8 col-xl-7">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Gross wages, salary, tips, bonuses, overtime,commissions </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-4 col-xl-5">
							<label class="font-weight-bold ">Gross Avg. per month:
								<span class="font-weight-bold text-success">${{ number_format((float) $avgMonthlyGross, 2, '.', '') }}</span>
							</label>
						</div>
						<div class="col-12">
							<label class="font-weight-normal">{{ __('Average Payroll Deductions:') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Taxes: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $Taxes, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Mandatory retirement cont.: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $mandatory_contribution, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Vol. retirement cont.: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $voluntary_contribution, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Insurances: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $insurances, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Domestic support: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $domestic_support, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Union Dues: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $union_dues, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Required retirement loans: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float) $required_repayment, 2, '.', '') }}</label>
						</div>

						@if($isDWagesOn == 1 && $otherDeductions11 == 1 && isset($debtormonthlyincome['other_deduction']) && is_array($debtormonthlyincome['other_deduction']))
							@php
                                $other_deduction_type_array = Helper::validate_key_value('other_deduction_type', $debtormonthlyincome) ?? [];
                                $other_deduction_specify_array = Helper::validate_key_value('other_deduction_specify', $debtormonthlyincome) ?? [];
                                $other_deduction_array = Helper::validate_key_value('other_deduction', $debtormonthlyincome) ?? [];
                            @endphp
						<div class="col-md-12">
							<label for=""><span class="font-weight-bold">Other deductions that come out of your check deductions:</span></label>
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<label for=""><span class="font-weight-bold">Deduction type: </span></label>
								</div>
								<div class="col-md-5">
									<label for=""><span class="font-weight-bold">Specify: </span></label>
								</div>
								<div class="col-md-2">
									<label for=""><span class="font-weight-bold">Deduction: </span></label>
								</div>
								@if(!empty(array_filter($other_deduction_array)))
									@foreach($other_deduction_array as $key => $value)
										@php
                                            $deductionTypeValue = Helper::getOtherDeductionsArray();
                                            $typeKey = Helper::validate_key_value($key, $other_deduction_type_array);
                                        @endphp
										<div class="col-md-5">
											<label for="">{{ Helper::validate_key_value($typeKey, $deductionTypeValue) }}</label>
										</div>
										<div class="col-md-5">
											<label for="" class="{{ empty(Helper::validate_key_value($key, $other_deduction_specify_array)) ? 'hide-data' : '' }}">{{ Helper::validate_key_value($key, $other_deduction_specify_array) }}</label>
										</div>
										<div class="col-md-2">
											<label for="" class="text-c-red">${{ Helper::validate_key_value($key, $other_deduction_array) }}</label>
										</div>
									@endforeach
								@endif
							</div>
						</div>
						@else
							<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
								<label class="font-weight-bold price_dots_label">
									<span class="price_dots_span">Other deductions that come out of your check deductions: </span>
									<span class="font-weight-normal price_dots_span"> </span>
								</label>
							</div>
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
								<label class="font-weight-normal text-c-red">$0.00</label>
							</div>
						@endif

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Net Average Income: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-bold {{ (float)$debtor_net_average_income >= 0 ? 'text-success' : 'text-c-red' }}">${{ number_format((float) $debtor_net_average_income, 2, '.', '') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 border-bottom-light-blue text-danger ">
									Other (W-2) Income from other source(s) during the last 6 months:
								</span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">
							$0.00
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Income from operation of business:
								</span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">
							{{ isset($debtormonthlyincome['operation_business']) && $debtormonthlyincome['operation_business'] == 1 ? '' : '$0.00' }}
						</div>
						<div class="col-md-12">
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name']"
								:client_id="@$client_id"
								additional="0"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss_2']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name_2']"
								:client_id="@$client_id"
								additional="2"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss_3']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name_3']"
								:client_id="@$client_id"
								additional="3"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss_4']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name_4']"
								:client_id="@$client_id"
								additional="4"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss_5']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name_5']"
								:client_id="@$client_id"
								additional="5"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="self"
								:operationBusiness="@$debtormonthlyincome['operation_business']"
								:incomeProfitLoss="@$debtormonthlyincome['income_profit_loss_6']"
								:companyName="@$debtormonthlyincome['profit_loss_business_name_6']"
								:client_id="@$client_id"
								additional="6"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
						</div>

						@php
							// Calculate average total income from business operations - Optimized
							$avgTotalIncome = 0;
							if (!empty($debtormonthlyincome['operation_business'])) {
								// Process each business income source efficiently
								$businessIncomeSources = [
									'income_profit_loss',
									'income_profit_loss_2', 
									'income_profit_loss_3',
									'income_profit_loss_4',
									'income_profit_loss_5',
									'income_profit_loss_6'
								];
								
								foreach ($businessIncomeSources as $source) {
									$incomeProfitLossCollection = collect($debtormonthlyincome[$source]);
									if ($incomeProfitLossCollection->isNotEmpty() && is_array($incomeProfitLossCollection->first())) {
										$income_profit_loss = $incomeProfitLossCollection->take(6)->avg('total_profit_loss');
									} else {
										$income_profit_loss = $incomeProfitLossCollection->get('total_profit_loss');
									}
									$avgTotalIncome += (float) $income_profit_loss;
								}
							}
						@endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Rent and other real property income:
								</span>
							</label>
						</div>

						@if(isset($debtormonthlyincome['rent_real_property']) && $debtormonthlyincome['rent_real_property'] == 1)
							@if(!empty($debtormonthlyincome['same_rent_income']))
								@php $avgTotalIncome = ((float)$avgTotalIncome + (float)Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['rent_real_property_month'] , 'avgLabel' => 'Avg. Rent Income: ', 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['rent_real_property_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Interest, dividends, and royalties:
								</span>
							</label>
						</div>

						@if(isset($debtormonthlyincome['royalties']) && $debtormonthlyincome['royalties'] == 1)
							@if(!empty($debtormonthlyincome['same_royalty_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['royalties_month'], 'calculateTotal' => true] )
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['royalties_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Pension and retirement income (NOT Social Security):
								</span>
							</label>
						</div>
						@if(isset($debtormonthlyincome['retirement_income']) && $debtormonthlyincome['retirement_income'] == 1)
							@if(!empty($debtormonthlyincome['same_retirement_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::retirementPension($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::retirementPension($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['retirement_income_month'], 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['retirement_income_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif

						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::retirementPension($debtormonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Regular contributions from others to the household expenses, including child support:
								</span>
							</label>
						</div>
						@if(isset($debtormonthlyincome['regular_contributions']) && $debtormonthlyincome['regular_contributions'] == 1)
							@if(!empty($debtormonthlyincome['same_regular_contribution_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['regular_contributions_month'], 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['regular_contributions_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Unemployment Compensation:
								</span>
							</label>
						</div>
						@if(isset($debtormonthlyincome['unemployment_compensation']) && $debtormonthlyincome['unemployment_compensation'] == 1)
							@if(!empty($debtormonthlyincome['same_unemployement_compensation_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['unemployment_compensation_month'], 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['unemployment_compensation_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome); @endphp

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Social Security income:
								</span>
							</label>
						</div>
						@if(isset($debtormonthlyincome['social_security']) && $debtormonthlyincome['social_security'] == 1)
							@if(!empty($debtormonthlyincome['same_social_security_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::socialSecurity($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::socialSecurity($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['social_security_month'], 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['social_security_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::socialSecurity($debtormonthlyincome); @endphp

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Other government assistance you receive regularly:
								</span>
							</label>
						</div>

						@if(isset($debtormonthlyincome['government_assistance']) && $debtormonthlyincome['government_assistance'] == 1)
						<div class="col-md-12">
							<label class="font-weight-normal ">Specify:
								<span class="font-weight-bold">{{ $debtormonthlyincome['government_assistance_specify'] }}</span>
							</label>
						</div>
						@if(!empty($debtormonthlyincome['same_government_assistance_income']))
							@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome); @endphp
							@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome)) ])
						@else
							@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['government_assistance_month'], 'mbCustom' => 'mb-0', 'calculateTotal' => true ])
							@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['government_assistance_month']); @endphp
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome); @endphp
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif


						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Other sources of income not already mentioned:
								</span>
							</label>
						</div>

						@if(isset($debtormonthlyincome['other_sources']) && $debtormonthlyincome['other_sources'] == 1)
							<div class="col-md-12">
								<label class="font-weight-normal ">Source of income:
									<span class="font-weight-bold">{{ $debtormonthlyincome['other_options_income'] }}</span>
								</label>
							</div>
							@if(!empty($debtormonthlyincome['same_other_sources_income']))
								@php $avgTotalIncome = $avgTotalIncome + IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtormonthlyincome['other_sources_month'], 'mbCustom' => 'mb-0', 'calculateTotal' => true ])
								@php $avgTotalIncome = (float)$avgTotalIncome + Helper::calculateAverage($debtormonthlyincome['other_sources_month']); @endphp
							@endif
							@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome); @endphp
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif

						@php $totalAverageIncomeFromOtherSources = $totalAverageIncomeFromOtherSources + $avgTotalIncome; @endphp
						<div class="col-md-12 border_bottom"></div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Average w-2 Gross Income:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							${{ number_format((float)($debtorTotalAverageW2GrossIncome), 2, '.', ',') }}
						</div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Average Income from other Sources:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							${{ number_format((float)($totalAverageIncomeFromOtherSources), 2, '.', ',') }}
						</div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Net Income:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							@php $total_net_income = ((float)$debtor_net_average_income + (float)$totalAverageIncomeFromOtherSources); @endphp
							$<span class="total_net_income_2" id="debtor_total_net_income" data-net-income="{{$total_net_income}}">{{ number_format((float)$total_net_income, 2, '.', ',') }}</span>
						</div>

					</div>
				</div>
			</div>
		</div>
		@if($hasSpouseIncome)
			@php
				// Calculate spouse income and deductions
				$titlecde = __($spousename." Current Monthly Income Calculation");
				if ($client_type == $clientTypeMarried) {
					$titlecde = $spousename.' Current Monthly Income Calculation';
				}
				$isWagesOn = Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome);
				$gross_average_per_month = $isWagesOn == 1 && is_array($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) ? current($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) : 0.00;
				$Taxes = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_for_security']) ? $debtorspousemonthlyincome['joints_paycheck_for_security'] : 0.00;
				$mandatory_contribution = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_mandatory_contribution']) ? $debtorspousemonthlyincome['joints_paycheck_mandatory_contribution'] : 0.00;
				$voluntary_contribution = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_voluntary_contribution']) ? $debtorspousemonthlyincome['joints_paycheck_voluntary_contribution'] : 0.00;
				$insurances = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_automatically_deduction_insurance']) ? $debtorspousemonthlyincome['joints_automatically_deduction_insurance'] : 0.00;
				$domestic_support = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_domestic_support_obligations']) ? $debtorspousemonthlyincome['joints_domestic_support_obligations'] : 0.00;
				$union_dues = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_union_dues_deducted']) ? $debtorspousemonthlyincome['joints_union_dues_deducted'] : 0.00;
				$required_repayment = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_required_repayment']) ? $debtorspousemonthlyincome['joints_paycheck_required_repayment'] : 0.00;
				$otherDeductions22 = Helper::validate_key_value('otherDeductions22', $debtorspousemonthlyincome, 'radio');
				$other_deduction = ($isWagesOn == 1 && $otherDeductions22 == 1 && isset($debtorspousemonthlyincome['joints_other_deduction'])) ? $debtorspousemonthlyincome['joints_other_deduction'] : 0.00;
				$other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;
				$spouse_net_average_income = (float)$gross_average_per_month - ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction);
				$totaldeduction = ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction);
				$avgMonthlyGross = 0;
				$jointsTotalAverageIncomeFromOtherSources = 0;
				$jointsDebtorTotalAverageW2GrossIncome = $gross_average_per_month;
			@endphp
		<div class="col-6 outline-gray-border-area my-3 current_monthly_income">
			<div class="light-gray-div">
				<div class="light-gray-box-form-area">
					<h2 class="align-items-center ">
						<span class="">{{ $titlecde }} </span>                    
					</h2>
					<div class="row gx-3 set-mobile-col">
						<div class="col-md-12">
							<label class="font-weight-bold text-c-blue">(W-2 Income)</label>
						</div>

						<div class="col-xxl-8 col-xl-7">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Gross wages, salary, tips, bonuses, overtime,commissions </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-4 col-xl-5">
							<label class="font-weight-bold ">Gross Avg. per month:
								<span class="font-weight-bold text-success">${{ number_format((float) $gross_average_per_month, 2, '.', ',') }}</span>
							</label>
						</div>

						<div class="col-md-12">
							<label class="font-weight-normal">{{ __('Average Payroll Deductions:') }}</label>
						</div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Taxes: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal text-c-red">${{ number_format((float)$Taxes, 2, '.', ',') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Mandatory retirement cont.: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ number_format((float)$mandatory_contribution, 2, '.', ',') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Vol. retirement cont.: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ number_format((float)$voluntary_contribution, 2, '.', ',') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Insurances: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ number_format((float)$insurances, 2, '.', ',') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Domestic support: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ number_format((float)$domestic_support, 2, '.', ',') }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Union Dues: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ isset($debtorspousemonthlyincome['joints_union_dues_deducted']) ? number_format((float)$debtorspousemonthlyincome['joints_union_dues_deducted'], 2, '.', ',') : '0.00' }}</label>
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Required retirement loans: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-normal  text-c-red">${{ number_format((float)$required_repayment, 2, '.', ',') }}</label>
						</div>

						@if($isWagesOn && $otherDeductions22 == 1 && isset($debtorspousemonthlyincome['joints_other_deduction']) && is_array($debtorspousemonthlyincome['joints_other_deduction']))
							@php
								$other_deduction_type_array = Helper::validate_key_value('joints_other_deduction_type', $debtorspousemonthlyincome) ?? [];
								$other_deduction_specify_array = Helper::validate_key_value('other_deduction_specify', $debtorspousemonthlyincome) ?? [];
								$other_deduction_array = Helper::validate_key_value('joints_other_deduction', $debtorspousemonthlyincome) ?? [];
							@endphp
							<div class="col-md-12">
								<label for=""><span class="font-weight-bold">Other deductions that come out of your check deductions:</span></label>
							</div>

							<div class="col-md-12">
								<div class="row">
									<div class="col-md-5">
										<label for=""><span class="font-weight-bold">Deduction type:</span></label>
									</div>
									<div class="col-md-5">
										<label for=""><span class="font-weight-bold">Specify:</span></label>
									</div>
									<div class="col-md-2">
										<label for=""><span class="font-weight-bold">Deduction:</span></label>
									</div>
									@if(!empty(array_filter($other_deduction_array)))
										@foreach($other_deduction_array as $key => $value)
											@php
												$deductionTypeValue = Helper::getOtherDeductionsArray();
												$typeKey = Helper::validate_key_value($key, $other_deduction_type_array);
											@endphp
											<div class="col-md-5">
												<label for="">{{ Helper::validate_key_value($typeKey, $deductionTypeValue) }}</label>
											</div>
											<div class="col-md-5">
												<label for="" class="{{ empty(Helper::validate_key_value($key, $other_deduction_specify_array)) ? 'hide-data' : '' }}">{{ Helper::validate_key_value($key, $other_deduction_specify_array) }}</label>
											</div>
											<div class="col-md-2">
												<label for="" class="text-c-red">${{ Helper::validate_key_value($key, $other_deduction_array) }}</label>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						@else
							<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
								<label class="font-weight-bold price_dots_label">
									<span class="price_dots_span">Other deductions that come out of your check deductions: </span>
									<span class="font-weight-normal price_dots_span"> </span>
								</label>
							</div>
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
								<label class="font-weight-normal text-c-red">$0.00</label>
							</div>
						@endif
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Net Average Income: </span>
								<span class="font-weight-normal price_dots_span"> </span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3">
							<label class="font-weight-bold {{ (float)$spouse_net_average_income >= 0 ? 'text-success' : 'text-c-red' }}">${{ number_format((float)$spouse_net_average_income, 2, '.', ',') }}</label>
						</div>
						
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 border-bottom-light-blue text-danger ">
									Other (W-2) Income from other source(s) during the last 6 months:
								</span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">
							$0.00
						</div>

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Income from operation of business:
								</span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">
							{{ isset($debtorspousemonthlyincome['joints_operation_business']) && $debtorspousemonthlyincome['joints_operation_business'] == 1 ? '' : '$0.00' }}
						</div>
						<div class="col-md-12">
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name']"
								:client_id="@$client_id"
								additional="0"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss_2']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name_2']"
								:client_id="@$client_id"
								additional="2"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss_3']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name_3']"
								:client_id="@$client_id"
								additional="3"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss_4']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name_4']"
								:client_id="@$client_id"
								additional="4"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss_5']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name_5']"
								:client_id="@$client_id"
								additional="5"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							<x-attorney.companyIncome
								clientType="spouse"
								:operationBusiness="@$debtorspousemonthlyincome['joints_operation_business']"
								:incomeProfitLoss="@$debtorspousemonthlyincome['income_profit_loss_6']"
								:companyName="@$debtorspousemonthlyincome['profit_loss_business_name_6']"
								:client_id="@$client_id"
								additional="6"
								:val="@$val"
								:attProfitLossMonths="$attProfitLossMonths"
							></x-attorney.companyIncome>
							
						</div>

						@php
							// Calculate average total income from spouse business operations
							$avgTotalIncomeSpouse = 0;
							if (!empty($debtorspousemonthlyincome['joints_operation_business'])) {
								// Process each business income source
								$businessIncomeSources = [
									'income_profit_loss',
									'income_profit_loss_2', 
									'income_profit_loss_3',
									'income_profit_loss_4',
									'income_profit_loss_5',
									'income_profit_loss_6'
								];
								
								foreach ($businessIncomeSources as $source) {
									$incomeProfitLossCollection = collect($debtorspousemonthlyincome[$source]);
									if ($incomeProfitLossCollection->isNotEmpty() && is_array($incomeProfitLossCollection->first())) {
										$income_profit_loss = $incomeProfitLossCollection->take(6)->avg('total_profit_loss');
									} else {
										$income_profit_loss = $incomeProfitLossCollection->get('total_profit_loss');
									}
									$avgTotalIncomeSpouse += (float) $income_profit_loss;
								}
							}
						@endphp
							


						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Rent and other real property income:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_rent_real_property']) && $debtorspousemonthlyincome['joints_rent_real_property'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_rent_income']) || $debtorspousemonthlyincome['joints_same_rent_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_rent_real_property_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_rent_real_property_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Interest, dividends, and royalties:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_royalties']) && $debtorspousemonthlyincome['joints_royalties'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_royalty_income']) || $debtorspousemonthlyincome['joints_same_royalty_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_royalties_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_royalties_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome); @endphp

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Pension and retirement income (NOT Social Security):
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_retirement_income']) && $debtorspousemonthlyincome['joints_retirement_income'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_retirement_income']) || $debtorspousemonthlyincome['joints_same_retirement_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::retirementPension($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::retirementPension($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_retirement_income_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_retirement_income_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::retirementPension($debtorspousemonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Regular contributions from others to the household expenses, including child support:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_regular_contributions']) && $debtorspousemonthlyincome['joints_regular_contributions'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_contribution_income']) || $debtorspousemonthlyincome['joints_same_contribution_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_regular_contributions_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_regular_contributions_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Unemployment Compensation:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_unemployment_compensation']) && $debtorspousemonthlyincome['joints_unemployment_compensation'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_unemployement_compensation']) || $debtorspousemonthlyincome['joints_same_unemployement_compensation'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_unemployment_compensation_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_unemployment_compensation_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Social Security income:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_social_security']) && $debtorspousemonthlyincome['joints_social_security'] == 1)
							@if(!empty($debtorspousemonthlyincome['joints_same_social_security_income']) || $debtorspousemonthlyincome['joints_same_social_security_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::socialSecurity($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::socialSecurity($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_social_security_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_social_security_month']); @endphp
							@endif
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::socialSecurity($debtorspousemonthlyincome); @endphp
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Other government assistance you receive regularly:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['government_assistance']) && $debtorspousemonthlyincome['government_assistance'] == 1)
							<div class="col-md-12">
								<label class="font-weight-normal ">Specify:
									<span class="font-weight-bold">{{ $debtorspousemonthlyincome['government_assistance_specify'] }}</span>
								</label>
							</div>
							@if(!empty($debtorspousemonthlyincome['joints_same_government_assistance_income']) || $debtorspousemonthlyincome['joints_same_government_assistance_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['government_assistance_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['government_assistance_month']); @endphp
							@endif
							@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome); @endphp
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif

						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9">
							<label class="">
								<span class="section-title font-weight-bold font-lg-18 sec-heading-font ">
								Other sources of income not already mentioned:
								</span>
							</label>
						</div>
						@if(isset($debtorspousemonthlyincome['joints_other_sources']) && $debtorspousemonthlyincome['joints_other_sources'] == 1)
							<div class="col-md-12">
								<label class="font-weight-normal ">Source of income:
									<span class="font-weight-bold">{{ $debtorspousemonthlyincome['joints_other_sources_of_income'] }}</span>
								</label>
							</div>

							@if(!empty($debtorspousemonthlyincome['joints_same_other_sources_income']) || $debtorspousemonthlyincome['joints_same_other_sources_income'] === null)
								@php $avgTotalIncomeSpouse = ((float)$avgTotalIncomeSpouse + (float)(IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome))); @endphp
								@include('attorney.form_elements.common.income_data_same_income', ['average_per_month' => Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome)) ])
							@else
								@include('attorney.form_elements.common.income_data_different_income', ['month_data' => $debtorspousemonthlyincome['joints_other_sources_month'], 'calculateTotal' => false ])
								@php $avgTotalIncomeSpouse = (float)$avgTotalIncomeSpouse + Helper::calculateAverage($debtorspousemonthlyincome['joints_other_sources_month']); @endphp
							@endif
							@php $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome); @endphp
						@else
							<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-normal text-danger">$0.00</div>
						@endif
						@php $jointsTotalAverageIncomeFromOtherSources = $jointsTotalAverageIncomeFromOtherSources + $avgTotalIncomeSpouse; @endphp
						<div class="col-md-12 border_bottom"></div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Average w-2 Gross Income:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							${{ number_format((float)($jointsDebtorTotalAverageW2GrossIncome), 2, '.', ',') }}
						</div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Average Income from other Sources:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							${{ number_format((float)($jointsTotalAverageIncomeFromOtherSources), 2, '.', ',') }}
						</div>
						<div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 ">
							<label class="font-weight-bold price_dots_label">
								<span class="price_dots_span">Total Net Income:</span>
								<span class="font-weight-normal price_dots_span"></span>
							</label>
						</div>
						<div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 font-weight-bold text-c-blue">
							@php $joints_total_net_income = ((float)$spouse_net_average_income + (float)$jointsTotalAverageIncomeFromOtherSources); @endphp
							$<span class="total_net_income_2" id="joints_total_net_income" data-net-income="{{$joints_total_net_income}}">{{ number_format((float)$joints_total_net_income, 2, '.', ',') }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

