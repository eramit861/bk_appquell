/**
 * Tab 2 - Step 4: Financial Assets
 * Bank accounts, retirement, tax refunds, VPC accounts, etc.
 */

// ==================== INITIALIZATION ====================

/**
 * Initialize Property Step 4 - Auto-click radio buttons if no data
 */
function initializePropertyStep4() {
    var pstatus = (window.tab2Data && window.tab2Data.financialAssetsStatus) ? window.tab2Data.financialAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-d input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

/**
 * Initialize Property Step 4 Continue
 */
function initializePropertyStep4Continue() {
    var pstatus = (window.tab2Data && window.tab2Data.financialAssetsStatus) ? window.tab2Data.financialAssetsStatus : 0;
    if (pstatus == 0) {
        $("#property-part-d input:radio").each(function () {
            if (($(this).val() == 0 || $(this).val() == 1) && !($(this).hasClass('property_owned_by'))) {
                $(this).trigger('click');
            }
        });
    }
}

// ==================== BUSINESS ACCOUNT FUNCTIONS ====================

/**
 * Show/hide business name div based on account type
 */
function showHideBusinessNameDiv(element, index) {
    const targetDiv = $('.bank_business_name_div_' + index);
    const selectedValue = $(element).val();
    if (selectedValue === "1") {
        targetDiv.addClass('hide-data');
    } else {
        targetDiv.removeClass('hide-data');
    }
};

function setBusinessValue(value) {
    if (value == 2) {
        hasValueTwo = true;
    }
};

function handleS4ContinueSubmit(hasAnyBusiness, event) {
    event.preventDefault();
    let hasValueTwo = false;
    if (hasAnyBusiness) {
        $('.bank_personal_business_account').each(function () {
            if ($(this).val() == 2) {
                hasValueTwo = true;
                return false;
            }
        });

        if (!hasValueTwo) {
            $('html, body').animate({
                scrollTop: $('#checking_account_items_data_question').offset().top
            }, 500);
            openFlagPopup2('hasAnyBusiness-popup', 'No', true);
        } else {
            $('#client_property_step4_continue').submit();
        }
    } else {
        $('#client_property_step4_continue').submit();
    }
};

// ==================== RETIREMENT ACCOUNT FUNCTIONS ====================

/**
 * Check unknown retirement checkbox
 */
function checkUnknownRetirement(thisobj, index) {
    if (thisobj.checked == true) {
        $('.retirement_pension_property_value_is_unknown_' + index).removeClass('required');
        $('.retirement_pension_property_value_is_unknown_' + index).prop('disabled', true);
        $('.retirement_pension_property_value_is_unknown_' + index).val('');
    } else {
        $('.retirement_pension_property_value_is_unknown_' + index).addClass('required');
        $('.retirement_pension_property_value_is_unknown_' + index).prop('disabled', false);
        $('.retirement_pension_property_value_is_unknown_' + index).val('');
    }
};

// ==================== TAX REFUND FUNCTIONS ====================

/**
 * Select all / deselect all years
 */
function setSelectAll(thisObj, index) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');
    if ($(thisObj).is(':checked')) {
        $('.option').prop('checked', true);
        $(".select-text-" + index).html('Deselect');
    } else {
        $('.option').prop('checked', false);
        $(".select-text-" + index).html('Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

/**
 * Handle individual year selection
 */
function setJustOne(thisObj, index) {
    var inputName = $(thisObj).data('inputname');
    var inputFor = $(thisObj).data('inputfor');
    var a = $("input[type='checkbox'].justone");
    if (a.length == a.filter(":checked").length) {
        $('.selectall').prop('checked', true);
        $(".select-text-" + index).html(' Deselect');
    } else {
        $('.selectall').prop('checked', false);
        $(".select-text-" + index).html(' Select');
    }
    setSpaceSeperatedString(inputName, inputFor);
};

/**
 * Set space-separated string of selected years
 */
function setSpaceSeperatedString(inputName, inputFor) {
    var checkedYears = [];
    $("input[type='checkbox'].justone." + inputFor + ":checked").each(function () {
        checkedYears.push($(this).val());
    });
    checkedYears.sort((a, b) => b - a);
    var spaceSeparatedString = checkedYears.join(" ");
    $("input[name='" + inputName + "']").val(spaceSeparatedString);
};

/**
 * Select tax refund type - prevent duplicates
 */
function selectTaxRefundType(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var type = $('#tax_refunds_MainRow .tax_refunds_description');
    var isDuplicate = false;

    $(type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    }
};

// ==================== VPC ACCOUNT FUNCTIONS ====================

/**
 * Select VPC account type - prevent duplicates
 */
function selectVPCAccount(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var account_type = $('#account_items_data .account_type');
    var isDuplicate = false;

    $(account_type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    } else {
        var index = $(thisObj).data('index');
        showHideGuideVidDiv(index, selectedValue);
    }
};

/**
 * Show/hide guide video div based on account type
 */
function showHideGuideVidDiv(index, selectedValue) {
    var paypal = ["paypal_account_1", "paypal_account_2", "paypal_account_3"];
    var cash = ["cash_account_1", "cash_account_2", "cash_account_3"];
    var venmo = ["venmo_account_1", "venmo_account_2", "venmo_account_3"];
    if (paypal.includes(selectedValue)) {
        $(".paypalVideo-" + index).removeClass("hide-data");
        $(".cashVideo-" + index).addClass("hide-data");
        $(".venmoVideo-" + index).addClass("hide-data");
    }
    if (cash.includes(selectedValue)) {
        $(".cashVideo-" + index).removeClass("hide-data");
        $(".paypalVideo-" + index).addClass("hide-data");
        $(".venmoVideo-" + index).addClass("hide-data");
    }
    if (venmo.includes(selectedValue)) {
        $(".venmoVideo-" + index).removeClass("hide-data");
        $(".paypalVideo-" + index).addClass("hide-data");
        $(".cashVideo-" + index).addClass("hide-data");
    }
}   

/**
 * Select VPC alimony account - prevent duplicates
 */
function selectVPCAAlimonyccount(thisObj) {
    var selectedValue = $(thisObj).find(":selected").val();
    var selectedValueText = $(thisObj).find(":selected").text();
    var account_type = $('#alimony_child_data .account_type');
    var isDuplicate = false;

    $(account_type).each(function () {
        if (this !== thisObj && $(this).find(":selected").val() === selectedValue) {
            isDuplicate = true;
            return false;
        }
    });

    if (isDuplicate) {
        var previousValue = $(thisObj).data('previousvalue');
        $(thisObj).val(previousValue);
        $(thisObj).change();
    }
};

// ==================== FINANCIAL ASSET TOGGLE FUNCTIONS ====================

function getCashItems(value) {
    if (value == "yes") {
        document
            .getElementById("cash_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("cash_items_data").classList.add("hide-data");
    }
}

function getCheckingAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("checking_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("checking_account_items_data")
            .classList.add("hide-data");
    }
}

function getAccountItems(value) {
    if (value == "yes") {
        if (
            $(".cashVideo-0").hasClass("hide-data") &&
            $(".paypalVideo-0").hasClass("hide-data") &&
            $(".venmoVideo-0").hasClass("hide-data")
        ) {
            $(".paypalVideo-0").removeClass("hide-data");
        }
        $("#account_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#account_items_data").addClass("hide-data");
    }
}

function getBrokerageItems(value) {
    if (value == "yes") {
        $("#brokerage_items_data").removeClass("hide-data");
    } else if (value == "no") {
        $("#brokerage_items_data").addClass("hide-data");
    }
}

function getSavingsAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("savings_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("savings_account_items_data")
            .classList.add("hide-data");
    }
}

function getCertificateDepositeItems(value) {
    if (value == "yes") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("certificate_of_deposit_items_data")
            .classList.add("hide-data");
    }
}

function getOtherFinacialAccountItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("other_financial_account_items_data")
            .classList.add("hide-data");
    }
}

function getMutualFundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("bonds_mutual_funds_items_data")
            .classList.add("hide-data");
    }
}

function getGovernmentCoperateItems(value) {
    if (value == "yes") {
        document
            .getElementById("government_corporate_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("government_corporate_data")
            .classList.add("hide-data");
    }
}

function getRetirementPensionItems(value) {
    if (value == "yes") {
        document
            .getElementById("retirement_pension_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("retirement_pension_data")
            .classList.add("hide-data");
    }
}

function getPrepaymentsItems(value) {
    if (value == "yes") {
        document
            .getElementById("prepayments_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("prepayments_data").classList.add("hide-data");
    }
}

function getAnnuitiesItems(value) {
    if (value == "yes") {
        document.getElementById("annuities_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("annuities_data").classList.add("hide-data");
    }
}

function getEducationIRAItems(value) {
    if (value == "yes") {
        document
            .getElementById("education_IRA_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("education_IRA_data")
            .classList.add("hide-data");
    }
}

function getInterestPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("interestin_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("interestin_property_data")
            .classList.add("hide-data");
    }
}

function getintellectualPropertyItems(value) {
    if (value == "yes") {
        document
            .getElementById("intellectual_property_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("intellectual_property_data")
            .classList.add("hide-data");
    }
}

function getGeneralIntangiblesItems(value) {
    if (value == "yes") {
        document
            .getElementById("genral_intangibles_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("genral_intangibles_data")
            .classList.add("hide-data");
    }
}

function getTaxRefundsItems(value) {
    if (value == "yes") {
        document
            .getElementById("tax_refunds_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("tax_refunds_data").classList.add("hide-data");
    }
}

function getAlimonyChildItems(value) {
    if (value == "yes") {
        document
            .getElementById("alimony_child_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("alimony_child_data")
            .classList.add("hide-data");
    }
}

function getUnpaidWagesItems(value) {
    if (value == "yes") {
        document
            .getElementById("unpaid_wages_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("unpaid_wages_data").classList.add("hide-data");
    }
}

function getLifeInsuranceItems(value) {
    if (value == "yes") {
        document
            .getElementById("life_insurance_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("life_insurance_data")
            .classList.add("hide-data");
    }
}

function getInsurancePoliciesItems(value) {
    if (value == "yes") {
        document
            .getElementById("insurance_policies_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("insurance_policies_data")
            .classList.add("hide-data");
    }
}

function getInheritancesBenefitsItems(value) {
    if (value == "yes") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("Inheritances_benefits_data")
            .classList.add("hide-data");
    }
}

function getPersonalInjuryItems(value) {
    if (value == "yes") {
        document
            .getElementById("personal_injury_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("personal_injury_data")
            .classList.add("hide-data");
    }
}

function getLawsuitsItems(value) {
    if (value == "yes") {
        document.getElementById("Lawsuits_data").classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("Lawsuits_data").classList.add("hide-data");
    }
}

function getOtherClaimsItems(value) {
    if (value == "yes") {
        document
            .getElementById("other_claims_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document.getElementById("other_claims_data").classList.add("hide-data");
    }
}

function getFinancialAssetItems(value) {
    if (value == "yes") {
        document
            .getElementById("financial_asset_data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("financial_asset_data")
            .classList.add("hide-data");
    }
}

function showHideTransactionSection(value, index) {
    let transactionDiv = $(document).find(`.transaction-div-${index}`);
    let transactionAddMoreDiv = $(document).find(`.add-more-transaction-btn-${index}`);

    if (value == '1') {
        transactionDiv.removeClass("hide-data");
        transactionAddMoreDiv.removeClass("hide-data");        
    } else {
        transactionDiv.addClass("hide-data");    
        transactionAddMoreDiv.addClass("hide-data");  
    }
}

async function bank_addmore(transaction_pdf_enabled) {
    var clnln = $(document).find(".bank_accounts").length;
    const status = await seperate_save('bank','bank_accounts', 'checking_account_items_data', 'parent_bank', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 17) {
            alert("You can add only 18 entries.");
            return false;
        } else {
            var itm = $(document).find(".bank_accounts").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            itm.attr("rowNo", $rowNo);
            var index_val = clnln;
            var cln = $(itm).clone();
            cln.find(".bank_description").val("");
            cln.find(".bank_property_value").val("");

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/bank_accounts_\d+/g) || []).join(' ');
            }).addClass("bank_accounts_" + index_val);

            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('bank_accounts', " + index_val + ")");

            // Update input fields with the correct name attributes
            cln.find(".circle-number-div").html(index_val + 1);
             
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('bank','bank_accounts', 'checking_account_items_data', 'parent_bank', " + index_val + ")");


            cln.find("label").removeClass("active");
            let transaction_enabled = $("#bank-addmore-button").attr('data-transaction-enabled');
            var bank_description = cln.find(".bank_description");
            var bank_property_account = cln.find(".bank_property_account");
            var bank_business_name = cln.find(".bank_business_name");
            var bank_business_name_div = cln.find(".bank_business_name_div");
            var bank_personal_business_account = cln.find(".bank_personal_business_account");
            var last_4_digits = cln.find(".last_4_digits");
            var bank_property_value = cln.find(".bank_property_value");

            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            $(bank_description).each(function () {
                $(this).attr("name", "bank[data][description][" + index_val + "]");
            });
            $(last_4_digits).each(function () {
                $(this).attr(
                    "name",
                    "bank[data][last_4_digits][" + index_val + "]"
                );
            });

            $(bank_property_account).each(function () {
                $(this).attr("name", "bank[data][account_type][" + index_val + "]");
            });
            $(bank_personal_business_account).each(function () {
                $(this).attr("name", "bank[data][personal_business_account][" + index_val + "]");
                
                if ($(this).is("[onchange]")) {
                    $(this).attr("onchange", "showHideBusinessNameDiv(this, " + index_val + ")");
                }

            });
            var prev_index = index_val - 1;
            $(bank_business_name_div).each(function () {
                if ($(this).hasClass("bank_business_name_div_" + prev_index)) {
                    $(this)
                        .removeClass("bank_business_name_div_" + prev_index)
                        .addClass("bank_business_name_div_" + index_val);
                }
                if ($(this).hasClass("hide-data")) {
                    $(this).removeClass("hide-data");
                }
            });
            $(bank_business_name).each(function () {
                $(this).attr("name", "bank[data][business_name][" + index_val + "]");
            });
            $(bank_property_value).each(function () {
                $(this).attr(
                    "name",
                    "bank[data][property_value][" + index_val + "]"
                );
            });

            var transaction_radio               = cln.find(".transaction-radio");
            var transaction_div                 = cln.find(".transaction-div");
            var transaction_description         = cln.find(".transaction-description");
            var transaction_sample              = cln.find(".transaction-sample");
            var transaction_value               = cln.find(".transaction-value");
            var transaction_btn_div             = cln.find(".add-more-transaction-btn");
            var transaction_add                 = cln.find(".transaction-add");
            var transaction_radio_yes           = cln.find(".transaction-radio-yes");
            var transaction_radio_no            = cln.find(".transaction-radio-no");
            
            

            $(transaction_radio).each(function () {            
                $(this).prop("checked", false);
                $(this).attr( "name", "bank[data][transaction][" + index_val + "]" );

                if ($(this).val() == "1") {
                    $(this).attr("id", "transaction_" + index_val + "_yes");
                        $(transaction_radio_yes).next('label').attr( "for", "transaction_" + index_val + "_yes" );
                    if(transaction_enabled == 1){
                        $(transaction_radio_yes).next('label').attr( "onclick", "showHideTransactionSection(1, " + index_val + "); setTimeout(() => checkBankAccInputs(), 10)" );
                    }else{
                        $(transaction_radio_yes).next('label').attr( "onclick", "showHideTransactionSection(1, " + index_val + "); " );
                    }
                }
                if ($(this).val() == "0") {
                    $(this).attr("id", "transaction_" + index_val + "_no");
                    $(transaction_radio_no).next('label').attr( "for", "transaction_" + index_val + "_no" );
                    if(transaction_enabled == 1){
                        $(transaction_radio_no).next('label').attr( "onclick", "showHideTransactionSection(0, " + index_val + "); setTimeout(() => checkBankAccInputs(), 10)" );
                    }else{
                        $(transaction_radio_no).next('label').attr( "onclick", "showHideTransactionSection(0, " + index_val + "); " );
                    }
                }
            });

            transaction_div.each(function(index) {
                if (index > 0) {
                    $(this).remove();
                }
                
                $(this)
                    .removeClass(`transaction-div-${prev_index}`).removeClass(`bank_account_transaction_${prev_index}`).removeClass(`bank_account_transaction_${prev_index}_0`)
                    .addClass(`hide-data transaction-div-${index_val}`).addClass(`bank_account_transaction_${index_val}`).addClass(`bank_account_transaction_${index_val}_0`);
                $(this).find('.delete-div').attr( "name", `remove_div_common('bank_account_transaction_${index_val}',0,'',false)`);
                $(this).find('.circle-number-div').html(1);

            });

            $(transaction_description).attr( "name", `bank[data][transaction_data][${index_val}][0][description]`);
            $(transaction_sample).attr( "name", `bank[data][transaction_data][${index_val}][0][sample]`);
            $(transaction_value).attr( "name", `bank[data][transaction_data][${index_val}][0][value]`);
            $(transaction_btn_div).removeClass(`add-more-transaction-btn-${prev_index}`).addClass(`hide-data add-more-transaction-btn-${index_val}`);
            $(transaction_add).attr("onclick", "addMoreBankTransaction(" + index_val + ", "+transaction_pdf_enabled+")");
            
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove-bank-mutisec").show();
            if(transaction_pdf_enabled == 1){
                checkBankAccInputs();
            }
        }
    }, 200);
}

function addMoreBankTransaction( index, transaction_pdf_enabled ) {
    var divLength = $(document).find(`.transaction-div-${index}`).length;
    if (divLength > 9) {
        $.systemMessage('You can add only 10 transactions.', "alert--danger", true);
        return false;
    } else {
        var lastDiv = $(document).find(`.transaction-div-${index}`).last();
        var clonedDiv = $(lastDiv).clone();

        clonedDiv.find('input[type="text"]').val("");
        clonedDiv.find('input[type="number"]').val("");

        let divclass = 'bank_account_transaction_' + index;
        clonedDiv.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + divLength);

        clonedDiv.find(".delete-div").attr("onclick", "remove_div_common('bank_account_transaction_"+index+"', " + divLength + ")");

        // Update input fields with the correct name attributes
        clonedDiv.find(".circle-number-div").html(divLength + 1);

        var transaction_description  = clonedDiv.find(".transaction-description");
        var transaction_value        = clonedDiv.find(".transaction-value");
        var transaction_sample       = clonedDiv.find(".transaction-sample");
        
        $(transaction_description).attr( "name", `bank[data][transaction_data][${index}][${divLength}][description]`);
        $(transaction_description).attr( "value", ``);
        $(transaction_sample).attr( "name", `bank[data][transaction_data][${index}][${divLength}][sample]`);
        $(transaction_sample).attr( "value", ``);
        $(transaction_value).attr( "name", `bank[data][transaction_data][${index}][${divLength}][value]`);
        $(transaction_value).attr( "value", ``);

        $(lastDiv).after(clonedDiv);
        if(transaction_pdf_enabled == 1){
            checkBankAccInputs();
        }
    }
}

function handleBankButtonClick(event) {
    if (event && event.preventDefault) {
        event.preventDefault();
    } else {
        console.warn("handleBankButtonClick was called without an event.");
    }
}

function getListFinancialAccountsData(value) {
    if (value == "yes") {
        document
            .getElementById("list_all_financial_accounts-data")
            .classList.remove("hide-data");
    } else if (value == "no") {
        document
            .getElementById("list_all_financial_accounts-data")
            .classList.add("hide-data");
    }
}

async function addlistAllFinancialAccountsForm() {
    var clnln = $(document).find(".list_all_financial_accounts").length;
    const status = await seperate_save('list_all_financial_accounts','list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 4) {
            $.systemMessage('You can only insert 5 entries.', 'alert--danger', true);
            return false;
        } else {
            var itm = $(document).find(".list_all_financial_accounts").last();
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/list_all_financial_accounts_\d+/g) || []).join(' ');
            }).addClass("list_all_financial_accounts_" + index_val);            
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('list_all_financial_accounts', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);             
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('list_all_financial_accounts','list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts', " + index_val + ")");
            cln.find("label").removeClass("active");

            var classes = [
                "institution_name",
                "street_number",
                "city",
                "state",
                "zip",
                "account_number",
                "date_account_closed",
                "last_balance",
                "type_of_account",
            ];

            $(classes).each(function (index, value) {
                var field = cln.find("." + value);
                $(field).each(function (i, input) {
                    $(this).attr(
                        "name",
                        "list_all_financial_accounts_data[" +
                            value +
                            "][" +
                            index_val +
                            "]"
                    );

                    if (value == "date_account_closed") {
                        $(this).removeClass("hasDatepicker").attr("id", "");
                    }
                    if (value == "type_of_account") {
                        if ($(this).val() == "1") {
                            $(this).attr(
                                "id",
                                "type-of-account_checking_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account_checking_" + index_val
                                );
                        }
                        if ($(this).val() == "2") {
                            $(this).attr(
                                "id",
                                "type-of-account_savings_" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account_savings_" + index_val
                                );
                        }
                        if ($(this).val() == "3") {
                            $(this).attr(
                                "id",
                                "type-of-account-money-market-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account-money-market-" + index_val
                                );
                        }
                        if ($(this).val() == "4") {
                            $(this).attr(
                                "id",
                                "type-of-account-brokerage-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr(
                                    "for",
                                    "type-of-account-brokerage-" + index_val
                                );
                        }
                        if ($(this).val() == "5") {
                            $(this).attr(
                                "id",
                                "type-of-account-other-" + index_val
                            );
                            $(this)
                                .next("label")
                                .attr("for", "type-of-account-other-" + index_val);
                        }
                        $(this).attr("checked", false);
                    }
                });
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            initializeDatepicker();
        }
    }, 200);
}

async function brokerage_account_addmore() {
    var clnln = $(document).find(".brokerage_account_mutisec").length;
    const status = await seperate_save('brokerage_account','brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account', clnln, true);
    
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 9) {
            $.systemMessage('You can add only 10 entries.', "alert--danger", true);
            return false;
        } else {
            var itm = $(document).find(".brokerage_account_mutisec").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            itm.attr("rowNo", $rowNo);
            var index_val = clnln;
            var cln = $(itm).clone();

            // Update class and delete button for new index
            cln.removeClass(function (index, className) {
                return (className.match(/brokerage_account_mutisec_\d+/g) || []).join(' ');
            }).addClass("brokerage_account_mutisec_" + index_val);
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('brokerage_account_mutisec', " + index_val + ")");
            // Update input fields with the correct name attributes
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('brokerage_account','brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account', " + index_val + ")");
    
            cln.find(".brokerage_account_description").val("");
            cln.find(".brokerage_account_property_value").val("");
            var brokerage_account_description = cln.find(
                ".brokerage_account_description"
            );
            var brokerage_account_property_account = cln.find(
                ".brokerage_account_property_account"
            );
            var last_4_digits = cln.find(".last_4_digits");
            var brokerage_account_property_value = cln.find(
                ".brokerage_account_property_value"
            );
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            $(brokerage_account_description).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][description][" + index_val + "]"
                );
            });
            $(last_4_digits).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][last_4_digits][" + index_val + "]"
                );
            });

            $(brokerage_account_property_account).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][account_type][" + index_val + "]"
                );
            });
            $(brokerage_account_property_value).each(function () {
                $(this).attr(
                    "name",
                    "brokerage_account[data][property_value][" + index_val + "]"
                );
            });
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("textarea").val("");
            $(itm).after(cln);
            $(".remove_brokerage_account_sec").show();
        }    
    }, 200);
}

/**
 * Add more tax refund with limit
 */
async function tax_refund_addmore() {
    var divLength = $(document).find(".tax_refunds_mutisec").length;
    const status = await seperate_save('tax_refunds','tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund', divLength, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        
        if (divLength > 2) {
            $.systemMessage("You can add only 3 entries.", "alert--danger", true);
            return false;
        } else {
            var divLast = $(document).find(".tax_refunds_mutisec").last();

            var index_val = divLength;

            var divClone = $(divLast).clone();

            // Update class and delete button for new index
            divClone.removeClass(function (index, className) {
                return (className.match(/tax_refunds_mutisec_\d+/g) || []).join(' ');
            }).addClass("tax_refunds_mutisec_" + index_val);
            divClone.find(".delete-div").attr("onclick", "seperate_remove_div_common('tax_refunds_mutisec', " + index_val + ")");
            divClone.find(".client-edit-button").attr("onclick", "edit_div_common('tax_refunds_mutisec', " + index_val + ")");
            // Update input fields with the correct name attributes
            divClone.find(".circle-number-div").html(index_val + 1);
            divClone.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            divClone.find(`.edit_section`).removeClass('hide-data');
            divClone.find(`.save-btn`).attr("onclick", "seperate_save('tax_refunds','tax_refunds_mutisec', 'tax_refunds_MainRow', 'parent_tax_refund', " + index_val + ")");

            var type = divClone.find(".tax_refunds_description");
            var selectText = divClone.find(".selectText");
            var selectAll = divClone.find(".selectall");
            var justOne = divClone.find(".justone");
            var year = divClone.find(".refund_whats_year");
            var propertyValue = divClone.find(".tax_refunds_property_value");

            var previousSelectedType = divLast
                .find(".tax_refunds_description")
                .val();

            $(type).each(function () {
                $(this).attr(
                    "name",
                    "tax_refunds[data][description][" + index_val + "]"
                );
                var flagvar = false;

                $(this)
                    .find("option")
                    .each(function () {
                        var optionValue = $(this).val();
                        if (previousSelectedType == optionValue) {
                            flagvar = true;
                        } else {
                            if (flagvar) {
                                $(this).prop("selected", true);
                                flagvar = false;
                            }
                        }
                    });
                    
                $(this).attr("data-previousvalue", "");
            });

        

            $(selectText).each(function () {
                $(this)
                    .removeClass("select-text-" + (index_val - 1))
                    .addClass("select-text-" + index_val);
            });

            $(selectAll).each(function () {
                $(this).attr(
                    "data-inputname",
                    "tax_refunds[data][year][" + index_val + "]"
                );
                $(this).attr("data-inputfor", "refund_" + index_val);
                $(this).attr("onchange", "setSelectAll(this, " + index_val + ")");
                $(this).attr("id", $(this).attr("id") + index_val);
                $(this).parent("label").attr("for", $(this).attr("id"));
                $(this).prop("checked", false);
            });

            $(justOne).each(function () {
                var prev_index = index_val - 1;
                $(this).removeClass("refund_" + prev_index);
                $(this).addClass("refund_" + index_val);
                $(this).attr(
                    "data-inputname",
                    "tax_refunds[data][year][" + index_val + "]"
                );
                $(this).attr("data-inputfor", "refund_" + index_val);
                $(this).attr("onchange", "setJustOne(this, " + index_val + ")");
                $(this).attr("id", $(this).attr("id") + index_val);
                $(this).parent("label").attr("for", $(this).attr("id"));
                $(this).prop("checked", false);
            });

            $(year).each(function () {
                $(this).attr("name", "tax_refunds[data][year][" + index_val + "]");
                $(this)
                    .removeClass("refund_whats_year_" + (index_val - 1))
                    .addClass("refund_whats_year_" + index_val);
            });

            $(propertyValue).each(function () {
                $(this).attr(
                    "name",
                    "tax_refunds[data][property_value][" + index_val + "]"
                );
                $(this).prop("readonly", false);
            });

            divClone.find('input[type="text"]').val("");
            divClone.find('input[type="number"]').val("");
            // divClone.find('select').val('');

            $(divLast).after(divClone);
            $(".remove-tax-refund-mutisec").show();
        }
        
    }, 200);
}

/**
 * Store previous alimony value
 */
function storePreviousAlimonyValue(thisObj) {
    $(thisObj).attr('data-previousvalue', $(thisObj).val());
};

/**
 * Check for unique account numbers
 */
function checkUnique(thisobj) {
    var samecount = 0;
    $(".alimony_property_account").each(function () {
        if (thisobj.value != '' && $(this).val() != '' && $(this).val() == thisobj.value) {
            samecount = samecount + 1;
        }
        if (samecount > 1) {
            thisobj.value = '';
        }
    });
};

/**
 * Add more child support with limit
 */
async function child_addmore() {
    var clnln = $(document).find(".alimony_child_support_mutisec").length;
    const status = await seperate_save('alimony_child_support','alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support', clnln, true);
    if(!status){
        return;
    }

    setTimeout(function() {
        if (clnln > 6) {
            $.systemMessage('You can add only 7 entries.', "alert--danger", true);
            return false;
        } else {
            var itm = $(document).find(".alimony_child_support_mutisec").last();
            $rowNo = itm.attr("rowNo");
            if (
                $rowNo == undefined ||
                $rowNo == null ||
                $rowNo == NaN ||
                $rowNo == ""
            ) {
                $rowNo = 1;
            } else {
                $rowNo = parseInt($rowNo) + 1;
            }
            var alreadySelected = [];
            $(".alimony_property_account").each(function () {
                alreadySelected.push($(this).val());
            });
            
            itm.attr("rowNo", $rowNo);
            var index_val = $(itm).index() + 1;
            var cln = $(itm).clone();

            let parentDivClass = 'alimony_child_support_mutisec';
            cln.removeClass(function (index, className) {
                return (className.match(parentDivClass + "_\\d+", "g") || []).join(' ');
            }).addClass(parentDivClass + "_" + index_val);
            
            cln.find(".delete-div").attr("onclick", "seperate_remove_div_common('alimony_child_support_mutisec', " + index_val + ")");
            cln.find(".circle-number-div").html(index_val + 1);
            cln.find(`.summary_section, .client-edit-button`).addClass('hide-data');
            cln.find(`.edit_section`).removeClass('hide-data');
            cln.find(`.save-btn`).attr("onclick", "seperate_save('alimony_child_support','alimony_child_support_mutisec', 'alimony_child_data', 'parent_alimony_child_support', " + index_val + ")");


            cln.find(".alimony_description").val("");
            cln.find(".alimony_property_value").val("");
            var alimony_description = cln.find(".alimony_description");
            var alimony_property_account = cln.find(".alimony_property_account");
            var alimony_property_state = cln.find(".alimony_property_state");
            var alimony_child_support_data_for = cln.find(".alimony_child_support_data_for");
            var alimony_property_value = cln.find(".alimony_property_value");
            cln.find('input[type="text"]').val("");
            cln.find('input[type="number"]').val("");
            cln.find("select").val("");

            cln
            .find("input[type=checkbox]")
            .prop("checked", false)
            .end();

            var unknown = cln.find(".unknown");

            var newSelectedVal = "";

            $(alimony_property_account).each(function () {
                $(this).attr("name", `alimony_child_support[data][account_type][${index_val}]`);
                $(this).attr("data-index", index_val);
                $(this).find("option").each(function () {
                    var optionValue = $(this).val();
                    if ($.inArray(optionValue, alreadySelected) === -1 && newSelectedVal === "") {
                        $(this).prop("selected", true);
                        newSelectedVal = optionValue;
                    }
                });
            });
            $(alimony_child_support_data_for).each(function () {
                $(this).attr("name", `alimony_child_support[data][data_for][${index_val}]`);
            });
            $(unknown).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][property_value_unknown][" + index_val + "]"
                );
                $(this).attr(
                    "onchange",
                    "checkUnknown(this, " + index_val + ",'child')"
                );
                $(this).attr(
                    "checked",
                    false
                );
            });

            $(alimony_description).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][description][" + index_val + "]"
                );
            });
            $(alimony_property_state).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][state][" + index_val + "]"
                );
            });

            
            $(alimony_property_account).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][account_type][" + index_val + "]"
                );
            });
            $(alimony_property_value).each(function () {
                $(this).attr(
                    "name",
                    "alimony_child_support[data][property_value][" + index_val + "]"
                );
                var previndex = index_val - 1;
                $(this)
                .removeClass(
                    "is_child_unknown_" +
                        previndex
                )
                .addClass(
                    "is_child_unknown_" +
                        index_val
                );
                $(this).removeAttr("disabled");
            });
           
            $(itm).after(cln);
            $(".remove-child-mutisec").show();
        }
    }, 200);
}

/**
 * Open unknown flag popup
 */
function openUnknownFlagPopup(element, attorneyEdit = false) {
    const eValue = $(element).val();
    const parentDiv = $(element).closest('.life_insurance_mutisec');

    // Toggle visibility of sections based on the selected insurance type
    parentDiv.find('.beneficiary_div').toggleClass('hide-data', ['Renters', 'Disability'].includes(eValue));
    parentDiv.find('.cash_current_value').toggleClass('hide-data', !['Whole', 'Universal'].includes(eValue));
    parentDiv.find('.total_term_div').toggleClass('hide-data', !['Renters', 'Disability'].includes(eValue));

    // Handle popups for specific insurance types
    if (eValue === 'Whole') {
        openPopup('life-insurance-unknown-popup', attorneyEdit);
    } else if (eValue === 'Universal') {
        openPopup('universal-insurance-unknown-popup', attorneyEdit);
    }

    // Update label text for "total-span-section"
    if (eValue === 'Renters') {
        parentDiv.find('.total-span-section').html('Refund Value');
    } else if (eValue === 'Disability') {
        parentDiv.find('.total-span-section').html('Total Value of policy');
    }
};  

// Export functions for backward compatibility
window.initializePropertyStep4 = initializePropertyStep4;
window.initializePropertyStep4Continue = initializePropertyStep4Continue;
window.showHideBusinessNameDiv = showHideBusinessNameDiv;
window.setBusinessValue = setBusinessValue;
window.handleS4ContinueSubmit = handleS4ContinueSubmit;
window.checkUnknownRetirement = checkUnknownRetirement;
window.setSelectAll = setSelectAll;
window.setJustOne = setJustOne;
window.setSpaceSeperatedString = setSpaceSeperatedString;
window.selectTaxRefundType = selectTaxRefundType;
window.selectVPCAccount = selectVPCAccount;
window.selectVPCAAlimonyccount = selectVPCAAlimonyccount;
window.getCashItems = getCashItems;
window.getCheckingAccountItems = getCheckingAccountItems;
window.getAccountItems = getAccountItems;
window.getBrokerageItems = getBrokerageItems;
window.getSavingsAccountItems = getSavingsAccountItems;
window.getCertificateDepositeItems = getCertificateDepositeItems;
window.getOtherFinacialAccountItems = getOtherFinacialAccountItems;
window.getMutualFundsItems = getMutualFundsItems;
window.getGovernmentCoperateItems = getGovernmentCoperateItems;
window.getRetirementPensionItems = getRetirementPensionItems;
window.getPrepaymentsItems = getPrepaymentsItems;
window.getAnnuitiesItems = getAnnuitiesItems;
window.getEducationIRAItems = getEducationIRAItems;
window.getInterestPropertyItems = getInterestPropertyItems;
window.getintellectualPropertyItems = getintellectualPropertyItems;
window.getGeneralIntangiblesItems = getGeneralIntangiblesItems;
window.getTaxRefundsItems = getTaxRefundsItems;
window.getAlimonyChildItems = getAlimonyChildItems;
window.getUnpaidWagesItems = getUnpaidWagesItems;
window.getLifeInsuranceItems = getLifeInsuranceItems;
window.getInsurancePoliciesItems = getInsurancePoliciesItems;
window.getInheritancesBenefitsItems = getInheritancesBenefitsItems;
window.getPersonalInjuryItems = getPersonalInjuryItems;
window.getLawsuitsItems = getLawsuitsItems;
window.getOtherClaimsItems = getOtherClaimsItems;
window.getFinancialAssetItems = getFinancialAssetItems;
window.showHideTransactionSection = showHideTransactionSection;
window.bank_addmore = bank_addmore;
window.addMoreBankTransaction = addMoreBankTransaction;
window.handleBankButtonClick = handleBankButtonClick;
window.showHideGuideVidDiv = showHideGuideVidDiv;
window.getListFinancialAccountsData = getListFinancialAccountsData;
window.addlistAllFinancialAccountsForm = addlistAllFinancialAccountsForm;
window.brokerage_account_addmore = brokerage_account_addmore;
window.tax_refund_addmore = tax_refund_addmore;
window.storePreviousAlimonyValue = storePreviousAlimonyValue;
window.checkUnique = checkUnique;
window.child_addmore = child_addmore;
window.openUnknownFlagPopup = openUnknownFlagPopup;
