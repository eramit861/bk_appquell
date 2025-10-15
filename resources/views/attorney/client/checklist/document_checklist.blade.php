<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style>       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: auto;
            padding: 5px 10px;
            /* Reduced left & right padding */
            box-shadow: none;
            /* Removed border/shadow */
        }

        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-align: left;
            margin: 5px 0;
            /* Reduced margin */
            padding: 0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin: 0px 0 0px 0;
            /* More compact spacing */
        }

        .checkbox-item input[type="checkbox"] {
            margin: 0;
        }

        .checkbox-item label, label {
            flex: 1;
            margin-left: 5px;
            font-size: 13px;
        }

        .checkbox-item input[type="text"] {
            flex: 2;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
            margin-left: 5px;
            font-size: 13px;
            padding: 2px;
        }
        
        /* .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col {
            -ms-flex-preferred-size:0;
            flex-basis:0;
            -ms-flex-positive:1;
            flex-grow:1;
            max-width:100%
        }
        .col-auto {
            -ms-flex:0 0 auto;
            flex:0 0 auto;
            width:auto;
            max-width:none
        }
        .col-1 {
            -ms-flex:0 0 8.333333%;
            flex:0 0 8.333333%;
            max-width:8.333333%
        }
        .col-2 {
            -ms-flex:0 0 16.666667%;
            flex:0 0 16.666667%;
            max-width:16.666667%
        }
        .col-3 {
            -ms-flex:0 0 25%;
            flex:0 0 25%;
            max-width:25%
        }
        .col-4 {
            -ms-flex:0 0 33.333333%;
            flex:0 0 33.333333%;
            max-width:33.333333%
        }
        .col-5 {
            -ms-flex:0 0 41.666667%;
            flex:0 0 41.666667%;
            max-width:41.666667%
        }
        .col-6 {
            -ms-flex:0 0 50%;
            flex:0 0 50%;
            max-width:50%
        }
        .col-7 {
            -ms-flex:0 0 58.333333%;
            flex:0 0 58.333333%;
            max-width:58.333333%
        }
        .col-8 {
            -ms-flex:0 0 66.666667%;
            flex:0 0 66.666667%;
            max-width:66.666667%
        }
        .col-9 {
            -ms-flex:0 0 75%;
            flex:0 0 75%;
            max-width:75%
        }
        .col-10 {
            -ms-flex:0 0 83.333333%;
            flex:0 0 83.333333%;
            max-width:83.333333%
        }
        .col-11 {
            -ms-flex:0 0 91.666667%;
            flex:0 0 91.666667%;
            max-width:91.666667%
        }
        .col-12 {
            -ms-flex:0 0 100%;
            flex:0 0 100%;
            max-width:100%
        } */

    </style>

    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 20px;
        }

        .text-center {
        text-align: center;
        }

        .row {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        }

        .col-4 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        }

        .col-12 {
        width: 100%;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        .table,
        .th,
        .td {
        border: 1px solid #ddd;
        }

        th {
            padding: 0px;
        }
        td {
        padding: 0px;
        font-size: 14px;
        line-height: 14px;
        }

        h4 {
        font-size: 18px;
        margin-bottom: 15px;
        }

        .font {
        font-size: 14px;
        margin-top: 450px;
        }

        .mb-0 {
        margin-bottom: 0px !important;
        }

        .w-20 {
        width: 20% !important;
        }

        .w-40 {
        width: 40% !important;
        }

        .w-100 {
        width: 100% !important;
        }

        .ml-2{
            margin-left: 0.5rem;
        }
        .ml-3{
            margin-left: 1rem;
        }
        
        .pl-1{
            padding-left: 0.25rem;
        }
        .pl-2{
            padding-left: 0.5rem;
        }
        .pl-3{
            padding-left: 1rem;
        }
        .bb-1 {
            border-bottom: 1px solid black;
        }
        .p-1 {
            padding: 0.25rem;
        }
        .pt-2 { 
            padding-top: 0.5rem;
        }
        input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        .d-flex {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="container">

        <table>
            <tr>
                <th colspan="4">
                    <h1 class="bradly-heading">BK Questionnaire Document Checklist</h1>
                </th>
            </tr>
            
            <!-- Debtor/Co-debtor's Information -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Debtor/Co-debtor's Information</h2>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="checkbox-item ml-3">
                        <label class="pl-1"><?php echo $details['debtorLabel']; ?> Name:</label>
                        <label class="bb-1 w-100"><?php echo $details['debtorName']; ?> </label>
                    </div>
                </td>
                <td colspan="2">
                    <div class="checkbox-item ml-3">
                        <label class="pl-1"><?php echo $details['spouseLabel']; ?> Name:</label>
                        <label class="bb-1 w-100"><?php echo $details['spouseName']; ?> </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo $details['debtorLicense']; ?>>
                        <label for="debtor_license"><?php echo $details['debtorLabel']; ?> Driver's License/ID & SSN</label>
                    </div>
                </td>
                <td colspan="2">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo $details['coDebtorLicense']; ?>>
                        <label for="spouse_license"><?php echo $details['spouseLabel']; ?> Driver's License/ID & SSN</label>
                    </div>
                </td>
            </tr>

            <!-- Real Property -->
            <?php
                $propertyResident = $details['propertyResident'];
                        foreach ($propertyResident as $index => $resident) {
                            ?>
                <tr>
                    <th colspan="4">
                        <h2 class="section-title">Real Property - <?php echo $index + 1; ?></h2>
                    </th>
                </tr>            
                <tr>
                    <td colspan="4">
                        <div class="checkbox-item">
                            <input type="checkbox" <?php echo $resident['currently_lived'] == 1 ? 'checked' : ''; ?>>
                            <label for="debtor_license">Own</label>
                       
                            <input type="checkbox" class="ml-3" <?php echo $resident['currently_lived'] == 0 ? 'checked' : ''; ?>>
                            <label for="debtor_license">Rent</label>
                        
                            <input type="checkbox" class="ml-3" <?php echo $resident['eviction_pending'] == 1 ? 'checked' : ''; ?>>
                            <label for="debtor_license">Leasing Company/Landlord</label>
                            <?php
                                                  if ($resident['eviction_pending'] == 1) {
                                                      $eviction_pending_data = !empty($resident['eviction_pending_data']) ? json_decode($resident['eviction_pending_data'], true) : [];
                                                      if (!empty($eviction_pending_data)) {
                                                          ?>
                                <label class="bb-1 w-100"><?php echo $eviction_pending_data['Name']; ?></label>
                            <?php   }
                                                  }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
                    if ($resident['currently_lived'] == 1 && $resident['loan_own_type_property'] == 1) {
                        $homeCarLoan = !empty($resident['home_car_loan']) ? json_decode($resident['home_car_loan'], true) : [];
                        if (!empty($homeCarLoan)) {
                            $homeCarLoan2 = !empty($resident['home_car_loan2']) ? json_decode($resident['home_car_loan2'], true) : [];
                            $additionalLoan1 = !empty($homeCarLoan2) && isset($homeCarLoan2['additional_loan1']) ? $homeCarLoan2['additional_loan1'] : 0;
                            $homeCarLoan3 = !empty($resident['home_car_loan3']) ? json_decode($resident['home_car_loan3'], true) : [];
                            $additionalLoan2 = !empty($homeCarLoan3) && isset($homeCarLoan3['additional_loan2']) ? $homeCarLoan3['additional_loan2'] : 0;
                            ?>
                    <tr>
                        <td colspan="4">
                            <input type="checkbox" id="mortgage_company" checked>
                            <label >1st Mortgage Holder:</label>
                            <label class="bb-1 w-100"><?php echo $homeCarLoan['creditor_name']; ?></label>
                        </td>
                        </tr>
                    <?php if (!empty($homeCarLoan2) && $additionalLoan1 == 1) { ?>
                        <tr>
                        <td colspan="4">
                            <input type="checkbox" id="mortgage_company" checked>
                            <label >2nd Mortgage Holder:</label>
                            <label class="bb-1 w-100"><?php echo $homeCarLoan2['creditor_name']; ?></label>
                        </td>
                        </tr>
                    <?php } ?>
                  
                    <?php if (!empty($homeCarLoan2) && !empty($homeCarLoan3) && $additionalLoan1 == 1 && $additionalLoan2 == 1) { ?>
                        <tr>
                            <td colspan="4">
                                <input type="checkbox" id="mortgage_company" checked>
                                <label >3rd Mortgage Holder:</label>
                                <label class="bb-1 w-100"><?php echo $homeCarLoan2['creditor_name']; ?></label>
                            </td>
                        </tr>
                    <?php }
                    }
                    }
                        }
                        ?>
            <!-- Vehicles -->
            <?php
                            $propertyVehicle = $details['propertyVehicle'];
                        foreach ($propertyVehicle as $index => $vehicle) {
                            ?>
                <tr>
                    <th colspan="4">
                        <h2 class="section-title">Vehicles - <?php echo $index + 1; ?></h2>
                    </th>
                </tr>
                <tr>
                    <td colspan="4" class="pl-3">
                        <!-- <input type="checkbox" id="mortgage_company"> -->
                        <label class="pl-1">Year, Make, Model:</label>
                        <label class="bb-1 w-100">
                            <?php
                                                echo $vehicle['property_year'].'; '.$vehicle['property_make'].'; '.$vehicle['property_model'] ;
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input type="checkbox" id="mortgage_company" <?php  ?>>
                        <label >Title or Loan:</label>
                        <?php
                            if ($vehicle['loan_own_type_property'] == 1) {
                                $vehicleCarLoan = !empty($vehicle['vehicle_car_loan']) ? json_decode($vehicle['vehicle_car_loan'], true) : [];
                                ?>
                        <label class="bb-1 w-100"> <?php echo $vehicleCarLoan['creditor_name'] ?> </label>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>

            <!-- Financial Details -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Financial Details</h2>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $details['propertyReviwed'] == 1 ? 'checked' : '' ; ?>>
                    <label >Household Goods Inventory Complete?</label>
                    <label class="bb-1 w-100">(<?php echo $details['propertyReviwed'] == 1 ? 'Yes' : 'No' ; ?>)</label>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $details['debtorCreditReport']; ?>>
                    <label >Credit Report Uploaded?</label>
                    <label class="bb-1 w-100">(<?php echo $details['debtorCreditReport'] == 'checked' ? 'Yes' : 'No' ; ?>)</label>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $details['propertyReviwed'] == 1 ? 'checked' : '' ; ?>>
                    <label >All Debts Listed?</label>
                    <label class="bb-1 w-100">(<?php echo $details['propertyReviwed'] == 1 ? 'Yes' : 'No' ; ?>)</label>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="pl-3 pt-2">
                    <label class="pl-1">Bank Accounts (Bank Name & Account #):</label>
                </td>
            </tr>
            <?php
                $bankAccounts = $details['bankAccounts'];

                        foreach ($bankAccounts as $index => $bank) {
                            ?>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $bank['status'] ;?>>
                    <label class="bb-1 w-100"><?php echo $bank['name'] ;
                            echo !empty($bank['no']) ? ' & '.$bank['no'] : ''; ?> <small><?php echo $bank['months'];?></small></label>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td colspan="4" class="pl-3 pt-2">
                    <label class="pl-1">Retirement Accounts (401K, IRA, 403b, Pensions):</label>
                </td>
            </tr>
            <?php
                $retirementAccounts = $details['retirementAccounts'];
                        foreach ($retirementAccounts as $index => $retirement) {
                            ?>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $retirement['status'];?>>
                    <label class="bb-1 w-100"><?php echo $retirement['name']; ?></label>
                </td>
            </tr>
            <?php } ?>

            <!-- Other Financial Obligations -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Other Financial Obligations</h2>
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo $details['domesticSupport'] == 1 ? 'checked' : '' ; ?>>
                    <label >Divorce, Alimony, or Child Support?</label>
                    <label class="bb-1 w-100">(<?php echo $details['domesticSupport'] == 1 ? 'Yes' : 'No' ; ?>)</label>
                </td>
            </tr>

            
            <?php
                                $lifeInsuranceAccounts = $details['lifeInsuranceAccounts'];
                        foreach ($lifeInsuranceAccounts as $index => $acc) {
                            ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item <?php echo !in_array($acc['type'], ['Universal', 'Whole']) ? 'ml-3' : '' ; ?>">
                        <?php if (in_array($acc['type'], ['Universal', 'Whole'])) { ?>
                            <input type="checkbox" <?php echo $acc['status'];?>>
                        <?php } ?>
                        <label class="<?php echo !in_array($acc['type'], ['Universal', 'Whole']) ? 'pl-1' : '' ; ?>">Insurance Policies:</label>
                        <label class="bb-1 w-100"><?php echo $acc['name']; ?></label>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <!-- Other Income Sources -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Income Sources</h2>
                </th>
            </tr>
            <?php
                                $debtorEmployer = $details['debtorEmployer'];
                        ?>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo !empty($debtorEmployer) ? 'checked' : '' ; ?>>
                    <label >Debtor Income Source(s):</label>
                    <label class="bb-1 w-100"></label>
                </td>
            </tr>
            <?php foreach ($debtorEmployer as $employer) { ?> 
                <tr>
                    <td colspan="4" class="pl-3">
                        <div class="pl-1">
                            <label class="bb-1 w-100"><?php echo $employer; ?></label>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <?php
                            $spouseEmployer = $details['spouseEmployer'];
                        ?>
            <tr>
                <td colspan="4">
                    <input type="checkbox" <?php echo !empty($spouseEmployer) ? 'checked' : '' ; ?>>
                    <label >Spouse Income Source(s):</label>
                </td>
            </tr>
            <?php foreach ($spouseEmployer as $employer) { ?> 
                <tr>
                    <td colspan="4" class="pl-3">
                        <div class="pl-1">
                            <label class="bb-1 w-100"><?php echo $employer; ?></label>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item ml-3">
                        <label class="pl-1"><?php echo $details['debtorLabel']; ?> Business Income:</label>
                        <label class="bb-1 w-100"><?php echo $details['debtorBussinessIncome']; ?> </label>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="4">
                    <div class="checkbox-item ml-3">
                        <label class="pl-1"><?php echo $details['spouseLabel']; ?> Business Income:</label>
                        <label class="bb-1 w-100"><?php echo $details['spouseBussinessIncome']; ?> </label>
                    </div>
                </td>
            </tr>

            <!-- Tax Information -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Tax Information</h2>
                </th>
            </tr>
            <?php
                            $lastYear = $details['lastYear'];
                        $yearBefore = $details['yearBefore'];
                        $taxesLastYear = $details['taxesLastYear'];
                        $taxesYearBefore = $details['taxesYearBefore'];
                        $w2LastYear = $details['w2LastYear'];
                        $w2YearBefore = $details['w2YearBefore'];
                        ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo $taxesYearBefore;?>>
                        <label class=""><?php echo $yearBefore; ?> Taxes (State/Federal) Filed?</label>
                        <label class="bb-1 w-100">(<?php echo !empty($taxesYearBefore) ? 'Filed' : 'Not Filed'; ?>)</label>
                        
                        <input type="checkbox" <?php echo $w2YearBefore;?>>
                        <label class="">W-2s/1099s for <?php echo $yearBefore; ?>?</label>
                        <label class="bb-1 w-100">(<?php echo !empty($w2YearBefore) ? 'Filed' : 'Not Filed'; ?>)</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo $taxesLastYear;?>>
                        <label class=""><?php echo $lastYear; ?> Taxes (State/Federal) Filed?</label>
                        <label class="bb-1 w-100">(<?php echo !empty($taxesLastYear) ? 'Filed' : 'Not Filed'; ?>)</label>

                        <input type="checkbox" <?php echo $w2LastYear;?>>
                        <label class="">W-2s/1099s for <?php echo $lastYear; ?>?</label>
                        <label class="bb-1 w-100">(<?php echo !empty($w2LastYear) ? 'Filed' : 'Not Filed'; ?>)</label>
                    </div>
                </td>
            </tr>

            <!-- Credit Counseling -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Credit Counseling</h2>
                </th>
            </tr>
            <?php

                        ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="">Completed Credit Counseling?</label>
                        <label class="bb-1 w-100">(Yes/No)</label>
                    </div>
                </td>
            </tr>

            <!-- Additional Documents Requested -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Additional Documents Requested</h2>
                </th>
            </tr>
            <?php
                            $attorneydocuments = $details['attorneydocuments'];
                        ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo !empty($attorneydocuments) ? 'checked' : ''; ?>>
                        <label class="">List any additional documents requested:</label>
                        <label class="bb-1 w-100"><?php if (!empty($attorneydocuments)) { ?>(<?php foreach ($attorneydocuments as $document) {
                            echo $document.'; ';
                        } ?>)<?php } ?></label>
                    </div>
                </td>
            </tr>

            <!-- Notes -->
            <tr>
                <th colspan="4">
                    <h2 class="section-title">Notes</h2>
                </th>
            </tr>
            <?php
                $notes = $details['notes'];
                        ?>
            <tr>
                <td colspan="4">
                    <div class="checkbox-item">
                        <input type="checkbox" <?php echo !empty($notes) ? 'checked' : ''; ?>>
                        <label class="">General notes and comments:</label>
                    </div>
                </td>
            </tr>
            <?php foreach ($notes as $note) { ?>
                <tr>
                    <td colspan="4">
                        <div class="checkbox-item ml-3 pl-1">
                            <label class="bb-1 w-100"><?php echo $note['note']?></label>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>