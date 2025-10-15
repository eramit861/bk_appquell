<?php

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\AttorneyChatController;
use App\Http\Controllers\Client\CarmdApiController;
use App\Http\Controllers\Client\ClientDocumentController;
use App\Http\Controllers\Client\OcrController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// :::::::::::::::::: aman routes start ::::::::::::::::

Route::post('attachment_upload', [AttorneyChatController::class, 'Attachment_upload']);
Route::post('send-notification', [AttorneyChatController::class, 'SendNotification'])->name('send_notification');

// :::::::::::::::::: aman routes end ::::::::::::::::

Route::middleware('auth:api')->group(function () {


    Route::get('logout', [PassportAuthController::class, 'Logout'])->name('logout');

    Route::get('configuration', [PassportAuthController::class, 'configuration']);
    Route::get('help-support', [PassportAuthController::class, 'help_support']);
    Route::match(['get', 'post'], '/porperty/setting', [PassportAuthController::class, 'document_setting']);
    Route::get('profile', [PassportAuthController::class, 'userInfo']);
    Route::get('update-profile', [ClientController::class, 'updateProfile']);
    Route::get('change-password', [ClientController::class, 'changePassword']);
    Route::get('documents', [ClientDocumentController::class, 'getClientDocument']);
    Route::match(['get', 'post'], 'send-signed-doc', [ClientDocumentController::class, 'signed_document_api']);
    Route::post('update-document', [ClientDocumentController::class, 'updateDocument']);
    Route::post('mark/not/owned', [ClientDocumentController::class, 'mark_not_owned']);
    Route::post('get-document', [ClientDocumentController::class, 'getDocument']);
    Route::post('delete-document', [ClientDocumentController::class, 'deleteDocument']);
    Route::post('sub-documents', [ClientDocumentController::class, 'getSubDocument']);
    Route::post('/vehicle/fetch/vin', [CarmdApiController::class, 'fetch_vin_number'])->name('fetch_vin_number');

    /**Basic information tab api */


    //upload ocr data
    Route::post('/upload-ocr-data', [OcrController::class, 'uploadOcrData'])->name('uploadOcrData');
    Route::post('/get/statement/month/options', [PassportAuthController::class, 'find_statement_month_option']);



    // MasterCard Open Banking API


});
Route::prefix('document')->group(function () {
    Route::post('/debts', [DocumentController::class, 'get_debts_document'])->name('get_debts_document');
});
