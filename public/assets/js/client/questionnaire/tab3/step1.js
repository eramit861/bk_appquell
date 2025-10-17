/**
 * Tab 3 - Step 1: Unsecured Debts
 * Credit cards, collection accounts, medical bills, etc.
 */

// ==================== CARD COLLECTION FUNCTIONS ====================

/**
 * Card collection type changed - show/hide lawsuit section
 */
function cardCollectionChanged(event) {
    let selectedVal = $(event).val();
    let index = $(event).attr('name').match(/\[(\d+)\]/)[1];

    if (selectedVal == 6) {
        $('.law_suit_div_' + index).removeClass('hide-data');
        var creditorName = $(document).find('[name="debt_tax[creditor_name][' + index + ']').val();
        if (creditorName != '') {
            $(document).find('[name="debt_tax[list_lawsuits_data][case_title][' + index + ']"]').val(creditorName);
        }
    } else {
        $('.law_suit_div_' + index).addClass('hide-data');
    }
};


/**
 * Check if any unsecured debts exist
 */
function checkAC(value) {
    if (value == 'yes') {
        document.getElementById('second_step_debt_div').classList.remove("hide-data");
        document.getElementById('second_step_debt_note_div').classList.remove("hide-data");
    } else if (value == 'no') {
        document.getElementById('second_step_debt_div').classList.add("hide-data");
        document.getElementById('second_step_debt_note_div').classList.add("hide-data");
    }
};

function display_debt_div(thisObj, index) {
    var hasError = false;
    $(".unsecured_credit_form").each(function (index) {
        if (!$(this).hasClass('hide-data')) {
            hasError = revalidateFormWithMonthYear("client_debts_step2_unsecured", true);
            if (hasError) {
                return false;
            }
        }
    });
    if (!hasError) {
        $(".debt_creditor_sub_" + index).removeClass("hide-data");
        $(".creditor_summary_" + index).addClass("hide-data");
        var errorDiv = $(".debt_creditor_sub_" + index + ":visible").first();
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
    }
    $(thisObj).addClass('hide-data');
}


// Export functions for backward compatibility
function initializeStep1Validation() {
    // Step 1 specific initialization if needed
};

function originalCreditorCheck(value, index) {
    if (value == 0) {
        // $('.debt_date_section_'+index).addClass('d-none');
        $(".debt_second_address_" + index).removeClass("d-none");
        // $('input[name="debt_tax[debt_date]['+index+']"]').val("");
    }
    if (value == 1) {
        // $('.debt_date_section_'+index).removeClass('d-none');
        $(".debt_second_address_" + index).addClass("d-none");
    }
    setLawsuitTitle('', index);
}

/**
 * Add another debts
 */
function addanotherDebts(url) {
    var unsaved_debtor_len = $(document).find(".unsaved_debtor").length;
    if (unsaved_debtor_len > 0) {
        var saveData = saveTheseDebts(true);
        if (saveData == false) {
            return false;
        }
    }

    var clnln = $(document).find(".debt_creditor_form").length;
    if (clnln > 124) {
        alert("You can only insert 125 creditors.");
        return false;
    } else {
        var itm = $(document).find(".debt_creditor_form").last();
        var credit_itm = $(document).find(".credit_summ").last();
        var index_val = $(itm).index() + 1;
        /*Values that need to display under summary */
        var debtType = "";
        var last4_number = "";
        var amountOwned = "";
        var creditorName = "";
        var creditorAddress = "";
        var debtIncurredDate = "";
        debtType = $(itm)
            .find(".cards_collections")
            .find("option:selected")
            .data("type");
        last4_number = $(itm).find(".amount_number").val();
        amountOwned = $(itm).find(".amount_owned").val();
        creditorName = $(itm).find(".creditor_name").val();
        creditorAddress = $(itm).find(".creditor_information").val();
        creditorCity = $(itm).find(".creditor_city").val();
        creditorState = $(itm).find(".creditor_state").val();
        creditorZip = $(itm).find(".creditor_zip").val();
        debtIncurredDate = $(itm).find(".debt_date").val();
        var credName2 = $(itm).find(".second_creditor_name").val();
        var credAddress2 = $(itm).find(".second_creditor_information").val();
        var credCity2 = $(itm).find(".second_creditor_city").val();
        var credState2 = $(itm).find(".second_creditor_state").val();
        var credZip2 = $(itm).find(".second_creditor_zip").val();

        var originalCreditor = $(itm).find(".original_creditor:checked").val();

        if (originalCreditor == "1") {
            var summaryAgentOrigional = "";
            var summaryAgentCollection = "d-none";
            var collectionAgentDiv = "d-none";
        } else {
            var summaryAgentOrigional = "d-none";
            var summaryAgentCollection = "";
            var collectionAgentDiv = "";
        }

        var cln = $(itm).clone();

        $(document)
            .find(".creditor_summary_" + index_val)
            .removeClass("hide-data");
        $(".debt_creditor_sub_" + index_val).addClass("hide-data");
        cln.find(".debt_no").html(index_val + 1 + ".");
        cln.find(".credit_summ").addClass("hide-data");
        cln.find(".insider_data").removeClass("hide-data");


        cln.find("label").removeClass("active");

        let divclass = "debt_creditor";
        cln.removeClass(function (index, className) {
            return (className.match(divclass + "_\\d+", "g") || []).join(' ');
        }).addClass(divclass + "_" + index_val);
        cln.find(".delete-div").attr('data-saveid', (index_val + 1)).attr("onclick", "remove_debt_div(" + (index_val + 1) + ", this)");
        cln.find(".client-edit-button").attr('data-saveid', (index_val + 1)).attr("onclick", "display_debt_div(this, " + (index_val + 1) + ")");
        cln.find(".circle-number-div").html(index_val + 1);

        var credit_summ = cln.find(".credit_summ");
        var insider_data = cln.find(".insider_data");

        var cards_collections = cln.find(".cards_collections");
        var creditor_name = cln.find(".creditor_name");
        var creditor_information = cln.find(".creditor_information");
        var creditor_city = cln.find(".creditor_city");
        var creditor_state = cln.find(".creditor_state");
        var creditor_zip = cln.find(".creditor_zip");
        var im_action = cln.find(".im-action");

        var second_creditor_name = cln.find(".second_creditor_name");
        var second_creditor_information = cln.find(
            ".second_creditor_information"
        );
        var second_creditor_city = cln.find(".second_creditor_city");
        var second_creditor_state = cln.find(".second_creditor_state");
        var second_creditor_zip = cln.find(".second_creditor_zip");

        var original_creditor = cln.find(".original_creditor");

        var amount_owned = cln.find(".amount_owned");
        var amount_number = cln.find(".amount_number");
        var credt_owned_by = cln.find(".credt_owned_by");
        cln.find(".debt_tax_codebtor_cosigner_data").addClass("hide-data");
        var debt_date_unknown = cln.find(".debt_date_unknown");
        var debt_date = cln.find(".debt_date");

        var debt_tax_codebtor_creditor_name = cln.find(
            ".debt_tax_codebtor_creditor_name"
        );
        var debt_tax_codebtor_creditor_name_addresss = cln.find(
            ".debt_tax_codebtor_creditor_name_addresss"
        );
        var debt_tax_codebtor_creditor_city = cln.find(
            ".debt_tax_codebtor_creditor_city"
        );
        var debt_tax_codebtor_creditor_state = cln.find(
            ".debt_tax_codebtor_creditor_state"
        );
        var debt_tax_codebtor_creditor_zip = cln.find(
            ".debt_tax_codebtor_creditor_zip"
        );
        var debt_second_address = cln.find(
            ".debt_second_address_" + $(itm).index()
        );
        var debt_date_section = cln.find(
            ".debt_date_section_" + $(itm).index()
        );
        var remove_div_icon = cln.find(".remove_div_icon");
        var nextIndex = index_val + 1;

        var debt_months = cln.find(".debt_months");
        var debt_months_label_yes = cln.find(".debt_months_label_yes");
        var debt_months_label_no = cln.find(".debt_months_label_no");
        var debt_months_div = cln
            .find(".debt_months_div")
            .addClass("hide-data");
        var payment_1 = cln.find(".payment_1");
        var payment_2 = cln.find(".payment_2");
        var payment_3 = cln.find(".payment_3");
        var payment_dates_1 = cln.find(".payment_dates_1");
        var payment_dates_2 = cln.find(".payment_dates_2");
        var payment_dates_3 = cln.find(".payment_dates_3");
        var total_amount_paid = cln.find(".total_amount_paid");

        var validate_div = cln.find(".validate_div");
        var validate_msg = cln.find(".validate_msg");
        var saveBtn = cln.find(".save-btn");
        var trashBtn = cln.find(".trash-btn");
        var amount_less_sixhund = cln.find(".amount_less_sixhund");

        var law_suit = cln.find(".law_suit");

        $(law_suit).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("law_suit_div_" + prev_index);
            $(this).addClass("law_suit_div_" + index_val);

            $(this).find('.debtor').each(function () {
                let newId = 'add_debtor_' + index_val;
                $(this).attr('id', newId);
                $(this).prop('checked', false)
                $(this).next('label').attr('for', newId);
            });

            $(this).find('.codebtor').each(function () {
                let newId = 'add_codebtor_' + index_val;
                $(this).attr('id', newId);
                $(this).prop('checked', false)
                $(this).next('label').attr('for', newId);
            });

            // update text input names
            $(this).find('.case_title').attr('name', 'debt_tax[list_lawsuits_data][case_title][' + index_val + ']');
            $(this).find('.case_number').attr('name', 'debt_tax[list_lawsuits_data][case_number][' + index_val + ']');
            $(this).find('.agency_location').attr('name', 'debt_tax[list_lawsuits_data][agency_location][' + index_val + ']');
            $(this).find('.agency_street').attr('name', 'debt_tax[list_lawsuits_data][agency_street][' + index_val + ']');
            $(this).find('.agency_city').attr('name', 'debt_tax[list_lawsuits_data][agency_city][' + index_val + ']');
            $(this).find('.agency_state').attr('name', 'debt_tax[list_lawsuits_data][agency_state][' + index_val + ']');
            $(this).find('.agency_zip').attr('name', 'debt_tax[list_lawsuits_data][agency_zip][' + index_val + ']');

            // update radio buttons for disposition
            $(this).find('.disposition').each(function () {
                let val = $(this).val();
                let newId = 'list-lawsuits_disposition_' +
                    (val == '1' ? 'pending' : val == '2' ? 'appeal' : 'concluded')
                    + '-' + index_val;
                $(this).attr('id', newId);
                $(this).attr('name', 'debt_tax[list_lawsuits_data][disposition][' + index_val + ']');
                $(this).next('label').attr('for', newId);
            });
        });


        $(amount_less_sixhund).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("amount_not_saved_" + prev_index);
            $(this).addClass("amount_not_saved_" + index_val);
        });
        $(im_action).each(function () {
            $(this).attr("data-saveid", index_val + 1);
        });

        $(saveBtn).each(function () {
            $(this).attr(
                "onclick",
                'saveTheseDebts(true,this,true);'
            );
        });

        $(trashBtn).each(function () {
            $(this).attr(
                "onclick",
                "remove_debt_div(" + (index_val + 1) + ", this);"
            );
        });

        $(debt_months).each(function () {
            $(this).prop("checked", false);
            $(this).attr(
                "name",
                "debt_tax[is_debt_three_months][" + index_val + "]"
            );
            if ($(this).val() == "1") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('yes', 'debt_three_months_div_" +
                    index_val +
                    "')"
                );
                $(this).attr("id", "is_debt_three_months_yes_" + index_val);
                $(debt_months_label_yes).attr(
                    "for",
                    "is_debt_three_months_yes_" + index_val
                );
            }
            if ($(this).val() == "0") {
                $(this).attr(
                    "onclick",
                    "isThreeMonthsCommon('no', 'debt_three_months_div_" +
                    index_val +
                    "')"
                );
                $(this).attr("id", "is_debt_three_months_no_" + index_val);
                $(debt_months_label_no).attr(
                    "for",
                    "is_debt_three_months_no_" + index_val
                );
            }
            $(payment_1).each(function () {
                $(this).attr("name", "debt_tax[payment_1][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_2).each(function () {
                $(this).attr("name", "debt_tax[payment_2][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_3).each(function () {
                $(this).attr("name", "debt_tax[payment_3][" + index_val + "]");
                $(this).attr("data-index", index_val);
            });
            $(payment_dates_1).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_1][" + index_val + "]"
                );
            });
            $(payment_dates_2).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_2][" + index_val + "]"
                );
            });
            $(payment_dates_3).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[payment_dates_3][" + index_val + "]"
                );
            });
            $(total_amount_paid).each(function () {
                $(this).attr(
                    "name",
                    "debt_tax[total_amount_paid][" + index_val + "]"
                );
            });
        });
        $(debt_months_div).each(function () {
            var prev_index = index_val - 1;
            $(this).removeClass("debt_three_months_div_" + prev_index);
            $(this).addClass("debt_three_months_div_" + index_val);
        });

        $(cln).each(function () {
            $(cln)
                .removeClass("unsaved_debtor debt_creditor_" + index_val)
                .addClass("unsaved_debtor debt_creditor_" + nextIndex);
        });

        $(credit_summ).each(function () {
            $(credit_summ)
                .removeClass("creditor_summary_" + index_val)
                .addClass("creditor_summary_" + nextIndex);
        });
        $(insider_data).each(function () {
            $(insider_data)
                .removeClass("debt_creditor_sub_" + index_val)
                .addClass("debt_creditor_sub_" + nextIndex);
        });

        $(validate_div).each(function () {
            var oldInx = index_val - 1;
            $(validate_div).removeClass("validation_msg_div_" + oldInx);
            $(validate_div).addClass("validation_msg_div_" + index_val);
        });
        $(validate_msg).each(function () {
            var oldInx = index_val - 1;
            $(validate_msg)
                .removeClass("validation_msg_" + oldInx)
                .addClass("validation_msg_" + index_val);
        });

        $(debt_tax_codebtor_creditor_name).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_name][" + index_val + "]"
            );
        });

        $(remove_div_icon).each(function () {
            $(this).attr("onclick", "remove_debt_div(" + nextIndex + ")");
        });

        $(debt_tax_codebtor_creditor_name_addresss).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_name_addresss][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_city).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_city][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_state).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_state][" + index_val + "]"
            );
        });

        $(debt_tax_codebtor_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "debt_tax[codebtor_creditor_zip][" + index_val + "]"
            );
        });

        $(credt_owned_by).each(function () {
            $(this).prop("checked", false);
            $(this).attr("name", "debt_tax[owned_by][" + index_val + "]");
            let thisRadioId = $(this).attr("id");
            $(this).attr("id", thisRadioId + index_val);
            $(this).next("label").attr("for", thisRadioId + index_val);
        });

        $(cards_collections).each(function () {
            $(this).attr(
                "name",
                "debt_tax[cards_collections][" + index_val + "]"
            );
            $(this)
                .removeClass("cards_collections_" + index_val)
                .addClass("cards_collections_" + (index_val + 1));
        });

        $(creditor_name).each(function () {
            $(this).attr("name", "debt_tax[creditor_name][" + index_val + "]");
            $(this)
                .removeClass("creditor_name_" + index_val)
                .addClass("creditor_name_" + (index_val + 1));
        });
        $(creditor_information).each(function () {
            $(this).attr(
                "name",
                "debt_tax[creditor_information][" + index_val + "]"
            );
            $(this)
                .removeClass("creditor_information_" + index_val)
                .addClass("creditor_information_" + (index_val + 1));
        });
        $(creditor_city).each(function () {
            $(this).attr("name", "debt_tax[creditor_city][" + index_val + "]");
            $(this)
                .removeClass("creditor_city_" + index_val)
                .addClass("creditor_city_" + (index_val + 1));
        });
        $(creditor_state).each(function () {
            $(this).attr("name", "debt_tax[creditor_state][" + index_val + "]");
            $(this)
                .removeClass("creditor_state_" + index_val)
                .addClass("creditor_state_" + (index_val + 1));
        });
        $(creditor_zip).each(function () {
            $(this).attr("name", "debt_tax[creditor_zip][" + index_val + "]");
            $(this)
                .removeClass("creditor_zip_" + index_val)
                .addClass("creditor_zip_" + (index_val + 1));
        });
        $(amount_owned).each(function () {
            $(this).attr("name", "debt_tax[amount_owned][" + index_val + "]");
            $(this)
                .removeClass("amount_owned_" + index_val)
                .addClass("amount_owned_" + (index_val + 1));
        });
        $(amount_number).each(function () {
            $(this).attr("name", "debt_tax[amount_number][" + index_val + "]");
            $(this)
                .removeClass("amount_number_" + index_val)
                .addClass("amount_number_" + (index_val + 1));
        });
        $(debt_date_unknown).each(function () {
            $(this).attr(
                "name",
                "debt_tax[debt_date_unknown][" + index_val + "]"
            );
            $(this).attr("onclick", "unknownChecked(" + index_val + ")");
            $(this).attr("id", "debt_date_unknown_" + index_val);
        });
        $(debt_date).each(function () {
            $(this).attr("name", "debt_tax[debt_date][" + index_val + "]");
            $(this)
                .removeClass("debt_date_" + index_val)
                .addClass("debt_date_" + (index_val + 1));
            $(this).removeClass("hasDatepicker").attr("id", "");
        });

        $(second_creditor_name).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_name][" + index_val + "]"
            );
            $(this).attr(
                "data-index",
                (index_val + 1)
            );
            $(this)
                .removeClass("second_creditor_name_" + index_val)
                .addClass("second_creditor_name_" + (index_val + 1));
        });
        $(second_creditor_information).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_information][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_information_" + index_val)
                .addClass("second_creditor_information_" + (index_val + 1));
        });
        $(second_creditor_city).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_city][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_city_" + index_val)
                .addClass("second_creditor_city_" + (index_val + 1));
        });
        $(second_creditor_state).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_state][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_state_" + index_val)
                .addClass("second_creditor_state_" + (index_val + 1));
        });
        $(second_creditor_zip).each(function () {
            $(this).attr(
                "name",
                "debt_tax[second_creditor_zip][" + index_val + "]"
            );
            $(this)
                .removeClass("second_creditor_city_" + index_val)
                .addClass("second_creditor_city_" + (index_val + 1));
        });

        $(original_creditor).each(function () {
            $(this).attr("name", "debt_tax[original_creditor][" + index_val + "]");
            $(this).removeClass("original_creditor_" + index_val).addClass("original_creditor_" + (index_val + 1));
            $(this).attr("data-index", index_val);
            if ($(this).val() == "1") {
                $(this).attr("id", "original_creditor_no_" + index_val);
                $(this).next("label").attr("onclick", "originalCreditorCheck(1," + index_val + ")");
                $(this).next("label").attr("for", "original_creditor_no_" + index_val);
            }
            if ($(this).val() == "0") {
                $(this).attr("id", "original_creditor_yes_" + index_val);
                $(this).next("label").attr("onclick", "originalCreditorCheck(0," + index_val + ")");
                $(this).next("label").attr("for", "original_creditor_yes_" + index_val);
            }
            $(this).prop("checked", false);
        });

        $(debt_second_address).each(function () {
            $(this).removeClass("debt_second_address_" + $(itm).index());
            $(this).addClass("debt_second_address_" + index_val);
        });

        $(debt_date_section).each(function () {
            $(this).removeClass("debt_date_section_" + $(itm).index());
            $(this).addClass("debt_date_section_" + index_val);
        });

        cln.find("select").val("");
        cln.find("select").removeAttr("selected");

        cln.find('input[type="text"]').val("");
        cln.find('input[type="number"]').val("");
        initializeDatepicker();
        $(itm).after(cln);
    }
}

/**
 * Save these debts
 */
function saveTheseDebts(displaymsg = true, thisobj={}, newdiv=false) {
    hasError = revalidateFormWithMonthYear("client_debts_step2_unsecured",displaymsg);
    if(!hasError && !newdiv){
        var cln = $(thisobj).parent('div').parent('div').parent("div").parent("div");
        var debt_creditor_form = cln.find(".debt_creditor_form");
        
        $(debt_creditor_form).each(function () {
           if($(this).find(".credit_summ").hasClass('hide-data')){
                $(this).find(".credit_summ").removeClass('hide-data');
                $(this).find(".insider_data").addClass('hide-data');
            }
        });
    }
    return !hasError;
}

/**
 * Remove debt div
 */
async function remove_debt_div(row_class, thisobj) {
    const canEdit = await is_editable('can_edit_debts');
       if (!canEdit) {
           return false; // Stops execution if no permission
       }
   var cloneLength = $(document).find(".debt_creditor_form").length;
   if (cloneLength <= 1) {
       $.systemMessage(
           "You cannot delete because at least 1 entry is required.",
           "alert--danger"
       );
       return false;
   } else {
       var saveId = $(thisobj).attr("data-saveid");

     
       showConfirmation("Do you want to remove this creditor?", function(confirmation) {
       if (confirmation) {
           $(".second_step_debt")
               .find(".debt_creditor_" + saveId)
               .remove();
           $(".second_step_debt")
               .find(".debt_creditor_sub_" + saveId)
               .remove();

           $(".second_step_debt .row.debt_creditor_form").each(function (
               index
           ) {
               var updatedRowClass = index + 1;
               $(this)
                   .removeClass("debt_creditor_" + (index + 2))
                   .addClass("debt_creditor_" + updatedRowClass);
               $(this)
                   .find(".debt_no")
                   .text(updatedRowClass + ".");
               var removeButton = $(this).find(".fas.fa-trash");
               removeButton.attr(
                   "onclick",
                   "remove_debt_div(" + updatedRowClass + ")"
               );
           });
           var url = $("#debt_url").val();
           saveTheseDebts(url);
       }
   });
   }
}

window.cardCollectionChanged = cardCollectionChanged;
window.checkAC = checkAC;
window.originalCreditorCheck = originalCreditorCheck;
window.addanotherDebts = addanotherDebts;
window.saveTheseDebts = saveTheseDebts;

