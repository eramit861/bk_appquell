<script>
allowClientEditQues = function(types) {
    var clientId = "<?php echo $val['id']; ?>";
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






    laws.ajax(url, {
        for_tab: types,
        can_edit_basic_info: $("#can_edit_basic_info").prop('checked')?1:0,
        can_edit_property: $("#can_edit_property").prop('checked')?1:0,
        can_edit_debts: $("#can_edit_debts").prop('checked')?1:0,
        can_edit_income: $("#can_edit_income").prop('checked')?1:0,
        can_edit_expenase: $("#can_edit_expenase").prop('checked')?1:0,
        can_edit_sofa: $("#can_edit_sofa").prop('checked')?1:0,
        client_id: clientId
    }, function(response) {

        var res = JSON.parse(response);
        
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else if (res.status == 1) {
            $.systemMessage(res.msg, 'alert--success', true);
            setTimeout(function() {
                var redirects =
                    '<?php echo route('attorney_form_submission_view', ['id' => $val['id']]); ?>';
                window.location.href = redirects;
            }, 300);
        }
    });
}


$(function () {

  $(".accordion-content:not(:first-of-type)").css("display", "none");
 
  $(".js-accordion-title:first-of-type").addClass("open");
 
  $(".js-accordion-title").click(function () {
    $(".open").not(this).removeClass("open").next().slideUp(300);
    $(this).toggleClass("open").next().slideToggle(300);
  });
});




</script>