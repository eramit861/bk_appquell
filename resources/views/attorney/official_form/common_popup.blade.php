<script>

$(document).on("input", ".is_ssn", function(evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/,'$1-$2-$3'));
    var first10 = $(this).val().substring(0, 11);
    if (this.value.length > 11) {
        this.value = first10;
    }
});

$(document).on("input", ".eiin", function(evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/(\d{2})\-?(\d{7})/,'$1-$2'));
    var first10 = $(this).val().substring(0, 10);
    if (this.value.length > 10) {
        this.value = first10;
    }
});

$(document).on("input", ".phone-field", function(evt){
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
    var first10 = $(this).val().substring(0, 14);
    if (this.value.length > 14) {
        this.value = first10;
    }
});

        var setting = {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        style: 'currency',
        currency: 'USD'
    };
    function validateNumberData(id) {
        if (!$(id).val() || $(id).val() === undefined) {
            return 0;
        }

        return $(id).val().replace(/,/g, '');
    }

    $(".price-field").on({keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        // get input value
        var input_val = input.val();
        // don't validate empty input
        if (input_val === "") {
            if (blur === "blur") {
                input.val('0.00');
                return;
            } else {
                return;
            }
        }
        // original length
        var original_len = input_val.length;
        // initial caret position
        var caret_pos = input.prop("selectionStart");
        // check for decimal
        if (input_val.indexOf(".") >= 0) {
            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");
            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);
            // add commas to left side of number
            left_side = formatNumber(left_side);
            // validate right side
            right_side = formatNumber(right_side);
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);
            // join number by .
            input_val = left_side + "." + right_side;
        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }
        // send updated string to input
        input.val(input_val);
        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    $(document).on("keyup", ".mortgage-monthly-payments", function(evt) {
        $(this).closest(".row").find(".mortgage-payment-total").val(parseFloat($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".mortgage_payment-remaining-number").val().replace(/,/g, '')).toLocaleString());
        $(this).closest(".row").find(".mortgage-payment-total").blur();
    });

    $(document).on("keyup", ".monthly-payments", function(evt) {
        $(this).closest(".row").find(".vehicle-payment-total").val(parseFloat($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".payment-remaining-number").val().replace(/,/g, '')).toLocaleString());
        $(this).closest(".row").find(".vehicle-payment-total").blur();
    });

    $(document).on("change", ".payment-remaining-number", function(evt) {
        if ($(this).val()) {
            $(this).closest(".row").find(".vehicle-payment-total").val(parseFloat($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".monthly-payments").val().replace(/,/g, '')).toFixed(2).toLocaleString('en-IN', setting));
            $(this).closest(".row").find(".vehicle-payment-total").blur();
        }
    });

    $(document).on("change", ".mortgage_payment-remaining-number", function(evt) {
        if ($(this).val()) {
            $(this).closest(".row").find(".mortgage-payment-total").val(parseFloat($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".mortgage-monthly-payments").val().replace(/,/g, '')).toFixed(2).toLocaleString('en-IN', setting));
            $(this).closest(".row").find(".mortgage-payment-total").blur();
        }
    });

    calculateVehicleLoand = function() {
        $('.payment-remaining-number').each(function(index) {
            $(this).closest(".row").find(".vehicle-payment-total").val($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".monthly-payments").val().replace(/,/g, ''));
            $(this).closest(".row").find(".vehicle-payment-total").blur();
        });
    }

    calculateMortages = function() {
        $('.mortgage_payment-remaining-number').each(function(index) {
            $(this).closest(".row").find(".mortgage-payment-total").val(parseFloat($(this).val().replace(/,/g, '') * $(this).closest(".row").find(".mortgage-monthly-payments").val().replace(/,/g, '')).toLocaleString());
            $(this).closest(".row").find(".mortgage-payment-total").blur();
        });
    }
</script>
<style>
    .price_dots_label {
        background-image: linear-gradient(to right, #000 20%, rgba(255, 255, 255, 0) 0%);
        background-position: 0 14px;
        background-size: 10px 1px;
        background-repeat: repeat-x;
        width: 100%;
    }



    .input-group-prepend input[type=text] {
        border-left: none;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .basic-addon1 {
        margin-top: 6px;
        margin-left: 0px;
    }

    .input-group-text {
        background-color: transparent;
        border-radius: 0px !important
    }

    input[type="text"].form-control {
        padding-bottom: 0px;
    }

    .text-c-blue {
        color: #012cae !important;
    }

    .self-class {
        font-family: sans-serif;
    }

    .full-text {
        max-width: 80px;
        min-width: 92px;
    }

    .profitlosspopup .input-groups input[type="text"].form-control {
        padding-left: 0;
        padding-top: 5px;
        padding-right: 5px;
    }

    .profitlosspopup .input-group .debtor_per_month_net {
        padding-left: 0;
    }

    .cs-bd input[type="text"].form-control {
        font-weight: bold;
    }

    .cs-bd span.input-group-text {
        font-weight: 500;
    }

    span.creditors {
        display: block;
        font-weight: 600;
        font-size: 10px;
    }

    .cs-min-h {
        min-height: 21px;
    }

    .headingtexdt {
        font-size: 16px !important;
        font-weight: bold;
    }

    .text-underline {
        text-decoration: underline;
    }

    .smallh {
        font-size: 12px !important;
        font-weight: bold;
    }

    .payment-mtgr {
        font-size: 14px;
        font-weight: 600;
        text-decoration: underline;
    }

    .tbl-resive-cs table.table {
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
    }

    .tbl-resive-cs table.table th {
        text-align: left;
        background: #f8f8f8;
        padding: 5px 8px;
    }

    .tbl-resive-cs table.table tr td {
        border: 1px solid #ccc;
        padding: 5px 8px;
    }

    .tbl-resive-cs table.table tr td textarea {
        height: 29px;
        /* max-width: 370px; */
        appearance: none;
        padding-left: 0;
        padding-bottom: 0;
    }

    .pop_tile_main {
        justify-content: center;
        align-items: center;
    }

    .pop_tile_main .meantest-img {
        margin-left: 5px;
    }

    .flx_cs_add {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    /***************/
    .switch {
        position: relative;
        display: inline-block;
        width: 53px;
        height: 9px;
    }

    .text-center.btn-cstm-toggle {
        position: absolute;
        top: 2px;
        z-index: 9;
        width: 100%;
        padding: 0px 19px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 5px;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        width: 46px;
    }

    .slider-second-text {
        margin-left: 5px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 19px;
        left: 1px;
        bottom: -5px;
        background-color: black;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    /*TOGGLE END*/
    input[type="radio"] {
        width: 18px;
        height: 18px;
        vertical-align: middle;
        margin: 0 4px;
    }

    .width-cust {
        width: 96px;
        float: right;
    }

    .payment-box {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    input[type="text"].form-control.input-green-background {
        border: green 1px solid !important;
        color: green;
    }

    input[type="text"].form-control.input-red-background {
        border: red 1px solid !important;
        color: red;
    }


    /***************/

    @media only screen and (min-width:992px) {
        .w2_income label.price_dots_label {
            position: relative;
            top: 7px;
        }

        .spouse_w2_income label.price_dots_label {
            position: relative;
            top: 7px;
        }

        .cs-bd strong {
            padding-top: 7px;
            display: block;
        }

        .opt-bs label.price_dots_label {
            position: relative;
            top: 7px;
        }

    }

    .headingpm {
        background: #efefef;
        padding-bottom: 3px;
        padding-top: 3px;
        margin-top: 5px;
        border-left: 5px solid #fff;
    }
</style>