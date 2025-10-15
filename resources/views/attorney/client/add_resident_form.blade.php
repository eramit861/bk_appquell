<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            Add new Residence
        </h5>
    </div>
    <form name="client_property_step1" id="client_property_step1" action="{{route('manual_resident_setup')}}" method="post">
    @csrf
        <div class="light-gray-div  mt-4 mx-3 ">
            <h2>Property details</h2>
            <?php $i = 0; ?>
            <input type="hidden" name="report_id" value="{{@$report_id}}" />
            <input type="hidden" name="client_id" value="{{@$client_id}}" />
            <input type="hidden" name="property_resident[currently_lived][<?php echo $i; ?>]" value="1">
            <div class="row gx-3">
                <div class="col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label class="d-block">{{ __('What is the property? Check all that apply.') }}</label>


                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="single-family-home"
                                    name="property_resident[property][<?php echo $i; ?>]" value="1"
                                    class="property required" required>
                                <label for="single-family-home"
                                    class="cr">{{ __('Single family home') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="duplex-building"
                                    name="property_resident[property][<?php echo $i; ?>]" value="2"
                                    class="property required" required>
                                <label for="duplex-building" class="cr"> {{ __('Duplex or multi-unit building') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="condominium-or-cooperative"
                                    name="property_resident[property][<?php echo $i; ?>]" value="3"
                                    class="property required" required>
                                <label for="condominium-or-cooperative" class="cr">
                                    {{ __('Condominium or cooperative') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="manufactured-or-mobile-home"
                                    name="property_resident[property][<?php echo $i; ?>]" value="4"
                                    class="property required" required>
                                <label for="manufactured-or-mobile-home" class="cr">
                                    {{ __('Manufactured or mobile home') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="land"
                                    name="property_resident[property][<?php echo $i; ?>]" value="5" required
                                    class="property required">
                                <label for="land" class="cr">
                                    {{ __('Land') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="investment"
                                    name="property_resident[property][<?php echo $i; ?>]" value="6" required
                                    class="property required">
                                <label for="investment" class="cr"> {{ __('Investment property') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="timeshare"
                                    name="property_resident[property][<?php echo $i; ?>]" value="7" required
                                    class="property required">
                                <label for="timeshare" class="cr"> {{ __('Timeshare') }}
                                </label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" id="address-other"
                                    name="property_resident[property][<?php echo $i; ?>]" value="8" required
                                    class="property required">
                                <label for="address-other" class="cr"> {{ __('Other:') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 ">
                    <div class="light-gray-box-tittle-div mb-3 pb-1">
                        <h2>Please provide details requested below.:</h2>
                    </div>
                </div>
                <div class="col-12  payment_not_primary_address_parents">
                    <div class="label-div">
                        <div class="form-group">
                            <label
                                class="d-block">{{ __('Is this property your primary residence?') }}
                            </label>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio"
                                    id="payment_not_primary_address_no_<?php echo $i; ?>"
                                    name="property_resident[not_primary_address][<?php echo $i; ?>]"
                                    value="1" class="not_primary_address" required
                                    onchange="not_primary_address_property('no',this);">
                                <label for="payment_not_primary_address_no_<?php echo $i; ?>"
                                    class="cr">{{ __('No') }}
                                </label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio"
                                    id="payment_not_primary_address_yes_<?php echo $i; ?>"
                                    name="property_resident[not_primary_address][<?php echo $i; ?>]"
                                    value="0" class="not_primary_address" required
                                    onchange="not_primary_address_property('yes',this);">
                                <label for="payment_not_primary_address_yes_<?php echo $i; ?>"
                                    class="cr">{{ __('Yes') }}
                                </label>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="col-12 payment_not_primary_address_data hide-data">
                    <div class="label-div">
                        <div class="form-group">
                            <label>{{ __('Street Address') }}</label>
                            <input type="text" class="form-control  mortgage_address"
                                name="property_resident[mortgage_address][<?php echo $i; ?>]"
                                placeholder="{{ __('Street Address') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>{{ __('City') }}</label>
                                    <input type="text" class="form-control  mortgage_city"
                                        name="property_resident[mortgage_city][<?php echo $i; ?>]"
                                        placeholder="{{ __('City') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>{{ __('State') }}</label>
                                    <select class="form-control  mortgage_state"
                                        name="property_resident[mortgage_state][<?php echo $i; ?>]">
                                        <option value="">{{ __('Please Select State') }}
                                        </option>
                                        <?php echo AddressHelper::getStatesList(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>{{ __('Zip Code') }}</label>
                                    <input type="number"
                                        class="form-control allow-5digit  mortgage_zip"
                                        name="property_resident[mortgage_zip][<?php echo $i; ?>]"
                                        placeholder="Zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>{{ __('County') }}</label>
                                    <input type="text" class="form-control  mortgage_county"
                                        name="property_resident[mortgage_county][<?php echo $i; ?>]"
                                        placeholder="{{ __('County') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label>{{ __('Estimated') }}<strong> {{ __('Value of') }}</strong>
                                {{ __('Property') }}</label>
                            <input type="number" required
                                class="form-control  price-field required estimated_property_value"
                                placeholder="{{ __('Property value') }}"
                                name="property_resident[estimated_property_value][<?php echo $i; ?>]">
                        </div>
                        <label>
                            <small >{{ __('You can find out the value of your home here') }}
                                    <a href="https://www.zillow.com"
                                        target="_blank">{{ __('zillow.com') }}
                                    </a> 
                                    and/or 
                                    <a
                                        href="https://www.redfin.com"
                                        target="_blank">redfin.com
                                    </a>
                            </small>
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label
                                class="d-block">{{ __('Would you like to retain the above property?') }}
                            </label>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" required
                                    id="retain_above_property_yes_<?php echo $i; ?>"
                                    class="retain_above_property"
                                    name="property_resident[retain_above_property][<?php echo $i; ?>]"
                                    value="1">
                                <label for="retain_above_property_yes_<?php echo $i; ?>"
                                    class="cr">{{ __('Yes') }}</label>
                            </div>
                            <div class="d-inline-flex radio-primary">
                                <input type="radio" required
                                    id="retain_above_property_no_<?php echo $i; ?>"
                                    class="retain_above_property"
                                    name="property_resident[retain_above_property][<?php echo $i; ?>]"
                                    value="0">
                                <label for="retain_above_property_no_<?php echo $i; ?>"
                                    class="cr">{{ __('No') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="bottom-btn-div mx-3 mb-3 w-auto">
            <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default"><span class="">Save</span></button>
        </div>
    </form>
</div>
<style>
    label.error {
        color: red;
        font-style: italic;
    }
</style>
<script>
    function property_toggle_own_by(value, obj) {
        if (value == 2 || value == 4) {
            $(obj).parents('.property_own_by').next('.property_codebtor_cosigner_data').removeClass("hide-data");
            $("input[name='property_resident[codebtor_creditor_name][0]']").prop('required', true);
            $("input[name='property_resident[codebtor_creditor_name_addresss][0]']").prop('required', true);
            $("input[name='property_resident[codebtor_creditor_city][0]']").prop('required', true);
            $("select[name='property_resident[codebtor_creditor_state][0]']").prop('required', true);
            $("input[name='property_resident[codebtor_creditor_zip][0]']").prop('required', true);

            // document.getElementById('own_property_data').classList.remove("hide-data");
        } else if (value == 1 || value == 3) {
            $(obj).parents('.property_own_by').next('.property_codebtor_cosigner_data').addClass("hide-data");
            $("input[name='property_resident[codebtor_creditor_name][0]']").prop('required', false);
            $("input[name='property_resident[codebtor_creditor_name_addresss][0]']").prop('required', false);
            $("input[name='property_resident[codebtor_creditor_city][0]']").prop('required', false);
            $("select[name='property_resident[codebtor_creditor_state][0]']").prop('required', false);
            $("input[name='property_resident[codebtor_creditor_zip][0]']").prop('required', false);

        }
    }

    $(document).ready(function() {


        $("#client_property_step1").validate({

            errorPlacement: function(error, element) {

                if ($(element).parents(".form-group").next('label').hasClass('error')) {

                    $(element).parents(".form-group").next('label').remove();

                    $(element).parents(".form-group").after($(error)[0].outerHTML);

                } else {

                    $(element).parents(".form-group").after($(error)[0].outerHTML);

                }

            },

            success: function(label, element) {

                label.parent().removeClass('error');

                $(element).parents(".form-group").next('label').remove();

            },

        });
    });
</script>