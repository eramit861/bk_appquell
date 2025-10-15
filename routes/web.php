<?php

use App\Http\Controllers\Client\CarmdApiController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\NotificationController;
use App\Http\Controllers\Client\RetainerDocumentController;
use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\Client\ClientAutoSearchController;
use App\Http\Controllers\Client\ClientBasicInfoController;
use App\Http\Controllers\ClientDebtsController;
use App\Http\Controllers\Client\ClientDocumentController;
use App\Http\Controllers\ClientExpensesController;
use App\Http\Controllers\ClientFinancialController;
use App\Http\Controllers\ClientIncomeController;
use App\Http\Controllers\ClientPropertyController;
use App\Http\Controllers\Client\ClientPropertyScannedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AttorneyChatController;
use App\Http\Controllers\Attorney\AttorneyDocumentActionController;
use App\Http\Controllers\CalendlyWebhookController;
use App\Http\Controllers\CustomScriptController;
use App\Http\Controllers\CreditCounselingCertificateWebhookController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AiApiWebhookController;
use App\Http\Controllers\IntakeFormController;
use App\Http\Controllers\UnsubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/download-zip', [App\Http\Controllers\TestController::class, 'download_zip'])->name('download_zip');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/doc/download/{id}', [App\Http\Controllers\HomeController::class, 'doc_download'])->name('doc_download');

Route::match(['get', 'post'], '/calendly/webhook', [CalendlyWebhookController::class, 'calendly_webhook_url'])->name('calendly_webhook_url');

Route::match(['get', 'post'], '/aiapi/webhook/{uid?}', [AiApiWebhookController::class, 'webhook'])->name('ai_api_webhook');

Route::match(['post'], '/aiapi/resend/{uid?}', [AiApiWebhookController::class, 'resend_ai_request'])->name('resend_ai_request');


Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contact');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/county/by/statename', [ClientAjaxController::class, 'get_county_by_state_name'])->name('county_by_state_name');
Route::post('/property/autosuggest', [ClientAutoSearchController::class, 'loan_company_search'])->name('loan_company_search');
Route::post('/mortgage/autosuggest', [ClientAutoSearchController::class, 'mortgage_search'])->name('mortgage_search');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::post('/creditor/creditorautosuggest', [ClientAutoSearchController::class, 'master_credit_search'])->name('master_credit_search');

Route::post('/creditor/category/search', [ClientAutoSearchController::class, 'master_credit_search_by_category'])->name('master_credit_search_by_category');

/* START:: For Terms & Conditions */
Route::get('/terms-of-services', [App\Http\Controllers\HomeController::class, 'terms_of_services'])->name('terms_of_services');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/benefits', [App\Http\Controllers\HomeController::class, 'resources'])->name('resources');
Route::get('/pricing', [App\Http\Controllers\HomeController::class, 'pricing'])->name('pricing');
Route::get('/manual-upload/{code}', 'App\Http\Controllers\ManualDocumentController@shortenLinkManual')->name('manual.shorten.link');
Route::get('/short-form/{code}', 'App\Http\Controllers\OnePageQuestionnaireRequestController@shortenLink')->name('shorten.link');
Route::get('/short-form/custom/{code}/{userId?}', 'App\Http\Controllers\IntakeFormController@shortenLinkCustom')->name('shorten.link.custom');

Route::get('/questionnaire', [App\Http\Controllers\OnePageQuestionnaireRequestController::class, 'questionnaire'])->name('questionnaire');
Route::post('/questionnaire/checkemail', [App\Http\Controllers\OnePageQuestionnaireRequestController::class, 'check_email'])->name('check_email');
Route::post('/questionnaire/update', [App\Http\Controllers\OnePageQuestionnaireRequestController::class, 'questionnaire_update'])->name('questionnaire_update');

Route::get('/form/intake', [IntakeFormController::class, 'intake_form'])->name('intake_form');
Route::post('/form/intake/save/{stepNo}/{userId?}', [App\Http\Controllers\IntakeFormController::class, 'intake_form_save'])->name('intake_form_save');

Route::get('/manual-upload', [App\Http\Controllers\ManualDocumentController::class, 'manual_upload'])->name('manual_upload');
Route::post('/manual-upload/checkemailid', [App\Http\Controllers\ManualDocumentController::class, 'check_manual_upload_email_and_id'])->name('check_manual_upload_email_and_id');
Route::post('/dashboard/manual/document/uploads', [App\Http\Controllers\ManualDocumentController::class, 'manual_document_uploads'])->name('manual_client_document_uploads');

Route::post('/mark/not/own/document', [App\Http\Controllers\ManualDocumentController::class, 'mark_not_own_document'])->name('mark_not_own_document');
Route::post('/mark/not/own/paystub', [App\Http\Controllers\DocumentController::class, 'mark_not_own_paystub'])->name('mark_not_own_paystub');
Route::post('/get-statement-month-option', [App\Http\Controllers\DocumentController::class, 'get_statement_month_option'])->name('get_statement_month_option');
Route::post('/load-guide-popup', [App\Http\Controllers\DocumentController::class, 'load_guide_doc'])->name('load_guide_doc');
// simpletext message webhook
Route::match(['get', 'post'], '/simpletext/message/webhook', [App\Http\Controllers\SimpleTextMessageController::class, 'simpletext_message_webhook'])->name('simpletext_message_webhook');
Route::match(['get','post'], '/ccc/webhook', [CreditCounselingCertificateWebhookController::class, 'webhook'])->name('ccc_webhook');



Route::prefix('client')->group(function () {
    Route::get('/login/{attorney?}', [ClientController::class, 'create'])->name('client_login');
    Route::post('/login', [ClientController::class, 'index'])->name('authenticate_client');
    Route::get('verify-login/{token}', [ClientController::class, 'verifyLogin'])->name('verify-login');
    Route::get('verify/resend', [App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', App\Http\Controllers\Auth\TwoFactorController::class)->only(['index', 'store']);
});

Route::post('/vehicle/fetch/vin', [CarmdApiController::class, 'fetch_vin_number'])->name('fetch_vin_number');
Route::post('/property/get/details/residence', [CarmdApiController::class, 'get_property_residence_details_by_graphql'])->name('get_property_residence_details_by_graphql');
Route::post('/property/get/details/vehicle', [CarmdApiController::class, 'get_property_vehicle_details_by_graphql'])->name('get_property_vehicle_details_by_graphql');


Route::group(['prefix' => 'client','middleware' => ['is_client', 'twofactor']], function () {


    Route::post('/attachment-upload-client', [AttorneyChatController::class, 'Attachment_upload'])->name('attachment_upload_client');
    Route::get('/dashboard', [ClientBasicInfoController::class, 'basic_information'])->name('client_dashboard');
    Route::get('/pre-dashboard', [DashboardController::class, 'pre_client_dashboard'])->name('pre_client_dashboard');
    Route::post('/add-upload-client-note', [DashboardController::class, 'add_upload_client_note'])->name('add_upload_client_note');

    Route::get('/progress', [ClientBasicInfoController::class, 'client_progress'])->name('client_progress');
    Route::get('/landing', [ClientController::class, 'landing'])->name('client_landing');
    Route::get('/no/client/questionnaire', [ClientController::class, 'no_client_questionnaire'])->name('no_client_questionnaire');

    Route::get('/no/client/questionnaire/mobile', [ClientController::class, 'no_client_questionnaire_mobile'])->name('no_client_questionnaire_mobile');

    Route::get('/guide', [ClientController::class, 'guide_webview_mobile'])->name('guide_webview_mobile');



    Route::get('/payroll/landing', [ClientController::class, 'client_payroll_landing'])->name('client_payroll_landing');



    Route::post('/fetch/user/notifications', [NotificationController::class, 'fetch_user_notifications'])->name('fetch_user_notifications');
    Route::post('/read/user/notifications', [NotificationController::class, 'read_user_notifications'])->name('read_user_notifications');

    Route::get('/logout', [ClientController::class, 'logout'])->name('client_logout');
    Route::match(['get', 'post'], '/basicinfo/step1', [ClientBasicInfoController::class, 'basic_info_step1'])->name('client_basic_info_step1');
    Route::match(['get', 'post'], '/basicinfo/step2', [ClientBasicInfoController::class, 'basic_info_step2'])->name('client_basic_info_step2');
    Route::match(['get', 'post'], '/basicinfo/step3', [ClientBasicInfoController::class, 'basic_info_step3'])->name('client_basic_info_step3');
    Route::match(['get', 'post'], '/basicinfo/step4', [ClientBasicInfoController::class, 'basic_info_step4'])->name('client_basic_info_step4');
    Route::match(['get', 'post'], '/basicinfo/step5', [ClientBasicInfoController::class, 'basic_info_step5'])->name('client_basic_info_step5');
    Route::post('/basicinfo/step6', [ClientBasicInfoController::class, 'basic_info_step6'])->name('client_basic_info_step6');




    Route::post('/courthouses/autosuggest', [ClientAutoSearchController::class, 'courthouses_search'])->name('courthouses_search');



    Route::post('tax/paying/popup', [ClientController::class, 'tax_paying_popup'])->name('tax_paying_popup');
    Route::post('show/vin/popup', [ClientController::class, 'show_vehicle_popup'])->name('show_vehicle_popup');


    Route::post('loan/mortgage/get', [ClientController::class, 'get_loan_data_to_import'])->name('get_loan_data_to_import');

    Route::post('request/edit/access', [ClientController::class, 'request_edit_access'])->name('request_edit_access');





    /* Property-Part */
    Route::get('/dashboard/property', [ClientPropertyController::class, 'property_information'])->name('property_information');
    Route::match(['get'], '/property/step1', [ClientPropertyController::class, 'client_property_step1'])->name('client_property_step1');
    Route::match(['post'], '/property/step1/ajax', [ClientPropertyController::class, 'update_property_step1_ajax'])->name('update_property_step1_ajax');

    Route::match(['get', 'post'], '/property/step2', [ClientPropertyController::class, 'client_property_step2'])->name('client_property_step2');
    Route::match(['post'], '/property/ajax/step2', [ClientPropertyController::class, 'property_ajax_save'])->name('property_ajax_save');

    Route::match(['get', 'post'], '/property/step3', [ClientPropertyController::class, 'client_property_step3'])->name('client_property_step3');
    Route::match(['get', 'post'], '/property/step4', [ClientPropertyController::class, 'client_property_step4'])->name('client_property_step4');
    Route::match(['get', 'post'], '/property/step4/continued', [ClientPropertyController::class, 'client_property_step4_continue'])->name('client_property_step4_continue');
    Route::match(['get', 'post'], '/property/step5', [ClientPropertyController::class, 'client_property_step5'])->name('client_property_step5');
    Route::match(['get', 'post'], '/property/step6', [ClientPropertyController::class, 'client_property_step6'])->name('client_property_step6');
    Route::match(['get', 'post'], '/property/step7', [ClientPropertyController::class, 'client_property_step7'])->name('client_property_step7');
    Route::post('/property/detailed/item/popup', [ClientPropertyController::class, 'detailed_tab_items_popup'])->name('detailed_tab_items_popup');

    Route::match(['post'], '/property/asset/save', [ClientPropertyController::class, 'update_property_asset_client_side'])->name('update_property_asset_client_side');

    Route::post('/property/assets/seperate/save', [ClientPropertyController::class, 'property_asset_seperate_save'])->name('property_asset_seperate_save');
    Route::post('/sofa/seperate/save', [ClientFinancialController::class, 'sofa_seperate_save'])->name('sofa_seperate_save');
    Route::post('/income/employer/seperate/save', [ClientIncomeController::class, 'income_employer_seperate_save'])->name('income_employer_seperate_save');

    /* debts-Part */
    Route::match(['get', 'post'], '/debts/unsecured', [ ClientDebtsController::class, 'client_debts_step2_unsecured'  ])->name('client_debts_step2_unsecured');
    Route::match(['get', 'post'], '/debts/back-tax', [ ClientDebtsController::class, 'client_debts_step2_back_tax'	  ])->name('client_debts_step2_back_tax');
    Route::match(['get', 'post'], '/debts/irs', [ ClientDebtsController::class, 'client_debts_step2_irs'		  ])->name('client_debts_step2_irs');
    Route::match(['get', 'post'], '/debts/domestic', [ ClientDebtsController::class, 'client_debts_step2_domestic'	  ])->name('client_debts_step2_domestic');
    Route::match(['get', 'post'], '/debts/additional', [ ClientDebtsController::class, 'client_debts_step2_additional' ])->name('client_debts_step2_additional');

    Route::match(['post'], '/debts/save', [ClientDebtsController::class, 'debt_custom_save'])->name('debt_custom_save');
    Route::match(['post'], '/check/permission', [ClientDebtsController::class, 'check_permission'])->name('check_permission');

    Route::match(['post'], '/debts/back-tax/save', [ClientDebtsController::class, 'back_tax_custom_save'])->name('back_tax_custom_save');
    Route::match(['post'], '/debts/irs/save', [ClientDebtsController::class, 'irs_custom_save'])->name('irs_custom_save');
    Route::match(['post'], '/debts/domestic/save', [ClientDebtsController::class, 'dso_custom_save'])->name('dso_custom_save');
    Route::match(['post'], '/debts/additional/save', [ClientDebtsController::class, 'additional_liens_custom_save'])->name('additional_liens_custom_save');

    /* Income-Part */
    Route::match(['get', 'post'], '/dashboard/income', [ClientIncomeController::class, 'client_income'])->name('client_income');
    Route::match(['get', 'post'], '/income/step1', [ClientIncomeController::class, 'client_income_step1'])->name('client_income_step1');
    Route::match(['get', 'post'], '/income/step2', [ClientIncomeController::class, 'client_income_step2'])->name('client_income_step2');
    Route::match(['get', 'post'], '/income/step3', [ClientIncomeController::class, 'client_income_step3'])->name('client_income_step3');
    Route::match(['get', 'post'], '/income/step4', [ClientIncomeController::class, 'client_income_step4'])->name('client_income_step4');

    Route::match(['post'], '/income/current/employer/debtor/save', [ClientIncomeController::class, 'current_employer_custom_save'])->name('current_employer_custom_save');
    Route::match(['post'], '/income/current/employer/spouse/save', [ClientIncomeController::class, 'current_employer_custom_save_spouse'])->name('current_employer_custom_save_spouse');

    Route::post('/income/profitloss', [ClientAjaxController::class, 'client_profit_loss_setup'])->name('client_profit_loss_setup');
    Route::post('/income/profitlosspopup', [ClientAjaxController::class, 'client_profit_loss_popup'])->name('client_profit_loss_popup');
    Route::post('/income/remove/additional-profit-loss-popup', [ClientAjaxController::class, 'remove_client_additional_profit_loss_popup'])->name('remove_client_additional_profit_loss_popup');
    Route::post('/income/remove/additional-profit-loss-popup-joint', [ClientAjaxController::class, 'remove_client_additional_profit_loss_popup_joint'])->name('remove_client_additional_profit_loss_popup_joint');
    Route::post('/income/profitlossjoint', [ClientAjaxController::class, 'client_profit_loss_joint_setup'])->name('client_profit_loss_joint_setup');
    Route::post('/income/profitlosspopupjoint', [ClientAjaxController::class, 'client_profit_loss_popup_joint'])->name('client_profit_loss_popup_joint');

    /* Expenses-Part */
    Route::match(['get', 'post'], '/dashboard/expenses', [ClientExpensesController::class, 'client_expenses'])->name('client_expenses');
    Route::post('/expense/utility/popup', [ClientExpensesController::class, 'expense_utility_popup'])->name('expense_utility_popup');

    /* Spouce Expenses */
    Route::match(['get', 'post'], '/dashboard/spouse_expenses', [ClientExpensesController::class, 'client_spouse_expenses'])->name('client_spouse_expenses');

    /* Financial-Affairs */
    Route::match(['get', 'post'], '/dashboard/financial/affairs', [ClientFinancialController::class, 'client_financial_affairs'])->name('client_financial_affairs');
    Route::match(['get', 'post'], '/financial/affairs/step2', [ClientFinancialController::class, 'client_financial_affairs'])->name('client_financial_affairs2');
    Route::match(['get', 'post'], '/financial/affairs/step3', [ClientFinancialController::class, 'client_financial_affairs'])->name('client_financial_affairs3');



    /* Document upload */
    Route::match(['post'], '/dashboard/document/uploads', [RetainerDocumentController::class, 'document_uploads'])->name('client_document_uploads');
    Route::match(['get'], '/mydocuments', [RetainerDocumentController::class, 'listUploadedDocuments'])->name('list_uploaded_documents');

    Route::post('/client/documents/download/popup', [RetainerDocumentController::class, 'client_documents_download_popup'])->name('client_documents_download_popup');
    Route::post('/client/documents/download/popup/delete', [RetainerDocumentController::class, 'client_documents_download_popup_single_delete'])->name('client_documents_download_popup_single_delete');

    Route::match(['get', 'post'], '/dashboard/document/multi-uploads', [ClientController::class, 'mutiple_document_uploads'])->name('client_mutiple_document_uploads');

    Route::match(['get', 'post'], '/dashboard/retainer/documents', [RetainerDocumentController::class, 'client_retainer_documents'])->name('client_retainer_documents');
    Route::match(['get', 'post'], '/dashboard/final/submit', [DashboardController::class, 'client_final_submit'])->name('client_final_submit');

    Route::match(['post'], '/sign/document/', [ClientDocumentController::class, 'signed_document'])->name('client_signed_doc');
    Route::post('/update/document/view/status', [ClientDocumentController::class, 'update_attorney_doc_view_status'])->name('update_attorney_doc_view_status');

    Route::get('/document/download/{type}/{client_id}', [ClientDocumentController::class, 'client_doc_see'])->name('client_doc_see');

    Route::post('/income/step2/profitloss', [ClientController::class, 'income_profit_loss'])->name('income_profit_loss');

    Route::post('/change/password/popup', [ClientController::class, 'change_password_popup'])->name('change_password_popup');
    Route::post('/setup/new/password', [ClientController::class, 'setup_new_password'])->name('setup_new_password');



    Route::post('/show/property/scanned', [ClientPropertyScannedController::class, 'show_scanned_property'])->name('show_scanned_property');
    Route::post('/setup/property/scanned', [ClientPropertyScannedController::class, 'setup_scanned_property'])->name('setup_scanned_property');
    Route::post('/show/resident/scanned', [ClientPropertyScannedController::class, 'show_scanned_resident'])->name('show_scanned_resident');
    Route::post('/setup/resident/scanned', [ClientPropertyScannedController::class, 'setup_scanned_resident'])->name('setup_scanned_resident');

    Route::post('/upload/crs/report', [ClientAjaxController::class, 'upload_crs_report'])->name('upload_crs_report');
    Route::post('/fetch/client/crs/report', [ClientAjaxController::class, 'fetch_client_crs_report'])->name('fetch_client_crs_report');
    Route::post('/import/client/crs/creditor', [ClientAjaxController::class, 'import_client_crs_creditor'])->name('import_client_crs_creditor');
    Route::post('/client/confirm/creditors', [ClientAjaxController::class, 'confirmCreditorIntoCrs'])->name('confirm_client_creditors');
    Route::post('/client/confirm/liens', [ClientAjaxController::class, 'confirm_client_liens'])->name('confirm_client_liens');
    /** pin wheel routs */

    Route::post('/client/common/creditors/autosuggest', [ClientAjaxController::class, 'client_common_creditors_search'])->name('client_common_creditors_search');
    Route::get('/attorney/back/to/home/{id}', [DashboardController::class, 'attorney_login_dashboard'])->name('attorney_login_dashboard');
    Route::get('/admin/back/to/home/{id}', [DashboardController::class, 'admin_login_dashboard'])->name('admin_login_dashboard');
    Route::post('/confirm/credit/popup', [ClientDebtsController::class, 'confirm_credit_popup'])->name('confirm_credit_popup');
    Route::post('/confirm/credit/report', [ClientDebtsController::class, 'confirm_credit_report'])->name('confirm_credit_report');
    Route::post('/open/get/credit/popup', [ClientDebtsController::class, 'open_get_report_popup'])->name('open_get_report_popup');

    Route::post('/paystub/delete', [ClientIncomeController::class, 'paystub_delete_client_side'])->name('paystub_delete_client_side');



});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/attorney.php';


Route::post('/generate-zip', [AttorneyDocumentActionController::class, 'generateZip']);
Route::get('/progress', [AttorneyDocumentActionController::class, 'getProgress']);
Route::get('/custom-scripts/{function_name}', [CustomScriptController::class, 'custom_scripts'])->name('custom_scripts');

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');

    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');

    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');

    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');

    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');

    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');

    return '<h1>Clear Config cleared</h1>';
});

Route::get('/logs', function () {
    return response()->file(storage_path('logs/laravel.log'));
});

// Unsubscribe route for automated emails (accessible without login)
Route::get('/unsubscribe/{token}', [UnsubscribeController::class, 'show'])->name('unsubscribe.show');
Route::post('/unsubscribe/{token}', [UnsubscribeController::class, 'unsubscribe'])->name('unsubscribe.process');

// Sitemap and SEO routes
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [App\Http\Controllers\SitemapController::class, 'robots'])->name('robots');
