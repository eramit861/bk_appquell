$(document).ready(function () {
    $("#register_form").validate({
        rules: {
            email: {
                required: true,
                email: true,
                pattern: /^[^@]+@[^@]+\.[^@]+\.com$/i
            }
        },
        messages: {
            email: {
                pattern: "Please enter a valid email address ending with .com"
            }
        },
        errorPlacement: function (error, element) {
            if ($(element).parents(".form-group").next('label').hasClass('error')) {
                $(element).parents(".form-group").next('label').remove();
                $(element).parents(".form-group").after($(error)[0].outerHTML);
            } else {
                $(element).parents(".form-group").after($(error)[0].outerHTML);
            }
        },
        success: function (label, element) {
            label.parent().removeClass('error');
            $(element).parents(".form-group").next('label').remove();
        },
    });
});
$(document).on('input', ".allow-5digit", function (e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if ((e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});