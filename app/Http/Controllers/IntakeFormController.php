<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\IntakeFormStepSubmit;
use App\Mail\OnePageQuesRequest;
use App\Mail\OnePageQuesRequestSuccessToClient;
use App\Models\AttorneySettings;
use App\Models\DocumentUploadedData;
use App\Models\IntakeFormUpdateLogs;
use App\Models\OnePageQuestionnaireRequest;
use App\Models\ShortLink;
use App\Models\User;
use App\Models\ZipCode;
use App\Services\CreditorsService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class IntakeFormController extends Controller
{
    public function intake_form(Request $request)
    {
        $stepNo = 1; // Default step number
        $token = '';
        $userId = '';
        $attorney_id = '';
        $martial_status = '';
        $clientname = '';
        $questions = [];
        $conditionalQuestions = [];
        $formData = [];
        $attorney_company = '';
        $attorney = '';

        if ($request->has('token')) {
            $token = $request->input('token');
            try {
                $attorney_id = base64_decode($token);
            } catch (DecryptException $e) {
                return redirect()->back()->withInput($request->all())->with('error', 'Invalid token.');
            }
            $questions = \App\Models\ConciergeAttorneyQuestions::where(['attorney_id' => $attorney_id, 'is_deleted' => '0'])->orderby('id', 'asc')->get();
            $questions = !empty($questions) ? $questions->toArray() : [];
            $checkedQuestions = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->first();
            $conditionalQuestions = $checkedQuestions['question_to_show'] ?? '';
            $conditionalQuestions = json_decode($conditionalQuestions, 1);
            $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
            $attorney = User::where('id', $attorney_id)->select(columns: ['name', 'email', 'id'])->first();
        }
        if ($request->has('userId')) {
            $userId = $request->input('userId');
            try {
                $userIdDecoded = base64_decode($userId);
            } catch (DecryptException $e) {
                return redirect()->back()->withInput($request->all())->with('error', 'Invalid user ID.');
            }
            $storedData = OnePageQuestionnaireRequest::where('id', $userIdDecoded)
                ->where('attorney_id', $attorney_id)
                ->first();
            $attorney = User::where('id', $attorney_id)->select(columns: ['name', 'email', 'id'])->first();
            if ($storedData) {
                $stepNo = $storedData->step_completed;
                if ($request->has('stepNo') && $request->input('stepNo') == 3) {
                    $stepNo = 3;
                } else {
                    $stepNo = ($stepNo == 1 || $stepNo == 2) ? $stepNo + 1 : $stepNo;
                }

                $clientname = trim(collect([
                    $storedData->name,
                    $storedData->middle_name,
                    $storedData->last_name
                ])->filter()->implode(' '));
                $martial_status = $storedData->martial_status;
                $formData = CreditorsService::calculateTax($storedData);
            } else {
                return redirect()->back()->withInput($request->all())->with('error', 'No data found for the provided user ID.');
            }

        }

        if ($request->has('stepNo')) {
            $stepNo = $request->input('stepNo');

        }

        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->select(['short_name', 'district_name', 'id'])->get();

        return view('intake_form.step' . $stepNo, ['district_names' => $district_names, 'stepNo' => $stepNo, 'attorney' => $attorney, 'formData' => $formData, 'userId' => $userId, 'clientname' => $clientname, 'martial_status' => $martial_status, 'attorney_company' => $attorney_company, 'token' => $token, 'questions' => $questions, 'conditionalQuestions' => $conditionalQuestions]);
    }


    public function shortenLinkCustom(Request $request, $code, $userId = '')
    {
        $find = ShortLink::where('code', $code)->first();
        if (!$find) {
            abort(404, 'Short link not found.');
        }

        $url = $find->custom_intake_link;
        if (!empty($userId)) {
            $url .= '&userId=' . $userId;
        }

        $stepNo = $request->input('stepNo') ?? '';
        if (!empty($stepNo)) {
            $url .= '&stepNo=' . $stepNo;
        }

        return redirect($url);
    }

    public function intake_form_save(Request $request, $stepNo, $userId = '')
    {
        if (!$request->isMethod('post')) {
            return Helper::renderJsonError("Invalid request");
        }

        if (empty($stepNo) || !in_array($stepNo, [1, 2, 3])) {
            return redirect()->back()->withInput()->with('error', 'Invalid step.');
        }

        if (empty($request->a_token)) {
            return redirect()->back()->withInput()->with('error', 'Invalid token.');
        }

        $attorney_id = base64_decode($request->a_token) ?? '';
        $attorney = User::select('users.id', 'tbl_attorney_company.company_name', 'tbl_attorney_company.attorney_phone', 'users.name', 'users.email')
                    ->leftJoin('tbl_attorney_company', 'users.id', '=', 'tbl_attorney_company.attorney_id')
                    ->where('users.id', $attorney_id)
                    ->first();
        if (!$attorney) {
            return redirect()->back()->withInput()->with('error', 'Invalid token');
        }

        $clientEmail = $request->email;
        $hasData = $request->hasData;

        if ($hasData != '1') {
            $emailExists = User::where('email', $clientEmail)->exists() || OnePageQuestionnaireRequest::where('email', $clientEmail)->exists();

            if ($emailExists) {
                return redirect()->back()->withInput()->with('error', 'E-Mail Id already exists.');
            }
        }

        DB::beginTransaction();
        try {
            $propertyVehicle = $request->property_vehicle ?? [];

            $dataToSave = OnePageQuestionnaireRequest::dataToSaveArrayStepWise($request, $attorney_id, $stepNo);
            unset($dataToSave['hasData']);

            $dataID = '';
            if ($stepNo == 1 && $hasData != '1') {
                $newRequest = OnePageQuestionnaireRequest::Create($dataToSave);
                $dataID = $newRequest->id;
            } else {
                $userIdDecoded = base64_decode($userId);
                $newRequest = OnePageQuestionnaireRequest::where('id', $userIdDecoded)
                    ->where('attorney_id', $attorney_id)
                    ->update($dataToSave);
                $dataID = $userIdDecoded;
                $clientEmail = $newRequest->email ?? $clientEmail;
            }

            if ($stepNo == 2 && !empty($propertyVehicle)) {
                $vehicle_property_value_document = $propertyVehicle['vehicle_property_value_document'] ?? [];
                // Reset the array indexes for vehicle_property_value_document to ensure sequential numeric keys
                if (!empty($vehicle_property_value_document) && is_array($vehicle_property_value_document)) {
                    $vehicle_property_value_document = array_values($vehicle_property_value_document);
                    DocumentUploadedData::uploadVehiclePropertyValueDocument($vehicle_property_value_document, $dataID);
                }
            }

            $sendMail = OnePageQuestionnaireRequest::willSendMail($dataID, $attorney_id, $stepNo);
            $clientname = trim(collect([
                $request->name,
                $request->middle_name,
                $request->last_name
            ])->filter()->implode(' '));

            $linkinput = [
                'link' => route('questionnaire') . "?token=" . $request->a_token,
                'attorney_id' => $attorney_id,
                'link_for' => ShortLink::CUSTOM_INTAKE_LINK,
                'custom_intake_link' => route('intake_form') . "?token=" . $request->a_token
            ];
            $urlCustom = ShortLink::getSetLink($linkinput, $attorney_id) . "/" . base64_encode($dataID);

            Log::info('Step ' . $stepNo . ' saved!!!', [
                'urlCustom' => $urlCustom,
            ]);

            $columnName = 'step_' . $stepNo . '_submited';

            if ($stepNo == 1 || $stepNo == 2) {

                if ($sendMail) {
                    try {
                        // Mail to Client
                        Mail::to($clientEmail)->send(
                            new IntakeFormStepSubmit($request->name, $stepNo, $urlCustom, $attorney->company_name)
                        );
                    } catch (\Exception $e) {
                        Log::error('Email failed to send to client.', ['error' => $e->getMessage()]);
                    }
                    OnePageQuestionnaireRequest::where('id', $dataID)
                        ->where('attorney_id', $attorney_id)
                        ->update([$columnName => 1]);
                }

                if ($hasData == '1') {
                    $urlCustom = route('intake_form', ['token' => $request->a_token, 'userId' => $userId, 'stepNo' => $stepNo + 1]);
                }

                DB::commit();

                return redirect($urlCustom)->with('success', 'Record has been added successfully.');
            }

            if ($stepNo == 3) {
                if ($sendMail) {
                    try {
                        // Mail to Attorney
                        if (AttorneySettings::isEmailEnabled($attorney_id, 'attorney_onepage_que_submit_mail')) {
                            $mail = Helper::getAttorneyEmailArray($attorney_id);
                            Mail::to($mail)->send(
                                new OnePageQuesRequest($clientname, $clientEmail, $attorney->name)
                            );
                        }
                    } catch (\Exception $e) {
                        Log::error('Email failed to send to attorney.', ['error' => $e->getMessage()]);
                    }

                    try {
                        // Mail to Client
                        Mail::to($clientEmail)->send(
                            new OnePageQuesRequestSuccessToClient($clientname)
                        );
                    } catch (\Exception $e) {
                        Log::error('Email failed to send to client.', ['error' => $e->getMessage()]);
                    }
                    OnePageQuestionnaireRequest::where('id', $dataID)
                        ->where('attorney_id', $attorney_id)
                        ->update([$columnName => 1]);
                }
                DB::commit();

                return redirect()->back()->with('success', 'Record has been added successfully.')->with('showSuccessModal', true);
            }

        } catch (\Exception $e) {
            Log::error('Error while submitting request.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function intake_form_save_by_attorney(Request $request, $dataFor = '', $intakeFormID = '')
    {
        if (empty($dataFor) || empty($intakeFormID)) {
            return Helper::renderJsonError("Invalid request");
        }

        $input = $request->all();
        $attorney_id = Helper::getCurrentAttorneyId();

        DB::beginTransaction();
        try {
            $propertyVehicle = $input['property_vehicle'] ?? [];

            $newData = OnePageQuestionnaireRequest::dataToSaveArrayStepWiseForAttorney($input, $dataFor);
            $oldJSON = OnePageQuestionnaireRequest::getSelectedSavedDataJSON($input, $intakeFormID, $dataFor);
            if (json_encode($newData) !== $oldJSON) {
                $dataToSave = $newData;
                $dataToSave['updated_at'] = date("Y-m-d H:i:s");
                OnePageQuestionnaireRequest::where('id', $intakeFormID)
                    ->where('attorney_id', $attorney_id)
                    ->update($dataToSave);

                IntakeFormUpdateLogs::create([
                    'form_id' => $intakeFormID,
                    'section_name' => $dataFor,
                    'old_json' => $oldJSON,
                    'new_json' => json_encode($newData),
                    'added_by' => $attorney_id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
            if ($dataFor == 'vehicles-info') {
                $vehicle_property_value_document = $propertyVehicle['vehicle_property_value_document'] ?? [];
                // Reset the array indexes for vehicle_property_value_document to ensure sequential numeric keys
                if (!empty($vehicle_property_value_document) && is_array($vehicle_property_value_document)) {
                    $vehicle_property_value_document = array_values($vehicle_property_value_document);
                    $this->uploadVehiclePropertyValueDocument($vehicle_property_value_document, $intakeFormID);
                }

            }

            $returnHTML = OnePageQuestionnaireRequest::getReturnHtmlForAttorney($dataFor, $intakeFormID);
            DB::commit();

            return response()->json([
                'success' => true,
                'html' => $returnHTML
            ]);
            // return Helper::renderJsonSuccess("Data saved successfully.", ['html' => $returnHTML]);
        } catch (\Exception $e) {
            Log::error('Error while updating data for ' . $dataFor . '.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
