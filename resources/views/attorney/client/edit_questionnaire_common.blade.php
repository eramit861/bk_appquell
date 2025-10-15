<div class="row dis_client mt-2">
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php echo Helper::validate_key_toggle('can_edit_basic_info', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_basic_info')" type="checkbox"
                class="packages" id="can_edit_basic_info"
                name="can_edit_basic_info" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                    $src = asset('assets/img/group-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_basic_info', $formstep) == 1) {
                $src = asset('assets/img/group-white-icon.svg');
            }
            ?>
                <img class="group_img" src="<?php echo $src; ?>" alt=" Basic Information">
                    <p class="text-bold"> 
                        Basic Information
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php  echo Helper::validate_key_toggle('can_edit_property', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_property')" type="checkbox"
                class="packages" id="can_edit_property"
                name="can_edit_property" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                $src = asset('assets/img/group1-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_property', $formstep) == 1) {
                $src = asset('assets/img/group1-white-icon.svg');
            }
            ?>
                <img class="group_img" src="<?php echo $src; ?>" alt="Property">
                    <p class="text-bold"> 
                        Property 
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php  echo Helper::validate_key_toggle('can_edit_debts', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_debts')" type="checkbox"
                class="packages" id="can_edit_debts"
                name="can_edit_debts" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                $src = asset('assets/img/group2-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_debts', $formstep) == 1) {
                $src = asset('assets/img/group2-white-icon.svg');
            }
            ?>
                    <img class="group_img" src="<?php echo $src; ?>" alt="Debts">
                    <p class="text-bold"> 
                        Debts
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php  echo Helper::validate_key_toggle('can_edit_income', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_income')" type="checkbox"
                class="packages" id="can_edit_income"
                name="can_edit_income" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                $src = asset('assets/img/group3-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_income', $formstep) == 1) {
                $src = asset('assets/img/group3-white-icon.svg');
            }
            ?>
                <img class="group_img" src="<?php echo $src; ?>" alt="Current Income">
                    <p class="text-bold"> 
                        Current Income
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php  echo Helper::validate_key_toggle('can_edit_expenase', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_expenase')" type="checkbox"
                class="packages" id="can_edit_expenase"
                name="can_edit_expenase" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                $src = asset('assets/img/group4-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_expenase', $formstep) == 1) {
                $src = asset('assets/img/group4-white-icon.svg');
            }
            ?>
                <img class="group_img" src="<?php echo $src; ?>" alt="Current Expenses">
                    <p class="text-bold"> 
                        Current Expenses
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <label class="card_question box_div package-101 mt-2">
            <input <?php  echo Helper::validate_key_toggle('can_edit_sofa', $formstep, 1); ?>
                onchange="allowClientEditQues('can_edit_sofa')" type="checkbox"
                class="packages" id="can_edit_sofa"
                name="can_edit_sofa" value="1">
            <span class="check_div">
                <i class="fas fa-check-circle"></i>
                <div class="package-desc">
                <?php
                $src = asset('assets/img/group5-gray-icon.svg');
            if (Helper::validate_key_value('can_edit_sofa', $formstep) == 1) {
                $src = asset('assets/img/group5-white-icon.svg');
            }
            ?>
                <img class="group_img" src="<?php echo $src; ?>" alt="Statement of Financial Affairs">
                    <p class="text-bold"> 
                        Statement of Financial Affairs
                    </p>
                    <!-- <input type="hidden" name="package-price-<?php echo '';?>" value=""> -->
                </div>
            </span>
        </label>
    </div>
</div>

<style>
    .card_question input {
        display: none;
    }
    .check_div {
        width: 190px;
        height: 120px;
        display: inline-block;
        border-radius: 10px;
        position: relative;
        text-align: center;
        cursor: pointer;
    }
    .check_div > i {
        color: #ffffff;
        background-color: #012cae;
        font-size: 20px;
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%) scale(2);
        border-radius: 50px;
        padding: 3px;
        transition: 0.5s;
        pointer-events: none;
        opacity: 0;
    }
    .checkbax_fade{
        transform: translateX(-50%) scale(2);
        background-color: #efefef;
        opacity: 0.5;
    }

    .check_div .package-desc {
        padding-top: 50px;
        position: absolute;
        top: 36%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        text-align: center;
    }

    .check_div .package-desc i {
        color: #012cae;
        line-height: 80px;
        font-size: 60px;
    }
    .card_question.package-101  >  .check_div {
    background: #f4f5fb;
}

    .check_div .package-desc h3 {
        color: #555;
        font-size: 18px;
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing:1px;
    }

    .card_question.box_div input:checked + .check_div {
        color: #ffffff;
    }

    .card_question.box_div input:checked + .check_div > i {
        opacity: 1;
        transform: translateX(-50%) scale(1);
        display: block;
    }

    .card_question.box_div input + .check_div > i {
        display: none;
    }

    .check_div p{ margin: 10px 0px;}

    .card_question.package-101 input:checked + .check_div {
        background:#012cae;
    }
    .card_question.package-101 input:checked + .check_div > i {
        color: #012cae;
        background:#fff;
        font-size: 28px;
    }
    .card_question.box_div input + .check_div > i {
        opacity: 1;
        transform: translateX(-50%) scale(1);
    }
    .check_div > i {
        color: #ffffff;
        background-color: #efefef;
    }
   
/* //////////////////////////// */

.row.bc {
  
    margin-bottom: 10px;
}
.edit_ques_checkbox{
    padding: 9px 0px;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
  
    border-radius: 0.25rem;

    border-radius: 0;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
}

.p_client{
    font-size: 14px;
}

.row.bc label {
    font-size: 16px;
    vertical-align: super;
}

.row.bc span.text-c-blue {
    font-size: 20px;
    line-height: 25px;
}

.row.bc input {
    width: 20px;
    height: 20px;
}

span.noti_count {
    position: absolute;
    top: -20px;
    background: red;
    width: auto;
    height: 21px;
    line-height: 20px;
    border-radius: 25px;
    right: 0px;
    padding-left: 5px;
    font-weight: normal;
    color: #fff;
    padding-right: 5px;
    font-size: 10px;
}

.accordion-container .accordion-title {
  position: relative;
  margin: 0;
  font-size: 1.25em;
  font-weight: normal;
  color: #fff;
  cursor: pointer;
}

.accordion-title.open { 
  background-color: #fff;
}
.accordion-container .accordion-title::after {
  content: "";
  position: absolute;
  top: 25px;
  right: 0px;
  width: auto;
  height: auto;
  border: 8px solid transparent;
  border-top-color: #012cae;
}
.accordion-container .accordion-title.open::after {
  content: "";
  position: absolute;
  top: 15px;
  border: 8px solid transparent;
  border-bottom-color: #012cae;
}

/*CSS for CodePen*/


@media only screen and (max-width: 1440px) and (min-width: 1400px){
    .radio-btn { width: 150px;}
}

@media screen and (max-width: 1440px) {
    .p_client{
    font-size: 13px;
    }
    .row.bc span.text-c-blue {
        font-size: 18px;
    }
}

@media screen and (max-width: 1200px) {
  .float_none{
    float: none !important;
  }
  .pt-2px {
    padding-top: 5px;
}
.row.bc span.text-c-blue {
    font-size: 20px;
}
}

@media screen and (max-width: 1024px) {
    .radio-btn { width: 155px;}
}
@media screen and (max-width: 768px) {

.pt-2px {
    padding-top: 8px;
}
}
</style>