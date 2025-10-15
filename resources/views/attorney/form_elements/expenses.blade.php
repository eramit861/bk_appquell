@php $Total_monthly_expenses = []; @endphp

<div class="part-a outline-gray-border-area">
   <div class="current-income-sec outline-gray-border-area" id="current-income">
      <div class="section-title-div bb-0-i mt-3 mb-3 ">
         <h3 class=""></h3>
         <div class="section-edit-div fs-16px">
            <div class="row">
               <div class="col-12">
                  <span class="">I Versus J:</span>
                  <span class="float_right ml-1 text-bold display_i_vs_j_income_total"></span>
               </div>
               <div class="col-12">
                  <span style="visibility: hidden ; display: none; ">Total Monthly Expenses:</span>
                  <span class="float_right ml-1 text-bold display_net_expense_total" style="visibility: hidden ; display: none; "></span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="light-gray-div">
      <div class="light-gray-box-form-area">
         <h2 class="  align-items-center ">
               <span class="">Current Debtor Expenses</span>                    
         </h2>
         {{-- Dependents Information Section --}}
         <div class="row gx-3 set-mobile-col">
            <div class="col-md-4"><p>{{ __('Dependents living in your household') }}</p></div>
            <div class="row col-md-12 sec_merger {{ Helper::key_hide_show_v('any_dependents', $expenses_info) }}">
               @if(!empty($expenses_info['dependent_relationship']))
                  @for($i = 0; $i < count($expenses_info['dependent_relationship']); $i++)
                     <div class="col-md-3">
                        <label class="font-weight-bold ">Relationship: <span
                           class="font-weight-normal">{{ $expenses_info['dependent_relationship'][$i] }}</span></label>
                     </div>
                     <div class="col-md-1">
                        <label class="font-weight-bold ">Age: <span
                           class="font-weight-normal">{{ $expenses_info['dependent_age'][$i] }}</span></label>
                     </div>
                     <div class="col-md-8">
                        <label class="font-weight-bold ">Does dependent live with you: <span
                           class="font-weight-normal">{{ ArrayHelper::getYesNoArray($expenses_info['dependent_live_with'][$i]) }}</span></label>
                     </div>
                  @endfor
               @endif
            </div>
            <div class="col-md-6">
               <label class="font-weight-bold ">Do you and your spouse live separately and maintain separate households:    
                  @php
                        $live_separately_val= Helper::key_display('live_separately',$expenses_info);
                  @endphp
                  <x-singlespan class="font-weight-normal" spantext="{{ $live_separately_val }}"></x-singlespan>

               </label>
            </div>
            <div class="col-md-12">
               <x-singlespan class="section-title font-weight-bold font-lg-12" spantext="Monthly Expenses:"></x-singlespan>
            </div>

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label">
                     <x-singlespan class="price_dots_span" spantext="Primary rent or home mortgage:"></x-singlespan>
                     <x-singlespan class="font-weight-normal price_dots_span" spantext=""></x-singlespan>
                     </label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_value('rent_home_mortage', $expenses_info), 2, '.', ',') }}</span></label>
                  </div>
               </div>
            </div>
            {{-- Real Estate Taxes Section --}}
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label">
                     <x-singlespan class="price_dots_span" spantext="Amount of real estate taxes: "></x-singlespan>
                     <x-singlespan class="font-weight-normal price_dots_span" spantext=""></x-singlespan>
                     </label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold ">               
                        @php
                        $estate_taxes_val= $Total_monthly_expenses[] = (Helper::validate_key_value('real_estate_taxes',$expenses_info) == 0) ? number_format((float)Helper::validate_key_value('estate_taxes_pay',$expenses_info), 2, '.', ',') : '0.00';
                        @endphp
                     <x-singlespan class="font-weight-normal text-c-red" spantext="${{ $estate_taxes_val }}"></x-singlespan>
                     </label>
                  </div>
               </div>
            </div>
            {{-- Property Insurance Section --}}
            <div class="col-md-12 {{ Helper::key_hide_show_v2('amount_include_property', $expenses_info) }}">
               <div class="row">
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ __("Amount of property, homeowners, or renter's insurance:") }} </span><span
                  class="font-weight-normal price_dots_span"></span></label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = Helper::validate_key_value('amount_include_property', $expenses_info) == 0 ? number_format((float)Helper::validate_key_value('amount_include_property_pay', $expenses_info), 2, '.', ',') : '0.00' }}</span></label>
                  </div>
               </div>
            </div>
            {{-- Home Maintenance Section --}}
            <div class="col-md-12 {{ Helper::key_hide_show_v2('amount_include_home', $expenses_info) }}">
               <div class="row">
                  <div class="col-md-7 pr-0">
                  <label class="font-weight-bold price_dots_label">Amount ofany home maintenance, repair, or upkeep expenses: <span
                     class="font-weight-normal price_dots_span"></span></label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = Helper::validate_key_value('amount_include_home', $expenses_info) == 0 ? number_format((float)Helper::validate_key_value('amount_include_home_pay', $expenses_info), 2, '.', ',') : '0.00' }}</span></label>
                  </div>
               </div>
            </div>
            {{-- Homeowner Association Section --}}
            <div class="col-md-12 {{ Helper::key_hide_show_v2('amount_include_homeowner', $expenses_info) }}">
               <div class="row">
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label">Amount of any homeowner's association or condominium dues: <span
                        class="font-weight-normal price_dots_span"></span></label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = Helper::validate_key_value('amount_include_homeowner', $expenses_info) == 0 ? number_format((float)Helper::validate_key_value('amount_include_homeowner_pay', $expenses_info), 2, '.', ',') : '0.00' }}</span></label>
                  </div>
               </div>
            </div>
            {{-- Additional Mortgage Payments Section --}}
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ __('Additional mortgage payments:') }} </span><span
                        class="font-weight-normal price_dots_span "></span></label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = Helper::validate_key_value('mortgage_payments', $expenses_info) == 1 ? number_format((float)Helper::validate_key_value('mortgage_payments_pay', $expenses_info), 2, '.', ',') : '0.00' }}</span></label>
                  </div>
               </div>
            </div>

            {{-- Utilities Section --}}
            <div class="col-md-12">
               <span class="section-title font-weight-bold font-lg-12">{{ __('Utilities:') }}</span>
            </div>
            @php
               $utilities = ["Electricity and heating fuel","Water and sewer","Telephone service/long distance"];
            @endphp
            
            @if(!empty($expenses_info['utilities']))
               @php
                  $utilities_info = array_chunk($expenses_info['utilities'], 2);
                  $utili = array_merge($utilities_info[0], $utilities_info[1]);
                  $j = 0;
               @endphp
               
               @foreach($utili as $key => $utilitval)
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-7 pr-0">
                           <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ $utilities[$j] }}: </span><span
                              class="font-weight-normal price_dots_span"></span></label>
                        </div>
                        <div class="col-md-3 pl-0">
                           <label class="font-weight-bold "><span
                              class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)$utilitval, 2, '.', ',') }}</span></label>
                        </div>
                     </div>
                  </div>
                  @php $j++; @endphp
               @endforeach
               
               <div class="col-md-12">
                  <label class="font-weight-bold ">Do you have any other utility bills: <span
                     class="font-weight-normal">{{ Helper::key_display('utility_bills', $expenses_info) }}</span></label>
               </div>
               <div class="row col-md-12 sec_merger {{ Helper::key_hide_show_v('utility_bills', $expenses_info) }}">
                  <div class="col-md-12">
                     <label class="font-weight-bold ">Describe additional utilities: <span
                        class="font-weight-normal">{{ Helper::current($expenses_info['monthly_utilities_bills']) }}</span></label>
                  </div>
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-7 pr-0">
                           <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ __('Enter monthly amount below:') }} </span><span
                              class="font-weight-normal price_dots_span"></span></label>
                        </div>
                        <div class="col-md-3 pl-0  utilities-amount-padding">
                           <label class="font-weight-bold utilities-amount-label"><span
                              class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = Helper::validate_key_value('utility_bills', $expenses_info) == 1 ? number_format((float)Helper::current(@$expenses_info['monthly_utilities_value']), 2, '.', ',') : '0.00' }}</span></label>
                        </div>
                     </div>
                  </div>
               </div>
            @endif
            {{-- Food and Housekeeping Expenses Section --}}
            @php
               $food_housekeeping = [
                        "food_housekeeping" => "Food and housekeeping supplies",
                        "childcare" => "Childcare and Children Education Costs",
                        "laundry" => "Clothing, laundry, and dry cleaning",
                        "personal_care" => "Personal care products and services",
                        "medical_dental" => "Medical and dental expenses",
                        "transportation" => "Transportation (do NOT include car payments)",
                        "entertainment" => "Recreation,entertainment, newspapers, magazines, and books",
                        "charitablet" => "Charitable contributions and religious donations",
                        "life_insurance" => "Life insurance",
                        "health_insurance" => "Health insurance",
                        "auto_insurance" => "Auto insurance"
               ];
            @endphp
            
            @foreach($food_housekeeping as $key => $housevalue)
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-7 pr-0">
                        <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ $housevalue }}: </span><span
                           class="font-weight-normal price_dots_span"></span></label>
                     </div>
                        <div class="col-md-3 pl-0">
                           <label class="font-weight-bold "><span
                              class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_value($key.'_price', $expenses_info), 2, '.', ',') }}</span></label>
                        </div>
                  </div>
               </div>
            @endforeach
            {{-- Other Insurance Section --}}
            <div class="col-md-12">
               <div class="row">
                     <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label">
                           <span class="price_dots_span">{{ __('Other insurance(describe and list monthly amount):') }} </span>
                           <span class="font-weight-normal price_dots_span">
                              @if($expenses_info['otherInsurance_notListed'] == 1)
                                 {{ $expenses_info['other_insurance_value'] }}:
                              @endif
                           </span>
                           <span class="font-weight-normal price_dots_span"></span>
                     </label>
                     </div>
                     <div class="col-md-3 pl-0">
                        <label class="font-weight-bold "><span
                           class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = ($expenses_info['otherInsurance_notListed'] == 1) ? number_format((float)$expenses_info['other_insurance_price'], 2, '.', ',') : '0.00' }}</span></label>
                     </div>
                  </div>
            </div>
            {{-- Tax Bills Section --}}
            @if(Helper::validate_key_value('taxbills_not_deducted', $expenses_info) == 1)
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-7 pr-0">
                        <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ __('Tax bills NOT deducted from wages or included in home mortgage payments or other real estate property expenses:') }}</span><span
                           class="font-weight9-normal price_dots_span"></span></label>
                     </div>
                     <div class="col-md-3 pl-0">
                        <label class="font-weight-bold "><span
                           class="font-weight-normal text-c-red">&nbsp;${{ isset($expenses_info['taxbills_price']) ? $Total_monthly_expenses[] = number_format((float)$expenses_info['taxbills_price'], 2, '.', ',') : '' }}</span></label>
                     </div>
                  </div>
               </div>
            @endif
            {{-- Installment Payments Section --}}
            @if(Helper::validate_key_value('installment_payment_for_car', $expenses_info) == 1)
               @php
                  $food_housekeeping2 = [
                     "installmentpayments" => "Installment payments for car, furniture, etc. (Describe):",
                  ];
               @endphp

               @foreach($food_housekeeping2 as $key => $housevalue)
                  @if(isset($expenses_info[$key.'_price']) && !empty($expenses_info[$key.'_price']))
                     <div class="col-md-12">
                        <label class="font-weight-bold ">{{ $housevalue }} </label>
                     </div>
                  @endif
                  
                  @if(is_array($expenses_info[$key.'_price']))
                     @for($i = 0; $i < count($expenses_info[$key.'_price']); $i++)
                        @if(isset($expenses_info[$key.'_type'][$i]))
                           <div class="col-md-12 mt-2">
                              <div class="row">
                                 <div class="col-md-7 pr-0">
                                    <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ ArrayHelper::installmentPaymentArray($expenses_info[$key.'_type'][$i]) }}: </span><span class="font-weight-normal price_dots_span">{{ $expenses_info[$key.'_value'][$i] }}</span></label>

                                 </div>
                                 @if(!empty($expenses_info[$key.'_type'][$i]) && in_array($expenses_info[$key.'_type'][$i], [3,4]))
                                 <!-- <div class="col-md-3">
                                    <label class="font-weight-bold ">Specify: <span
                                       class="font-weight-normal"></span></label>
                                 </div> -->
                                 @endif
                                 <div class="col-md-3 pl-0">
                                    <label class="font-weight-bold "><span
                                       class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)$expenses_info[$key.'_price'][$i], 2, '.', ',') }}</span></label>
                                 </div>
                              </div>
                           </div>
                        @endif
                     @endfor
                  @endif
               @endforeach
            @endif
            {{-- Alimony and Support Payments Section --}}
            @php
               $food_housekeeping3 = [
                        "alimony" => "Alimony, maintenance and support paid to others:",
                        "payments_dependents" => "Payments for support of additional dependents not living at your home:"
               ];
               $alimony = Helper::validate_key_value('alimony_maintenance', $expenses_info);
               if ($alimony != 1) {
                   unset($food_housekeeping3['alimony']);
               }
               $paymentforsupport_dependents_n = Helper::validate_key_value('paymentforsupport_dependents_n', $expenses_info);
               if ($paymentforsupport_dependents_n != 1) {
                   unset($food_housekeeping3['payments_dependents']);
               }
            @endphp
            
            @foreach($food_housekeeping3 as $key => $housevalue)
               @if($key != 'payments_dependents')
                  <div class="col-md-12 mt-3">
                     <div class="row">
                        <div class="col-md-7 pr-0">
                           <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ $housevalue }} </span><span
                              class="font-weight-normal price_dots_span"></span></label>
                        </div>
                        <div class="col-md-3 pl-0">
                           <label class="font-weight-bold "><span
                              class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_value($key.'_price', $expenses_info), 2, '.', ',') }}</span></label>
                        </div>
                     </div>
                  </div>
               @else
                  <div class="col-md-12 dsad">
                     <div class="row">
                        <div class="col-md-7 pr-0">
                           <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ $housevalue }} </span><span
                              class="font-weight-normal price_dots_span">{{ Helper::validate_key_value($key.'_value', $expenses_info) }}</span></label>
                        </div>
                        <div class="col-md-3 pl-0">
                           <label class="font-weight-bold "><span
                              class="font-weight-normal text-c-red">${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_value($key.'_price', $expenses_info), 2, '.', ',') }}</span></label>
                        </div>
                     </div>
                  </div>
               @endif
            @endforeach
            {{-- Additional Mortgages Section --}}
            @if(Helper::validate_key_value('mortgage_property1', $expenses_info) == 1)
               @php
                  $food_housekeeping4 = [
                           "other_real_estate_price" => "Mortgage payment on other Real Estate Property",
                           "tax" => "Taxes on other Real Estate Property",
                           "rental_insurance_price" => "Other Real Property, Homeowner's, or Renter's Insurance payments",
                           "home_maintenance_price" => "Home maintenance (including repairs and upkeep)",
                           "condominium_price" => "Homeowner's association or condominium dues",
                  ];
               @endphp
               
               <div class="col-md-12">
                  <label class="font-weight-bold "> <span class="section-title font-weight-bold font-lg-12 ">{{ __('Additional Mortgages on other properties:') }}</span></label>
               </div>
               
               @foreach($food_housekeeping4 as $key => $housevalue)
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-7 pr-0">
                           <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ $housevalue }}:</span><span
                              class="font-weight-normal price_dots_span"></span></label>
                        </div>
                        <div class="col-md-3 pl-0">
                           <label class="font-weight-bold "><span
                              class="font-weight-normal text-c-red">&nbsp;${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_loop_value('mortgage_property', $expenses_info, $key), 2, '.', ',') }}</span></label>
                        </div>
                     </div>
                  </div>
               @endforeach
            @endif
            {{-- Other Expenses Section --}}
            @if(Helper::validate_key_value('other_expense_available', $expenses_info) == 1)
               @if(!empty($expenses_info['other_expense_specify']))
                  <div class="col-md-7 pr-0">
                     <label class="font-weight-bold price_dots_label"><span class="price_dots_span">{{ __('Other expenses (Describe):') }}</span><span
                        class="font-weight-normal price_dots_span"> {{ $expenses_info['other_expense_specify'] }}</span></label>
                  </div>
                  <div class="col-md-3 pl-0">
                     <label class="font-weight-bold "><span
                        class="font-weight-normal text-c-red">&nbsp;${{ $Total_monthly_expenses[] = number_format((float)Helper::validate_key_value('other_expense_price', $expenses_info), 2, '.', ',') }}</span></label>
                  </div>
               @endif
            @endif
            {{-- Future Expense Changes Section --}}
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-12">
                     <label class="font-weight-bold ">Do you expect any increase or decrease in expenses to occur in the next year: <span
                        class="font-weight-normal">{{ Helper::key_display('increase_decrease_expenses_option', $expenses_info) }}</span></label>
                  </div>
                  <div class="col-md-6 {{ Helper::key_hide_show_v('increase_decrease_expenses_option', $expenses_info) }}">
                     <label class="font-weight-bold ">Notes: <span
                        class="font-weight-normal">{{ $expenses_info['increase_decrease_expenses'] }}</span></label>
                  </div>
               </div>
            </div>
            
            {{-- Total Monthly Expenses Calculation --}}
            @php
               $total_cal_price = [];
               foreach ($Total_monthly_expenses as $price) {
                   $total_cal_price[] = (float) (str_replace(",", "", $price));
               }
               $Total_monthly_expenses_cal = number_format(array_sum($total_cal_price), 2, '.', ',');
            @endphp

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-7 pr-0 text-right">
                     <label class="font-weight-bold text-c-red">{{ __('Total Monthly Expenses:') }} </label>
                  </div>
               <div class="col-md-3 pl-0">
                  <span
                     class="font-weight-bold text-c-red text-c-red">&nbsp;${{ $Total_monthly_expenses_cal }}</span>
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
