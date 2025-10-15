<div class="sign_up_bgs paralegal-popup">
   <?php
   $finaanicalAff = $financialAffairs;
   $ques6dateone = [];
   $ques6datetwo = [];
   $ques6datethree = [];
   $ques6amountpaid = [];
   $QUES7 = Helper::validate_key_value("payment_past_one_year", $finaanicalAff);

   $finaanical6Aff = json_decode($finaanicalAff['primarily_consumer_debets_data'], 1);
   if (!empty($finaanical6Aff['creditor_address'])) {
       for ($i = 0;$i < count($finaanical6Aff['creditor_address']);$i++) {
           $finacial_affairst = $finaanical6Aff;
           $ques6dateone[] = Helper::validate_key_loop_value('payment_dates', $finacial_affairst, $i);
           $ques6datetwo[] = Helper::validate_key_loop_value('payment_dates2', $finacial_affairst, $i);
           $ques6datethree[] = Helper::validate_key_loop_value('payment_dates3', $finacial_affairst, $i);
           $ques6amountpaid[] = Helper::validate_key_loop_value('total_amount_paid', $finacial_affairst, $i);
       }
   }


   ?>
   <div class=" container-fluid">
      <div class="row page-flex">
         <div class="col-md-12 " style="padding:0px 30px 20px 30px;">
            <div class="form_colm row py-4 ">
               <div class="col-md-12">
                  <div class="align-center mt-1">
                     <h1 class="text-c-blue" style="font-size:28px; font-family:'Bradley Hand', sans-serif !important"><strong>{{ __('Paralegal Check') }}</strong></h1>
                  </div>
               </div>
               <div class="col-md-2">
               </div>
               <div class="col-md-12 mt-3">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive">
                           <?php
                              $no = "<span class='gray'>N/A</span>";
   $err = "<span class='perr'>No</span>";
   $yes = "<span class='psucc'>OK</span>";
   $mod = "<span class='mod'>OK</span>";
   ?>
                           <table class="table table-hover w-100">
                              <tr>
                                 <th colspan="2" scope="col">{{ __('Voluntary Petition:') }}</th>
                              </tr>
                              <tr>
                                 <td> {{ __('SSN/ITIN:') }} </td>
                                 <td>SSN: <span id="ssnOK"></span>, ITIN: <span id="itinOK"></span> </td>
                              </tr>
                              <tr>
                                 <td> {{ __('Prior Cases:') }} </td>
                                 <td> Ques 9: <span id="prior9OK"></span>, Ques 10: <span id="prior10OK"></span> 
                                 </td>
                              </tr>

                              <tr>
                                 <td> {{ __('Business Names:') }} </td>
                                 <td id="businessNameOK"></td>
                              </tr>
                              <tr>
                                 <td class="border-none" colspan=2></td>
                              </tr>
                              <tr>
                                 <th colspan="2" scope="col">Income & Deductions:
                                    <span class="font-weight-normal">{{ __('(Checks to make sure all Income related assets are listed on Schedule A/B)') }}</span>
                                 </th>
                              </tr>
                              <tr>
                                 <td class="border-none" colspan=2></td>
                              </tr>
                              <?php

      $li = $no;
   $hs = $no;
   $sl = $no;

   if (Helper::validate_key_value('otherDeductions11', $debtorIncome) == 1) {
       $debtorDeductionsName = json_encode(Helper::validate_key_value('other_deduction_specify', $debtorIncome));
       if (str_contains(strtolower($debtorDeductionsName), 'health savings')) {
           $hs = $yes;
       }
       if (str_contains(strtolower($debtorDeductionsName), 'life')) {
           $li = $yes;
       }
       if (str_contains(strtolower($debtorDeductionsName), 'supp. life')) {
           $sl = $yes;
       }
   }

   $sli = $no;
   $shs = $no;
   $ssl = $no;
   if (Helper::validate_key_value('otherDeductions22', $spouseIncome) == 1) {
       $spousedeductionsName = json_encode(Helper::validate_key_value('other_deduction_specify', $spouseIncome));
       if (str_contains(strtolower($spousedeductionsName), 'life')) {
           $sli = $yes;
       }
       if (str_contains(strtolower($spousedeductionsName), 'health savings')) {
           $shs = $yes;
       }
       if (str_contains(strtolower($spousedeductionsName), 'supp. life')) {
           $ssl = $yes;
       }
   }
   ?>

                              <tr>
                                 <td width="50%">
                                    <table class="w-100">
                                       <tr class="mt-3">
                                          <td width="60%"><strong>{{ __('Deductions:') }} </strong> </td>
                                          <td width="20%">{{ __('Debtor') }}</td>
                                          <td width="20%">{{ __('Codebtor') }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Life Insurance') }} </td>
                                          <td><?php echo $li; ?></td>
                                          <td><?php echo $sli; ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Supplemental Life') }}</td>
                                          <td><?php echo $sl; ?></td>
                                          <td><?php echo $ssl; ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Retirement (Mandatory, Voluntary)') }}</td>
                                          <td><?php echo Helper::validate_key_value('paycheck_mandatory_contribution', $debtorIncome) > 0 ? "M: " . $yes . "" : "M: " . $no . ""; ?>
                                             , <?php echo Helper::validate_key_value('paycheck_voluntary_contribution', $debtorIncome) > 0 ? "V: " . $yes . "" : "V: " . $no . ""; ?></td>
                                          <td><?php echo Helper::validate_key_value('joints_paycheck_mandatory_contribution', $spouseIncome) > 0 ? "M: " . $yes . "" : "M: " . $no . ""; ?>
                                             , <?php echo Helper::validate_key_value('joints_paycheck_voluntary_contribution', $spouseIncome) > 0 ? "V: " . $yes . "" : "V: " . $no . ""; ?></td>
                                       </tr>
                                       <tr>


                                          <td>{{ __('Health Savings Account') }}</td>
                                          <td><?php echo $hs; ?></td>
                                          <td><?php echo $shs; ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Union Dues') }}</td>
                                          <td><?php echo Helper::validate_key_value('union_dues_deducted', $debtorIncome) > 0 ? "" . $yes . "" : "" . $no . ""; ?></td>
                                          <td><?php echo Helper::validate_key_value('joints_union_dues_deducted', $spouseIncome) > 0 ? "" . $yes . "" : "" . $no . ""; ?></td>
                                       </tr>
                                    </table>
                                 </td>
                                 <td width="50%">
                                    <table class="w-100">
                                       <tr>
                                          <td width="60%"><strong>{{ __('Income:') }} </strong> </td>
                                          <td width="20%">{{ __('Debtor') }}</td>
                                          <td width="20%">{{ __('Codebtor') }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Social Security') }} </td>
                                          <td><?php echo Helper::paralegal_key_display('social_security', $debtorIncome); ?></td>
                                          <td><?php echo Helper::paralegal_key_display('joints_social_security', $spouseIncome); ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Pension') }} </td>
                                          <td><?php echo Helper::paralegal_key_display('retirement_income', $debtorIncome); ?></td>
                                          <td><?php echo Helper::paralegal_key_display('joints_retirement_income', $spouseIncome); ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Unemployment') }} </td>
                                          <td> <?php echo Helper::paralegal_key_display('unemployment_compensation', $debtorIncome); ?></td>
                                          <td> <?php echo Helper::paralegal_key_display('joints_unemployment_compensation', $spouseIncome); ?></td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Government Assistance') }} </td>
                                          <td> <?php echo Helper::paralegal_key_display('government_assistance', $debtorIncome); ?></td>
                                          <td> <?php echo Helper::paralegal_key_display('government_assistance', $spouseIncome); ?></td>
                                       </tr>
                                       <tr>
                                          <td> {{ __('Business (self-employed)') }} </td>
                                          <td><?php echo Helper::paralegal_key_display('operation_business', $debtorIncome); ?></td>
                                          <td> <?php echo Helper::paralegal_key_display('joints_operation_business', $spouseIncome); ?></td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="border-none" colspan=2></td>
                              </tr>
                              <tr>
                                 <th colspan="2" scope="col">Property:
                                    <span class="font-weight-normal">{{ __('(Checks to make sure all property is listed on Schedule A/B)') }} </span>
                                 </th>
                              </tr>
                              <tr>
                                 <td> {{ __('Real Property') }} </td>
                                 <td><?php echo !empty($resident) ? (Helper::validate_key_value('currently_lived', $resident[0]) == 1 ? "" . $yes . "" : "" . $no . "") : ''; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Vehicles') }} </td>
                                 <td><?php echo !empty($vehicle) ? (Helper::validate_key_value('own_any_property', $vehicle[0]) == 1 ? "" . $yes . "" : "" . $no . "") : ''; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Recreational vehicles') }} </td>
                                 <td><?php echo !empty($recretional) ? (Helper::validate_key_value('own_any_property', $recretional[0]) == 1 ? "" . $yes . "" : "" . $no . "") : ''; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Personal Property') }} </td>
                                 <td><?php echo !empty($householdExists) ? "" . $yes . "" : "" . $no . ""; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Financial Assets') }} </td>
                                 <td><?php echo !empty($financialExists) ? "" . $yes . "" : "" . $no . ""; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Business Related') }} </td>
                                 <td><?php echo !empty($businessExists) ? "" . $yes . "" : "" . $no . ""; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Farm & Commercial Property') }} </td>
                                 <td><?php echo !empty($farmExists) ? "" . $yes . "" : "" . $no . ""; ?></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Misc. Property') }} </td>
                                 <td><?php echo !empty($miscExists) ? "" . $yes . "" : "" . $no . ""; ?></td>
                              </tr>
                              <tr>
                                 <td class="border-none" colspan=2></td>
                              </tr>
                              <!-- <tr>
                                 <th scope="col">Exemptions:
                                    <span class="font-weight-normal">{{ __('(Checks to make sure all property listed on Schedule A/B is exempt on Schedule C)') }}</span>
                                 </th>
                                 <th><span class="exemption_alert"><span class="psucc">OK</span></span></th>
                              </tr>
                              <tr>
                                 <td class="border-none" colspan=2>
                                    <span class="exemption_alert_reason"></span>
                                 </td>
                              </tr> -->
                              <tr>
                                 <td class="border-none" colspan=2></td>
                              </tr>
                              <tr>
                                 <th colspan="2" scope="col">Statement of Financial Affairs: <br>
                                 </th>
                              </tr>
                              <tr>
                                 <td> {{ __('Community Property Schedule H') }} </td>
                                 <td><span id="sch_h_paralegal"></span></td>
                              </tr>

                              <tr>
                                 <td> {{ __('Income') }} </td>
                                 <td>Ques 4: Debtor <span id="income4_OK"></span> Spouse <span id="incomespouse4_OK"></span>, Ques 5: Debtor <span id="income5_OK"></span> Spouse <span id="incomespouse5_OK"></span></td>
                              </tr>
                              <tr>
                                 <td> {{ __('Business(s) Listed') }} </td>
                                 <td>
                                    <?php echo "Ques 27: ";?>
                                    <span id="sofa27"><?php echo $no; ?></span>
                                    <?php echo ", Ques 28: " . Helper::paralegal_key_display('list_financial_institutions', $financialAffairs); ?></td>
                                 </td>
                              </tr>
                              <tr>
                                 <td> {{ __('Payment within last 90 days listed') }} </td>
                                 <td>Ques 6: <span id="payment6_OK"></span>, Ques 7: <span id="payment7_OK"></span></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   .paralegal-popup .table td {
      padding: 5px
   }

   .paralegal-popup .table td,
   .paralegal-popup .table th {
      padding: 5px;
      border-top: 1px solid #eaeaea;
      white-space: nowrap;
      vertical-align: middle;
   }

   .large-fb-width {
      min-width: 1100px !important;
      width: 90% !important;
      height: 90%;
      min-height: 90% !important;
   }

   .halfw {
      width: 110px;
      display: inline-flex;
   }

   .font-weight-bold {
      font-weight: bold;
   }

   a.close-custom {
      position: absolute;
      right: 10px;
      top: 0px;
      font-size: 20px;
   }

   .psucc {
      color: green;
      font-weight: bold;
   }
   .mod {
      color: #FCD12A;
      font-weight: bold;
   }

   .perr {
      color: red;
      font-weight: bold;
   }

   ul.nobullet li {
      list-style-type: none !important;
   }

   ul.nobullet {
      padding: 0px;
      margin-top: 0px;
   }

   li.alert-u {
      width: 100px;
      float: left;
   }

   ul.nobullet li {
      padding: 5px;

   }

   li.li_alert_head {
      border-top: 1px solid #efefef;
      border-bottom: 1px solid #efefef;
   }

   .paralegal-popup tr th {
      text-align: left;
   }
.gray{font-weight: bold;color:gray;}
   #facebox {
      top: 0px;
   }
</style>
<script>
   $(document).ready(function() {
      var scval = $(".community_prop_sch_h").val();
      var sign = "<?php echo $yes ?>";
      if (scval == '' && scval == undefined) {
         sign = "<?php echo $no; ?>";
      }
      $("#sch_h_paralegal").html(sign);

      var indexcount = 0;
      var datalist = {};
      var totalpages = $("#schc_tot_pages").val();
      var ullist = "<ul class='nobullet'><li class='li_alert_head'><span class='halfw font-weight-bold'>{{ __('Exemption Pending Count') }}</span></li>";
      $(".exemption-sel").each(function() {
         if ($(this).hasClass('exemp-red')) {
            pagefrom = $(this).parent("div").data("pagefrom");
            if (pagefrom in datalist) {
               indexcount = indexcount + 1;
            } else {
               indexcount = 0
            }
            if (indexcount == 0) {
               indexcount = indexcount + 1;
            }
            datalist[pagefrom] = indexcount;
            
         }
      });
      ullist += "</ul>";
      var pagesArray = [];
      for (ind = 1; ind <= totalpages; ind++) {
         pagesArray.push(ind);
      }
      var filledpages = [];
      $.each(datalist, function(pageno, notfilledCount) {
         filledpages.push(pageno);
      });
    
      if (indexcount > 0) {
       
         for (ind = 1; ind <= totalpages; ind++) {
            if (datalist[ind] > 0) {
               ullist = ullist + "<li attr=" + ind + " class='alert-u'> <span class='perr'>" + datalist[ind] + "<</span><span> {{ __('on page') }}</span> </span> <span class='font-weight-bold'>" + ind + "</span> </li>";
            } else {
               ullist = ullist + "<li attr=" + ind + " class='alert-u'> <span class='psucc'> OK</span><span> {{ __('on page') }}</span> </span> <span class='font-weight-bold'>" + ind + "</span> </li>";
            }
         }

         $(".exemption_alert_reason").html(ullist);
         $(".exemption_alert").html("<label class='perr'>{{ __('No') }}</label>");
      }
      
      // ssn/itin
      var ssn_from_ssn_statement =  document.querySelector('.ssn_full_debtor').value;
      var itin_full_debtor =  document.querySelector('.itin_full_debtor').value;
      document.getElementById('ssnOK').innerHTML = "<?php echo $no;?>";
      var vol_pet_ssn = document.querySelector('.vol_pet_ssn').value;
      var vol_pet_itin = document.querySelector('.vol_pet_itin').value;
      var ssn1 = "<?php echo $ssn1; ?>";
      var hasssn = "<?php echo $hasssn; ?>";
      if(hasssn !=1){
         if(ssn_from_ssn_statement == ssn1 &&  vol_pet_ssn == ssn1){
            document.getElementById('ssnOK').innerHTML = "<?php echo $yes?>";
         }else{
            document.getElementById('ssnOK').innerHTML = "<?php echo $err?>";
         }
      }
      document.getElementById('itinOK').innerHTML = "<?php echo $no;?>";
      if(hasssn ==1){
         var itin_ful = "<?php echo $itin_full; ?>";
         var itin_from_ssn_statement =  document.querySelector('.itin_full_debtor').value;
         if(itin_from_ssn_statement == itin_ful && vol_pet_itin == itin_ful){
            document.getElementById('itinOK').innerHTML = "<?php echo $yes?>";
         }else{
            document.getElementById('itinOK').innerHTML = "<?php echo $err?>";
         }
      }

      //prior cases Q9
      if (document.querySelector('.prior_case_9_yes').checked) {
         document.getElementById('prior9OK').innerHTML = "<?php echo $yes?>";
      } 
      if (document.querySelector('.prior_case_9_no').checked) {
         document.getElementById('prior9OK').innerHTML = "<?php echo $no?>";
      }
      if (document.querySelector('.prior_case_9_no').checked == false && document.querySelector('.prior_case_9_yes').checked == false) {
         document.getElementById('prior9OK').innerHTML = "<?php echo $err?>";
      }
      
      //prior cases Q10
      if (document.querySelector('.prior_case_10_yes').checked) {
         document.getElementById('prior10OK').innerHTML = "<?php echo $yes?>";
      } 
      if (document.querySelector('.prior_case_10_no').checked) {
         document.getElementById('prior10OK').innerHTML = "<?php echo $no?>";
      }
      if (document.querySelector('.prior_case_10_no').checked == false && document.querySelector('.prior_case_10_yes').checked == false) {
         document.getElementById('prior10OK').innerHTML = "<?php echo $err?>";
      }

     

      //bussiness names if($any_other_name == 'No'){echo $no;} if($any_other_name == 'Yes'){echo $yes;}
      var any_other_name = "<?php echo $any_other_name; ?>"
      if(any_other_name == 'No'){
         document.getElementById('businessNameOK').innerHTML = "<?php echo $no?>";
         
      } 
     
      if(any_other_name == 'Yes'){
         var businessName =  <?php echo json_encode($partRest); ?>;
         var nameEqual = 0;
         var ind = 0;
         $(".businessname").each(function(){
            var b_nam = '';
            b_name = $(this).val();
            console.log(businessName[ind]);
            if(businessName.indexOf(b_name) == -1) {
               nameEqual++;
            }
            ind++;
         });
         
         if(nameEqual>0){
            document.getElementById('businessNameOK').innerHTML = "<?php echo $err?>";
         }else{
            if(businessName.length > 0){
               
               document.getElementById('businessNameOK').innerHTML = "<?php echo $yes?>";
            }
         }
      }

      //income q4
      
      var income_q4_d1 = "<?php echo $income_q4_d1; ?>"
      var income_q4_d2 = "<?php echo $income_q4_d2; ?>"
     

      //income q5
    
      var income_q5_d1 = "<?php echo $income_q5_d1; ?>"
      var income_q5_d2 = "<?php echo $income_q5_d2; ?>"
      

            document.getElementById('income4_OK').innerHTML = "<?php echo $no?>";
           
         
            var quesdebtorerror = 0;
            var quesdebtormodified = 0;
            var quesdebtormatched = 0;

            var total_amount_this_year_income =  '<?php echo Helper::validate_key_value('total_amount_this_year_income', $financialAffairs); ?>';
            var total_amount_this_year_income_html = 0;
            total_amount_this_year_income_html = $(".total_amount_this_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_this_year_income) > 0 && parseFloat(total_amount_this_year_income_html) <= 0){
               quesdebtorerror = quesdebtorerror +1;
               
            }
            if(parseFloat(total_amount_this_year_income) > 0 && parseFloat(total_amount_this_year_income_html) > 0 && parseFloat(total_amount_this_year_income)!=parseFloat(total_amount_this_year_income_html)){
               quesdebtormodified = quesdebtormodified +1;
               
            }
            var total_amount_last_year_income =  '<?php echo Helper::validate_key_value('total_amount_last_year_income', $financialAffairs); ?>';
            var total_amount_last_year_income_html = 0;
            total_amount_last_year_income_html = $(".total_amount_last_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_last_year_income) > 0 && parseFloat(total_amount_last_year_income_html) <= 0){
               quesdebtorerror = quesdebtorerror +1;
            }
            if(parseFloat(total_amount_last_year_income) > 0 && parseFloat(total_amount_last_year_income_html) > 0 && parseFloat(total_amount_last_year_income)!=parseFloat(total_amount_last_year_income_html)){
               quesdebtormodified = quesdebtormodified +1;
            }

            var total_amount_lastbefore_year_income =  '<?php echo Helper::validate_key_value('total_amount_lastbefore_year_income', $financialAffairs); ?>';
            var total_amount_lastbefore_year_income_html = 0;
            total_amount_lastbefore_year_income_html = $(".total_amount_lastbefore_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_lastbefore_year_income) > 0 && parseFloat(total_amount_lastbefore_year_income_html) <= 0){
               quesdebtorerror = quesdebtorerror +1;
            }
            if(parseFloat(total_amount_lastbefore_year_income) > 0 && parseFloat(total_amount_lastbefore_year_income_html) > 0 && parseFloat(total_amount_lastbefore_year_income) != parseFloat(total_amount_lastbefore_year_income_html)){
               quesdebtormodified = quesdebtormodified +1;
            }
            
            if(quesdebtorerror >0){
               document.getElementById('income4_OK').innerHTML = "<?php echo $err?>";
            }else if(quesdebtormodified>0){
               document.getElementById('income4_OK').innerHTML = "<?php echo $mod?>";
            }else{
               if(income_q4_d1 ==1 && quesdebtorerror ==0 && quesdebtormodified == 0){
                  document.getElementById('income4_OK').innerHTML = "<?php echo $yes;?>";
               }
            }




            /*"total_amount_spouse_this_year_income",
            "total_amount_spouse_last_year_income",
            "total_amount_spouse_lastbefore_year_income",*/
            document.getElementById('incomespouse4_OK').innerHTML = "<?php echo $no?>";
            var quesspouseerror = 0;
            var quesspousemodified = 0;

            var total_amount_spouse_this_year_income =  '<?php echo Helper::validate_key_value('total_amount_spouse_this_year_income', $financialAffairs); ?>';
            var total_amount_spouse_this_year_income_html = 0;
            total_amount_spouse_this_year_income_html = $(".total_amount_spouse_this_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_spouse_this_year_income) > 0 && parseFloat(total_amount_spouse_this_year_income_html) <= 0){
               quesspouseerror = quesspouseerror +1;
            }
            if(parseFloat(total_amount_spouse_this_year_income) > 0 && parseFloat(total_amount_spouse_this_year_income_html) > 0 && parseFloat(total_amount_spouse_this_year_income)!=parseFloat(total_amount_spouse_this_year_income_html)){
               quesspousemodified = quesspousemodified +1;
               
            }
            var total_amount_spouse_last_year_income =  '<?php echo Helper::validate_key_value('total_amount_spouse_last_year_income', $financialAffairs); ?>';
            var total_amount_spouse_last_year_income_html = 0;
            total_amount_spouse_last_year_income_html = $(".total_amount_spouse_last_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_spouse_last_year_income) > 0 && parseFloat(total_amount_spouse_last_year_income_html) <= 0){
               quesspouseerror = quesspouseerror +1;
            }
            if(parseFloat(total_amount_spouse_last_year_income) > 0 && parseFloat(total_amount_spouse_last_year_income_html) > 0 && parseFloat(total_amount_spouse_last_year_income)!=parseFloat(total_amount_spouse_last_year_income_html)){
               quesspousemodified = quesspousemodified +1;
            }

            var total_amount_spouse_lastbefore_year_income =  '<?php echo Helper::validate_key_value('total_amount_spouse_lastbefore_year_income', $financialAffairs); ?>';
            var total_amount_spouse_lastbefore_year_income_html = 0;
            total_amount_spouse_lastbefore_year_income_html = $(".total_amount_spouse_lastbefore_year_income").val().replace(/,/g, '');
            if(parseFloat(total_amount_spouse_lastbefore_year_income) > 0 && parseFloat(total_amount_spouse_lastbefore_year_income_html) <= 0){
               quesspouseerror = quesspouseerror +1;
            }
            if(parseFloat(total_amount_spouse_lastbefore_year_income) > 0 && parseFloat(total_amount_spouse_lastbefore_year_income_html) > 0 && parseFloat(total_amount_spouse_lastbefore_year_income) != parseFloat(total_amount_spouse_lastbefore_year_income_html)){
               quesspousemodified = quesspousemodified +1;
            }
            
            if(quesspouseerror >0){
               document.getElementById('incomespouse4_OK').innerHTML = "<?php echo $err?>";
            }else if(quesspousemodified>0){
               document.getElementById('incomespouse4_OK').innerHTML = "<?php echo $mod?>";
            }else{
               if(income_q4_d2 ==1 && quesspouseerror ==0 && quesspousemodified == 0){
                  document.getElementById('incomespouse4_OK').innerHTML = "<?php echo $yes;?>";
               }
            }

            /*"other_amount_this_year_income",
            "other_amount_last_year_income",
            "other_amount_lastbefore_year_income",*/

            document.getElementById('income5_OK').innerHTML = "<?php echo $no?>";
           
         
           var ques5debtorerror = 0;
           var ques5debtormodified = 0;
           var ques5debtormatched = 0;

           var other_amount_this_year_income =  '<?php echo Helper::validate_key_value('other_amount_this_year_income', $financialAffairs); ?>';
           var other_amount_this_year_income_html = 0;
           other_amount_this_year_income_html = $(".other_amount_this_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_this_year_income) > 0 && parseFloat(other_amount_this_year_income_html) <= 0){
              ques5debtorerror = ques5debtorerror +1;
              
           }
           if(parseFloat(other_amount_this_year_income) > 0 && parseFloat(other_amount_this_year_income_html) > 0 && parseFloat(other_amount_this_year_income)!=parseFloat(other_amount_this_year_income_html)){
              ques5debtormodified = ques5debtormodified +1;
              
           }
           var other_amount_last_year_income =  '<?php echo Helper::validate_key_value('other_amount_last_year_income', $financialAffairs); ?>';
           var other_amount_last_year_income_html = 0;
           other_amount_last_year_income_html = $(".other_amount_last_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_last_year_income) > 0 && parseFloat(other_amount_last_year_income_html) <= 0){
              ques5debtorerror = ques5debtorerror +1;
           }
           if(parseFloat(other_amount_last_year_income) > 0 && parseFloat(other_amount_last_year_income_html) > 0 && parseFloat(other_amount_last_year_income)!=parseFloat(other_amount_last_year_income_html)){
              ques5debtormodified = ques5debtormodified +1;
           }

           var other_amount_lastbefore_year_income =  '<?php echo Helper::validate_key_value('other_amount_lastbefore_year_income', $financialAffairs); ?>';
           var other_amount_lastbefore_year_income_html = 0;
           other_amount_lastbefore_year_income_html = $(".other_amount_lastbefore_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_lastbefore_year_income) > 0 && parseFloat(other_amount_lastbefore_year_income_html) <= 0){
              ques5debtorerror = ques5debtorerror +1;
           }
           if(parseFloat(other_amount_lastbefore_year_income) > 0 && parseFloat(other_amount_lastbefore_year_income_html) > 0 && parseFloat(other_amount_lastbefore_year_income) != parseFloat(other_amount_lastbefore_year_income_html)){
              ques5debtormodified = ques5debtormodified +1;
           }
           
           if(ques5debtorerror >0){
              document.getElementById('income5_OK').innerHTML = "<?php echo $err?>";
           }else if(ques5debtormodified>0){
              document.getElementById('income5_OK').innerHTML = "<?php echo $mod?>";
           }else{
              if(income_q5_d1 ==1 && ques5debtorerror ==0 && ques5debtormodified == 0){
                 document.getElementById('income5_OK').innerHTML = "<?php echo $yes;?>";
              }
           }
            
            /*"other_amount_spouse_this_year_income",
            "other_amount_spouse_last_year_income",
            "other_amount_spouse_lastbefore_year_income"*/
            document.getElementById('incomespouse5_OK').innerHTML = "<?php echo $no?>";
           
         
            var ques5spouseerror = 0;
           var ques5spousemodified = 0;
           var ques5spousematched = 0;

           var other_amount_this_year_income =  '<?php echo Helper::validate_key_value('other_amount_this_year_income', $financialAffairs); ?>';
           var other_amount_this_year_income_html = 0;
           other_amount_this_year_income_html = $(".other_amount_this_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_this_year_income) > 0 && parseFloat(other_amount_this_year_income_html) <= 0){
              ques5spouseerror = ques5spouseerror +1;
              
           }
           if(parseFloat(other_amount_this_year_income) > 0 && parseFloat(other_amount_this_year_income_html) > 0 && parseFloat(other_amount_this_year_income)!=parseFloat(other_amount_this_year_income_html)){
              ques5spousemodified = ques5spousemodified +1;
              
           }
           var other_amount_last_year_income =  '<?php echo Helper::validate_key_value('other_amount_last_year_income', $financialAffairs); ?>';
           var other_amount_last_year_income_html = 0;
           other_amount_last_year_income_html = $(".other_amount_last_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_last_year_income) > 0 && parseFloat(other_amount_last_year_income_html) <= 0){
              ques5spouseerror = ques5spouseerror +1;
           }
           if(parseFloat(other_amount_last_year_income) > 0 && parseFloat(other_amount_last_year_income_html) > 0 && parseFloat(other_amount_last_year_income)!=parseFloat(other_amount_last_year_income_html)){
              ques5spousemodified = ques5spousemodified +1;
           }

           var other_amount_lastbefore_year_income =  '<?php echo Helper::validate_key_value('other_amount_lastbefore_year_income', $financialAffairs); ?>';
           var other_amount_lastbefore_year_income_html = 0;
           other_amount_lastbefore_year_income_html = $(".other_amount_lastbefore_year_income").val().replace(/,/g, '');
           if(parseFloat(other_amount_lastbefore_year_income) > 0 && parseFloat(other_amount_lastbefore_year_income_html) <= 0){
              ques5spouseerror = ques5spouseerror +1;
           }
           if(parseFloat(other_amount_lastbefore_year_income) > 0 && parseFloat(other_amount_lastbefore_year_income_html) > 0 && parseFloat(other_amount_lastbefore_year_income) != parseFloat(other_amount_lastbefore_year_income_html)){
              ques5spousemodified = ques5spousemodified +1;
           }
           
           if(ques5spouseerror >0){
              document.getElementById('incomespouse5_OK').innerHTML = "<?php echo $err?>";
           }else if(ques5spousemodified>0){
              document.getElementById('incomespouse5_OK').innerHTML = "<?php echo $mod?>";
           }else{
              if(income_q5_d1 ==1 && ques5spouseerror ==0 && ques5spousemodified == 0){
                 document.getElementById('incomespouse5_OK').innerHTML = "<?php echo $yes;?>";
              }
           }

           var einisOk = 0;
           var einiserr = 0;
           var quest27einNum = <?php echo json_encode($quest27einNum);?>;
           var quest27bizname = <?php echo json_encode($quest27bizname);?>;
           
           var einind = 0;
           $(".financial_affair_business_ein").each(function(){
              if(quest27einNum.length > 0){
                  if($(this).val() != quest27einNum[einind]){
                     einiserr = einiserr + 1;
                  }
               }
               einind++;
           });

            var nameiserr = 0;
            var nameind = 0;
            $(".financial_affair_business_name").each(function(){
              if(quest27bizname.length > 0){
                 if($(this).val() != quest27bizname[nameind]){
                     nameiserr = nameiserr + 1;
                  }
               }
               nameind++;
           });
            if(quest27bizname.length > 0){
                  document.getElementById('sofa27').innerHTML = "<?php echo $yes?>";
            }
            if(einiserr > 0 || nameiserr>0){
                  document.getElementById('sofa27').innerHTML = "<?php echo $err?>";
            }

            var ques6dateone = <?php echo json_encode($ques6dateone) ?>;
            var ques6dateoneerr = 0;
            var date1ind = 0;
              $(".quest6_date_one").each(function(){
              if(ques6dateone.length > 0){
                 if($(this).val() != ques6dateone[date1ind]){
                  ques6dateoneerr = ques6dateoneerr + 1;
                  }
               }
               date1ind++;
           });
/*quest6_amount_paid
quest6_date_one
quest6_date_two
quest6_date_three*/
            var ques6datetwo = <?php echo json_encode($ques6datetwo) ?>;
            var ques6datetwoerr = 0;
            var date2ind = 0;
              $(".quest6_date_two").each(function(){
              if(ques6datetwo.length > 0){
                 if($(this).val() != ques6datetwo[date2ind]){
                  ques6datetwoerr = ques6datetwoerr + 1;
                  }
               }
               date2ind++;
           });
            var ques6datethree = <?php echo json_encode($ques6datethree); ?>;
            var ques6datethreeerr = 0;
            var date3ind = 0;
              $(".quest6_date_three").each(function(){
              if(ques6datethree.length > 0){
                 if($(this).val() != ques6datethree[date3ind]){
                  ques6datethreeerr = ques6datethreeerr + 1;
                  }
               }
               date3ind++;
           });
            var ques6amountpaid = <?php echo json_encode($ques6amountpaid); ?>;
            var ques6amountpaideerr = 0;
            var dapaidind = 0;
              $(".quest6_amount_paid").each(function(){
              if(ques6amountpaid.length > 0){
                 console.log(ques6amountpaid[dapaidind]+"="+$(this).val().replace(/,/g, ''));
                 var ap = 0;
                 ap = $(this).val().replace(/,/g, '');
                 if(ap != ques6amountpaid[dapaidind]){
                    
                  ques6amountpaideerr = ques6amountpaideerr + 1;
                  }
               }
               dapaidind++;
           });

           if(ques6amountpaid.length > 0){
            document.getElementById('payment6_OK').innerHTML = "<?php echo $yes;?>";
           }
         
           if(ques6dateoneerr > 0 || ques6datetwoerr > 0 || ques6datethreeerr > 0 || ques6amountpaideerr > 0){
               document.getElementById('payment6_OK').innerHTML = "<?php echo $err?>";
           }

      //payment q7
      var ques7 = '<?php echo $QUES7 ?>';
      if (ques7 == 1) {
         document.getElementById('payment7_OK').innerHTML = "<?php echo $yes?>";
      } 
      if (ques7 =='') {
         document.getElementById('payment7_OK').innerHTML = "<?php echo $no?>";
      }
      
   });
</script>
