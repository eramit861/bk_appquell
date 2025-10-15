<div class="row g-3">
    <!-- User Credentials -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-primary text-white">User Credentials</div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="UserName" class="form-label">UserName</label>
                        <input type="text" class="form-control" id="UserName" name="clientNetWorthData[UserName]" value="<?php echo Helper::validate_key_value('UserName', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ReqUser" class="form-label">ReqUser</label>
                        <input type="text" class="form-control" id="ReqUser" name="clientNetWorthData[ReqUser]" value="<?php echo Helper::validate_key_value('ReqUser', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ReqPass" class="form-label">ReqPass</label>
                        <input type="password" class="form-control" id="ReqPass" name="clientNetWorthData[ReqPass]" value="<?php echo Helper::validate_key_value('ReqPass', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CourseID" class="form-label">CourseID</label>
                        <input type="text" class="form-control" id="CourseID" name="clientNetWorthData[CourseID]" value="<?php echo Helper::validate_key_value('CourseID', $clientIncomeExpenseData, 'radio'); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CourseStatus" class="form-label">CourseStatus</label>
                        <input type="text" class="form-control" id="CourseStatus" name="clientNetWorthData[CourseStatus]" value="<?php echo Helper::validate_key_value('CourseStatus', $clientIncomeExpenseData, 'radio'); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="AsOfDate" class="form-label">AsOfDate</label>
                        <input type="text" class="form-control" id="AsOfDate" name="clientNetWorthData[AsOfDate]" value="<?php echo Helper::validate_key_value('AsOfDate', $clientIncomeExpenseData, 'radio'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assets -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-success text-white">Assets</div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="Cash" class="form-label">Cash on Hand</label>
                        <input type="text" class="form-control" id="Cash" name="clientNetWorthData[Cash]" value="<?php echo Helper::validate_key_value('Cash', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Checking" class="form-label">Checking Account</label>
                        <input type="text" class="form-control" id="Checking" name="clientNetWorthData[Checking]" value="<?php echo Helper::validate_key_value('Checking', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Savings" class="form-label">Savings Account</label>
                        <input type="text" class="form-control" id="Savings" name="clientNetWorthData[Savings]" value="<?php echo Helper::validate_key_value('Savings', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MMktAcct" class="form-label">Money Market Account</label>
                        <input type="text" class="form-control" id="MMktAcct" name="clientNetWorthData[MMktAcct]" value="<?php echo Helper::validate_key_value('MMktAcct', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CertDep" class="form-label">Certificates of Deposit </label>
                        <input type="text" class="form-control" id="CertDep" name="clientNetWorthData[CertDep]" value="<?php echo Helper::validate_key_value('CertDep', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CSVLifeIns" class="form-label">Cash Value - Life Insurance</label>
                        <input type="text" class="form-control" id="CSVLifeIns" name="clientNetWorthData[CSVLifeIns]" value="<?php echo Helper::validate_key_value('CSVLifeIns', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ProfitShare" class="form-label">Profit Sharing Plan</label>
                        <input type="text" class="form-control" id="ProfitShare" name="clientNetWorthData[ProfitShare]" value="<?php echo Helper::validate_key_value('ProfitShare', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="IRAs" class="form-label">IRAs</label>
                        <input type="text" class="form-control" id="IRAs" name="clientNetWorthData[IRAs]" value="<?php echo Helper::validate_key_value('IRAs', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="R401k" class="form-label">401(k) Retirement Plan</label>
                        <input type="text" class="form-control" id="R401k" name="clientNetWorthData[R401k]" value="<?php echo Helper::validate_key_value('R401k', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="SEPIRA" class="form-label">SEP IRA</label>
                        <input type="text" class="form-control" id="SEPIRA" name="clientNetWorthData[SEPIRA]" value="<?php echo Helper::validate_key_value('SEPIRA', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Keogh" class="form-label">Keogh Plan</label>
                        <input type="text" class="form-control" id="Keogh" name="clientNetWorthData[Keogh]" value="<?php echo Helper::validate_key_value('Keogh', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MoneyOwed2U" class="form-label">Money Owed to You</label>
                        <input type="text" class="form-control" id="MoneyOwed2U" name="clientNetWorthData[MoneyOwed2U]" value="<?php echo Helper::validate_key_value('MoneyOwed2U', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Stocks" class="form-label">Stocks</label>
                        <input type="text" class="form-control" id="Stocks" name="clientNetWorthData[Stocks]" value="<?php echo Helper::validate_key_value('Stocks', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MutualFd" class="form-label">Mutual Funds</label>
                        <input type="text" class="form-control" id="MutualFd" name="clientNetWorthData[MutualFd]" value="<?php echo Helper::validate_key_value('MutualFd', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="REInvest" class="form-label">Real Estate Investments</label>
                        <input type="text" class="form-control" id="REInvest" name="clientNetWorthData[REInvest]" value="<?php echo Helper::validate_key_value('REInvest', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest1Name" class="form-label">Other Investment 1 - Name</label>
                        <input type="text" class="form-control" id="OtherInvest1Name" name="clientNetWorthData[OtherInvest1Name]" value="<?php echo Helper::validate_key_value('OtherInvest1Name', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest1Amt" class="form-label">Other Investment 1 - Amount</label>
                        <input type="text" class="form-control" id="OtherInvest1Amt" name="clientNetWorthData[OtherInvest1Amt]" value="<?php echo Helper::validate_key_value('OtherInvest1Amt', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest2Name" class="form-label">Other Investment 2 - Name</label>
                        <input type="text" class="form-control" id="OtherInvest2Name" name="clientNetWorthData[OtherInvest2Name]" value="<?php echo Helper::validate_key_value('OtherInvest2Name', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest2Amt" class="form-label">Other Investment 2 - Amount</label>
                        <input type="text" class="form-control" id="OtherInvest2Amt" name="clientNetWorthData[OtherInvest2Amt]" value="<?php echo Helper::validate_key_value('OtherInvest2Amt', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest3Name" class="form-label">Other Investment 3 - Name</label>
                        <input type="text" class="form-control" id="OtherInvest3Name" name="clientNetWorthData[OtherInvest3Name]" value="<?php echo Helper::validate_key_value('OtherInvest3Name', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherInvest3Amt" class="form-label">Other Investment 3 - Amount</label>
                        <input type="text" class="form-control" id="OtherInvest3Amt" name="clientNetWorthData[OtherInvest3Amt]" value="<?php echo Helper::validate_key_value('OtherInvest3Amt', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Home" class="form-label">Home</label>
                        <input type="text" class="form-control" id="Home" name="clientNetWorthData[Home]" value="<?php echo Helper::validate_key_value('Home', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="VacayProp" class="form-label">Vacation Property</label>
                        <input type="text" class="form-control" id="VacayProp" name="clientNetWorthData[VacayProp]" value="<?php echo Helper::validate_key_value('VacayProp', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Vehicles" class="form-label">Vehicles</label>
                        <input type="text" class="form-control" id="Vehicles" name="clientNetWorthData[Vehicles]" value="<?php echo Helper::validate_key_value('Vehicles', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Furn_Appl" class="form-label">Furniture & Appliances</label>
                        <input type="text" class="form-control" id="Furn_Appl" name="clientNetWorthData[Furn_Appl]" value="<?php echo Helper::validate_key_value('Furn_Appl', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Jewel_Fur" class="form-label">Jewelry & Furs</label>
                        <input type="text" class="form-control" id="Jewel_Fur" name="clientNetWorthData[Jewel_Fur]" value="<?php echo Helper::validate_key_value('Jewel_Fur', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="Art" class="form-label">Art & Collectibles</label>
                        <input type="text" class="form-control" id="Art" name="clientNetWorthData[Art]" value="<?php echo Helper::validate_key_value('Art', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MiscProp" class="form-label">Miscellaneous Property</label>
                        <input type="text" class="form-control" id="MiscProp" name="clientNetWorthData[MiscProp]" value="<?php echo Helper::validate_key_value('MiscProp', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherProp" class="form-label">Other Property</label>
                        <input type="text" class="form-control" id="OtherProp" name="clientNetWorthData[OtherProp]" value="<?php echo Helper::validate_key_value('OtherProp', $clientNetWorthData); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liabilities -->
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-header bg-danger text-white">Liabilities</div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="HomeMtg" class="form-label">Home Mortgage</label>
                        <input type="text" class="form-control" id="HomeMtg" name="clientNetWorthData[HomeMtg]" value="<?php echo Helper::validate_key_value('HomeMtg', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="VacayMtg" class="form-label">Vacation Property Mortgage</label>
                        <input type="text" class="form-control" id="VacayMtg" name="clientNetWorthData[VacayMtg]" value="<?php echo Helper::validate_key_value('VacayMtg', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="PersLoans" class="form-label">Personal Loans</label>
                        <input type="text" class="form-control" id="PersLoans" name="clientNetWorthData[PersLoans]" value="<?php echo Helper::validate_key_value('PersLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="VehicleLoans" class="form-label">Vehicle Loans</label>
                        <input type="text" class="form-control" id="VehicleLoans" name="clientNetWorthData[VehicleLoans]" value="<?php echo Helper::validate_key_value('VehicleLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="CreditCardBal" class="form-label">Credit Card Balances</label>
                        <input type="text" class="form-control" id="CreditCardBal" name="clientNetWorthData[CreditCardBal]" value="<?php echo Helper::validate_key_value('CreditCardBal', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="EducationLoans" class="form-label">Education Loans</label>
                        <input type="text" class="form-control" id="EducationLoans" name="clientNetWorthData[EducationLoans]" value="<?php echo Helper::validate_key_value('EducationLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="InvestLoans" class="form-label">Investment Loans</label>
                        <input type="text" class="form-control" id="InvestLoans" name="clientNetWorthData[InvestLoans]" value="<?php echo Helper::validate_key_value('InvestLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="LifeInsLoans" class="form-label">Life Insurance Loans</label>
                        <input type="text" class="form-control" id="LifeInsLoans" name="clientNetWorthData[LifeInsLoans]" value="<?php echo Helper::validate_key_value('LifeInsLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="OtherLiab" class="form-label">Other Liabilities</label>
                        <input type="text" class="form-control" id="OtherLiab" name="clientNetWorthData[OtherLiab]" value="<?php echo Helper::validate_key_value('OtherLiab', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MedBills" class="form-label">Medical Bills</label>
                        <input type="text" class="form-control" id="MedBills" name="clientNetWorthData[MedBills]" value="<?php echo Helper::validate_key_value('MedBills', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="PaydayLoans" class="form-label">Payday Loans</label>
                        <input type="text" class="form-control" id="PaydayLoans" name="clientNetWorthData[PaydayLoans]" value="<?php echo Helper::validate_key_value('PaydayLoans', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="BackTaxes" class="form-label">Back Taxes</label>
                        <input type="text" class="form-control" id="BackTaxes" name="clientNetWorthData[BackTaxes]" value="<?php echo Helper::validate_key_value('BackTaxes', $clientNetWorthData); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="MuniTickets" class="form-label">Municipal Tickets</label>
                        <input type="text" class="form-control" id="MuniTickets" name="clientNetWorthData[MuniTickets]" value="<?php echo Helper::validate_key_value('MuniTickets', $clientNetWorthData); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>