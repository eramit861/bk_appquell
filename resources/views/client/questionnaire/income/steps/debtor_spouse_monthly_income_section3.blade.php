<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <h2 class="text-dark fw-bold"></h2>
        <div class="row gx-3">
            <!--Debuts Income from operation of business: a. Gross Income - b. Expenses = c. Net Income -->
            <div class="col-12">
                <div class="label-div question-area JointOperationBusiness-radio-div">
                    <label>
                        Self Employment, Gig Work and or 1099 Income <br><span class="text-c-blue">(If you currently own a business,</span> have gig work <span class="text-c-blue">(Uber, Lyft, Door Dash Drivers etc.)</span> you would select yes)</span>
                        <!-- Have you received any income from operation of a business <span class="text-c-blue">Self
                            Employment</span>, <span class="text-c-blue">Gig Work</span> and or <span
                            class="text-c-blue">1099 Income</span> from any sources over the past 6 months? -->
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(If you currently own a business the Court requires you to fill out 6 month of Profit/Loss, even if your not making money each month) (Money earned from platforms such as Uber, Lyft, DoorDash, Upwork, or other gig-based services is considered self-employment income)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <!-- <p class="text-bold mb-0">
                            <span class="text-danger">Gig work is: Uber, Lyft, Door Dash Drivers etc.</span>
                        </p> -->
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_operation_business" id="joint_operation_business-no"
                            class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_operation_business', $debtorspousemonthlyincome, 0) }}>
                        <label for="joint_operation_business-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_operation_business', $debtorspousemonthlyincome, 0) }}"
                            onclick="GetJointOperationBusiness('no'); @if (!empty($isthereSpouseBusiness)) openFlagPopup('no-profit-loss-popup','',false,{{ $attorney_edit }}); @endif">No</label>

                        <input type="radio" name="joints_operation_business" id="joint_operation_business-yes"
                            class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_operation_business', $debtorspousemonthlyincome, 1) }}>
                        <label for="joint_operation_business-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_operation_business', $debtorspousemonthlyincome, 1) }}"
                            onclick="GetJointOperationBusiness('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_operation_business', $debtorspousemonthlyincome) }}"
                id="joint_operation_business">
                <div class="outline-gray-border-area">
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" :income_video="@$income_video"
                        :plIsImportedCodebtor="@$plIsImportedCodebtor" :income_profit_loss="$income_profit_loss"
                        :companyName="$companyName1" :attProfitLossMonths="$attProfitLossMonths"
                        class="joint_operation_business company_1 mt-2"
                        hideShowClass="{{!empty($companyName1) ? '' : 'hide-data'}}" additional="" businessIndex="1">
                    </x-questionnaire.income.operationBusinessSpouse>
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" income_video=""
                        plIsImportedCodebtor="" :income_profit_loss="$income_profit_loss_2" :companyName="$companyName2"
                        :attProfitLossMonths="$attProfitLossMonths" class="joint_operation_business company_2"
                        hideShowClass="{{!empty($companyName2) ? '' : 'hide-data'}}" additional="2" businessIndex="2">
                    </x-questionnaire.income.operationBusinessSpouse>
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" income_video=""
                        plIsImportedCodebtor="" :income_profit_loss="$income_profit_loss_3" :companyName="$companyName3"
                        :attProfitLossMonths="$attProfitLossMonths" class="joint_operation_business company_3"
                        hideShowClass="{{!empty($companyName3) ? '' : 'hide-data'}}" additional="3" businessIndex="3">
                    </x-questionnaire.income.operationBusinessSpouse>
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" income_video=""
                        plIsImportedCodebtor="" :income_profit_loss="$income_profit_loss_4" :companyName="$companyName4"
                        :attProfitLossMonths="$attProfitLossMonths" class="joint_operation_business company_4"
                        hideShowClass="{{!empty($companyName4) ? '' : 'hide-data'}}" additional="4" businessIndex="4">
                    </x-questionnaire.income.operationBusinessSpouse>
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" income_video=""
                        plIsImportedCodebtor="" :income_profit_loss="$income_profit_loss_5" :companyName="$companyName5"
                        :attProfitLossMonths="$attProfitLossMonths" class="joint_operation_business company_5"
                        hideShowClass="{{!empty($companyName5) ? '' : 'hide-data'}}" additional="5" businessIndex="5">
                    </x-questionnaire.income.operationBusinessSpouse>
                    <x-questionnaire.income.operationBusinessSpouse :webView="@$webView" income_video=""
                        plIsImportedCodebtor="" :income_profit_loss="$income_profit_loss_6" :companyName="$companyName6"
                        :attProfitLossMonths="$attProfitLossMonths" class="joint_operation_business company_6"
                        hideShowClass="{{!empty($companyName6) ? '' : 'hide-data'}}" additional="6" businessIndex="6">
                    </x-questionnaire.income.operationBusinessSpouse>

                    <div class="add-more-div-bottom">
                        <button type="button"
                            class="btn-new-ui-default py-1 px-2 {{ !empty($income_profit_loss) ? '' : 'mt-3' }}"
                            onclick="addAdditionalBusinessSectionJoint(); return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add Additional Company(s)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>