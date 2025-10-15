<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAttorneyController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminConciergeClientController;
use App\Http\Controllers\AdminCommonNotesController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\AdminManageVideoController;
use App\Http\Controllers\AdminMeansTestController;
use App\Http\Controllers\AdminEmailNotificationController;
use App\Http\Controllers\AdminManageNotificationController;
use App\Http\Controllers\AdminZipCodeController;
use App\Http\Controllers\AdminStateController;
use App\Http\Controllers\AdminPropertyRequestController;
use App\Http\Controllers\AdminDomesticAddressController;
use App\Http\Controllers\AutoLoanCompaniesController;
use App\Http\Controllers\MasterCreditorController;
use App\Http\Controllers\GovtCreditorController;
use App\Http\Controllers\CourtHousesController;
use App\Http\Controllers\MortgagesController;
use App\Http\Controllers\AdminDeductionListController;
use App\Http\Controllers\AdminAttorneyChatController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\ExemptionListController;
use App\Http\Controllers\DistrictFormOrderController;
use App\Http\Controllers\DistrictCreditersSettingController;
use App\Http\Controllers\DebtStateTaxesController;
use App\Http\Controllers\AdminCountyFipsController;
use App\Http\Controllers\AdminDistrictsController;
use App\Http\Controllers\AdminCombineDocumentController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\AdminSimpleTextMessagesController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminParalegalListController;
use App\Http\Controllers\UserLoginHistoryController;
use App\Http\Controllers\AdminDocumentGuideImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'create'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'index'])->name('authenticate_admin');
    Route::get('verify/resend', [TwoFactorController::class,'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);

});

Route::group(['prefix' => 'admin','middleware' => ['is_admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');

    Route::get('/user/attorneychat', [AdminAttorneyChatController::class, 'AttorneyChatListing'])->name('attorneychat');
    Route::post('/admin-file-sharing', [AdminAttorneyChatController::class, 'AdminFileSharing'])->name('admin_file_sharing');

    /* Attorney Management section*/
    Route::get('/user/attorney', [AdminAttorneyController::class, 'listing'])->name('admin_attorney_list');
    Route::post('/user/attorney/add', [AdminAttorneyController::class, 'add'])->name('admin_attorney_add');
    Route::match(['get', 'post'], '/user/attorney/edit/{id}', [AdminAttorneyController::class, 'edit'])->name('admin_attorney_edit');
    Route::get('/user/attorney/view/{id}', [AdminAttorneyController::class, 'view'])->name('admin_attorney_view');
    Route::get('/admin/reports', [AdminReportsController::class, 'index'])->name('admin_reports');
    Route::post('/admin/reports', [AdminReportsController::class, 'index'])->name('admin_reports');

    Route::get('/user/attorney/mark/demo/{id}', [AdminAttorneyController::class, 'admin_attorney_mark_demo'])->name('admin_attorney_mark_demo');
    Route::get('/user/attorney/unmark/demo/{id}', [AdminAttorneyController::class, 'admin_attorney_unmark_demo'])->name('admin_attorney_unmark_demo');
    Route::post('/enable/bank/statement/free', [AdminAttorneyController::class, 'enable_free_bank_statements'])->name('enable_free_bank_statements');
    Route::post('/enable/payroll-assistant/free', [AdminAttorneyController::class, 'enable_free_payroll_assistant'])->name('enable_free_payroll_assistant');
    Route::post('/enable/law/firm', [AdminAttorneyController::class, 'enable_law_firm_management_enabled'])->name('enable_law_firm_management_enabled');
    Route::post('/enable/invite/document/selection', [AdminAttorneyController::class, 'update_invite_doc_selection_status'])->name('update_invite_doc_selection_status');

    /** Paralegal list */
    Route::get('/paralegal/list', [AdminParalegalListController::class, 'listing'])->name('admin_paralegal_list');
    Route::match(['get', 'post'], '/paralegal/edit/{id}', [AdminParalegalListController::class, 'edit'])->name('admin_paralegal_edit');
    /* Exemption list section*/
    Route::get('/exemption/show', [ExemptionListController::class, 'index'])->name('exemption_list');
    Route::post('/exemption/add', [ExemptionListController::class, 'create'])->name('exemption_create');
    Route::post('/exemption/store', [ExemptionListController::class, 'store'])->name('exemption_store');
    Route::get('/exemption/edit/{id}', [ExemptionListController::class, 'edit'])->name('exemption_edit');
    Route::post('/exemption/update/{id}', [ExemptionListController::class, 'update'])->name('exemption_update');
    Route::post('/exemption/delete/{id}', [ExemptionListController::class, 'delete'])->name('exemption_delete');

	/* Client Management section*/
	Route::get('/user/client', [AdminClientController::class, 'listing'])->name('admin_client_list');
	Route::post('/user/client/add', [AdminClientController::class, 'add'])->name('admin_client_add');
	Route::match(['get', 'post'],'/user/client/edit/{id}', [AdminClientController::class, 'edit'])->name('admin_client_edit');
	Route::get('/user/client/view/{id}', [AdminClientController::class, 'view'])->name('admin_client_view');
	Route::post('/user/client/delete', [AdminClientController::class, 'delete'])->name('admin_client_delete');
    Route::post('/user/client/delete/permanent', [AdminClientController::class, 'delete_permanent'])->name('admin_client_delete_permanent');
     Route::post('/user/client/restore', [AdminClientController::class, 'restore'])->name('admin_client_restore');
	Route::post('/user/attorney/delete', [AdminAttorneyController::class, 'delete'])->name('admin_attorney_delete');
	Route::post('/user/client/password/reset', [AdminClientController::class, 'client_password_reset_popup_by_admin'])->name('client_password_reset_popup_by_admin');
	Route::post('/user/client/password/reset/save', [AdminClientController::class, 'client_password_reset_save_by_admin'])->name('client_password_reset_save_by_admin');
	Route::post('/user/client/survey/text', [AdminClientController::class, 'send_survey_text'])->name('send_survey_text');

    //  Concierge Service
    Route::get('/user/client/concierge-service/{attorneyWise?}/{type?}', [AdminConciergeClientController::class, 'index'])->name('admin_concierge_service_list');
    Route::post('/user/client/concierge-service/data', [AdminConciergeClientController::class, 'getAdminClientManagementCommonData'])->name('admin_client_management_common_data');
    Route::post('/user/client/concierge-service/activate', [AdminConciergeClientController::class, 'activate'])->name('admin_activate_concierge_service');
    Route::post('/user/client/concierge-service/inactivate', [AdminConciergeClientController::class, 'mark_inprogress'])->name('mark_inprogress');
    Route::post('/user/client/concierge-service/queue/status', [AdminConciergeClientController::class, 'add_remove_client_from_queue'])->name('add_remove_client_from_queue');
    Route::post('/user/client/concierge-service/email/status', [AdminConciergeClientController::class, 'disable_client_concierge_mail'])->name('disable_client_concierge_mail');
    Route::post('/user/client/concierge-service/status/update', [AdminConciergeClientController::class, 'admin_client_status'])->name('admin_client_status');
    Route::post('/user/client/send/paralegal/info', [AdminConciergeClientController::class, 'send_paralegal_info_to_client_popup_by_admin'])->name('send_paralegal_info_to_client_popup_by_admin');
    Route::post('/user/client/send/paralegal/info/save', [AdminConciergeClientController::class, 'send_paralegal_info_to_client_by_admin'])->name('send_paralegal_info_to_client_by_admin');


    Route::get('/user/clendly/events/{type?}', [AdminConciergeClientController::class, 'getclendlywebhook'])->name('getclendlywebhook');

    Route::post('/user/client/concierge-service/notes', [AdminConciergeClientController::class, 'notes_popup'])->name('notes_popup');
    Route::post('/user/client/concierge-service/notes/update', [AdminConciergeClientController::class, 'update_notes'])->name('update_notes');
    Route::post('/user/client/concierge-service/admin/notes', [AdminConciergeClientController::class, 'admin_notes_popup'])->name('admin_notes_popup');
    Route::post('/user/client/concierge-service/admin/notes/update', [AdminConciergeClientController::class, 'admin_update_notes'])->name('admin_update_notes');
    Route::post('/user/client/concierge-service/documents', [AdminConciergeClientController::class, 'documents_popup'])->name('documents_popup');
    Route::post('/user/client/concierge-service/admin/notify/client', [AdminConciergeClientController::class, 'notify_client_for_docs'])->name('notify_client_for_docs');
    Route::post('/user/client/concierge-service/admin/add/document', [AdminConciergeClientController::class, 'add_admin_client_document'])->name('add_admin_client_document');
    Route::get('/client/taxreturn/combine/{id}/{type}/{employer_id?}', [AdminCombineDocumentController::class, 'combine_and_download_tax_return'])->name('combine_and_download_tax_return');
    Route::post('/user/client/concierge-service/request/edit', [AdminConciergeClientController::class, 'edit_request_popup'])->name('edit_request_popup');
    /* ZipCode section*/
    Route::get('/zipcode/show', [AdminZipCodeController::class, 'index'])->name('admin_zipcode_index');
    Route::get('/zipcode/add', [AdminZipCodeController::class, 'create'])->name('admin_zipcode_create');
    Route::post('/zipcode/store', [AdminZipCodeController::class, 'store'])->name('admin_zipcode_store');
    Route::get('/zipcode/edit/{id}', [AdminZipCodeController::class, 'edit'])->name('admin_zipcode_edit');
    Route::post('/zipcode/update/{id}', [AdminZipCodeController::class, 'update'])->name('admin_zipcode_update');
    Route::get('/zipcode/delete/{id}', [AdminZipCodeController::class, 'destroy'])->name('admin_zipcode_delete');
    Route::get('/get-divisions', [AdminZipCodeController::class, 'getDivisionNames']);
    Route::get('/get-zip-codes', [AdminZipCodeController::class, 'getZipCodes']);

    /* Common notes section*/
    Route::get('/common/notes/show', [AdminCommonNotesController::class, 'index'])->name('admin_common_notes_category_index');
    Route::post('/common/notes/add', [AdminCommonNotesController::class, 'create'])->name('admin_common_notes_category_create');
    Route::post('/common/notes/update', [AdminCommonNotesController::class, 'update'])->name('admin_common_notes_category_update');
    Route::post('/common/notes/delete', [AdminCommonNotesController::class, 'destroy'])->name('admin_common_notes_category_delete');

    /* Form section*/
    Route::get('/forms/show', [AdminFormController::class, 'index'])->name('admin_forms_index');
    Route::get('/forms/add', [AdminFormController::class, 'create'])->name('admin_forms_create');
    Route::post('/forms/store', [AdminFormController::class, 'store'])->name('admin_forms_store');
    Route::post('/forms/trustee/list', [AdminFormController::class, 'get_trustee_list_for_form'])->name('get_trustee_list_for_form');
    Route::get('/forms/edit/{form_id}', [AdminFormController::class, 'edit'])->name('admin_forms_edit');
    Route::post('/forms/update/{form_id}', [AdminFormController::class, 'update'])->name('admin_forms_update');
    Route::get('/forms/delete/{form_id}', [AdminFormController::class, 'destroy'])->name('admin_forms_delete');
    Route::post('/additional/form', [AdminFormController::class, 'openAdditionalFormPopup'])->name('openAdditionalFormPopup');
    Route::post('/additional/update/{district_id}', [AdminFormController::class, 'additional_form_update'])->name('additional_form_update');

    /* Payment settings */
    Route::match(['get', 'post'], '/payment/settings', [AdminController::class, 'settings'])->name('admin_payment_settings');
    Route::match(['get', 'post'], '/meanstest/settings', [AdminMeansTestController::class, 'meansTestSetting'])->name('admin_means_test_settings');
    Route::match(['get', 'post'], '/meanstest/settings/ajax', [AdminMeansTestController::class, 'meansTestSettingAjax'])->name('admin_means_test_settings_ajax');
    Route::post('/add/subscription/to/attorney', [AdminAttorneyController::class, 'add_subscription_to_attorney'])->name('add_subscription_to_attorney');
    Route::post('/add/payroll/to/attorney', [AdminAttorneyController::class, 'add_payroll_to_attorney'])->name('add_payroll_to_attorney');

    /* email notifications*/
    Route::get('/email/notification/show', [AdminEmailNotificationController::class, 'index'])->name('admin_email_notification_index');
    Route::post('/email/notification/create', [AdminEmailNotificationController::class, 'create'])->name('admin_email_notification_create');
    Route::post('/email/notification/create/popup', [AdminEmailNotificationController::class, 'view_message_popup'])->name('admin_email_notification_popup');

    /* manage notifications*/
    Route::get('/manage/notification/show', [AdminManageNotificationController::class, 'index'])->name('admin_manage_notification_index');
    Route::post('/manage/notification/save', [AdminManageNotificationController::class, 'save'])->name('admin_manage_notification_save');

    /* state section*/
    Route::get('/state/show', [AdminStateController::class, 'index'])->name('admin_state_index');
    Route::post('/state/add', [AdminStateController::class, 'create'])->name('admin_state_create');
    Route::post('/state/store', [AdminStateController::class, 'store'])->name('admin_state_store');
    Route::get('/state/edit/{state_id}', [AdminStateController::class, 'edit'])->name('admin_state_edit');
    Route::post('/state/update/{state_id}', [AdminStateController::class, 'update'])->name('admin_state_update');
    Route::post('/state/delete/{state_id}', [AdminStateController::class, 'delete'])->name('admin_state_delete');
    Route::post('/state/divisions', [AdminStateController::class, 'list_divisions'])->name('list_divisions');
    Route::post('/state/division/add/{state_code}', [AdminStateController::class, 'add_division_to_state'])->name('add_division_to_state');
    Route::post('/state/divisions/id', [AdminStateController::class, 'update_id_in_jubliee'])->name('update_id_in_jubliee');
    Route::post('/state/trustee', [AdminStateController::class, 'list_trustee'])->name('list_trustee');
    Route::post('/state/trustee/add/{state_code}', [AdminStateController::class, 'add_trustee_to_state'])->name('add_trustee_to_state');

    /* Loan Companies section*/
    Route::get('/loancompanies/show', [AutoLoanCompaniesController::class, 'index'])->name('admin_loancompanies_index');
    Route::post('/loancompanies/add', [AutoLoanCompaniesController::class, 'create'])->name('admin_loancompanies_create');
    Route::post('/loancompanies/store', [AutoLoanCompaniesController::class, 'store'])->name('admin_loancompanies_store');
    Route::get('/loancompanies/edit/{id}', [AutoLoanCompaniesController::class, 'edit'])->name('admin_loancompanies_edit');
    Route::post('/loancompanies/update/{id}', [AutoLoanCompaniesController::class, 'update'])->name('admin_loancompanies_update');
    Route::post('/loancompanies/delete/{id}', [AutoLoanCompaniesController::class, 'delete'])->name('admin_loancompanies_delete');
    Route::get('/loancompanies/activate/{id}', [AutoLoanCompaniesController::class, 'activate'])->name('auto_loan_activate');
    Route::post('/loancompanies/multiple/delete', [AutoLoanCompaniesController::class, 'multiple_delete'])->name('companies_multiple_delete');

    /* Master Creditors section*/
    Route::get('/creditors/show', [MasterCreditorController::class, 'index'])->name('admin_creditors_index');
    Route::post('/creditors/add', [MasterCreditorController::class, 'create'])->name('admin_creditors_create');
    Route::post('/creditors/store', [MasterCreditorController::class, 'store'])->name('admin_creditors_store');
    Route::get('/creditors/edit/{id}', [MasterCreditorController::class, 'edit'])->name('admin_creditors_edit');
    Route::post('/creditors/update/{id}', [MasterCreditorController::class, 'update'])->name('admin_creditors_update');
    Route::post('/creditors/delete/{id}', [MasterCreditorController::class, 'delete'])->name('admin_creditors_delete');
    Route::get('/creditors/activate/{id}', [MasterCreditorController::class, 'activate'])->name('creditor_activate');
    Route::post('/creditors/category/update', [MasterCreditorController::class, 'update_category'])->name('admin_creditors_category_update');
    Route::post('/creditors/multiple/delete', [MasterCreditorController::class, 'multiple_delete'])->name('creditors_multiple_delete');

    /* Govt Creditors section*/
    Route::get('/govt/creditors/show', [GovtCreditorController::class, 'index'])->name('admin_govt_creditors_index');
    Route::post('/govt/creditors/sync', [GovtCreditorController::class, 'sync_with_api'])->name('admin_govt_creditors_sync_with_api');
    Route::post('/govt/creditors/delete/{id}', [GovtCreditorController::class, 'delete'])->name('admin_govt_creditors_delete');
    Route::post('/govt/creditors/multiple/import/creditor', [GovtCreditorController::class, 'import_to_creditor'])->name('admin_govt_creditors_import_to_creditor');
    Route::post('/govt/creditors/multiple/import/mortgage', [GovtCreditorController::class, 'import_to_mortgage'])->name('admin_govt_creditors_import_to_mortgage');
    Route::post('/govt/creditors/multiple/delete', [GovtCreditorController::class, 'multiple_delete'])->name('admin_govt_creditors_multiple_delete');

    /* CourtHouses section*/
    Route::get('/courthouses/show', [CourtHousesController::class, 'index'])->name('admin_courthouses_index');
    Route::post('/courthouses/add', [CourtHousesController::class, 'create'])->name('admin_courthouses_create');
    Route::post('/courthouses/store', [CourtHousesController::class, 'store'])->name('admin_courthouses_store');
    Route::get('/courthouses/edit/{id}', [CourtHousesController::class, 'edit'])->name('admin_courthouses_edit');
    Route::post('/courthouses/update/{id}', [CourtHousesController::class, 'update'])->name('admin_courthouses_update');
    Route::post('/courthouses/delete/{id}', [CourtHousesController::class, 'delete'])->name('admin_courthouses_delete');
    Route::post('/courthouses/multiple/delete', [CourtHousesController::class, 'multiple_delete'])->name('courthouse_multiple_delete');
    Route::post('/courthouses/import', [CourtHousesController::class, 'import'])->name('admin_courthouses_import');

    /* Mortgages section*/
    Route::get('/mortgages/show', [MortgagesController::class, 'index'])->name('admin_mortgages_index');
    Route::post('/mortgages/add', [MortgagesController::class, 'create'])->name('admin_mortgages_create');
    Route::post('/mortgages/store', [MortgagesController::class, 'store'])->name('admin_mortgages_store');
    Route::get('/mortgages/edit/{id}', [MortgagesController::class, 'edit'])->name('admin_mortgages_edit');
    Route::post('/mortgages/update/{id}', [MortgagesController::class, 'update'])->name('admin_mortgages_update');
    Route::post('/mortgages/delete/{id}', [MortgagesController::class, 'delete'])->name('admin_mortgages_delete');
    Route::get('/mortgages/activate/{id}', [MortgagesController::class, 'activate'])->name('admin_mortgages_activate');
    Route::post('/mortgages/multiple/delete', [MortgagesController::class, 'multiple_delete'])->name('mortgage_multiple_delete');

    /* Deduction List section*/
    Route::get('/deduction/show', [AdminDeductionListController::class, 'index'])->name('admin_deduction_index');
    Route::post('/deduction/add', [AdminDeductionListController::class, 'create'])->name('admin_deduction_create');
    Route::post('/deduction/update', [AdminDeductionListController::class, 'update'])->name('admin_deduction_update');
    Route::post('/deduction/delete/', [AdminDeductionListController::class, 'delete'])->name('admin_deduction_delete');

    /* State Taxes section*/
    Route::get('/debtstaxes/show', [DebtStateTaxesController::class, 'index'])->name('admin_debtstaxes_index');
    Route::post('/debtstaxes/add', [DebtStateTaxesController::class, 'create'])->name('admin_debtstaxes_create');
    Route::post('/debtstaxes/store', [DebtStateTaxesController::class, 'store'])->name('admin_debtstaxes_store');
    Route::get('/debtstaxes/edit/{id}', [DebtStateTaxesController::class, 'edit'])->name('admin_debtstaxes_edit');
    Route::post('/debtstaxes/update/{id}', [DebtStateTaxesController::class, 'update'])->name('admin_debtstaxes_update');
    Route::post('/debtstaxes/delete/{id}', [DebtStateTaxesController::class, 'delete'])->name('admin_debtstaxes_delete');

    /** Domestic Address */
    Route::get('/domesticaddress/show', [AdminDomesticAddressController::class, 'index'])->name('admin_domestic_index');
    Route::post('/domesticaddress/add', [AdminDomesticAddressController::class, 'create'])->name('admin_domestic_create');
    Route::post('/domesticaddress/store', [AdminDomesticAddressController::class, 'store'])->name('admin_domestic_store');
    Route::get('/domesticaddress/edit/{id}', [AdminDomesticAddressController::class, 'edit'])->name('admin_domestic_edit');
    Route::post('/domesticaddress/update/{id}', [AdminDomesticAddressController::class, 'update'])->name('admin_domestic_update');
    Route::post('/domesticaddress/delete/{id}', [AdminDomesticAddressController::class, 'delete'])->name('admin_domestic_delete');

    /** District Form Order */
    Route::get('/districtform/show', [DistrictFormOrderController::class, 'index'])->name('admin_districtform_index');
    Route::get('/get-district-form/{district_id}', [DistrictFormOrderController::class, 'get_district_from_order'])->name('get_district_form');
    Route::post('/save-district-form-order', [DistrictFormOrderController::class, 'save_district_form_order'])->name('save_district_form_order');
    Route::post('/district-form-edit/{district_id}', [DistrictFormOrderController::class, 'district_form_edit'])->name('district_form_edit');
    Route::get('/district/show', [AdminDistrictsController::class, 'index'])->name('admin_district_index');
    Route::post('/save-district-order', [AdminDistrictsController::class, 'save_district_order'])->name('save_district_order');
    Route::post('/save/chapter/thirteen', [AdminDistrictsController::class, 'chapter_thirteen_status'])->name('chapter_thirteen_status');
    Route::post('/save/region', [AdminDistrictsController::class, 'region_update'])->name('region_update');
    Route::get('/district-crediter-setting/show', [DistrictCreditersSettingController::class, 'index'])->name('district_crediter_setting_index');
    Route::get('/district-crediter-setting/add', [DistrictCreditersSettingController::class, 'create'])->name('district_crediter_setting_create');
    Route::post('/district-crediter-setting/store', [DistrictCreditersSettingController::class, 'store'])->name('district_crediter_setting_store');
    Route::get('/district-crediter-setting/edit/{id}', [DistrictCreditersSettingController::class, 'edit'])->name('district_crediter_setting_edit');
    Route::post('/district-crediter-setting/update/{id}', [DistrictCreditersSettingController::class, 'update'])->name('district_crediter_setting_update');
    Route::get('/district-crediter-setting/delete/{id}', [DistrictCreditersSettingController::class, 'destroy'])->name('district_crediter_setting_delete');
    Route::get('/import/default', [DistrictFormOrderController::class, 'importDefault'])->name('importDefault');

    #Route::get('/get-divisions', [AdminZipCodeController::class, 'getDivisionNames']);
    #Route::get('/get-zip-codes', [AdminZipCodeController::class, 'getZipCodes']);

    /** add manage video page**/
    Route::get('/manage-website-video', [AdminManageVideoController::class, 'index'])->name('admin_manage_video');
    Route::post('/manage-website-video-create', [AdminManageVideoController::class, 'create'])->name('admin_manage_video_create');

    /* Website videos section*/
    Route::get('/webvideos/show', [AdminManageVideoController::class, 'index'])->name('admin_webvideos_index');
    Route::post('/webvideos/add', [AdminManageVideoController::class, 'create'])->name('admin_webvideos_create');
    Route::post('/webvideos/store', [AdminManageVideoController::class, 'store'])->name('admin_webvideos_store');
    Route::post('/webvideos/edit/{id}', [AdminManageVideoController::class, 'edit'])->name('admin_webvideos_edit');
    Route::post('/webvideos/update/{id}', [AdminManageVideoController::class, 'update'])->name('admin_webvideos_update');
    Route::post('/webvideos/delete/{id}', [AdminManageVideoController::class, 'delete'])->name('admin_webvideos_delete');
    Route::get('/ocruploadeddata/{id}', [AdminClientController::class, 'ocrlisting'])->name('ocrlisting');

    /* County FIPS section*/
    Route::get('/fips/show', [AdminCountyFipsController::class, 'index'])->name('admin_fips_index');
    Route::post('/fips/add', [AdminCountyFipsController::class, 'create'])->name('admin_fips_create');
    Route::get('/fips/edit/{id}', [AdminCountyFipsController::class, 'edit'])->name('admin_fips_edit');
    Route::post('/fips/update/{id}', [AdminCountyFipsController::class, 'update'])->name('admin_fips_update');
    Route::post('/fips/delete/{id}', [AdminCountyFipsController::class, 'delete'])->name('admin_fips_delete');
    Route::get('/clientprofileloginbyadmin/{id}', [AdminClientController::class, 'admin_client_login'])->name('admin_client_login');
    Route::post('generate-shorten-link', 'App\Http\Controllers\AdminAttorneyController@getSetLink')->name('generate.shorten.link.post');
    Route::get('/attorneyprofileloginbyadmin/{id}', [AdminAttorneyController::class, 'admin_attorney_login'])->name('admin_attorney_login');
    /**Simle text api calls */
    Route::post('/simpletext/mesages', [AdminSimpleTextMessagesController::class, 'admin_simpletext_messages'])->name('admin_simpletext_messages');
    Route::post('/simpletext/send', [AdminSimpleTextMessagesController::class, 'admin_simpletext_messages_send'])->name('admin_simpletext_messages_send');

    Route::get('/document/list/{type}', [AdminDocumentController::class, 'client_document_directory_list'])->name('client_document_directory_list');
    Route::get('/document/sync/to/s3', [AdminDocumentController::class, 'client_document_directory_sync_with_s3'])->name('client_document_directory_sync_with_s3');
    Route::get('/fix/doc/type/special', [AdminConciergeClientController::class, 'fix_doc_type_for_requested_docs'])->name('fix_doc_type_for_requested_docs');
    Route::get('/user/login-history', [UserLoginHistoryController::class, 'userLoginHistory'])->name('userLoginHistory');

    Route::get('/guide/document', [AdminDocumentGuideImageController::class, 'index'])->name('admin_guide_documents');
    Route::post('/upload-guide-document', [AdminDocumentGuideImageController::class, 'uploadToS3'])->name('admin_documents_upload');
    Route::get('/document-guide/preview/{type}', [AdminDocumentGuideImageController::class, 'getPreview']);
    Route::post('/document/guide/delete', [AdminDocumentGuideImageController::class, 'deleteImg'])->name('admin_guide_documents_delete');

    Route::get('/property/request/show', [AdminPropertyRequestController::class, 'index'])->name('admin_property_request_index');
	Route::match(['get', 'post'], '/client/change/case/filed', [AdminConciergeClientController::class, 'adminChangeCaseFiled'])->name('admin_client_case_filed');
    Route::match(['get', 'post'], '/client/change/case/filed/popup/preview', [AdminConciergeClientController::class, 'adminChangeCaseFiledPreviewPopup'])->name('admin_client_case_filed_preview_popup');
    Route::match(['get', 'post'], '/client/change/case/filed/popup', [AdminConciergeClientController::class, 'adminChangeCaseFiledPopup'])->name('admin_client_case_filed_popup');
    Route::match(['get', 'post'], '/client/change/case/filed/save', [AdminConciergeClientController::class, 'adminChangeCaseFiled'])->name('admin_client_case_filed');
    Route::match(['get', 'post'], '/client/change/case/filed/not/available', [AdminConciergeClientController::class, 'adminChangeCaseFiledNotAvailable'])->name('admin_client_case_filed_not_available');

});
