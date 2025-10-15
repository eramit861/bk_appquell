<form name="attorney_setting_frm" id="attorney_setting_frm" action="{{ route('attorney_setting_save', ['type'=>2]) }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <input type="hidden" name="is_associate" value="{{ Helper::validate_key_value('is_associate', $associate_data, 'radio') }}">
    <input type="hidden" name="associate_id" value="{{ Helper::validate_key_value('associate_id', $associate_data, 'radio') }}">



    <div class="row gx-3">
        <div class="col-12">
            <div class="card-title-header pb-2">
                <h4 class="card-title pb-0 mb-0 bb-0-i ">
                    <i class="bi bi-file-text"></i> Manage Questionnaire Doc Settings
                </h4>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="light-gray-div mt-3">
                <h2>Overall Questionnaire Changes:</h2>
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Confirm/Submit By Each Tab/Section Of The Questionnaire:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_confirm_prompt_enabled_no" class="d-none" name="is_confirm_prompt_enabled" {{ $is_confirm_prompt_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_confirm_prompt_enabled_no" class="btn-toggle btn-red {{ $is_confirm_prompt_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="is_confirm_prompt_enabled_yes" class="d-none" name="is_confirm_prompt_enabled" {{ $is_confirm_prompt_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_confirm_prompt_enabled_yes" class="btn-toggle btn-green {{ $is_confirm_prompt_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Request <span class="underline">Bank Statements</span> From Client(s):</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="attorney_enabled_bank_statment_no" class="d-none" name="attorney_enabled_bank_statment" {{ $attorney_enabled_bank_statment == 0 ? 'checked' : '' }} value="0">
                                <label for="attorney_enabled_bank_statment_no" class="btn-toggle btn-red {{ $attorney_enabled_bank_statment == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="attorney_enabled_bank_statment_yes" class="d-none" name="attorney_enabled_bank_statment" {{ $attorney_enabled_bank_statment == 1 ? 'checked' : '' }} value="1">
                                <label for="attorney_enabled_bank_statment_yes" class="btn-toggle btn-green {{ $attorney_enabled_bank_statment == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Request <span class="underline">Vehicle Title</span> (Paid off Vehicles):</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_car_title_enabled_no" class="d-none" name="is_car_title_enabled" {{ $is_car_title_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_car_title_enabled_no" class="btn-toggle btn-red {{ $is_car_title_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="is_car_title_enabled_yes" class="d-none" name="is_car_title_enabled" {{ $is_car_title_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_car_title_enabled_yes" class="btn-toggle btn-green {{ $is_car_title_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Add <span class="underline">Credit Report Header</span> To Debt Tab:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_debt_header_custom_enabled_no" class="d-none" name="is_debt_header_custom_enabled" {{ $is_debt_header_custom_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_debt_header_custom_enabled_no" class="btn-toggle btn-red {{ $is_debt_header_custom_enabled == 0 ? 'active' : '' }} " onclick="toggleShowHideDiv(false, 'debt_header_custom_text_div')">No</label>

                                <input type="radio" id="is_debt_header_custom_enabled_yes" class="d-none" name="is_debt_header_custom_enabled" {{ $is_debt_header_custom_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_debt_header_custom_enabled_yes" class="btn-toggle btn-green {{ $is_debt_header_custom_enabled == 1 ? 'active' : '' }} " onclick="toggleShowHideDiv(true, 'debt_header_custom_text_div')">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 debt_header_custom_text_div {{ $is_debt_header_custom_enabled == 1 ? '' : 'hide-data' }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label class="">Header Custom Text</label>
                                <textarea type="text" rows=4 required name="debt_header_custom_text" placeholder="Header Custom Text" class="form-control">{{ Helper::validate_key_value('debt_header_custom_text', $attorneySettings) ?: "Our office will pull your credit reports and provide you with a copy of the report and schedules to cross reference. You do not need to list any creditors at this time unless you know of any debts that would not appear on the report such as: Medical bills, payday loans, judgments or evictions." }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Enable <span class="underline">Document Upload</span> Restriction:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_doc_upload_restriction_enabled_no" class="d-none" name="is_doc_upload_restriction_enabled" {{ $is_doc_upload_restriction_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_doc_upload_restriction_enabled_no" class="btn-toggle btn-red {{ $is_doc_upload_restriction_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="is_doc_upload_restriction_enabled_yes" class="d-none" name="is_doc_upload_restriction_enabled" {{ $is_doc_upload_restriction_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_doc_upload_restriction_enabled_yes" class="btn-toggle btn-green {{ $is_doc_upload_restriction_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Request Copy of <span class="underline">Rental Agreement</span>:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_rental_agreement_enabled_no" class="d-none" name="is_rental_agreement_enabled" {{ $is_rental_agreement_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_rental_agreement_enabled_no" class="btn-toggle btn-red {{ $is_rental_agreement_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="is_rental_agreement_enabled_yes" class="d-none" name="is_rental_agreement_enabled" {{ $is_rental_agreement_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_rental_agreement_enabled_yes" class="btn-toggle btn-green {{ $is_rental_agreement_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="light-gray-div mt-3">
                <h2>Atty Document Settings:</h2>
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Enable <span class="underline">Text Message Notification</span>:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="enable_text_msg_notification_email_no" class="d-none" name="enable_text_msg_notification_email" {{ $enable_text_msg_notification_email == 0 ? 'checked' : '' }} value="0">
                                <label for="enable_text_msg_notification_email_no" class="btn-toggle btn-red {{ $enable_text_msg_notification_email == 0 ? 'active' : '' }} " onclick="toggleShowHideDiv(false, 'text_text_msg_notification_email_div')">No</label>

                                <input type="radio" id="enable_text_msg_notification_email_yes" class="d-none" name="enable_text_msg_notification_email" {{ $enable_text_msg_notification_email == 1 ? 'checked' : '' }} value="1">
                                <label for="enable_text_msg_notification_email_yes" class="btn-toggle btn-green {{ $enable_text_msg_notification_email == 1 ? 'active' : '' }} " onclick="toggleShowHideDiv(true, 'text_text_msg_notification_email_div')">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text_text_msg_notification_email_div {{ $enable_text_msg_notification_email == 1 ? '' : 'hide-data' }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label class="">Notification Email</label>
                                <input type="text" required name="text_text_msg_notification_email" placeholder="Notification Email" class="form-control" value="{{ Helper::validate_key_value('text_text_msg_notification_email', $attorneySettings) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Zip File - Categorize Client Documents & Name Of By <span class="underline">Petition Schedules</span>:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="zip_in_schedule_structure_no" class="d-none" name="zip_in_schedule_structure" {{ $zip_in_schedule_structure == 0 ? 'checked' : '' }} value="0">
                                <label for="zip_in_schedule_structure_no" class="btn-toggle btn-red {{ $zip_in_schedule_structure == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="zip_in_schedule_structure_yes" class="d-none" name="zip_in_schedule_structure" {{ $zip_in_schedule_structure == 1 ? 'checked' : '' }} value="1">
                                <label for="zip_in_schedule_structure_yes" class="btn-toggle btn-green {{ $zip_in_schedule_structure == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="label-div question-area">
                            <label class="">Invites All Clients with <span class="underline">Detailed Property Page</span>:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="enabled_detailed_property_no" class="d-none" name="enabled_detailed_property" {{ $enabled_detailed_property == 0 ? 'checked' : '' }} value="0">
                                <label for="enabled_detailed_property_no" class="btn-toggle btn-red {{ $enabled_detailed_property == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="enabled_detailed_property_yes" class="d-none" name="enabled_detailed_property" {{ $enabled_detailed_property == 1 ? 'checked' : '' }} value="1">
                                <label for="enabled_detailed_property_yes" class="btn-toggle btn-green {{ $enabled_detailed_property == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card-title-header pb-2">
                <h4 class="card-title pb-0 mb-0 bb-0-i ">
                    <i class="bi bi-file-text"></i> Customized Document Requests
                </h4>
            </div>
        </div>
        <div class="col-12">
            <div class="light-gray-div mt-3">
                <h2>Document Request Options:</h2>
                <div class="row gx-3">
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area border-0 p-0">
                            <div class="form-group">
                                <label>How Many Months of <span class="underline">Bank Statements</span> would you like BKQ to request:</label>
                                @php $monthPrevValue = Helper::validate_key_value('bank_statement_months', $attorneySettings); @endphp
                                <select class="form-control" name="bank_statement_months">
                                    <option value="3" {{ $monthPrevValue == '3' ? 'selected' : '' }}>3 Months</option>
                                    <option value="6" {{ $monthPrevValue == '6' ? 'selected' : '' }}>6 Months</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area border-0 p-0">
                            <div class="form-group">
                                <label class="">How Many Months Of <span class="underline">Profit/Loss</span> BKQ will request:</label>
                                @php $monthPrevValue = Helper::validate_key_value('profit_loss_months', $attorneySettings); @endphp
                                <select class="form-control" name="profit_loss_months">
                                    <option value="6" {{ $monthPrevValue == '6' ? 'selected' : '' }}>6 Months</option>
                                    <option value="12" {{ $monthPrevValue == '12' ? 'selected' : '' }}>12 Months</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area">
                            <label class="">Request Current Month <span class="underline">Bank Transactions</span>:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_current_partial_month_enabled_no" class="d-none" name="is_current_partial_month_enabled" {{ $is_current_partial_month_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="is_current_partial_month_enabled_no" class="btn-toggle btn-red {{ $is_current_partial_month_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="is_current_partial_month_enabled_yes" class="d-none" name="is_current_partial_month_enabled" {{ $is_current_partial_month_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="is_current_partial_month_enabled_yes" class="btn-toggle btn-green {{ $is_current_partial_month_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area">
                            <label class="">Request <span class="underline">Bank Transactions</span> List For Payments <span class="underline">Over $600.00</span> For The Last 90 Days:</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="transaction_pdf_enabled_no" class="d-none" name="transaction_pdf_enabled" {{ $transaction_pdf_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="transaction_pdf_enabled_no" class="btn-toggle btn-red {{ $transaction_pdf_enabled == 0 ? 'active' : '' }}" onclick="toggleShowHideDiv(false, 'transaction_pdf_signature_div')">No</label>

                                <input type="radio" id="transaction_pdf_enabled_yes" class="d-none" name="transaction_pdf_enabled" {{ $transaction_pdf_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="transaction_pdf_enabled_yes" class="btn-toggle btn-green {{ $transaction_pdf_enabled == 1 ? 'active' : '' }}" onclick="toggleShowHideDiv(true, 'transaction_pdf_signature_div')">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 transaction_pdf_signature_div {{ $transaction_pdf_enabled == 1 ? '' : 'hide-data' }}">
                        <div class="label-div question-area">
                            <label class="">Enable Signature in Transactions PDF</label>
                            <!-- Radio Buttons -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="transaction_pdf_signature_enabled_no" class="d-none" name="transaction_pdf_signature_enabled" {{ $transaction_pdf_signature_enabled == 0 ? 'checked' : '' }} value="0">
                                <label for="transaction_pdf_signature_enabled_no" class="btn-toggle btn-red {{ $transaction_pdf_signature_enabled == 0 ? 'active' : '' }}">No</label>

                                <input type="radio" id="transaction_pdf_signature_enabled_yes" class="d-none" name="transaction_pdf_signature_enabled" {{ $transaction_pdf_signature_enabled == 1 ? 'checked' : '' }} value="1">
                                <label for="transaction_pdf_signature_enabled_yes" class="btn-toggle btn-green {{ $transaction_pdf_signature_enabled == 1 ? 'active' : '' }}">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area border-0 p-0">
                            <div class="form-group">
                                <label class="">The Date In Which Tax Return Years will change:</label>
                                <input type="text" readonly name="tax_return_day_month" placeholder="MM/DD" class="form-control" value="{{ Helper::validate_key_value('tax_return_day_month', $attorneySettings) }}" id="datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="label-div question-area border-0 p-0">
                            <div class="form-group">
                                <label class="">How Many Months Of <span class="underline">Brokerage Statements</span> BKQ will request:</label>
                                @php $monthPrevValue = Helper::validate_key_value('brokerage_months', $attorneySettings); @endphp
                                <select class="form-control" name="brokerage_months">
                                    <option value="1" {{ ($monthPrevValue == '1' || empty($monthPrevValue)) ? 'selected' : '' }}>Most recent month</option>
                                    <option value="3" {{ $monthPrevValue == '3' ? 'selected' : '' }}>Last 3 Months</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save Settings</span></button>
    </div>
</form>