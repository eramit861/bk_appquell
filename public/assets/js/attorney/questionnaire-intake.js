(function (window, document, $) {
  'use strict';

  if (typeof $ === 'undefined') {
    console.warn('[questionnaire-intake] jQuery is required');
  }

  window.BK = window.BK || {};
  const ns = (window.BK.QuestionnaireIntake = {});
  const cfg = window.QuestionnaireIntakeConfig || {};

  // Helpers
  function ajax(url, data, cb, method) {
    if (typeof laws !== 'undefined' && typeof laws.ajax === 'function') {
      laws.ajax(url, data, cb, method);
    } else {
      $.ajax({ url: url, data: data, method: method || 'GET' }).done(cb);
    }
  }

  // Document ready hooks
  $(function () {
    $('#page_loader').hide();
  });

  // Exposed functions (to keep existing inline onclicks working)
  window.copyFromDataUrl = function copyFromDataUrl(button) {
    var url = $(button).data('url');
    var msg = $(button).data('success');
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val(url).select();
    document.execCommand('copy');
    $temp.remove();
    if (typeof $.systemMessage === 'function') $.systemMessage(msg, 'alert--success', true);
  };

  window.conditional_questions_popup = function conditional_questions_popup() {
    var noticeModal = document.getElementById('PresetQuestionsModal');
    var modal = new bootstrap.Modal(noticeModal);
    modal.show();
  };

  window.attorney_questions_popup = function attorney_questions_popup() {
    var noticeModal = document.getElementById('YesNoQuestionsModal');
    var modal = new bootstrap.Modal(noticeModal);
    modal.show();
  };

  window.attorney_short_form_notes_popup = function attorney_short_form_notes_popup(questionnaire_id) {
    var url = cfg.routes?.short_form_notes || '';
    ajax(url, { questionnaire_id: questionnaire_id }, function (response) {
      if (typeof laws !== 'undefined' && laws.updateFaceboxContent) {
        laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div short_form_notes');
      }
    });
  };

  window.details_view_modal = function details_view_modal(client_id) {
    $('.previewQuestionsIntakeModal').each(function () { $(this).remove(); });
    var url = cfg.routes?.questionnaire_view || '';
    ajax(url, { client_id: client_id }, function (response) {
      try {
        var res = (typeof response === 'string') ? JSON.parse(response) : response;
        if (res.status == 0) {
          $.systemMessage(res.msg, 'alert--danger', true);
        } else {
          var modalContainer = document.createElement('div');
          modalContainer.classList.add('previewQuestionsIntakeModal');
          modalContainer.innerHTML = res.html;
          document.body.appendChild(modalContainer);
          var modalElement = modalContainer.querySelector('.modal');
          if (modalElement) {
            var submitModal = new bootstrap.Modal(modalElement);
            if (typeof statecounty === 'function') statecounty('debtor_state', 'state_based_county');
            submitModal.show();
          }
        }
      } catch (e) {
        console.error('Parse error:', e, response);
      }
    });
  };

  window.openmodel = function openmodel(email, name, last_name, cell, martial_status, req_id, spouse_email, spouse_name, spouse_last_name, spouse_cell, spouse_filing_with_you) {
    $('#add_attorney').modal('show');
    $('#client_first_name').val(name);
    $('#client_last_name').val(last_name);
    $('#client_email').val(email);
    $('#client_phone').val(cell);
    $('#request_id').val(req_id);
    $('#spouse_first_name').val(spouse_name);
    $('#spouse_last_name').val(spouse_last_name);
    $('#spouse_email').val(spouse_email);
    $('#spouse_cell').val(spouse_cell);

    if (martial_status == 0) {
      $('#invite_client_type>option:eq(1)').prop('selected', true);
    } else if (martial_status == 1) {
      $('#invite_client_type>option:eq(3)').prop('selected', true);
    } else if (martial_status == 2 || martial_status == 3 || martial_status == 4) {
      $('#invite_client_type>option:eq(2)').prop('selected', true);
    }

    if (typeof marital_status !== 'undefined' && (marital_status == 1 || marital_status == 2)) {
      if (spouse_filing_with_you == 0) {
        $('#invite_client_type>option:eq(3)').prop('selected', true);
      }
      if (spouse_filing_with_you == 1) {
        $('#invite_client_type>option:eq(2)').prop('selected', true);
      }
    }

    if (typeof updateShowHideDocList === 'function') updateShowHideDocList();
  };

  window.importQuestions = function importQuestions(request_id) {
    var url = cfg.routes?.questionnaire_import || '';
    ajax(url, { request_id: request_id }, function (response) {
      var res = (typeof response === 'string') ? JSON.parse(response) : response;
      if (res.status == 0) {
        $.systemMessage(res.msg, 'alert--danger', true);
      } else if (res.status == 1) {
        $.systemMessage(res.msg, 'alert--success', true);
        window.location.href = cfg.routes?.questionnaire_index || window.location.href;
      }
    });
  };

  window.deleteIntakeRequest = function deleteIntakeRequest(request_id, clname) {
    if (!confirm((window.langLbl?.confirmDelete || 'Confirm delete') + ' ' + clname + ' Short Form Questionnaire?')) {
      return;
    }
    var url = cfg.routes?.delete_intake_request || '';
    ajax(url, { request_id: request_id }, function (response) {
      var res = (typeof response === 'string') ? JSON.parse(response) : response;
      if (res.status == 0) {
        $.systemMessage(res.msg, 'alert--danger', true);
      } else {
        $.systemMessage(res.msg, 'alert--success', true);
        $('.request-' + request_id).fadeOut();
      }
    });
  };

  window.printDiv = function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    var tempDiv = document.createElement('div');
    tempDiv.innerHTML = printContents;
    tempDiv.querySelectorAll('.scrollable-div').forEach(function (el) { el.classList.remove('scrollable-div'); });
    tempDiv.querySelectorAll('.notes-section style').forEach(function (el) { el.remove(); });
    tempDiv.querySelectorAll('.intake-edit-div').forEach(function (el) { el.remove(); });
    printContents = tempDiv.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    
    // Re-initialize the modal after restoring content
    setTimeout(function() {
      // Remove any orphaned modal backdrops
      document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
        backdrop.remove();
      });
      
      // Remove modal-open class from body
      document.body.classList.remove('modal-open');
      
      // Reset body styles that Bootstrap adds
      document.body.style.overflow = '';
      document.body.style.paddingRight = '';
      
      var modalElement = document.getElementById('previewQuestionsModal');
      if (modalElement && typeof bootstrap !== 'undefined') {
        // Dispose of any existing modal instance first
        var existingInstance = bootstrap.Modal.getInstance(modalElement);
        if (existingInstance) {
          existingInstance.dispose();
        }
        
        // Create new modal instance and show it
        var modalInstance = new bootstrap.Modal(modalElement);
        modalInstance.show();
      }
    }, 100);
  };

  window.toggleMessageView = function toggleMessageView(index) {
    var $message = $('.message_no_' + index);
    if ($message.hasClass('hidden')) {
      $message.removeClass('hidden').addClass('visible');
    } else {
      $message.removeClass('visible').addClass('hidden');
    }
  };

  window.editIntakeData = function editIntakeData(obj, section) {
    $('.' + section + '.summary-div').addClass('hide-data');
    $('.' + section + '.edit-div').removeClass('hide-data');
    $(obj).addClass('hide-data');
  };

  window.closeIntakeForm = function closeIntakeForm(section) {
    $('.' + section + '.summary-div').removeClass('hide-data');
    $('.' + section + '.edit-div').addClass('hide-data');
    $('.' + section + ' a.edit').removeClass('hide-data');
  };

  window.submitIntakeForm = function submitIntakeForm(dataFor) {
    var form = $('#intake_form_save_by_attorney_' + dataFor);
    form.validate().form();
    if (!form.valid()) {
      return;
    }
    var url = form.attr('action');
    var formData = form.serialize();
    var submitBtn = form.find('.submitButton');
    submitBtn.prop('disabled', true).text('Saving...');
    ajax(url, formData, function (response) {
      try {
        var res = (typeof response === 'string') ? JSON.parse(response) : response;
        if (!res.success) {
          $.systemMessage('Error saving data.', 'alert--danger', true);
        } else {
          $.systemMessage('Data saved successfully.', 'alert--success', true);
          $('.' + dataFor + '.parent').html(res.html);
        }
      } catch (e) {
        console.error('Parse error:', e, response);
        $.systemMessage('Unexpected error occurred', 'alert--danger', true);
      } finally {
        submitBtn.prop('disabled', false).text('Save Marital Info');
      }
    }, 'POST');
  };

  window.openHistoryLogsModal = function openHistoryLogsModal(dataFor, formId) {
    var url = cfg.routes?.log_history || '';
    ajax(url, { dataFor: dataFor, formId: formId }, function (response) {
      var res = (typeof response === 'string') ? JSON.parse(response) : response;
      if (res.status == 0) {
        $.systemMessage(res.msg, 'alert--danger', true);
      } else {
        var modalContainer = document.createElement('div');
        modalContainer.innerHTML = res.html;
        document.body.appendChild(modalContainer);
        var modalElement = modalContainer.querySelector('.modal');
        if (modalElement) {
          var submitModal = new bootstrap.Modal(modalElement);
          submitModal.show();
        }
      }
    });
  };

  window.expandJSON = function expandJSON(el) {
    var parent = el.closest('.json-snippet');
    var shortText = parent.querySelector('.short-text');
    var fullText = parent.querySelector('.full-text');
    if (fullText.classList.contains('d-none')) {
      shortText.classList.add('d-none');
      fullText.classList.remove('d-none');
      el.textContent = 'Read less';
    } else {
      shortText.classList.remove('d-none');
      fullText.classList.add('d-none');
      el.textContent = 'Read more';
    }
  };
})(window, document, window.jQuery);