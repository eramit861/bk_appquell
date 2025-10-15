<div class="row px-2 paralegal_div">
   <div class="col-md-12">
      <h3 class="text-c-blue text-center text-bold" >Paralegal Check</h3>
   </div>
   <div class="col-md-12 mt-1">
      <div class="table_card">
         <table class="w-100">
            <thead>
               <tr>
                  <th colspan="3">Voluntary Petition:</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="w-50">SSN/ITIN:</td>
                  <td class="w-25">SSN: <?php echo $voluntaryPetition['ssn'];?></td>
                  <td class="w-25">ITIN: <?php echo $voluntaryPetition['itin'];?></td>
               </tr>
               <tr>
                  <td>Prior Cases:</td>
                  <td>Ques 9: <?php echo $voluntaryPetition['ques9'];?></td>
                  <td>Ques 10: <?php echo $voluntaryPetition['ques10'];?></td>
               </tr>
               <tr>
                  <td>Business Names:</td>
                  <td colspan="2"><?php echo $voluntaryPetition['businessNames'];?></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="col-md-12 mt-3">
      <div class="table_card">
         <table class="w-100">
            <thead>
               <tr>
                  <th colspan="3">Income & Deductions: <small>(Checks to make sure all Income related assets are listed on Schedule A/B)</small></th>
               </tr>
            </thead>
         </table>
         <div class="row">
            <div class="col-md-6 pr-0">
               <table class="w-100">
                  <tbody>
                     <tr>
                        <td class="text-bold w-50">Deductions:</td>
                        <td class="w-25">Debtor</td>
                        <td class="w-25">Codebtor</td>
                     </tr>
                     <tr>
                        <td>Life Insurance</td>
                        <td><?php echo $deductionsDebtor['lifeInsurance'];?></td>
                        <td><?php echo $deductionsCodebtor['lifeInsurance'];?></td>
                     </tr>
                     <tr>
                        <td>Supplemental Life</td>
                        <td><?php echo $deductionsDebtor['supplementalLife'];?></td>
                        <td><?php echo $deductionsCodebtor['supplementalLife'];?></td>
                     </tr>
                     <tr>
                        <td>Retirement (Mandatory, Voluntary)</td>
                        <td>M: <?php echo $deductionsDebtor['retirementMandatory'];?>, V: <?php echo $deductionsDebtor['retirementVoluntary'];?></td>
                        <td>M: <?php echo $deductionsCodebtor['retirementMandatory'];?>, V: <?php echo $deductionsCodebtor['retirementVoluntary'];?></td>
                     </tr>
                     <tr>
                        <td>Health Savings Account</td>
                        <td><?php echo $deductionsDebtor['healthSavingsAccount'];?></td>
                        <td><?php echo $deductionsCodebtor['healthSavingsAccount'];?></td>
                     </tr>
                     <tr>
                        <td>Union Dues</td>
                        <td><?php echo $deductionsDebtor['unionDues'];?></td>
                        <td><?php echo $deductionsCodebtor['unionDues'];?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="col-md-6 pl-0">
               <table class="w-100">
                  <tbody>
                     <tr>
                        <td class="text-bold w-50">Income:</td>
                        <td class="w-25">Debtor</td>
                        <td class="w-25">Codebtor</td>
                     </tr>
                     <tr>
                        <td>Social Security</td>
                        <td><?php echo $incomeDebtor['socialSecurity'];?></td>
                        <td><?php echo $incomeCodebtor['socialSecurity'];?></td>
                     </tr>
                     <tr>
                        <td>Pension</td>
                        <td><?php echo $incomeDebtor['pension'];?></td>
                        <td><?php echo $incomeCodebtor['pension'];?></td>
                     </tr>
                     <tr>
                        <td>Unemployment</td>
                        <td><?php echo $incomeDebtor['unemployment'];?></td>
                        <td><?php echo $incomeCodebtor['unemployment'];?></td>
                     </tr>
                     <tr>
                        <td>Government Assistance</td>
                        <td><?php echo $incomeDebtor['governmentAssistance'];?></td>
                        <td><?php echo $incomeCodebtor['governmentAssistance'];?></td>
                     </tr>
                     <tr>
                        <td>Business (self-employed)</td>
                        <td><?php echo $incomeDebtor['BusinessSelfEmployed'];?></td>
                        <td><?php echo $incomeCodebtor['BusinessSelfEmployed'];?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 mt-3">
      <div class="table_card">
         <table class="w-100">
            <thead>
               <tr>
                  <th colspan="3">Property: <small>(Checks to make sure all property is listed on Schedule A/B)</small></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="w-50">Real Property</td>
                  <td class="w-50"><?php echo $property['realProperty']; ?></td>
               </tr>
               <tr>
                  <td>Vehicles</td>
                  <td><?php echo $property['Vehicles']; ?></td>
               </tr>
               <tr>
                  <td>Recreational vehicles</td>
                  <td><?php echo $property['recreationalVehicles']; ?></td>
               </tr>
               <tr>
                  <td>Personal Property</td>
                  <td><?php echo $property['personalProperty']; ?></td>
               </tr>
               <tr>
                  <td>Financial Assets</td>
                  <td><?php echo $property['financialAssets']; ?></td>
               </tr>
               <tr>
                  <td>Business Related</td>
                  <td><?php echo $property['businessRelated']; ?></td>
               </tr>
               <tr>
                  <td>Farm & Commercial Property</td>
                  <td><?php echo $property['farmAndCommercialProperty']; ?></td>
               </tr>
               <tr>
                  <td>Misc. Property</td>
                  <td><?php echo $property['miscProperty']; ?></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="col-md-12 mt-3">
      <div class="table_card">
         <table class="w-100">
            <thead>
               <tr>
                  <th colspan="3">Statement of Financial Affairs:</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="w-50">Community Property Schedule H</td>
                  <td class="w-25"><?php echo $sofa['communityPropertyScheduleH']; ?></td>
                  <td class="w-25"></td>
               </tr>
               <tr>
                  <td>Income</td>
                  <td>Ques 4: Debtor <?php echo $sofa['ques4Debtor']; ?> Spouse <?php echo $sofa['ques4Codebtor']; ?>,</td>
                  <td>Ques 5: Debtor <?php echo $sofa['ques5Debtor']; ?> Spouse <?php echo $sofa['ques5Codebtor']; ?></td>
               </tr>
               <tr>
                  <td>Business(s) Listed</td>
                  <td>Ques 27: <?php echo $sofa['ques27']; ?>,</td>
                  <td>Ques 28: <?php echo $sofa['ques28']; ?></td>
               </tr>
               <tr>
                  <td>Payment within last 90 days listed</td>
                  <td>Ques 6: <?php echo $sofa['ques6']; ?>,</td>
                  <td>Ques 7: <?php echo $sofa['ques7']; ?></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>

</div>

<style>
   #facebox{
      top: 80px;
   }
   /* .large-fb-width {
      min-width: 1100px !important;
      width: 90% !important;
      height: 90%;
      min-height: 90% !important;
   } */
   .table_card table{
      border-collapse: collapse;
   }.table_card {
      border-radius: 8px;
      background-color: #fff;
      box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.07);
      -webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.07);
      -moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.07);
      border: 1px solid #E2E2E2;
   }
   .table_card th{
      padding: 8px 10px;
      background-color: #EDEEF0;
      border-top-left-radius: 7px;
      border-top-right-radius: 7px
   }
   .table_card td{
      border-top: 1px solid rgba(224, 224, 224, 1);
      padding: 5px 10px;
   }
   .text-na{
      color: #808080;
      font-weight: bold;
   }
   .text-no{
      color: #ff0000;
      font-weight: bold;
   }
   .text-ok{
      color: #008000;
      font-weight: bold;
   }
   .text-ok-yellow{
      color: #FCD12A;
      font-weight: bold;
   }
/* only works with Helper::paralegal_key_display function data */
   .psucc{
      color: #008000;
      font-weight: bold;
   }
   .gray{
      color: #808080;
      font-weight: bold;
   }
</style>