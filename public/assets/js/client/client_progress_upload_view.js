// Client Progress Upload View JavaScript

$(function () {
    makrnotOwn = function (client_id, document_type, thisObject) {
        var originalState = thisObject.checked;
        var status = thisObject.checked ? 1 : 0;

        var confirmMessage = status === 0 ?
            "Are you sure you want to mark it yes?" :
            "Are you sure you want to mark it no?";

        if (!confirm(confirmMessage)) {
            thisObject.checked = !originalState;
            return;
        }

        var url = window.__clientProgressUploadViewRoutes.markNotOwnDocument;
        laws.ajax(url, {
            client_id: client_id,
            document_type: document_type,
            status: status
        }, function (response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                setTimeout(function () {
                    window.location.reload();
                }, 200);
            }
        });
    }
});