<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            Pay Check/Calculation
        </h5>
    </div>

    @if ($User['client_type'] == 1 || $User['client_type'] == 3)
           
        <div class="mt-4">
            @include('attorney.client.pay_check_calculation_accordian', ['accHeading' => "Debtor's Pay Stub Check", 'payCheckData' => $debtorPayCheckData, 'completeList' => $debtorCompleteList])
        </div>
        <div class="">
            @include('client.common_calculation_popup', ['title' => "Debtor's 6-Months Income (CMI)", "allReport" => $debtorAllReport])
        </div>        
        
    @endif

    @if ($User['client_type'] == 2 || $User['client_type'] == 3)
           
        <div class="">
            @include('attorney.client.pay_check_calculation_accordian', ['accHeading' => "Co-debtor's Pay Stub Check", 'payCheckData' => $codebtorPayCheckData, 'completeList' => $codebtorCompleteList])
        </div>
        <div class="">
            @include('client.common_calculation_popup', ['title' => "Co-debtor's 6-Months Income (CMI)", "allReport" => $codebtorAllReport])
        </div>
        
    @endif

</div>

<script>
    $(document).ready(function(){

        $(".section-title").on('focus', function () {
        if (!$(this).data("mouseDown"))
            $(this).click();
        });

        $(".section-title").on('mousedown', function () {
            $(this).data("mouseDown", true);
        });

        $(".section-title").on('mouseup', function () {
            $(this).removeData("mouseDown");
        });

        $(".section-title").on('click', function (e) {
            if ($(this).hasClass('open')) {
                //Close the current section
                $('.section-title').removeClass('open');
                $('.section-title .arrow-icon').removeClass('fa-angle-up').addClass('fa-angle-down');
                $('.collapsing-section').slideUp();
            } else {
                //close the prev section & open the newly click
                $('.section-title').removeClass('open');
                $('.section-title .arrow-icon').removeClass('fa-angle-up').addClass('fa-angle-down');
                $(this).find('.arrow-icon').removeClass('fa-angle-down').addClass('fa-angle-up');
                $('.collapsing-section').slideUp(); //Side up all sections that are open & remove their open class
                $(this).addClass('open');
                var sectionToOpen = $(this).next('.collapsing-section');
                $(sectionToOpen).slideDown();
            }
        });
        
        $("#pay_check_calculation_form").validate({
            errorPlacement: function (error, element) {
                if($(element).parents(".form-group").next('label').hasClass('error')){
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }else{
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            },
        });

        overridePayDate = function (thisObject, overrideDate, formattedDate) {
            var selectedOption = $(thisObject).find(' option:selected');
            var optionValue = selectedOption.val();
            var optionText = selectedOption.text();
            var confirmed = confirm("Are you sure you want to override " + formattedDate + " paystub with " + optionText + " paystub?");
            if (!confirmed) {
                $(thisObject).val('');
                return false;
            }
            var ajaxurl = "{{ route('override_paystub_date') }}";
            laws.ajax(ajaxurl, {paystub_id:optionValue, overrideDate: overrideDate }, function (response) {
                var res = JSON.parse(response);
                if (res.status == 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                }else if(res.status == 1){
                    $.systemMessage(res.msg, 'alert--success', true);
                    setTimeout(function () {
                       location.reload(true);
                    }, 2000);
                }
            });
        }
    }); 
</script>
<style>
.w-18{
    width:18% !important;
}

.p-point75{
    color: #414141;  
    padding: 0.75rem;
}
.pr-point75{
    padding-right: 0.75rem;
}
/* Accordian headers */
.section-title{
	background: #edeef0;
	display: block;
	margin: 0;
    border-bottom: 1px solid #ced4da;
}


.section-title:hover{
    cursor: default;
}
.js .collapsing-section{
    display: none;
}
.collapsing-section p{
	margin: 0;
}
label.error {color: red;font-style: italic;  }
#facebox .content.fbminwidth {
/* margin-top: 40px !important; */
min-width: 1200px;
min-height: 300px;
}
</style>
