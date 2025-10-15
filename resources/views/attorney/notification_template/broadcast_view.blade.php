<form id="broadcast_form" action="{{route('notification_brodcast_setup')}}" method="post" novalidate>
    @csrf
    <div class="row">

        <div class="col-md-6 col-12">
            <div class="light-gray-div mt-2">
                <div class="light-gray-box-form-area">
                    <h2 class="align-items-center">
                        <span class="">Client(s)</span>                    
                    </h2>
                    <div class="row gx-3 set-mobile-col">
                        <div class="col-12 ">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">Choose Client(s) you want to notify</label>
                                    <div class="dropdown w-100">
                                        <button class="year-btn form-control dropdown-toggle mb-0 w-auto"
                                            type="button" data-bs-toggle="dropdown">
                                            <span class="dropdown-text">Choose Client(s)</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu py-2">
                                            <li>
                                                <label class="justone-label">
                                                    <input type="checkbox" class="selectall"
                                                        data-inputname="preview"
                                                        data-inputfor="client" onchange="setSelectAll(event, this)" />
                                                    <span class="select-text"> Select</span> All
                                                </label>
                                            </li>
                                            <li class="divider"></li>
                                            <?php foreach ($clients as $index => $client) { ?>
                                            <li class="justone-li">
                                                <label class="justone-label" for="<?php echo 'client_'.$client['id'];?>">
                                                    <input type="checkbox" class="option justone client"
                                                        name="selected_clients[]"
                                                        data-inputname="preview"
                                                        data-inputfor="client"
                                                        id="<?php echo 'client_'.$client['id'];?>"
                                                        value='<?php echo $client['id'];?>'
                                                        onchange="setJustOne(event, this)" />
                                                    <?php echo '('.$client['id'].') '.$client['name'];?>
                                                </label>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="client_preview label-div">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="light-gray-div mt-2">
                <div class="light-gray-box-form-area">
                    <h2 class="align-items-center">
                        <span class="">Template</span>                    
                    </h2>
                    <div class="row gx-3 set-mobile-col">
                        <div class="col-12 ">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">Choose a Template</label>
                                    <?php if (!empty($templates) && count($templates) > 0) {?>
                                        <select name="selected_template" class="form-control w-auto">
                                            <option>Choose Template</option>
                                            <?php foreach ($templates as $key => $val) { ?>
                                                <option value="<?php echo $val['id'];?>"><?php echo $val['noti_tenp_subject'];?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <p class="mt-3">No Templates added yet.</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="template_preview label-div">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="bottom-btn-div align-items-md-center align-items-start d-flex flex-md-row flex-column">
                <div class="d-flex flex-sm-row flex-column">
                <div class="form-check form-group mb-0 me-3">
                    <label class="form-check-label" for="email">
                        <input type="checkbox" id="email" name="email" class="form-check-input" value="1">
                        Select to send Email
                    </label>
                </div>
                
                <div class="form-check form-group mb-0 me-3">
                    <label class="form-check-label" for="mobile">
                        <input type="checkbox" id="mobile" name="mobile" class="form-check-input" value="1">
                        Select to send Text Message
                    </label>
                </div>
                </div>
                <div class="d-flex flex-sm-row flex-column">
                <button type="submit" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 mt-sm-0 mt-1" data-bs-dismiss="modal">Click here to Send</button>
                <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 mt-sm-0 mt-1" onclick="resetForm()" >Reset</button>
            </div>
        </div></div>
        
    </div>
</form>

<script>
     function resetForm() {
        window.location.href = "{{ route('notification_template_list',['type'=> 'broadcast']) }}";
    }
    $(document).ready(function () {

        var templates = <?php echo json_encode($templates, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

        // Prevent dropdown from closing when clicking inside
        $('.dropdown-menu').on('click', function (event) {
            event.stopPropagation();
        });

        $('select[name="selected_template"]').on('change', function () {
            var selectedTemplateId = $(this).val(); // Get selected template ID

            if (selectedTemplateId && templates) {
                var selectedTemplate = templates.find(t => t.id == selectedTemplateId);

                if (selectedTemplate) {
                    var subject = selectedTemplate.noti_tenp_subject || "No Subject";
                    var body = selectedTemplate.noti_tenp_body ? selectedTemplate.noti_tenp_body.replace(/\n/g, "<br>") : "No Body";

                    // Display template preview
                    $(".template_preview").html(`
                        <label>Template Preview</label>
                        <div class='preview form-control h-unset template-preview'>
                            <p><strong>Subject:</strong></br> ${subject}</p>
                            <p class="mb-0"><strong>Body:</strong></br> ${body}</p>
                        </div>
                    `);
                } else {
                    $(".template_preview").html("<label>Invalid Template Selected</label>");
                }
            } else {
                $(".template_preview").html("<label>No Template Selected</label>");
            }
        });

        // $(".client_preview").html(`<label>Selected Clients</label><span class='form-control h-unset client-preview'>${selectedClients.join(", ")}</span>`);


        $("#broadcast_form").submit(function (event) {
            var selectedClients = $("input[name='selected_clients[]']:checked").length;
            var selectedTemplate = $("select[name='selected_template']").val();
            var emailChecked = $("#email").is(':checked');
            var mobileChecked = $("#mobile").is(':checked');

            if (selectedClients === 0) {
                event.preventDefault(); // Stop form submission
                $.systemMessage('Select clients first', 'alert--danger', true);
                return;
            }

            if (!selectedTemplate || selectedTemplate === "Select Template") {
                event.preventDefault(); // Stop form submission
                $.systemMessage('Select a template first', 'alert--danger', true);
                return;
            }

            if (!emailChecked && !mobileChecked) {
                event.preventDefault(); // Stop form submission
                $.systemMessage('Select at least one broadcast method (Email or Mobile)', 'alert--danger', true);
                return;
            }
		});

    });

    function setSelectAll(event, thisObj) {
        event.stopPropagation(); 
        var inputFor = $(thisObj).data('inputfor');
        
        if ($(thisObj).is(':checked')) {
            $("input.justone." + inputFor).prop('checked', true);
            $(".select-text").html('Deselect');
        } else {
            $("input.justone." + inputFor).prop('checked', false);
            $(".select-text").html('Select');
        }
        
        setSpaceSeparatedString(inputFor);
    }

    function setJustOne(event, thisObj) {
        event.stopPropagation(); 
        var inputFor = $(thisObj).data('inputfor');
        var allCheckboxes = $("input.justone." + inputFor);
        
        if (allCheckboxes.length === allCheckboxes.filter(":checked").length) {
            $('.selectall').prop('checked', true);
            $(".select-text").html('Deselect');
        } else {
            $('.selectall').prop('checked', false);
            $(".select-text").html('Select');
        }

        setSpaceSeparatedString(inputFor);
    }

    function setSpaceSeparatedString(inputFor) {
        var selectedClients = [];
        
        $("input.justone." + inputFor + ":checked").each(function() {
            var clientId = $(this).val();
            var clientName = $(this).closest("label").text().trim(); // Get client name from label
            
            selectedClients.push(`${clientName}`);
        });

        $(".client_preview").html(`<label>Selected Clients</label><span class='form-control h-unset client-preview'>${selectedClients.join(", ")}</span>`);
    }

</script>