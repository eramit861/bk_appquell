<div class="row g-3">
  <!-- User Information Section -->
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header bg-primary text-white">
        User Information
      </div>
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-md-2 mb-3">
            <label for="UserName" class="form-label">UserName</label>
            <input type="text" class="form-control required" id="UserName" name="clientIncomeExpenseData[UserName]" value="<?php echo Helper::validate_key_value('UserName', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-md-2 mb-3">
            <label for="ReqUser" class="form-label">ReqUser</label>
            <input type="text" class="form-control" id="ReqUser" name="clientIncomeExpenseData[ReqUser]" value="<?php echo Helper::validate_key_value('ReqUser', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-md-2 mb-3">
            <label for="ReqPass" class="form-label">ReqPass</label>
            <input type="password" class="form-control" id="ReqPass" name="clientIncomeExpenseData[ReqPass]" value="<?php echo Helper::validate_key_value('ReqPass', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-md-2 mb-3">
            <label for="CourseID" class="form-label">CourseID</label>
            <input type="text" class="form-control" id="CourseID" name="clientIncomeExpenseData[CourseID]" value="<?php echo Helper::validate_key_value('CourseID', $clientIncomeExpenseData, 'radio'); ?>">
          </div>
          <div class="col-md-2 mb-3">
            <label for="CourseStatus" class="form-label">CourseStatus</label>
            <input type="text" class="form-control" id="CourseStatus" name="clientIncomeExpenseData[CourseStatus]" value="<?php echo Helper::validate_key_value('CourseStatus', $clientIncomeExpenseData, 'radio'); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Income Section -->
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header bg-primary text-white">
        Income
      </div>
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-2 mb-3">
            <label for="Wages" class="form-label">Wages / Salary</label>
            <input type="text" class="form-control" id="Wages" name="clientIncomeExpenseData[Wages]" value="<?php echo Helper::validate_key_value('Wages', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="InterestDivs" class="form-label">Interest & Dividends</label>
            <input type="text" class="form-control" id="InterestDivs" name="clientIncomeExpenseData[InterestDivs]" value="<?php echo Helper::validate_key_value('InterestDivs', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="InvestInc" class="form-label">Investment Income</label>
            <input type="text" class="form-control" id="InvestInc" name="clientIncomeExpenseData[InvestInc]" value="<?php echo Helper::validate_key_value('InvestInc', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="SocSecInc" class="form-label">Social Security Income</label>
            <input type="text" class="form-control" id="SocSecInc" name="clientIncomeExpenseData[SocSecInc]" value="<?php echo Helper::validate_key_value('SocSecInc', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="RetirePlan" class="form-label">Retirement Plan Income</label>
            <input type="text" class="form-control" id="RetirePlan" name="clientIncomeExpenseData[RetirePlan]" value="<?php echo Helper::validate_key_value('RetirePlan', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="UnemployComp" class="form-label">Unemployment Compensation</label>
            <input type="text" class="form-control" id="UnemployComp" name="clientIncomeExpenseData[UnemployComp]" value="<?php echo Helper::validate_key_value('UnemployComp', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc1Name" class="form-label">Other Income Source 1 (Name)</label>
            <input type="text" class="form-control" id="OtherInc1Name" name="clientIncomeExpenseData[OtherInc1Name]" value="<?php echo Helper::validate_key_value('OtherInc1Name', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc1Amt" class="form-label">Other Income Source 1 (Amount)</label>
            <input type="text" class="form-control" id="OtherInc1Amt" name="clientIncomeExpenseData[OtherInc1Amt]" value="<?php echo Helper::validate_key_value('OtherInc1Amt', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc2Name" class="form-label">Other Income Source 2 (Name)</label>
            <input type="text" class="form-control" id="OtherInc2Name" name="clientIncomeExpenseData[OtherInc2Name]" value="<?php echo Helper::validate_key_value('OtherInc2Name', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc2Amt" class="form-label">Other Income Source 2 (Amount)</label>
            <input type="text" class="form-control" id="OtherInc2Amt" name="clientIncomeExpenseData[OtherInc2Amt]" value="<?php echo Helper::validate_key_value('OtherInc2Amt', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc3Name" class="form-label">Other Income Source 3 (Name)</label>
            <input type="text" class="form-control" id="OtherInc3Name" name="clientIncomeExpenseData[OtherInc3Name]" value="<?php echo Helper::validate_key_value('OtherInc3Name', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OtherInc3Amt" class="form-label">Other Income Source 3 (Amount)</label>
            <input type="text" class="form-control" id="OtherInc3Amt" name="clientIncomeExpenseData[OtherInc3Amt]" value="<?php echo Helper::validate_key_value('OtherInc3Amt', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Inc_ChildSupport" class="form-label">Child Support Received</label>
            <input type="text" class="form-control" id="Inc_ChildSupport" name="clientIncomeExpenseData[Inc_ChildSupport]" value="<?php echo Helper::validate_key_value('Inc_ChildSupport', $clientIncomeExpenseData); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Expenses Section (Sample: Housing, Utilities, Food, Internet) -->
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header bg-primary text-white">
        Basic Expenses
      </div>
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-2 mb-3">
            <label for="Mtg_Rent" class="form-label">Mortgage / Rent</label>
            <input type="text" class="form-control" id="Mtg_Rent" name="clientIncomeExpenseData[Mtg_Rent]" value="<?php echo Helper::validate_key_value('Mtg_Rent', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="PropTax" class="form-label">Property Taxes</label>
            <input type="text" class="form-control" id="PropTax" name="clientIncomeExpenseData[PropTax]" value="<?php echo Helper::validate_key_value('PropTax', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Home_RentIns" class="form-label">Home/Renter’s Insurance</label>
            <input type="text" class="form-control" id="Home_RentIns" name="clientIncomeExpenseData[Home_RentIns]" value="<?php echo Helper::validate_key_value('Home_RentIns', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="UtilElectric" class="form-label">Electricity</label>
            <input type="text" class="form-control" id="UtilElectric" name="clientIncomeExpenseData[UtilElectric]" value="<?php echo Helper::validate_key_value('UtilElectric', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="UtilGas" class="form-label">Gas</label>
            <input type="text" class="form-control" id="UtilGas" name="clientIncomeExpenseData[UtilGas]" value="<?php echo Helper::validate_key_value('UtilGas', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="Phone" name="clientIncomeExpenseData[Phone]" value="<?php echo Helper::validate_key_value('Phone', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Water" class="form-label">Water</label>
            <input type="text" class="form-control" id="Water" name="clientIncomeExpenseData[Water]" value="<?php echo Helper::validate_key_value('Water', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Garbage" class="form-label">Garbage</label>
            <input type="text" class="form-control" id="Garbage" name="clientIncomeExpenseData[Garbage]" value="<?php echo Helper::validate_key_value('Garbage', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Furnishings" class="form-label">Home Furnishings</label>
            <input type="text" class="form-control" id="Furnishings" name="clientIncomeExpenseData[Furnishings]" value="<?php echo Helper::validate_key_value('Furnishings', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="HomeSecurity" class="form-label">Home Security</label>
            <input type="text" class="form-control" id="HomeSecurity" name="clientIncomeExpenseData[HomeSecurity]" value="<?php echo Helper::validate_key_value('HomeSecurity', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="VehiclePymts" class="form-label">Vehicle Payments</label>
            <input type="text" class="form-control" id="VehiclePymts" name="clientIncomeExpenseData[VehiclePymts]" value="<?php echo Helper::validate_key_value('VehiclePymts', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="AutoInsur_Reg" class="form-label">Auto Insurance & Registration</label>
            <input type="text" class="form-control" id="AutoInsur_Reg" name="clientIncomeExpenseData[AutoInsur_Reg]" value="<?php echo Helper::validate_key_value('AutoInsur_Reg', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Fuel" class="form-label">Fuel</label>
            <input type="text" class="form-control" id="Fuel" name="clientIncomeExpenseData[Fuel]" value="<?php echo Helper::validate_key_value('Fuel', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="VehMaint" class="form-label">Vehicle Maintenance</label>
            <input type="text" class="form-control" id="VehMaint" name="clientIncomeExpenseData[VehMaint]" value="<?php echo Helper::validate_key_value('VehMaint', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="PublicTrans" class="form-label">Public Transportation</label>
            <input type="text" class="form-control" id="PublicTrans" name="clientIncomeExpenseData[PublicTrans]" value="<?php echo Helper::validate_key_value('PublicTrans', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Tolls" class="form-label">Tolls & Parking</label>
            <input type="text" class="form-control" id="Tolls" name="clientIncomeExpenseData[Tolls]" value="<?php echo Helper::validate_key_value('Tolls', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Groceries" class="form-label">Groceries</label>
            <input type="text" class="form-control" id="Groceries" name="clientIncomeExpenseData[Groceries]" value="<?php echo Helper::validate_key_value('Groceries', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OutsideMeals" class="form-label">Dining Out</label>
            <input type="text" class="form-control" id="OutsideMeals" name="clientIncomeExpenseData[OutsideMeals]" value="<?php echo Helper::validate_key_value('OutsideMeals', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Snacks" class="form-label">Snacks / Beverages</label>
            <input type="text" class="form-control" id="Snacks" name="clientIncomeExpenseData[Snacks]" value="<?php echo Helper::validate_key_value('Snacks', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Other" class="form-label">Other</label>
            <input type="text" class="form-control" id="Other" name="clientIncomeExpenseData[Other]" value="<?php echo Helper::validate_key_value('Other', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Clothes" class="form-label">Clothing</label>
            <input type="text" class="form-control" id="Clothes" name="clientIncomeExpenseData[Clothes]" value="<?php echo Helper::validate_key_value('Clothes', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Medical_Dental" class="form-label">Medical / Dental</label>
            <input type="text" class="form-control" id="Medical_Dental" name="clientIncomeExpenseData[Medical_Dental]" value="<?php echo Helper::validate_key_value('Medical_Dental', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="HairCare" class="form-label">Hair Care</label>
            <input type="text" class="form-control" id="HairCare" name="clientIncomeExpenseData[HairCare]" value="<?php echo Helper::validate_key_value('HairCare', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Toiletries" class="form-label">Toiletries</label>
            <input type="text" class="form-control" id="Toiletries" name="clientIncomeExpenseData[Toiletries]" value="<?php echo Helper::validate_key_value('Toiletries', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Hobbies" class="form-label">Hobbies</label>
            <input type="text" class="form-control" id="Hobbies" name="clientIncomeExpenseData[Hobbies]" value="<?php echo Helper::validate_key_value('Hobbies', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Vacation" class="form-label">Vacation</label>
            <input type="text" class="form-control" id="Vacation" name="clientIncomeExpenseData[Vacation]" value="<?php echo Helper::validate_key_value('Vacation', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Entertainment" class="form-label">Entertainment</label>
            <input type="text" class="form-control" id="Entertainment" name="clientIncomeExpenseData[Entertainment]" value="<?php echo Helper::validate_key_value('Entertainment', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="News_Mags" class="form-label">Newspapers & Magazines</label>
            <input type="text" class="form-control" id="News_Mags" name="clientIncomeExpenseData[News_Mags]" value="<?php echo Helper::validate_key_value('News_Mags', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="PhysFit" class="form-label">Physical Fitness</label>
            <input type="text" class="form-control" id="PhysFit" name="clientIncomeExpenseData[PhysFit]" value="<?php echo Helper::validate_key_value('PhysFit', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Cable_Stream" class="form-label">Cable & Streaming Services</label>
            <input type="text" class="form-control" id="Cable_Stream" name="clientIncomeExpenseData[Cable_Stream]" value="<?php echo Helper::validate_key_value('Cable_Stream', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Internet" class="form-label">Internet Service</label>
            <input type="text" class="form-control" id="Internet" name="clientIncomeExpenseData[Internet]" value="<?php echo Helper::validate_key_value('Internet', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="ProfServ" class="form-label">Professional Services</label>
            <input type="text" class="form-control" id="ProfServ" name="clientIncomeExpenseData[ProfServ]" value="<?php echo Helper::validate_key_value('ProfServ', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="BankFees" class="form-label">Bank Fees</label>
            <input type="text" class="form-control" id="BankFees" name="clientIncomeExpenseData[BankFees]" value="<?php echo Helper::validate_key_value('BankFees', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="WholeLife" class="form-label">Whole Life Insurance</label>
            <input type="text" class="form-control" id="WholeLife" name="clientIncomeExpenseData[WholeLife]" value="<?php echo Helper::validate_key_value('WholeLife', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="TermLife" class="form-label">Term Life Insurance</label>
            <input type="text" class="form-control" id="TermLife" name="clientIncomeExpenseData[TermLife]" value="<?php echo Helper::validate_key_value('TermLife', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OOP_HealthIns" class="form-label">Out-of-Pocket Health Insurance Costs</label>
            <input type="text" class="form-control" id="OOP_HealthIns" name="clientIncomeExpenseData[OOP_HealthIns]" value="<?php echo Helper::validate_key_value('OOP_HealthIns', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="DisabilityIns" class="form-label">Disability Insurance</label>
            <input type="text" class="form-control" id="DisabilityIns" name="clientIncomeExpenseData[DisabilityIns]" value="<?php echo Helper::validate_key_value('DisabilityIns', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OthInsurance" class="form-label">Other Insurance</label>
            <input type="text" class="form-control" id="OthInsurance" name="clientIncomeExpenseData[OthInsurance]" value="<?php echo Helper::validate_key_value('OthInsurance', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="ChildCare" class="form-label">Child Care</label>
            <input type="text" class="form-control" id="ChildCare" name="clientIncomeExpenseData[ChildCare]" value="<?php echo Helper::validate_key_value('ChildCare', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Tuition" class="form-label">Tuition / School Fees</label>
            <input type="text" class="form-control" id="Tuition" name="clientIncomeExpenseData[Tuition]" value="<?php echo Helper::validate_key_value('Tuition', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Allowances" class="form-label">Personal Allowances</label>
            <input type="text" class="form-control" id="Allowances" name="clientIncomeExpenseData[Allowances]" value="<?php echo Helper::validate_key_value('Allowances', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="OOP_HealthSavings" class="form-label">Out-of-Pocket Health Savings</label>
            <input type="text" class="form-control" id="OOP_HealthSavings" name="clientIncomeExpenseData[OOP_HealthSavings]" value="<?php echo Helper::validate_key_value('OOP_HealthSavings', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Mand_PayrollDeducts" class="form-label">Mandatory Payroll Deductions</label>
            <input type="text" class="form-control" id="Mand_PayrollDeducts" name="clientIncomeExpenseData[Mand_PayrollDeducts]" value="<?php echo Helper::validate_key_value('Mand_PayrollDeducts', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="CCPymts" class="form-label">Credit Card Payments</label>
            <input type="text" class="form-control" id="CCPymts" name="clientIncomeExpenseData[CCPymts]" value="<?php echo Helper::validate_key_value('CCPymts', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Investments" class="form-label">Investment Contributions</label>
            <input type="text" class="form-control" id="Investments" name="clientIncomeExpenseData[Investments]" value="<?php echo Helper::validate_key_value('Investments', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Retirement" class="form-label">Retirement Contributions</label>
            <input type="text" class="form-control" id="Retirement" name="clientIncomeExpenseData[Retirement]" value="<?php echo Helper::validate_key_value('Retirement', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Payroll_MedIns" class="form-label">Medical Insurance</label>
            <input type="text" class="form-control" id="Payroll_MedIns" name="clientIncomeExpenseData[Payroll_MedIns]" value="<?php echo Helper::validate_key_value('Payroll_MedIns', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="UnionDues" class="form-label">Union Dues</label>
            <input type="text" class="form-control" id="UnionDues" name="clientIncomeExpenseData[UnionDues]" value="<?php echo Helper::validate_key_value('UnionDues', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Exp_ChildSupport" class="form-label">Child Support Payments</label>
            <input type="text" class="form-control" id="Exp_ChildSupport" name="clientIncomeExpenseData[Exp_ChildSupport]" value="<?php echo Helper::validate_key_value('Exp_ChildSupport', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="StudentLoans" class="form-label">Student Loan Payments</label>
            <input type="text" class="form-control" id="StudentLoans" name="clientIncomeExpenseData[StudentLoans]" value="<?php echo Helper::validate_key_value('StudentLoans', $clientIncomeExpenseData); ?>">
          </div>          
          <div class="col-2 mb-3">
            <label for="FoodAssist" class="form-label">Food Assistance</label>
            <input type="text" class="form-control" id="FoodAssist" name="clientIncomeExpenseData[FoodAssist]" value="<?php echo Helper::validate_key_value('FoodAssist', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="CharitableCont" class="form-label">Charitable Contributions</label>
            <input type="text" class="form-control" id="CharitableCont" name="clientIncomeExpenseData[CharitableCont]" value="<?php echo Helper::validate_key_value('CharitableCont', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Savings" class="form-label">Savings Contributions</label>
            <input type="text" class="form-control" id="Savings" name="clientIncomeExpenseData[Savings]" value="<?php echo Helper::validate_key_value('Savings', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="Gifts" class="form-label">Gifts Given</label>
            <input type="text" class="form-control" id="Gifts" name="clientIncomeExpenseData[Gifts]" value="<?php echo Helper::validate_key_value('Gifts', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="FederalTax" class="form-label">Federal Taxes Paid</label>
            <input type="text" class="form-control" id="FederalTax" name="clientIncomeExpenseData[FederalTax]" value="<?php echo Helper::validate_key_value('FederalTax', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="StateTax" class="form-label">State Taxes Paid</label>
            <input type="text" class="form-control" id="StateTax" name="clientIncomeExpenseData[StateTax]" value="<?php echo Helper::validate_key_value('StateTax', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="LocalTax" class="form-label">Local Taxes Paid</label>
            <input type="text" class="form-control" id="LocalTax" name="clientIncomeExpenseData[LocalTax]" value="<?php echo Helper::validate_key_value('LocalTax', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="SalesTax" class="form-label">Sales Taxes Paid</label>
            <input type="text" class="form-control" id="SalesTax" name="clientIncomeExpenseData[SalesTax]" value="<?php echo Helper::validate_key_value('SalesTax', $clientIncomeExpenseData); ?>">
          </div>
          <div class="col-2 mb-3">
            <label for="SSMedDeduct" class="form-label">Social Security & Medicare Deductions</label>
            <input type="text" class="form-control" id="SSMedDeduct" name="clientIncomeExpenseData[SSMedDeduct]" value="<?php echo Helper::validate_key_value('SSMedDeduct', $clientIncomeExpenseData); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>