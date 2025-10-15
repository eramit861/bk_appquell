<div class="sign_up_bgs">
    <div class="container-fluid">
        <div class="row py-0 page-flex">
            <div class="col-md-12">
                <div class="form_colm row px-md-5 py-4">
                    <div class="col-md-12 mb-3">
                        <div class="title-h mt-1 d-flex">

                            <h4><strong>Add reason for {{ $label}} the doc </strong></h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="align-left">
                                    <form method="POST" action="">
                                        <div>
                                            @csrf
                                            <div class="form_bgp">
                                                <div class="input-group mb-3">
                                                    <select name="selected_reason" class="form-control" id="selected_reason">
                                                        <option value="">{{ __('Choose reason') }}</option>
                                                        <option value="Not readable">{{ __('Not readable') }}</option>
                                                        <option value="Too Dark">{{ __('Too Dark') }}</option>
                                                        <option value="Other">{{ __('Other') }}</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <textarea rows="6" name="document_decline_reason" class="form-control hide-data noadjust required" id="document_decline_reason" placeholder="{{ __('Description') }}"> </textarea>
                                                    <input id="reason_document_type" type="hidden" value="<?php echo $document_type; ?>" name="document_type">
                                                    <input id="reason_client_id" type="hidden" value="<?php echo $client_id; ?>" name="client_id">
                                                    <input type="hidden" value="<?php echo $document_status; ?>" name="document_status" id="document_status">
                                                </div>
                                                <div class="login-btn action-auth">
                                                    <a href="javascript:void(0)" onclick="setupDeclineDocs('<?php echo route('client_document_status'); ?>', '<?php echo $file_url; ?>','<?php echo $doc_id; ?>')" class="btn btn-primary shadow-2 mb-4">{{ __('Submit') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#selected_reason").change(function() {
        if ($("#selected_reason").val() == "Other") {

            $("#document_decline_reason").removeClass("hide-data");
        } else {
            $("#document_decline_reason").addClass("hide-data");
        }
    });

    setupDeclineDocs = function(url, file_url, doc_id = 0) {
        var key = $("#reason_document_type").val();
        var dstatus = $("#document_status").val();
        var clientId = $("#reason_client_id").val();
        if ($("#selected_reason").val() == "") {
            $.systemMessage("Please choose reason to decline the doc", 'alert--danger', true);
            return false;
        }
        var document_decline_reason = $("#document_decline_reason").val();
        if ($("#selected_reason").val() == "Other" && $.trim(document_decline_reason) == '') {
            $.systemMessage("Please mention reason to decline the doc", 'alert--danger', true);
            return false;
        }
        if ($("#selected_reason").val() != "Other") {
            document_decline_reason = $("#selected_reason").val();
        }
        $.systemMessage("Updating status..", 'alert--process');
        laws.ajax(url, {
            document_type: key,
            document_status: dstatus,
            client_id: clientId,
            document_decline_reason: document_decline_reason,
            file_url: file_url,
            doc_id: doc_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
                $.facebox.close();
            } else {
                $.facebox.close();
                updateUploadedDocsHtml(key, clientId);
                $.systemMessage(res.msg, 'alert--success', true);
            }
        });


    }
</script>