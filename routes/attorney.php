<?php

use App\Http\Controllers\IntakeFormController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Attorney\ClientLoginHistoryController;
use App\Http\Controllers\Attorney\ClientController;
use App\Http\Controllers\Attorney\SettingsController;
use App\Http\Controllers\Attorney\AttorneyCreditReportController;
use App\Http\Controllers\Attorney\AttorneyCinReportController;
use App\Http\Controllers\Attorney\AttorneyProfileController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\AttorneyChatController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Attorney\PdfController;
use App\Http\Controllers\Attorney\AttorneyClientQuestionnaireController;
use App\Http\Controllers\Attorney\AttorneyBciController;
use App\Http\Controllers\Attorney\AttorneyDocumentController;
use App\Http\Controllers\Attorney\AttorneyCrsReportController;
use App\Http\Controllers\Attorney\AttorneyPaystubController;
use App\Http\Controllers\Attorney\AttorneyBankStatementController;
use App\Http\Controllers\Attorney\StatementProfitLossController;
use App\Http\Controllers\Attorney\AttorneyBaseController;
use App\Http\Controllers\Attorney\OfficialFormController;
use App\Http\Controllers\Attorney\ClientManagementController;
use App\Http\Controllers\Attorney\AttorneyDashboardController;
use App\Http\Controllers\Attorney\CreditReportController;
use App\Http\Controllers\Attorney\ClientCreditorsController;
use App\Http\Controllers\Attorney\AttorneyDocumentActionController;
use App\Http\Controllers\Attorney\AttorneySubscriptionController;
use App\Http\Controllers\Attorney\FilingInformationController;
use App\Http\Controllers\Attorney\ChapterPlanController;
use App\Http\Controllers\Attorney\ParalegalPopupController;
use App\Http\Controllers\Attorney\MeanTestPopupController;
use App\Http\Controllers\Attorney\JubileeImportController;
use App\Http\Controllers\Attorney\ScheduleABPopupController;
use App\Http\Controllers\Attorney\PayrollPurchaseController;
use App\Http\Controllers\Attorney\QuestionnaireRequestController;
use App\Http\Controllers\Attorney\DocumentNotificationController;
use App\Http\Controllers\Attorney\CombineDocumentController;
use App\Http\Controllers\Attorney\AttorneySimpleTextMessagesController;
use App\Http\Controllers\Attorney\ParalegalsController;
use App\Http\Controllers\Attorney\AttorneyTemplateController;
use App\Http\Controllers\Attorney\Questionnaire\BasicInfoEditController;
use App\Http\Controllers\Attorney\Questionnaire\PropertyEditController;
use App\Http\Controllers\Attorney\DocumentChecklistController;
use App\Http\Controllers\Attorney\NotificationTemplatesController;
use App\Http\Controllers\Attorney\LawFirmController;
use App\Http\Controllers\Attorney\CreditCounselingController;
use App\Http\Controllers\Attorney\AiProcessedController;
use App\Http\Controllers\Attorney\DocumentUploadedController;

Route::group(['prefix' => 'attorney', 'middleware' => ['auth', 'is_attorney', 'twofactor']], static function () {

    Route::get('/landing', [AttorneyBaseController::class, 'landing'])->name('attorney_landing');
    Route::post('/landing', [AttorneyBaseController::class, 'landing'])->name('attorney_landing');
    Route::get('/pricing', [AttorneyBaseController::class, 'pricing'])->name('attorney_price_table');
    Route::get('/dashboard', [AttorneyBaseController::class, 'dashboard'])->name('attorney_dashboard');
    Route::get('/logout', [AttorneyProfileController::class, 'logout'])->name('attorney_logout');

    Route::get('/admin/back/to/dashboard/{id}', [AttorneyProfileController::class, 'admin_login_dashboard_via_attorney'])->name('admin_login_dashboard_via_attorney');
    Route::get('/admin/back/to/dashboard/viaparalegal/{id}', [AttorneyProfileController::class, 'admin_login_dashboard_via_paralegal'])->name('admin_login_dashboard_via_paralegal');

    // :::::::::::::::::: aman routes start ::::::::::::::::
    Route::get('/clientchat', [AttorneyChatController::class, 'clientchat'])->name('clientChat');
    Route::post('/attachment-upload', [AttorneyChatController::class, 'Attachment_upload'])->name('attachment_upload');
    Route::post('/send-notification', [AttorneyChatController::class, 'SendNotification'])->name('send_notification');
    // :::::::::::::::::: aman routes end ::::::::::::::::

    /* Attorney Management section*/
    Route::post('/client/add', [ClientController::class, 'store'])->name('attorney_client_add');
    Route::match(['get', 'post'], '/client/edit/{id}', [AttorneyController::class, 'edit'])->name('attorney_client_edit');
    Route::get('/client/view/{id}', [ClientController::class, 'show'])->name('attorney_client_view');
    Route::post('/client/delete', [ClientController::class, 'delete'])->name('attorney_client_delete');
    Route::post('/client/changestatus', [ClientController::class, 'changeStatus'])->name('attorney_client_status');

    Route::post('/client/resend/invite', [ClientController::class, 'reSendInvite'])->name(
        'attorney_client_resend_invite'
    );
    Route::get('/clientprofilelogin/{id}', [AttorneyDashboardController::class, 'client_login'])->name('attorney_client_login');
    Route::match(['get', 'post'], '/client/help/popup', [ClientController::class, 'helpPopup'])->name('helpPopup');

    Route::post('/attorney/price/available', [ClientController::class, 'checkPackagesAvailablity'])->name(
        'check_package_available_for_attorney'
    );

    Route::post('/attorney/purchase/package', [AttorneySubscriptionController::class, 'purchase_package_for_attorney'])->name(
        'purchase_package_for_attorney'
    );


    Route::post('/attorney/package/add/to/client', [AttorneySubscriptionController::class, 'purchase_package_add_to_client'])->name(
        'purchase_package_add_to_client'
    );



    Route::post('/package/purchase/popup', [OfficialFormController::class, 'package_purchase_popup'])->name('package_purchase_popup');
    Route::post('/add/package/to/client', [ClientController::class, 'add_package_to_client'])->name('add_package_to_client');

    Route::post('/payroll/purchase/popup', [PayrollPurchaseController::class, 'payroll_purchase_popup'])->name('payroll_purchase_popup');
    Route::post('/bank/assistant/purchase/popup', [PayrollPurchaseController::class, 'bank_assistant_purchase_popup'])->name('bank_assistant_purchase_popup');
    Route::post('/bank/assistant/premium/purchase/popup', [PayrollPurchaseController::class, 'bank_assistant_premium_purchase_popup'])->name('bank_assistant_premium_purchase_popup');
    Route::post('/profit/loss/purchase/popup', [PayrollPurchaseController::class, 'profit_loss_purchase_popup'])->name('profit_loss_purchase_popup');
    Route::post('/credit/report/purchase/popup', [PayrollPurchaseController::class, 'credit_report_purchase_popup'])->name('credit_report_purchase_popup');
    Route::post('/subscription/purchase/popup', [PayrollPurchaseController::class, 'free_package_purchase_popup'])->name('free_package_purchase_popup');

    Route::get('/client/management/{type?}', [AttorneyDashboardController::class, 'client_management'])->name('attorney_client_management');
    Route::get('/paralegal/management', [ParalegalsController::class, 'index'])->name('attorney_paralegal_management');
    Route::post('/paralegal/add', [ParalegalsController::class, 'add'])->name('attorney_paralegal_add');
    Route::match(['get', 'post'], '/paralegal/edit/{id}', [ParalegalsController::class, 'edit'])->name('attorney_paralegal_edit');
    Route::get('/paralegal/view/{id}', [ParalegalsController::class, 'view'])->name('attorney_paralegal_view');
    Route::post('/paralegal/delete', [ParalegalsController::class, 'delete'])->name('attorney_paralegal_delete');

    Route::post('/paralegal/popup/edit/{id}', [ParalegalsController::class, 'edit_popup'])->name('attorney_paralegal_edit_popup');
    Route::post('/paralegal/popup/toggle/menu/{id}', [ParalegalsController::class, 'toggle_menu_items_popup'])->name('attorney_paralegal_toggle_menu_items_popup');
    Route::post('/paralegal/popup/toggle/menu/item/save', [ParalegalsController::class, 'toggle_menu_items_popup_save'])->name('toggle_menu_items_popup_save');

    Route::post('/client/management/document/list/request/popup', [AttorneyDashboardController::class, 'edit_attorney_request_popup'])->name('edit_attorney_request_popup');
    Route::post('/client/management/document/list/popup', [AttorneyDashboardController::class, 'attorney_documents_list_popup_non_concierge'])->name('non_concierge_documents_list_popup');
    Route::post('/client/management/document/list/popup/translate', [AttorneyDashboardController::class, 'translate_to_spanish'])->name('translate_to_spanish');
    Route::post('/client/management/document/list/popup/add/document', [AttorneyDashboardController::class, 'add_attorney_client_document'])->name('add_attorney_client_document');
    Route::post('/client/management/document/list/popup/notify/client', [AttorneyDashboardController::class, 'attorney_notify_client_for_docs'])->name('attorney_notify_client_for_docs');
    Route::post('/client/management/document/list', [AttorneyDashboardController::class, 'attorney_documents_list_popup'])->name('attorney_documents_list_popup');
    Route::post('/client/management/password/reset', [AttorneyDashboardController::class, 'client_password_reset_popup_by_attorney'])->name('client_password_reset_popup_by_attorney');
    Route::post('/client/management/password/reset/save', [AttorneyDashboardController::class, 'client_password_reset_save_by_attorney'])->name('client_password_reset_save_by_attorney');
    Route::post('/client/management/send/paralegal/info', [AttorneyDashboardController::class, 'send_paralegal_info_to_client_popup_by_attorney'])->name('send_paralegal_info_to_client_popup_by_attorney');
    Route::post('/client/management/send/paralegal/info/save', [AttorneyDashboardController::class, 'send_paralegal_info_to_client_by_attorney'])->name('send_paralegal_info_to_client_by_attorney');

    Route::post('/update/name', [ClientController::class, 'update_name'])->name('update_name');
    Route::post('/update/email', [ClientController::class, 'update_email'])->name('update_email');
    Route::post('/update/phone', [ClientController::class, 'update_phone'])->name('update_phone');

    Route::post('/save-document-order', [AttorneyDocumentActionController::class, 'save_document_order'])->name('save_document_order');
    Route::post('/update-tax-name-after-order', [AttorneyDocumentActionController::class, 'update_tax_name_after_order'])->name('update_tax_name_after_order');
    Route::post('/update-bank-name-after-order', [AttorneyDocumentActionController::class, 'update_bank_name_after_order'])->name('update_bank_name_after_order');

    Route::post('/client/uploaded/documents/mark/read', [AttorneyDocumentController::class, 'mark_document_seen'])->name('mark_document_seen');
    Route::get('/client/uploaded/documents/{id}', [DocumentUploadedController::class, 'client_uploaded_documents'])->name('attorney_client_uploaded_documents');
    Route::post('/client/document/bank/delete', [AttorneyDocumentActionController::class, 'delete_bank_type'])->name('delete_bank_type');
    Route::post('/client/requested/document/delete', [AttorneyDocumentActionController::class, 'delete_requested_doc_type'])->name('delete_requested_doc_type');
    Route::post('/client/decline/popup', [AttorneyDocumentActionController::class, 'client_decline_docs_popup'])->name('client_decline_docs_popup');
    Route::post('/client/document/status', [AttorneyDocumentActionController::class, 'client_document_status'])->name('client_document_status');
    Route::post('/client/document/delete', [AttorneyDocumentActionController::class, 'client_document_delete'])->name('client_document_delete');
    Route::post('/client/child/document/delete', [AttorneyDocumentActionController::class, 'client_child_document_delete'])->name('client_child_document_delete');
    Route::post('/client/document/enable/reupload', [AttorneyDocumentActionController::class, 'client_document_enable_reupload'])->name('client_document_enable_reupload');
    Route::post('/client/delete/documents', [AttorneyDocumentActionController::class, 'client_delete_documents'])->name('attorney_client_delete_documents');
    Route::post('/update/document/name', [AttorneyDocumentActionController::class, 'update_doc_name'])->name('update_doc_name');
    Route::post('/update/document/date', [AttorneyDocumentActionController::class, 'update_doc_date'])->name('update_doc_date');
    Route::post('/client/uploaded/documents/post-submission/add', [AttorneyDocumentController::class, 'post_submission_document_add'])->name('post_submission_document_add');


    Route::match(['get', 'post'], '/process/client/paystub/via/graphql', [AiProcessedController::class, 'process_by_graphql'])->name('process_by_graphql');
    Route::match(['get', 'post'], '/process/client/paystub/via/graphql/all', [AiProcessedController::class, 'process_by_graphql_for_all_employers'])->name('process_by_graphql_for_all_employers');

    Route::post('/update/document/type', [AttorneyDocumentController::class, 'move_document_to'])->name('move_document_to');
    Route::post('/update/document/creditor', [AttorneyDocumentController::class, 'update_creditors_to_doc'])->name('update_creditors_to_doc');

    Route::post('/update/viewedByAttorney', [AttorneyDocumentController::class, 'update_viewed_by_attorney'])->name('update_viewed_by_attorney');

    Route::get('/client/document/zip/{id}/{type}', [AttorneyDocumentActionController::class, 'client_document_zip_download'])->name('client_document_zip_download');
    Route::post('/mark/not/own/document', [AttorneyDocumentActionController::class, 'mark_own_document'])->name('mark_own_document');
    Route::get('/paystub/zip/{id}/{type}', [AttorneyPaystubController::class, 'paystub_zip_download'])->name('paystub_zip_download');
    Route::post('/paystub/create/form', [AttorneyPaystubController::class, 'add_new_paystub'])->name('add_new_paystub');
    Route::post('/paystub/pay/check/calculation', [AttorneyPaystubController::class, 'pay_check_calculation'])->name('pay_check_calculation');
    Route::post('/paystub/copy/form/save', [AttorneyPaystubController::class, 'copy_save_new_paystub'])->name('copy_save_new_paystub');
    Route::post('/paystub/document/save', [AttorneyPaystubController::class, 'save_paystub_doc'])->name('save_paystub_doc');
    Route::post('/paystub/clone/form/save', [AttorneyPaystubController::class, 'clone_save_new_paystub'])->name('clone_save_new_paystub');
    Route::post('/paystub/create/form/save', [AttorneyPaystubController::class, 'save_new_paystub'])->name('save_new_paystub');
    Route::post('/paystub/copy/form', [AttorneyPaystubController::class, 'copy_paystub'])->name('copy_paystub');
    Route::post('/paystub/clone/form', [AttorneyPaystubController::class, 'clone_paystub'])->name('clone_paystub');
    Route::post('/paystub/import/data/others', [AttorneyPaystubController::class, 'import_data_to_other_paystubs'])->name('import_data_to_other_paystubs');
    Route::post('/paystub/import/data/this', [AttorneyPaystubController::class, 'import_data_to_this_paystubs'])->name('import_data_to_this_paystubs');
    Route::post('/paystub/calculation/logs/popup', [AttorneyPaystubController::class, 'calculation_logs_popup'])->name('calculation_logs_popup');
    Route::post('/paystub/new/monthlypay', [AttorneyPaystubController::class, 'new_monthly_pay'])->name('new_monthly_pay');
    Route::post('/paystub/save/monthlypay', [AttorneyPaystubController::class, 'save_monthly_pay_form'])->name('save_monthly_pay_form');
    Route::post('/paystub/edit/form', [AttorneyPaystubController::class, 'edit_paystub'])->name('edit_paystub');
    Route::post('/paystub/manage/employer', [AttorneyPaystubController::class, 'manage_employer'])->name('manage_employer');
    Route::post('/paystub/delete/employer', [AttorneyPaystubController::class, 'delete_employer'])->name('delete_employer');
    Route::post('/paystub/edit/employer', [AttorneyPaystubController::class, 'edit_employer'])->name('edit_employer');
    Route::post('/paystub/save/employer', [AttorneyPaystubController::class, 'save_employer'])->name('save_employer');
    Route::post('/paystub/employer/autosuggest', [AttorneyPaystubController::class, 'employer_search'])->name('employer_search');
    Route::post('/paystub/override', [AttorneyPaystubController::class, 'override_paystub_date'])->name('override_paystub_date');

    Route::get('/client/byatt/taxreturn/combine/{id}/{type}/{employer_id?}', [CombineDocumentController::class, 'att_combine_and_download_tax_return'])->name('combine_and_download_tax_return');
    Route::post('/client/byatt/taxreturn/get-documents/{id}/{type}/{employer_id?}', [CombineDocumentController::class, 'get_document_for_combine'])->name('get_document_for_combine');
    Route::post('/client/get-thumbnail-generate-status', [AttorneyDocumentController::class, 'get_thumbnail_generate_status'])->name('get_thumbnail_generate_status');
    /* report upload */
    Route::post('/client/credit/report/uploads', [AttorneyCreditReportController::class, 'credit_report_uploads'])->name('credit_report_uploads');

    Route::match(['get', 'post'], '/client/credit/report/edit/{id}/{dType?}', [CreditReportController::class, 'credit_report_edit'])->name('attorney_edit_client_report');
    Route::match(['post'], '/import/schedule', [AttorneyCrsReportController::class, 'import_schedule'])->name('import_schedule');
    Route::match(['post'], '/import/schedule/d', [AttorneyCrsReportController::class, 'import_schedule_d'])->name('import_schedule_d');
    Route::match(['post'], '/import/schedule/vehicle', [AttorneyCrsReportController::class, 'import_schedule_d_vehicle'])->name('import_schedule_d_vehicle');
    Route::match(['post'], 'manual/import/schedule', [CreditReportController::class, 'manual_import_schedule'])->name('manual_import_schedule');
    Route::match(['post'], 'popup/import/csv', [CreditReportController::class, 'csv_import_popup'])->name('csv_import_popup');
    Route::match(['post'], 'popup/import/csv/save', [CreditReportController::class, 'csv_import_save'])->name('csv_import_save');
    Route::match(['post'], 'creditor/iincurred/date/save', [CreditReportController::class, 'save_creditor_incurred_date'])->name('save_creditor_incurred_date');
    Route::match(['post'], 'import/unsecured/save', [CreditReportController::class, 'import_unsecured_to_client'])->name('import_unsecured_to_client');
    Route::match(['post'], 'delete/record', [CreditReportController::class, 'delete_crs_creditor'])->name('delete_crs_creditor');
    Route::post('/manual/save/creditors', [AttorneyCrsReportController::class, 'manual_save_creditors'])->name('manual_save_creditors');

    Route::match(['post'], 'popup/import/cin/popup', [AttorneyCinReportController::class, 'cin_report_popup'])->name('cin_report_popup');
    Route::match(['post'], 'popup/import/cin/upload', [AttorneyCinReportController::class, 'cin_report_upload'])->name('cin_report_upload');
    Route::match(['post'], 'popup/import/cin/review', [AttorneyCinReportController::class, 'cin_report_review'])->name('cin_report_review');
    Route::match(['post'], 'popup/import/cin/status', [AttorneyCinReportController::class, 'cin_report_save'])->name('cin_report_save');

    Route::match(['post'], '/manual/resident/form', [AttorneyCrsReportController::class, 'manual_add_resident_form'])->name('manual_add_resident_form');
    Route::match(['post'], '/manual/resident/setup', [AttorneyCrsReportController::class, 'manual_resident_setup'])->name('manual_resident_setup');
    Route::match(['post'], '/manual/vehicle/form', [AttorneyCrsReportController::class, 'manual_add_vehicle_form'])->name('manual_add_vehicle_form');
    Route::match(['post'], '/manual/vehicle/setup', [AttorneyCrsReportController::class, 'manual_vehicle_setup'])->name('manual_vehicle_setup');



    Route::post('/client/{id}/credit-report/popup', [AttorneyBciController::class, 'attorney_bci_popup'])->name('download_attorney_bci_popup');
    Route::post('/client/{id}/credit-report/download/bci', [AttorneyBciController::class, 'download_attorney_bci'])->name('download_attorney_bci');


    Route::post('/client/{id}/jubliee/import/popup', [JubileeImportController::class, 'jubliee_import_popup'])->name('download_jubliee_import_popup');
    Route::post('/client/{id}/jubliee/import/file', [JubileeImportController::class, 'index'])->name('download_jubliee_import');

    Route::match(['get', 'post'], '/questionnaire/intake', [QuestionnaireRequestController::class, 'index'])->name('questionnaire_index');
    Route::post('/questionnaire/import', [QuestionnaireRequestController::class, 'import'])->name('questionnaire_import');
    Route::post('/questionnaire/view', [QuestionnaireRequestController::class, 'questionnaire_view'])->name('questionnaire_view');
    Route::post('/questionnaire/log/show', [QuestionnaireRequestController::class, 'show_log_history_modal'])->name('show_log_history_modal');
    Route::post('/question/conditional/save', [QuestionnaireRequestController::class, 'conditional_questions_save'])->name('conditional_questions_save');
    Route::post('/question/notes', [QuestionnaireRequestController::class, 'attorney_short_form_notes_popup'])->name('attorney_short_form_notes_popup');
    Route::post('/question/notes/save', [QuestionnaireRequestController::class, 'attorney_short_form_notes_save'])->name('attorney_short_form_notes_save');
    Route::post('/question/notes/update', [QuestionnaireRequestController::class, 'attorney_short_form_notes_update'])->name('attorney_short_form_notes_update');
    Route::post('/question/save', [QuestionnaireRequestController::class, 'attorney_concierge_question_save'])->name('attorney_concierge_question_save');
    Route::post('/question/update', [QuestionnaireRequestController::class, 'attorney_concierge_question_update'])->name('attorney_concierge_question_update');
    Route::post('/question/delete', [QuestionnaireRequestController::class, 'attorney_concierge_question_delete'])->name('attorney_concierge_question_delete');
    Route::get('/questionnaire/download/{id}', [QuestionnaireRequestController::class, 'print_pdf'])->name('print_pdf');
    Route::post('/questionnaire/delete', [QuestionnaireRequestController::class, 'delete_intake_request'])->name('delete_intake_request');

    /* Setting section setup */
    Route::get('/myprofile', [AttorneyProfileController::class, 'profile'])->name('attorney_profile');
    Route::get('/settings', [SettingsController::class, 'index'])->name('attorney_settings');
    Route::post('/settings/save', [SettingsController::class, 'attorney_setting_save'])->name('attorney_setting_save');
    Route::post('/settings/notification/save', [SettingsController::class, 'attorney_notification_setting_save'])->name('attorney_notification_setting_save');

    // Law firm settings
    Route::get('/lawfirm/settings/{associate_id}', [SettingsController::class, 'index'])->name('attorney_lawfirm_settings');


    Route::post('/myprofile/subpackage', [AttorneyProfileController::class, 'settingsPopupSubPackageArray'])->name('settingsPopupSubPackageArray');
    Route::post('/subscription', [AttorneySubscriptionController::class, 'subscription'])->name('attorney_subscription');
    Route::post('/video/subscription', [AttorneySubscriptionController::class, 'video_subscription'])->name('attorney_video_subscription');


    Route::post('/petition/subscription', [AttorneySubscriptionController::class, 'petition_subscription'])->name('attorney_petition_subscription');

    Route::get('/form/submission/view/{id}', [AttorneyClientQuestionnaireController::class, 'form_submission_view'])->name('attorney_form_submission_view');
    Route::post('/review/status/update', [AttorneyClientQuestionnaireController::class, 'update_review_status'])->name('update_review_status');

    Route::post('/clientprofitloss/to/zip', [AttorneyClientQuestionnaireController::class, 'add_profit_loss_to_client_zip'])->name('add_profit_loss_to_client_zip');
    Route::get('/clientprofitloss/zip/{id}', [AttorneyClientQuestionnaireController::class, 'client_profit_loss_popup_zip_download'])->name('client_profit_loss_popup_zip_download');

    Route::post('/paralegal/popup/{id}', [AttorneyClientQuestionnaireController::class, 'paralegal_check_popup'])->name('paralegal_check_popup');

    Route::post('/company/profile', [AttorneyProfileController::class, 'company_profile'])->name('attorney_company_profile');
    Route::match(['get', 'post'], '/update/password', [AttorneyProfileController::class, 'update_password'])->name('attorney_update_password');
    Route::post('/retainer/document', [AttorneyDocumentController::class, 'retainer_document'])->name('attorney_retainer_doc');

    Route::match(['get', 'post'], '/sign/document/{id}', [AttorneyDocumentController::class, 'signed_document'])->name('attorney_signed_doc');
    Route::post('/signed/document/{id}', [AttorneyDocumentController::class, 'save_signed_document'])->name('save_signed_document');


    Route::match(['get', 'post'], '/delete/sign/document/{id}/{file_name}', [AttorneyDocumentController::class, 'delete_signed_document'])->name('attorney_delete_signed_doc');


    Route::get('/income/profitlossdownload/{id}/{for_month}/{existing_type}/{onchange}', [AttorneyClientQuestionnaireController::class, 'client_profit_loss_popup_download'])->name('client_profit_loss_popup_download');
    Route::get('/income/spouseprofitlossdownload/{id}/{for_month}/{existing_type}/{onchange}', [AttorneyClientQuestionnaireController::class, 'client_spouse_profit_loss_popup_download'])->name('client_spouse_profit_loss_popup_download');


    Route::get('/upload/credit/report/{id}', [AttorneyCreditReportController::class, 'upload_credit_form'])->name('attorney_client_upload_credit_report');
    Route::match(['get', 'post'], '/delete/credit/report/{id}/{file_name}', [AttorneyCreditReportController::class, 'attorney_delete_credit_report'])->name('attorney_delete_credit_report');


    Route::get('/client/paystub/{id}/{type?}', [AttorneyPaystubController::class, 'client_paystub'])->name('client_paystub');
    Route::get('/client/paystub/partner/{id}/{type?}', [AttorneyPaystubController::class, 'client_paystub_partner'])->name('client_paystub_partner');
    Route::get('/client/transfer/paystub/{id}/{paystubType}', [AttorneyPaystubController::class, 'transfer_paystub_to_spouse'])->name('transfer_paystub_to_spouse');
    Route::post('/client/paystub/delete', [AttorneyPaystubController::class, 'client_paystub_delete'])->name('client_paystub_delete');
    Route::post('/client/paystub/popup', [AttorneyPaystubController::class, 'show_paystub_calculation'])->name('show_paystub_calculation');
    Route::post('/client/paystub/popup/debtor/import', [AttorneyPaystubController::class, 'pinwheel_calculation_setup_attorney_side'])->name('pinwheel_calculation_setup_attorney_side');
    Route::post('/client/paystub/popup/codebtor/import', [AttorneyPaystubController::class, 'spouse_setup_paystub_calculation_attorney_side'])->name('spouse_setup_paystub_calculation_attorney_side');

    Route::get('/client/bankstatement/index/{client_type}/{id}/{monthNo}/{subscription}', [AttorneyBankStatementController::class, 'bank_statement_index'])->name('bank_statement_index');
    Route::get('/client/bankstatement/{client_type}/{id}/{monthNo}/{key}', [AttorneyBankStatementController::class, 'bank_statement'])->name('bank_statement');
    Route::get('/client/statement/download/{client_type}/{id}', [AttorneyBankStatementController::class, 'download_bank_statement'])->name('download_bank_statement');
    Route::get('/client/statement/download/zip/{client_type}/{id}/{key}/{monthNo}', [AttorneyBankStatementController::class, 'statement_zip_download'])->name('statement_zip_download');
    Route::post('/client/statement/expense/update', [StatementProfitLossController::class, 'updateExpenseType'])->name('updateExpenseType');
    Route::get('/client/statement/download/pdf/{client_id}}/{statement_id}', [AttorneyBankStatementController::class, 'download_pdf'])->name('download_pdf_new');
    Route::get('/client/statement/download/pdf/all/{client_id}', [AttorneyBankStatementController::class, 'download_pdf_all'])->name('download_pdf_all_new');
    Route::post('/client/bankstatement/import/popup', [AttorneyBankStatementController::class, 'import_client_bank_statement_popup'])->name('import_client_bank_statement_popup');
    Route::post('/client/bankstatement/import/save', [AttorneyBankStatementController::class, 'import_client_bank_statement_save'])->name('import_client_bank_statement_save');


    Route::post('/payment', [StripeController::class, 'payment'])->name('attorney_payment');

    Route::post('/subscription-payment', [StripeController::class, 'create_payment'])->name('create_payment');


    Route::match(['post'], '/client/document/uploads/{client_id?}', [AttorneyDocumentController::class, 'upload_client_date'])->name('upload_client_date');
    Route::match(['post'], '/client/document/updated/HTML', [AttorneyDocumentController::class, 'getUpdatedDocViewHTML'])->name('get_updated_doc_view_html');


    Route::get('/transactions', [AttorneyBaseController::class, 'transactions'])->name('attorney_transactions');
    Route::match(['get', 'post'], '/document/management', [AttorneyDocumentController::class, 'manage_document'])->name('attorney_document_mgt');
    Route::match(['post'], '/document/management/edit', [AttorneyDocumentController::class, 'manage_document_edit'])->name('attorney_document_edit');
    Route::match(['post'], '/exclude/docs', [AttorneyDocumentController::class, 'attorney_exclude_docs'])->name('attorney_exclude_docs');

    Route::post('/document/management/setup-attorney-certificate-ccc', [AttorneyDocumentController::class, 'setup_attorney_certificate_ccc'])->name('setup_attorney_certificate_ccc');

    Route::match(['post'], '/save/attorney/data', [OfficialFormController::class, 'save_attorney_data'])->name('save_attorney_data');



    Route::match(['get'], '/csv', [AttorneyController::class, 'csv'])->name('attorney_document_csv');
    Route::match(['get'], '/official/form/{id}', [OfficialFormController::class, 'official_form'])->name('attorney_offical_form');
    Route::get('set-locale/{locale}', function ($locale) {
        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    })->name('language_setup');

    Route::post('/generate/official/pdf', [PdfController::class, 'generatePDF'])->name('generate_official_pdf');
    Route::post('/add/trustee', [PdfController::class, 'assign_trustee'])->name('assign_trustee');
    Route::match(['post','get'], '/combine/official/pdf/{id}/{excludepdf?}/{zipcode?}', [PdfController::class, 'combineOfficialPDF'])->name('generate_combine_official_pdf');
    Route::post('/generatecombined', [PdfController::class, 'combineOfficialPDF2'])->name('generatecombined');
    Route::get('/download/combine/pdf/{id}', [PdfController::class, 'downloadCombined'])->name('downloadCombined');
    Route::post('/submitFormAjax', [PdfController::class, 'submitFormAjax'])->name('submitFormAjax');

    Route::post('/saveFormAjax', [AttorneyController::class, 'saveFormAjax'])->name('saveFormAjax');
    Route::post('/deleteHtmldata', [OfficialFormController::class, 'deleteHtmldata'])->name('deleteHtmldata');



    Route::post('/common/creditors/autosuggest', [AttorneyCrsReportController::class, 'common_creditors_search'])->name('common_creditors_search');

    //ajax call
    Route::post('/client/get/payrollAssistant', [AttorneyController::class, 'get_payroll_assistant_dropdown'])->name('get_payroll_assistant_dropdown');
    Route::post('/vehicle/fetch/vin', [AttorneyController::class, 'fetch_vin_number'])->name('attorney_fetch_vin_number');
    Route::post('/client/autosuggest', [ClientManagementController::class, 'attorney_client_search'])->name('attorney_client_search');
    Route::post('/client/getoption', [ClientManagementController::class, 'get_client_type_option'])->name('get_client_type_option');
    Route::post('paralegal-list-option', [ClientManagementController::class, 'get_paralegal_option'])->name('get_paralegal_option');
    Route::post('/update/clienttype', [ClientController::class, 'update_client_type'])->name('update_client_type');
    Route::post('/update/client-paralegal', [ClientController::class, 'update_client_paralegal'])->name('update_client_paralegal');
    Route::post('/update/client-associate', [ClientController::class, 'update_client_associate'])->name('update_client_associate');


    Route::post('/attorney/exemption', [OfficialFormController::class, 'getExemptionListById'])->name('attorney_exemption');
    Route::get('/client/{id}/download/creditors/xls', [ClientCreditorsController::class, 'download_client_creditors_xls'])->name('download_client_creditors_xls');
    Route::get('/client/{id}/download/creditors/', [ClientCreditorsController::class, 'download_cliet_creditors'])->name('download_cliet_creditors');
    Route::post('/activate/form/tab/', [OfficialFormController::class, 'activate_form_tab_by_attorney'])->name('activate_form_tab_by_attorney');
    Route::get('/reset/to/client/questionnaire/{id}', [OfficialFormController::class, 'resetToClientQuestionnaire'])->name('resetToClientQuestionnaire');
    Route::post('/create/creditor/pdf/{id}', [ClientCreditorsController::class, 'createCreditorPdfByAjax'])->name('createCreditorPdfByAjax');

    Route::post('/attorney/meantest/popup', [MeanTestPopupController::class, 'mean_test_popup'])->name('mean_test_popup');

    Route::post('/paralegal/check/popup', [ParalegalPopupController::class, 'paralegal_popup'])->name('paralegal_popup');

    Route::post('/attorney/meantest/save', [MeanTestPopupController::class, 'mean_test_popup_save'])->name('mean_test_popup_save');

    Route::post('/attorney/meantest/reset', [MeanTestPopupController::class, 'mean_test_popup_reset'])->name('mean_test_popup_reset');

    Route::post('/attorney/meantest/importincome', [MeanTestPopupController::class, 'mean_test_popup_import_income'])->name('mean_test_popup_import_income');

    Route::post('/attorney/schAB/popup', [ScheduleABPopupController::class, 'sch_ab_popup'])->name('sch_ab_popup');

    Route::post('/template/save', [ScheduleABPopupController::class, 'save_ab_template'])->name('save_ab_template');
    Route::post('/template/abimport', [ScheduleABPopupController::class, 'import_ab_template'])->name('import_ab_template');

    Route::post('/update/doc/support/format', [AttorneyDocumentActionController::class, 'client_doc_download_format'])->name(
        'client_doc_download_format'
    );
    Route::post('/update/notification/type', [DocumentNotificationController::class, 'update_notification_type'])->name(
        'update_notification_type'
    );
    Route::post('/update/post/submission/setting', [DocumentNotificationController::class, 'post_submission_documents_enabled'])->name(
        'post_submission_documents_enabled'
    );

    Route::get('/transactions/consumed', [AttorneySubscriptionController::class, 'consumed'])->name('attorney_transactions_consumed');

    Route::post('/filing/information', [FilingInformationController::class, 'filing_information_popup'])->name('filing_information_popup');
    Route::post('/chapter/plan/popup', [ChapterPlanController::class, 'popup'])->name('chapter_pan_popup');
    Route::post('/chapter/plan/popup/save', [ChapterPlanController::class, 'chapter_plan_popup_save'])->name('chapter_plan_popup_save');
    Route::post('/filing/information/save', [FilingInformationController::class, 'filing_information_popup_save'])->name('filing_information_popup_save');
    Route::post('/chapter/plan/popup/reset', [ChapterPlanController::class, 'chapter_plan_popup_reset'])->name('chapter_plan_popup_reset');
    Route::post('/read/sign/doc', [AttorneyDocumentController::class, 'mark_signed_doc_read'])->name('mark_signed_doc_read');
    Route::post('/purchase/concierge', [PayrollPurchaseController::class, 'purchase_concierge_service_popup'])->name('purchase_concierge_service_popup');

    Route::post('/check/api/processed/requests', [AiProcessedController::class, 'index'])->name('get_ai_processed_requests');


    Route::post('/check/for/notes', [AttorneyClientQuestionnaireController::class, 'checkForNotes'])->name('check_for_notes');
    Route::post('/mark/as/notes', [AttorneyClientQuestionnaireController::class, 'mark_notes_as_shown'])->name('mark_notes_as_shown');
    Route::post('/add/attorney/notes', [AttorneyClientQuestionnaireController::class, 'add_attorney_notes'])->name('add_attorney_notes');


    Route::post('/enable/detail/property', [ClientController::class, 'enable_detail_property'])->name('enable_detail_property');
    Route::post('/confirm/html', [OfficialFormController::class, 'confirm_html_forms'])->name('confirm_html_forms');
    Route::post('/delete/request/on/district/change', [OfficialFormController::class, 'delete_last_placed_request'])->name('delete_last_placed_request');
    Route::post('/check/request/queue', [OfficialFormController::class, 'check_request_queue'])->name('check_request_queue');
    Route::post('/client/allow/edit/ques', [AttorneyClientQuestionnaireController::class, 'allow_client_edit_ques'])->name('allow_client_edit_ques');

    Route::post('/reminder/resend', [AttorneyDashboardController::class, 'attorney_resend_reminder_popup'])->name('attorney_resend_reminder_popup');
    Route::post('/reminder/resend/send', [AttorneyDashboardController::class, 'attorney_resend_reminder_send'])->name('attorney_resend_reminder_send');

    /**Simle text api calls */
    Route::post('/simpletext/mesages/attorney', [AttorneySimpleTextMessagesController::class, 'attorney_simpletext_messages'])->name('attorney_simpletext_messages');
    Route::post('/simpletext/send/attorney', [AttorneySimpleTextMessagesController::class, 'attorney_simpletext_messages_send'])->name('attorney_simpletext_messages_send');
    Route::get('/document/download/{id}', [AttorneyDocumentActionController::class, 'client_doc_download'])->name('client_doc_download');
    Route::post('/set/bank/statement/months', [AttorneyDocumentController::class, 'set_bank_statement_months'])->name('set_bank_statement_months');

    Route::post('relate/registration/to/autoloan', [AttorneyDocumentActionController::class, 'relate_vehicle_reg_to_autoloan'])->name('relate_vehicle_reg_to_autoloan');

    Route::get('/client/template/management/{type?}/{subType?}', [AttorneyTemplateController::class, 'template_management'])->name('attorney_template_management');
    Route::post('/client/template/save', [AttorneyTemplateController::class, 'template_data_save'])->name('template_data_save');
    Route::post('/client/template/detailed/property/save', [AttorneyTemplateController::class, 'detailed_property_template_data_save'])->name('detailed_property_template_data_save');
    Route::post('/client/check/zip/status', [AttorneyDocumentActionController::class, 'check_zip_status'])->name('check_zip_status');
    Route::post('/client/delete/bulk/docs/{id?}/{type?}', [AttorneyDocumentActionController::class, 'delete_bulk_documents'])->name('delete_bulk_documents');
    Route::post('/client/accept/bulk/docs/{id?}/{type?}', [AttorneyDocumentActionController::class, 'accept_bulk_documents'])->name('accept_bulk_documents');
    Route::post('/client/decline/bulk/docs/{id?}/{type?}', [AttorneyDocumentActionController::class, 'decline_bulk_documents'])->name('decline_bulk_documents');

    Route::get('/notification/template/list', [NotificationTemplatesController::class, 'index'])->name('notification_template_list');
    Route::post('/notification/template/save', [NotificationTemplatesController::class, 'setup'])->name('notification_template_setup');
    Route::post('/notification/template/automated/save', [NotificationTemplatesController::class, 'automated_setup'])->name('automated_notification_template_setup');
    Route::get('/notification/template/remove/{id}/{type}', [NotificationTemplatesController::class, 'remove'])->name('notification_template_remove');
    Route::post('/notification/template/brodcast', [NotificationTemplatesController::class, 'brodcast'])->name('notification_brodcast_setup');
    Route::post('/notification/template/preview/', [NotificationTemplatesController::class, 'preview'])->name('automated_notification_template_preview');

    // Law Firm Associate Management
    Route::get('/lawfirm/management/list', [LawFirmController::class, 'index'])->name('law_firm_associate_management');
    Route::post('/lawfirm/management/save', [LawFirmController::class, 'setup'])->name('law_firm_associate_setup');
    Route::get('/lawfirm/management/remove/{id}', [LawFirmController::class, 'remove'])->name('law_firm_associate_remove');
    Route::post('/lawfirm/management/edit/{id}', [LawFirmController::class, 'edit_popup'])->name('law_firm_associate_edit');
    Route::post('lawfirm/management/edit/save/{id}', [LawFirmController::class, 'edit_popup_save'])->name('law_firm_associate_edit_save');

    // questionaaire edit routes for Basic info
    Route::post('/basicinfo/step1/edit', [BasicInfoEditController::class, 'basic_info_step1_modal'])->name('basic_info_step1_modal');
    Route::post('/basicinfo/step2/edit', [BasicInfoEditController::class, 'basic_info_step2_modal'])->name('basic_info_step2_modal');
    Route::post('/basicinfo/step3/edit', [BasicInfoEditController::class, 'basic_info_step3_modal'])->name('basic_info_step3_modal');

    Route::post('/basicinfo/step1/save', [BasicInfoEditController::class, 'basic_info_step1_modal_save'])->name('basic_info_step1_modal_save');
    Route::post('/basicinfo/step2/save', [BasicInfoEditController::class, 'basic_info_step2_modal_save'])->name('basic_info_step2_modal_save');
    Route::post('/basicinfo/step3/save', [BasicInfoEditController::class, 'basic_info_step3_modal_save'])->name('basic_info_step3_modal_save');

    // questionaaire edit routes for Property
    Route::post('/property/step1/edit', [PropertyEditController::class, 'property_step1_modal'])->name('property_step1_modal');
    Route::post('/property/step2/edit', [PropertyEditController::class, 'property_step2_modal'])->name('property_step2_modal');
    Route::post('/property/step3/edit', [PropertyEditController::class, 'property_step3_modal'])->name('property_step3_modal');
    Route::post('/property/step4/edit', [PropertyEditController::class, 'property_step4_modal'])->name('property_step4_modal');
    Route::post('/property/step5/edit', [PropertyEditController::class, 'property_step5_modal'])->name('property_step5_modal');
    Route::post('/property/step6/edit', [PropertyEditController::class, 'property_step6_modal'])->name('property_step6_modal');
    Route::post('/property/step7/edit', [PropertyEditController::class, 'property_step7_modal'])->name('property_step7_modal');

    // Property Steps Routes
    Route::post('/property/step1/save', [PropertyEditController::class, 'property_step1_modal_save'])->name('property_step1_modal_save');
    Route::post('/property/step2/save', [PropertyEditController::class, 'property_step2_modal_save'])->name('property_step2_modal_save');
    Route::post('/property/step3/save', [PropertyEditController::class, 'property_step3_modal_save'])->name('property_step3_modal_save');
    Route::post('/property/step4/save', [PropertyEditController::class, 'property_step4_modal_save'])->name('property_step4_modal_save');
    Route::post('/property/step5/save', [PropertyEditController::class, 'property_step5_modal_save'])->name('property_step5_modal_save');
    Route::post('/property/step6/save', [PropertyEditController::class, 'property_step6_modal_save'])->name('property_step6_modal_save');
    Route::post('/property/step7/save', [PropertyEditController::class, 'property_step7_modal_save'])->name('property_step7_modal_save');

    Route::post('/property/step3/asset/save', [PropertyEditController::class, 'property_step3_modal_asset_save'])->name('update_property_asset_att_side');
    Route::post('/property/step3/edit/detailed/item/popup', [PropertyEditController::class, 'detailed_tab_items_popup_att_edit'])->name('detailed_tab_items_popup_att_edit');

    // Shared Routes
    Route::post('/delete/attorney/mobile/video', [AttorneyProfileController::class, 'delete_attorney_mobile_video'])->name('delete_attorney_mobile_video');
    Route::get('/clients/login-history', [ClientLoginHistoryController::class, 'clientLoginHistory'])->name('clientLoginHistory');
    Route::get('/property/bank/transaction/download/pdf', [AttorneyDashboardController::class, 'download_transaction_pdf'])->name('download_transaction_pdf');
    Route::get('/client/pdf-preview/{fileid}', [AttorneyDocumentActionController::class, 'showPdf'])->name('showPdf');
    Route::get('/client/document/checklist/{id}', [DocumentChecklistController::class, 'index'])->name('document_checklist');
    Route::post('/client/paystub/date/change', [AttorneyDocumentActionController::class, 'client_paystub_date_change'])->name('client_paystub_date_change');

    Route::post('/client/profitloss/auto/zip', [AttorneyDocumentActionController::class, 'getProfitLossZipFileforClient'])->name('getProfitLossZipFileforClient');
    Route::post('/client/get-client-documents-view', [AttorneyDocumentController::class, 'get_client_documents_view'])->name('get_client_documents_view');

    Route::post('/client/credit/counseling/popup', [CreditCounselingController::class, 'index'])->name('credit_counseling_popup');
    Route::post('/client/credit/counseling/popup/save', [CreditCounselingController::class, 'save'])->name('save_credit_counseling');

    Route::match(['get', 'post'], '/common/document/management', [AttorneyDocumentController::class, 'attorney_common_document_mgt'])->name('attorney_common_document_mgt');
    Route::match(['post'], '/common/document/management/edit', [AttorneyDocumentController::class, 'attorney_common_document_edit'])->name('attorney_common_document_edit');
    Route::post('/common/doc/delete', [AttorneyDocumentActionController::class, 'attorney_common_doc_delete'])->name('attorney_common_doc_delete');

    // post submission docs
    Route::match(['get', 'post'], '/post-submission/document/management', [AttorneyDocumentController::class, 'attorney_post_submission_document_create'])->name('attorney_post_submission_document_create');
    Route::match(['post'], '/post-submission/document/management/edit', [AttorneyDocumentController::class, 'attorney_post_submission_document_update'])->name('attorney_post_submission_document_update');
    // Route::post('/post-submission/doc/delete', [AttorneyDocumentActionController::class, 'attorney_common_doc_delete'])->name('attorney_common_doc_delete');


    // Case Filed Routes
    Route::match(['get', 'post'], '/client/change/case/filed/popup/preview', [ClientController::class, 'changeCaseFiledPreviewPopup'])->name('attorney_client_case_filed_preview_popup');
    Route::match(['get', 'post'], '/client/change/case/filed/popup', [ClientController::class, 'changeCaseFiledPopup'])->name('attorney_client_case_filed_popup');
    Route::match(['get', 'post'], '/client/change/case/filed/not/available', [ClientController::class, 'changeCaseFiledNotAvailable'])->name('attorney_client_case_filed_not_available');
    Route::match(['get', 'post'], '/client/change/case/filed/save', [ClientController::class, 'changeCaseFiled'])->name('attorney_client_case_filed');
    Route::match(['get', 'post'], '/client/change/case/filed', [ClientController::class, 'changeCaseFiled'])->name('attorney_client_case_filed'); // Also keep this from master, in case it's used elsewhere

    Route::post('/form/intake/save/{dataFor?}/{intakeFormID?}', [IntakeFormController::class, 'intake_form_save_by_attorney'])->name('intake_form_save_by_attorney');

});
