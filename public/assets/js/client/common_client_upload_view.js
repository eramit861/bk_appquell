// Common Client Upload View JavaScript Functions

makrnotOwn = function(client_id, document_type, thisObject) {
    var status = thisObject.checked ? 1 : 0;
    var confirmMessage = status === 0 ?
        "Are you sure you want to mark it yes?" :
        "Are you sure you want to mark it no?";

    // Replace the confirm() with your custom function
    showConfirmation(confirmMessage, function(confirmed) {
        if (!confirmed) {
            $("#check_" + document_type).prop("checked", !thisObject
            .checked); // Toggle checkbox back to original state
            return;
        }

        var url = window.__commonClientUploadRoutes.markNotOwnDocument;
        laws.ajax(url, {
            client_id: client_id,
            document_type: document_type,
            status: status
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.reload();
                }, 200);
            }
        });
    });
}

makrnotOwnPaystub = function(client_id, pay_date, employer_id, thisObject) {
    var status = thisObject.checked ? 1 : 0;

    var confirmMessage = status === 0 ?
        "Are you sure you want to mark it yes?" :
        "Are you sure you want to mark it no?";

    showConfirmation(confirmMessage, function(confirmed) {
        if (!confirmed) {
            $("#dont_have_paystub_" + pay_date + "_" + employer_id).prop("checked", !thisObject
            .checked); // Toggle checkbox back to original state
            return;
        }

        var url = window.__commonClientUploadRoutes.markNotOwnPaystub;
        laws.ajax(url, {
            client_id: client_id,
            pay_date: pay_date,
            employer_id: employer_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function() {
                    window.location.reload();
                }, 200);
            }
        });
    });
}

clientShowSavedDocs = function(client_id, doc_type) {
    var ajaxurl = window.__commonClientUploadRoutes.clientDocumentsDownloadPopup;

    laws.ajax(ajaxurl, {
        client_id: client_id,
        doc_type: doc_type
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width documents_download_popup');
    });
}

removeDocumentById = function(doc_id, client_id, doc_type) {
    var url = window.__commonClientUploadRoutes.clientDocumentsDownloadPopupSingleDelete;
    laws.ajax(url, {
        client_id: client_id,
        doc_id: doc_id,
        doc_type: doc_type,
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else if (res.status == 1) {
            $.systemMessage(res.msg, 'alert--success', true);
            setTimeout(function() {
                window.location.reload();
            }, 200);
        }
    });
}
