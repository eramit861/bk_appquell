(function (window, document, $) {
  'use strict';

  if (typeof $ === 'undefined') {
    console.warn('[invite-client-popup] jQuery is required');
  }

  const cfg = window.InviteClientPopupConfig || {};

  function systemMessage(msg, type) {
    if (typeof $.systemMessage === 'function') {
      $.systemMessage(msg, type || 'alert--success', true);
    }
  }

  // Public functions used by onclick
  window.selectDocument = function selectDocument() {
    $(".notify_doc").each(function () {
      const $card = $(this).closest(".item-card");
      if ($(this).is(":checked")) {
        $card.addClass("selected").removeClass("no-selected");
      } else {
        $card.removeClass("selected").addClass("no-selected");
      }
    });
  };

  window.addNewDocument = function addNewDocument() {
    var $lastDocDiv = $('.new_doc_div:not(.d-none)').last();
    var $newDocDiv = $lastDocDiv.clone();
    var totalDocuments = $('.new_doc_div:not(.d-none)').length;
    var $inputField = $newDocDiv.find('input');
    $inputField.attr('name', `new_document[${totalDocuments + 1}]`);
    $inputField.attr('id', `new_document_${totalDocuments + 1}`);
    $inputField.val('');
    var $label = $newDocDiv.find('label');
    $label.attr('for', `new_document_${totalDocuments + 1}`);
    $label.text(`New Document ${totalDocuments + 1}:`);
    var $errorMsg = $newDocDiv.find('.help-block');
    if ($errorMsg.length > 0) $errorMsg.remove();
    $newDocDiv.removeClass('d-none');
    $lastDocDiv.after($newDocDiv);
  };

  window.deleteNewDocument = function deleteNewDocument() {
    var $visibleDocDivs = $('.new_doc_div:not(.d-none)');
    if ($visibleDocDivs.length > 1) {
      $visibleDocDivs.last().addClass('d-none');
    } else {
      alert('Cannot remove the last document section.');
    }
  };

  window.showSpinner = function showSpinner() {
    $('#loader').show();
  };

  window.toggleCheckbox = function toggleCheckbox(checkbox) {
    $('input[name="' + checkbox.name + '"]').not(checkbox).prop('checked', false);
  };

  window.helpPopup = function helpPopup(popup_for) {
    var ajaxurl = (cfg.routes && cfg.routes.helpPopup) || '';
    var popupSize = popup_for === 'client_subscription' ? 'large-fb-width' : 'medium-fb-width';
    if (typeof laws !== 'undefined' && typeof laws.ajax === 'function') {
      laws.ajax(ajaxurl, { popup_for: popup_for }, function (response) {
        laws.updateFaceboxContent(response, popupSize + ' p-0 bg-unset');
      });
    }
  };

  window.checkPackageAvailablity = function checkPackageAvailablity() {
    $("#invite_form").trigger("submit");
  };

  function validateInviteClient() {
    if (typeof $.fn.validate !== 'function') return;
    $("#invite_form").validate({
      errorPlacement: function (error, element) {
        if ($(element).parents(".form-group").next('label').hasClass('error')) {
          $(element).parents(".form-group").next('label').remove();
          $(element).parents(".form-group").after($(error)[0].outerHTML);
        } else {
          $(element).parents(".form-group").after($(error)[0].outerHTML);
        }
        $('#page_loader').hide();
        $('#loader').addClass('d-none').hide();
      },
      success: function (label, element) {
        label.parent().removeClass('error');
        $(element).parents(".form-group").next('label').remove();
        $('#loader').removeClass('d-none');
      }
    });
  }

  window.updateShowHideDocList = function updateShowHideDocList() {
    var invite_client_type = $('#invite_client_type').find(':selected').val();
    if (invite_client_type == '') {
      $('.doc_list, .doc_list_1, .doc_list_2, .doc_list_3').addClass('d-none');
      $('.co_deb_doc_list').html("Co-Debtor's Document List");
    }
    if (invite_client_type == 1) {
      $('.doc_list').removeClass('d-none');
      $('.doc_list_1').removeClass('d-none');
      $('.doc_list_2, .doc_list_3').addClass('d-none');
      $('.co_deb_doc_list').html("Co-Debtor's Document List");
    }
    if (invite_client_type == 2) {
      $('.doc_list').removeClass('d-none');
      $('.doc_list_2').removeClass('d-none');
      $('.doc_list_1, .doc_list_3').addClass('d-none');
      $('.co_deb_doc_list').html('Non-Filing Spouse Pay Stubs');
    }
    if (invite_client_type == 3) {
      $('.doc_list').removeClass('d-none');
      $('.doc_list_3').removeClass('d-none');
      $('.doc_list_1, .doc_list_2').addClass('d-none');
      $('.co_deb_doc_list').html("Co-Debtor's Document List");
      $('.debtor_2_details').removeClass('d-none');
    }
  };

  function populateSelections() {
    var options = '';
    var selectionsHtml = cfg.selectionHtml?.clientType || '';
    options += "<option value=''>Choose Client Type</option>";
    options += selectionsHtml;
    $("#invite_client_type").html(options);
  }

  function formatPhoneInputs() {
    $(document).on("input", ".phone-field", function () {
      var self = $(this);
      self.val(self.val().replace(/[^0-9\.]/g, ''));
      self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
      var first10 = $(this).val().substring(0, 14);
      if (this.value.length > 14) {
        this.value = first10;
      }
    });
  }

  function updatePackageDependentOptions() {
    var packageVal = $('#client_subscription').find(':selected').val();
    var inviteType = $('#invite_client_type').find(':selected').val();
    $('.debtor_2_details').addClass('d-none');
    updateShowHideDocList();

    var priceMaps = cfg.priceMaps || {};
    var payrollAssistantArr = cfg.arrays?.payrollAssistant || {};
    var bankStatementsArr = cfg.arrays?.bankStatements || {};
    var profitLossAssistantArr = cfg.arrays?.profitLossAssistant || {};
    var creditReportAssistantArr = cfg.arrays?.creditReportAssistant || {};

    var options = '';
    var bankOptions = '';
    var profitLossOptions = '';
    var creditReportOptions = '';

    // Payroll
    var pkgPayroll = priceMaps.packagePrice?.[packageVal] || {};
    Object.keys(payrollAssistantArr).forEach(function (pindex) {
      if (inviteType == 1) {
        if (inviteType == pindex && pkgPayroll[pindex] !== undefined) {
          var price = pkgPayroll[pindex] == 0 ? 'Included' : ('Additional ' + pkgPayroll[pindex]);
          options += '<option value="' + pindex + '">' + payrollAssistantArr[pindex] + ' (' + price + ')</option>';
        }
      } else if (inviteType == 2) {
        if (Number(pindex) <= 2 && pkgPayroll[pindex] !== undefined) {
          var price2 = pkgPayroll[pindex] == 0 ? 'Included' : ('Additional ' + pkgPayroll[pindex]);
          options += '<option value="' + pindex + '">' + payrollAssistantArr[pindex] + ' (' + price2 + ')</option>';
        }
      } else {
        if (pkgPayroll[pindex] !== undefined) {
          var price3 = pkgPayroll[pindex] == 0 ? 'Included' : ('Additional ' + pkgPayroll[pindex]);
          options += '<option value="' + pindex + '">' + payrollAssistantArr[pindex] + ' (' + price3 + ')</option>';
        }
      }
    });

    // Bank statements standard
    var bankStd = priceMaps.bankStatement?.[packageVal] || {};
    if (Object.keys(bankStd).length) bankOptions += '<optgroup label="Standard (3 months):" ></optgroup>';
    Object.keys(bankStatementsArr).forEach(function (bankIndex) {
      if (inviteType == 1) {
        if (inviteType == bankIndex && bankStd[bankIndex] !== undefined) {
          var bankPrice = bankStd[bankIndex] == 0 ? 'Included' : ('Additional ' + bankStd[bankIndex]);
          bankOptions += '<option value="' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice + ')</option>';
        }
      } else if (inviteType == 2) {
        if (Number(bankIndex) <= 2 && bankStd[bankIndex] !== undefined) {
          var bankPrice2 = bankStd[bankIndex] == 0 ? 'Included' : ('Additional ' + bankStd[bankIndex]);
          bankOptions += '<option value="' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice2 + ')</option>';
        }
      } else {
        if (bankStd[bankIndex] !== undefined) {
          var bankPrice3 = bankStd[bankIndex] == 0 ? 'Included' : ('Additional ' + bankStd[bankIndex]);
          bankOptions += '<option value="' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice3 + ')</option>';
        }
      }
    });

    // Bank statements premium
    var bankPrem = priceMaps.bankStatementPremium?.[packageVal] || {};
    if (Object.keys(bankPrem).length) bankOptions += '<optgroup label="Premium (6 months):" ></optgroup>';
    Object.keys(bankStatementsArr).forEach(function (bankIndex) {
      if (inviteType == 1) {
        if (inviteType == bankIndex && bankPrem[bankIndex] !== undefined) {
          var bankPrice = bankPrem[bankIndex] == 0 ? 'Included' : ('Additional ' + bankPrem[bankIndex]);
          bankOptions += '<option value="premium_' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice + ')</option>';
        }
      } else if (inviteType == 2) {
        if (Number(bankIndex) <= 2 && bankPrem[bankIndex] !== undefined) {
          var bankPrice2 = bankPrem[bankIndex] == 0 ? 'Included' : ('Additional ' + bankPrem[bankIndex]);
          bankOptions += '<option value="premium_' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice2 + ')</option>';
        }
      } else {
        if (bankPrem[bankIndex] !== undefined) {
          var bankPrice3 = bankPrem[bankIndex] == 0 ? 'Included' : ('Additional ' + bankPrem[bankIndex]);
          bankOptions += '<option value="premium_' + bankIndex + '">' + bankStatementsArr[bankIndex] + ' (' + bankPrice3 + ')</option>';
        }
      }
    });

    // Profit/Loss
    var profitMap = priceMaps.profitLoss?.[packageVal] || {};
    Object.keys(profitLossAssistantArr).forEach(function (idx) {
      if (inviteType == 1) {
        if (inviteType == idx && profitMap[idx] !== undefined) {
          profitLossOptions += '<option value="' + idx + '">' + profitLossAssistantArr[idx] + ' (Additional ' + profitMap[idx] + ')</option>';
        }
      } else if (inviteType == 2) {
        if (Number(idx) <= 2 && profitMap[idx] !== undefined) {
          profitLossOptions += '<option value="' + idx + '">' + profitLossAssistantArr[idx] + ' (Additional ' + profitMap[idx] + ')</option>';
        }
      } else {
        if (profitMap[idx] !== undefined) {
          profitLossOptions += '<option value="' + idx + '">' + profitLossAssistantArr[idx] + ' (Additional ' + profitMap[idx] + ')</option>';
        }
      }
    });

    // Credit Report
    var creditMap = priceMaps.creditReport?.[packageVal] || {};
    Object.keys(creditReportAssistantArr).forEach(function (idx) {
      if (inviteType == 1) {
        if (inviteType == idx && creditMap[idx] !== undefined) {
          var price = creditMap[idx] == 0 ? 'Included' : ('Additional ' + creditMap[idx]);
          creditReportOptions += '<option value="' + idx + '">' + creditReportAssistantArr[idx] + ' (' + price + ')</option>';
        }
      } else if (inviteType == 2) {
        if (Number(idx) <= 2 && creditMap[idx] !== undefined) {
          var price2 = creditMap[idx] == 0 ? 'Included' : ('Additional ' + creditMap[idx]);
          creditReportOptions += '<option value="' + idx + '">' + creditReportAssistantArr[idx] + ' (' + price2 + ')</option>';
        }
      } else {
        if (creditMap[idx] !== undefined) {
          var price3 = creditMap[idx] == 0 ? 'Included' : ('Additional ' + creditMap[idx]);
          creditReportOptions += '<option value="' + idx + '">' + creditReportAssistantArr[idx] + ' (' + price3 + ')</option>';
        }
      }
    });

    // Inject to DOM
    $("#client_payroll_assistant").html('<option value=0>None</option>' + options);
    $("#client_bank_statements").html('<option value=0>None</option>' + bankOptions);
    $("#client_profit_loss_assistant").html('<option value=0>None</option>' + profitLossOptions);
    $("#client_credit_report").html('<option value=0>None</option>' + creditReportOptions);
    if (packageVal == 164 || packageVal == 148 || packageVal == 121) {
      $(".report_included").text(' Included');
    } else {
      $(".report_included").text('');
    }
  }

  function bindChangeHandlers() {
    $("#petition_prepration_package, #peralegal_check_package").change(function () {
      $(this).val($(this).prop('checked') ? 1 : 0);
    });

    $('#modalRegister').click(function () {
      $('#myVal').val('any value');
    });

    $('#client_subscription').change(updatePackageDependentOptions);
    $('#invite_client_type').change(function () {
      var inviteType = $('#invite_client_type').find(':selected').val();
      if (inviteType === '3') {
        $('.debtor_2_details').removeClass('d-none');
      } else {
        $('.debtor_2_details').addClass('d-none');
      }
      updatePackageDependentOptions();
    });
  }

  $(function () {
    validateInviteClient();
    populateSelections();
    formatPhoneInputs();
    bindChangeHandlers();
    updateShowHideDocList();
    if (cfg.showModalOnError) {
      $("#add_attorney").modal('show');
    }
  });
})(window, document, window.jQuery);


