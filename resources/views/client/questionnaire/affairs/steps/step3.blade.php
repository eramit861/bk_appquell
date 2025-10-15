@php
$i = 0;
@endphp
@if((isset($sole_proprietor->hazardous_property) && $sole_proprietor->hazardous_property == 1))
    <div class="col-12">
        <div class="label-div question-area">
            <label>
                List every site for which you received notice by a governmental unit that you may be liable under or in violation of an environmental law. Include the name and address of the governmental unit, the date of the notice, and, if known, the environmental law.
                <br>
                <i>Environmental law </i>means any federal, state, or local statue or regulation regulating pollution, contamination, releases of hazardous or toxic substances, wastes or material into the air, land, soil surface water, ground water, or other medium, including, statutes or regulations controlling the cleanup of these substances, wastes, or material.
                <br>
                <i>Site </i> means any location, facility, or property as defined under any environmental law, whether you own, operate, or utilize it or used to own, operate, or utilize it, including disposal sites.
                <br>
                <i>Hazardous material </i>means anything an environmental law defines as a hazardous waste, hazardous substance, toxic substance, hazardous material, pollutant, or contaminant or similar term
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="list-noticeby-gov_yes" class="d-none" name="list_noticeby_gov" required {{ Helper::validate_key_toggle('list_noticeby_gov', $finacial_affairs, 1) }} value="1">
                <label for="list-noticeby-gov_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('list_noticeby_gov', $finacial_affairs, 1) }}" onclick="getNoticeByGovData('yes');">Yes</label>

                <input type="radio" id="list-noticeby-gov_no" class="d-none" name="list_noticeby_gov" required {{ Helper::validate_key_toggle('list_noticeby_gov', $finacial_affairs, 0) }} value="0">
                <label for="list-noticeby-gov_no" class="btn-toggle {{ Helper::validate_key_toggle_active('list_noticeby_gov', $finacial_affairs, 0) }}" onclick="getNoticeByGovData('no');">No</label>
            </div>
        </div>
    </div>
    <!-- Condition data -->
    <div class="col-12 {{ Helper::key_hide_show_v('list_noticeby_gov', $finacial_affairs) }}" id="list-noticeby-gov-data">
        @include("client.questionnaire.affairs.common.parent_list_noticeby_gov")
    </div>

    <div class="col-12">
        <div class="label-div question-area">
            <label>
                List the name and address of every site for which you have notified a governmental unit of a hazardous material release. Include the name and address of the governmental unit to which the notice was sent, the date of the notice, and, if know, the environment law.
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="list-environment_law_yes" class="d-none" name="list_environment_law" required {{ Helper::validate_key_toggle('list_environment_law', $finacial_affairs, 1) }} value="1">
                <label for="list-environment_law_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('list_environment_law', $finacial_affairs, 1) }}" onclick="getEnvironmentLawData('yes');">Yes</label>

                <input type="radio" id="list-environment_law_no" class="d-none" name="list_environment_law" required {{ Helper::validate_key_toggle('list_environment_law', $finacial_affairs, 0) }} value="0">
                <label for="list-environment_law_no" class="btn-toggle {{ Helper::validate_key_toggle_active('list_environment_law', $finacial_affairs, 0) }}" onclick="getEnvironmentLawData('no');">No</label>
            </div>
        </div>
    </div>
    <!-- Condition data -->
    <div class="col-12 {{ Helper::key_hide_show_v('list_environment_law', $finacial_affairs) }}" id="list-environment_law-data"> 
        @include("client.questionnaire.affairs.common.parent_list_environment_law")
    </div>

    <div class="col-12">
        <div class="label-div question-area">
            <label>
                List all judicial or administrative proceedings, including settlements and orders, under any environmental law to which you have been a party. Include the case title and the case number, the court or agency, the nature of the case, and the status.
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="list-judicial-proceedings_yes" class="d-none" name="list_judicial_proceedings" required {{ Helper::validate_key_toggle('list_judicial_proceedings', $finacial_affairs, 1) }} value="1">
                <label for="list-judicial-proceedings_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('list_judicial_proceedings', $finacial_affairs, 1) }}" onclick="getJudicialProceedingsData('yes');">Yes</label>

                <input type="radio" id="list-judicial-proceedings_no" class="d-none" name="list_judicial_proceedings" required {{ Helper::validate_key_toggle('list_judicial_proceedings', $finacial_affairs, 0) }} value="0">
                <label for="list-judicial-proceedings_no" class="btn-toggle {{ Helper::validate_key_toggle_active('list_judicial_proceedings', $finacial_affairs, 0) }}" onclick="getJudicialProceedingsData('no');">No</label>
            </div>
        </div>
    </div>
    <!-- Condition data -->
    <div class="col-12 {{ Helper::key_hide_show_v('list_judicial_proceedings', $finacial_affairs) }}" id="list-judicial-proceedings-data">
        @include("client.questionnaire.affairs.common.parent_list_judicial_proceedings")
    </div>
@endif

@if(isset($sole_proprietor->used_business_ein) && $sole_proprietor->used_business_ein == 1)
    <div class="col-12">
        <div class="label-div question-area">
            <label class="mb-0">
                List the name and address, nature of business, name of accountant or bookkeeper, Employer Identification Number (EIN), and dates of operation of every business you owned or with which you had any of the following connections within the past<strong> 4 years.</strong>
            </label>
        </div>
    </div>
    <!-- Condition data -->
    <div class="col-12" id="list-nature-business-data">
        @include("client.questionnaire.affairs.common.parent_list_nature_business")
    </div>

    <div class="col-12">
        <div class="label-div question-area">
            <label>
                List all financial institutions, creditors, or other parties to which you gave a financial statement about your business within the past <strong>2 years</strong>
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="list-financial-institutions_yes" class="d-none" name="list_financial_institutions" required {{ Helper::validate_key_toggle('list_financial_institutions', $finacial_affairs, 1) }} value="1">
                <label for="list-financial-institutions_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('list_financial_institutions', $finacial_affairs, 1) }}" onclick="getFinancialInstitutionsData('yes');">Yes</label>

                <input type="radio" id="list-financial-institutions_no" class="d-none" name="list_financial_institutions" required {{ Helper::validate_key_toggle('list_financial_institutions', $finacial_affairs, 0) }} value="0">
                <label for="list-financial-institutions_no" class="btn-toggle {{ Helper::validate_key_toggle_active('list_financial_institutions', $finacial_affairs, 0) }}" onclick="getFinancialInstitutionsData('no');">No</label>
            </div>
        </div>
    </div>
    <!-- Condition data -->
    <div class="col-12  {{ Helper::key_hide_show_v('list_financial_institutions', $finacial_affairs) }}" id="list-financial-institutions-data">        
        @include("client.questionnaire.affairs.common.parent_list_financial_institutions")
    </div>
@endif