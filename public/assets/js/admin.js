deleteClient = function (url,clid, clname) {
    showConfirmation('Do you want to mark ' +clname +' status to deleted?', function(confirmed) {
      if (confirmed) {
        laws.ajax(url, { client_id: clid }, function (response) {
          var res = JSON.parse(response);
          if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
          } else {
            $.systemMessage(res.msg, 'alert--success', true);
            $('.client-'+clid).fadeOut();
          }
        });
      }
    });
  };

  deleteClientPermanently = function (url,clid, clname) {
    showConfirmation('Do you want to permanently delete ' +clname +'?', function(confirmed) {
      if (confirmed) {
        laws.ajax(url, { client_id: clid }, function (response) {
          var res = JSON.parse(response);
          if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
          } else {
            $.systemMessage(res.msg, 'alert--success', true);
            $('.client-'+clid).fadeOut();
          }
        });
      }
    });
  };

  restoreClient = function (url,clid, clname) {
    showConfirmation('Do you want to mark ' +clname +' status to active?', function(confirmed) {
      if (confirmed) {
        laws.ajax(url, { client_id: clid }, function (response) {
          var res = JSON.parse(response);
          if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
          } else {
            $.systemMessage(res.msg, 'alert--success', true);
            $('.client-'+clid).fadeOut();
          }
        });
      }
    });
  };

  deleteExemption = function(url, recordId){
    laws.ajax(url, { id: recordId }, function (response) {
      var res = JSON.parse(response);
      if (res.status == 0) {
        $.systemMessage(res.msg, 'alert--danger', true);
      } else {
        $.systemMessage(res.msg, 'alert--success', true);
        
        $('.exemption-'+recordId).fadeOut();
        setTimeout(function () {
         location.reload(true);
        }, 2000);
        
  
      }
    });
  }
 
  clientChangeStatus = function (id,ustatus, url, isAdmin=false) {
    showConfirmation(langLbl.confirmChange, function(confirmed) {
      if (confirmed) {
        laws.ajax(url, { client_id: id,status:ustatus }, function (response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
          $.systemMessage(res.msg, 'alert--danger', true);
        } else {
          $.systemMessage(res.msg, 'alert--success', true);
          if(isAdmin){
            setTimeout(function () {
            location.reload(true);
            }, 1500);
          } else{
            $('.client-'+id).fadeOut();
          }
        }
      });
      }
    });
  };

  clientCaseFiledInfoPreviewPopup = function(client_id, ajaxurl, tab, container) {
		laws.ajax(ajaxurl, {
			client_id: client_id,
      status: tab
		}, function(response) {
			 var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
            clientCaseStatusSelectReset(id);
        } else {
            laws.updateFaceboxContent(res.html, 'large-fb-width bg-unset min-w-750px'); 
            revertCasePillSelection(container, tab == 'filed' ? 1 : 0);
        }
		});
	}

  clientCaseFiledInfoPopup = function(element, id, popupUrl) {
    const ustatus = element.value;
    if (ustatus === "") {
      clientCaseStatusSelectReset(id);
      return;
    }

    if (ustatus === "1") {
      laws.ajax(popupUrl, {
        client_id: id,status:ustatus
      }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
            clientCaseStatusSelectReset(id);
        } else {
            laws.updateFaceboxContent(res.html, 'large-fb-width bg-unset min-w-750px'); 
        }
      });
    }
	}

  function handleCaseStatusPillClick(button, newStatus) {
    var container = button.closest('.property-tab-pills');
    var clientId = container.getAttribute('data-client-id');
    var currentStatus = parseInt(container.getAttribute('data-current-status'));
    var popupUrl = container.dataset.popupUrl;

    // Avoid redundant click
    if (currentStatus === (newStatus ? 1 : 0)) {
        return;
    }
    // revertCasePillSelection(container, newStatus);
    clientCaseFiledInfoPreviewPopup(clientId, popupUrl, newStatus ? 'filed' : 'not_filed', container);    
  }

  function revertCasePillSelection(container, status) {
      var buttons = container.querySelectorAll('.property-pill');
      buttons.forEach(btn => btn.classList.remove('active'));

      if (status === 1) {
          container.querySelector('.enabled').classList.add('active');
      } else {
          container.querySelector('.disabled').classList.add('active');
      }
  }



  clientCaseStatusSelectReset = function (id) {
    let caseSelect = $('#case_filed_'+id);
    caseSelect.val('0');
  };
  
  resendInvite = function (id, url) {
    showConfirmation(langLbl.confirmResend, function(confirmed) {
			if (confirmed) {
        laws.ajax(url, { client_id: id }, function (response) {
          var res = JSON.parse(response);
          if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
          } else {
            $.systemMessage(res.msg, 'alert--success', true);
          }
        });
	    }
		});    
  };
  

  deleteDocument = function (url,attid, clname, is_associate = 0, associate_id = '') {
  if (!confirm(langLbl.confirmDelete+ " " +clname +'?')) {
    return;
  }
  laws.ajax(url, { document_id: attid, is_associate: is_associate, associate_id: associate_id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.row-'+attid).fadeOut();
      updatePaginationText(res.div);
    }
  });
};

function updatePaginationText(selector) {
    var $pagination = $('.'+selector);
    var text = $pagination.text().trim();

    // Match "Showing 1 to 10 of 12 entries"
    var match = text.match(/Showing\s+(\d+)\s+to\s+(\d+)\s+of\s+(\d+)/i);
    if (match) {
      var from = parseInt(match[1], 10);
      var to = parseInt(match[2], 10);
      var total = parseInt(match[3], 10);

      to = Math.max(from, to - 1);
      total = Math.max(0, total - 1);

      var newText = `Showing ${from} to ${to} of ${total} entries`;
      $pagination.text(newText);
    }
  }

deleteAttorney = function (url,attid, clname) {
  if (!confirm(langLbl.confirmDelete+ " " +clname +'? All associated data with this account will be lost permanently.')) {
    return;
  }
  laws.ajax(url, { attorney_id: attid }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      
      $('.attorney-'+attid).fadeOut();
     location.reload(true);

    }
  });
};

deleteState = function (url, stateid) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  //url = $("#deleteStateUrl"+stateid).val();
  laws.ajax(url, { state_id: stateid }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.state-'+stateid).fadeOut();
    }
  });
};

deleteCompany = function (url, recordId) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { id: recordId }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.id-'+recordId).fadeOut();
     location.reload(true);
    }
  });
};

deleteDomestic = function (url, id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { id: id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.row-'+id).fadeOut();
     location.reload(true);
    }
  });
};


deleteCreditors = function (url, id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { id: id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.row-'+id).fadeOut();
     location.reload(true);
    }
  });
};

deleteCourthouses = function (url, id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { id: id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.row-'+id).fadeOut();
     location.reload(true);
    }
  });
};


acceptDocument = function (key, url, dstatus, clientId, element, file_url,doc_id=0 ) {
  if (!confirm(langLbl.confirmApprove)) {
    return;
  }
  $.systemMessage("Updating status..", 'alert--process');
  laws.ajax(url, { document_type: key, document_status:dstatus, client_id:clientId,file_url:file_url,doc_id:doc_id}, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      updateUploadedDocsHtml(key, clientId);
      $.systemMessage(res.msg, 'alert--success', true);
    }
  });
}; 

declineDocument = function (key, url, dstatus, clientId, file_url,doc_id=0) {
  if (!confirm(langLbl.confirmDecline)) {
    return;
  }
  laws.ajax(url, { document_type: key, document_status:dstatus, client_id:clientId,file_url:file_url,doc_id:doc_id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
    
     location.reload(true);

    }
  });
};

deleteDocDocument = function (key, url,clientId, elemt,file_url,document_id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  $.systemMessage("Deleting document..", 'alert--process');
  laws.ajax(url, { type: key, client_id:clientId,file_url:file_url,document_id:document_id}, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      updateUploadedDocsHtml(key, clientId);
      $.systemMessage(res.msg, 'alert--success', true);
    }
  });
};

deleteBankType = function(document_type, client_id, ajaxurl){
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  var requestData = {
      document_type: document_type,
      client_id: client_id
  };
  laws.ajax(ajaxurl, requestData, function (response) {
      var res = JSON.parse(response);
      if (res.status == 0) {
          $.systemMessage(res.msg, 'alert--danger', true);
      } else {
          var parentForm = $('.main_form_'+document_type+'#'+document_type);
          parentForm.fadeOut();
          setTimeout(function () {
            parentForm.remove();
          }, 1500);
          $.systemMessage(res.msg, 'alert--success', true);
      }
  });
}

deleteChildDocument = function (key, url,clientId, doc_id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { type: key, client_id:clientId,doc_id:doc_id}, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
     location.reload(true);
      // $(elemt).parent().parent().hide("slow");
    }
  });
};

requestForReuploadDoc = function (key, url, dstatus, clientId, element, file_url,document_status,doc_id = 0) {
  if (!confirm(langLbl.confirmReuploading)) {
    return;
  }
 /* laws.displayProcessing();	*/
  laws.ajax(url, { document_type: key, document_enable_reupload:dstatus, client_id:clientId,file_url:file_url,document_status:document_status,doc_id:doc_id}, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      
    }
  });

}; 



// 20-09-2022 Jump To
$(document).ready(function() {
  // Cache our vars for the fixed sidebar on scroll
  var $sidebar = $('#questionnaire-sidebar-nav');
  $sidebar.addClass('sticky');

  $(document).on("blur",'.input_capitalize', function() {
    let value = $(this).val().toLowerCase();;
    let capitalizedValue = value.replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    });
    $(this).val(capitalizedValue);
  });

});

deleteCountyFIPS = function (url, id) {
  if (!confirm(langLbl.confirmDelete)) {
    return;
  }
  laws.ajax(url, { state_id: id }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      $('.state-'+id).fadeOut();
    }
  });
};

// Array to hold selected row ids
let selectedIds = [];

// Handle checkbox click event
$('.select-row').on('change', function() {
    let rowId = $(this).val();
    let row = $(this).closest('tr');

    // Toggle 'selected' class on the row
    if ($(this).is(':checked')) {
        row.addClass('selected selected-row');
        selectedIds.push(rowId); // Add id to selected list
    } else {
        row.removeClass('selected selected-row');
        selectedIds = selectedIds.filter(id => id != rowId); // Remove id from selected list
    }

    // Display or hide the delete button
    toggleDeleteButton();
});

// Handle checkbox click event
$('.select-govt-row').on('change', function() {
  let rowId = $(this).val();
  let row = $(this).closest('tr');

  // Toggle 'selected' class on the row
  if ($(this).is(':checked')) {
      row.addClass('selected selected-row');
      selectedIds.push(rowId); // Add id to selected list
  } else {
      row.removeClass('selected selected-row');
      selectedIds = selectedIds.filter(id => id != rowId); // Remove id from selected list
  }

  // Display or hide the delete button
  toggleImportToCreditorButton();
  toggleImportToMortgageButton();
});

// Toggle delete button visibility
function toggleDeleteButton() {
    if (selectedIds.length > 0) {
        $('#deleteSelectedButton').show(); // Show the button
        $('#deleteSelectedButton span').text(selectedIds.length); // Update the count
    } else {
        $('#deleteSelectedButton').hide(); // Hide the button if no rows are selected
    }
}

// Toggle delete button visibility
function toggleImportToCreditorButton() {
    if (selectedIds.length > 0) {
        $('#importToCreditorButton').show(); // Show the button
        $('#importToCreditorButton span').text(selectedIds.length); // Update the count
    } else {
        $('#importToCreditorButton').hide(); // Hide the button if no rows are selected
    }
}

// Toggle delete button visibility
function toggleImportToMortgageButton() {
    if (selectedIds.length > 0) {
        $('#importToMortgageButton').show(); // Show the button
        $('#importToMortgageButton span').text(selectedIds.length); // Update the count
    } else {
        $('#importToMortgageButton').hide(); // Hide the button if no rows are selected
    }
}
// Function to delete selected companies (example implementation)
function deleteSelectedEntries(url, message) {
  if (!confirm(message)) {
    return;
  }
  laws.ajax(url, { selectedIds: selectedIds }, function (response) {
    var res = JSON.parse(response);
    if (res.status == 0) {
      $.systemMessage(res.msg, 'alert--danger', true);
    } else {
      $.systemMessage(res.msg, 'alert--success', true);
      setTimeout(function() {
        location.reload(true);
      }, 1500);
    }
  });
}

function validateForm(formId) {
  $("#"+formId).validate({
    errorPlacement: function(error, element) {
        if ($(element).parents(".form-group").next('label').hasClass('error')) {
            $(element).parents(".form-group").next('label').remove();
            $(element).parents(".form-group").after($(error)[0].outerHTML);
        } else {
            $(element).parents(".form-group").after($(error)[0].outerHTML);
        }
        $(element).parents(".form-group").addClass('mb-0');
    },
    success: function(label, element) {
        label.parent().removeClass('error');
        $(element).parents(".form-group").removeClass('mb-0');
        $(element).parents(".form-group").next('label').remove();
    },
  });
}
