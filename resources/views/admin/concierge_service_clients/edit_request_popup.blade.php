<div class="d-flex"><h4 class=""><span class="border-bottom-light-blue">Allow client to edit following requested questionnaire:</span></h4>
   <label class="mt-1 ml-1">
    
    <?php
    $request_edit_access_types = Helper::validate_key_value('request_edit_access_types', $formstep);
    $request_edit_access_types = !empty($request_edit_access_types) ? json_decode($request_edit_access_types, true) : [];
    ?>
    <?php
        $types = [];
    foreach ($request_edit_access_types as $key => $status) {
        if ($status == 1) {
            $types[] = Helper::getRequestedTabByName($key);
        }
    }
    echo "<span class='mt-2 text-c-red'>".implode(', ', $types)."</span>";
    ?>
    <small class="ml-2"><i>(Requested at: <?php echo DateTimeHelper::dbDateToDisplay(Helper::validate_key_value('request_edit_access_time', $formstep), true); ?>)</i></small>
</label>
</div>
@include("attorney.client.edit_questionnaire_common")






<style>
    #facebox .content.fbminwidth {
        min-width: 650px;
        max-width: 10240px;
        min-height: 150px;
    }
</style>

<script>
    allowClientEditQues = function(types) {
        var clientId = "<?php echo $client_id; ?>";
        var url = '<?php echo route("allow_client_edit_ques");?>';
    
        
        if (types == 'can_edit_basic_info') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit Basic information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                    can_edit_basic_info = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit Basic information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_basic_info = 0;
                }
            }

        }
        if (types == 'can_edit_property') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit Property Information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                can_edit_property = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit Property information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_property = 0;
                }
            }
        }
        if (types == 'can_edit_debts') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit Debts Information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                    can_edit_debts = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit Debts information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_debts = 0;
                }
            }
        }
        if (types == 'can_edit_income') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit Income Information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                can_edit_income = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit Income information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_income = 0;
                }
            }
        }
        if (types == 'can_edit_expenase') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit Expenase Information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                can_edit_expenase = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit Expenase information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_expenase = 0;
                }
            }
        }
        if (types == 'can_edit_sofa') {
            if ($("#" + types).prop('checked')) {
                if (!confirm("Are you sure you want client to edit SOFA Information?")) {
                    $("#" + types).prop('checked',false);
                    return;
                }else{
                can_edit_sofa = 1;
                }
            } else {
                if (!confirm("Are you sure you want client not to edit SOFA information?")) {
                    $("#" + types).prop('checked',true);
                    return;
                }else{
                    can_edit_sofa = 0;
                }
            }
        }
        var isAdmin = "<?php echo $isAdmin; ?>";
        var isAttorney = "<?php echo $isAttorney; ?>";

        laws.ajax(url, {
            for_tab: types,
            can_edit_basic_info: $("#can_edit_basic_info").prop('checked')?1:0,
            can_edit_property: $("#can_edit_property").prop('checked')?1:0,
            can_edit_debts: $("#can_edit_debts").prop('checked')?1:0,
            can_edit_income: $("#can_edit_income").prop('checked')?1:0,
            can_edit_expenase: $("#can_edit_expenase").prop('checked')?1:0,
            can_edit_sofa: $("#can_edit_sofa").prop('checked')?1:0,
            client_id: clientId,
            isAdmin: isAdmin,
            isAttorney: isAttorney,
        }, function(response) {

            var res = JSON.parse(response);
            
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else if (res.status == 1) {
                $.systemMessage(res.msg, 'alert--success', true);
                // setTimeout(function () {
				// 	location.reload();
				// }, 2000);
            }
        });
    }
</script>