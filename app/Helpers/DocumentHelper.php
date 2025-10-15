<?php

namespace App\Helpers;

use App\Services\Client\CacheProperty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentHelper extends Helper
{
    public static function generateFile($baseContent, $fileName)
    {
        $context_options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-wine-extension-ini\r\n"
                    . "Content-Length: " . strlen($baseContent) . "\r\n",
                'content' => $baseContent
            ]
        ];

        $context = stream_context_create($context_options);
        file_put_contents(public_path($fileName), $baseContent, LOCK_EX, $context);
    }

    public static function generateJsonFile($baseContent, $fileName)
    {
        $baseContent = json_encode($baseContent, JSON_PRETTY_PRINT);
        $context_options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/json"
                    . "Content-Length: " . strlen($baseContent),
                'content' => $baseContent
            ]
        ];

        file_put_contents($fileName, $baseContent);
    }


    public static function generateZipFile($fileName, $secondryFileName)
    {

        if (!headers_sent()) {
            header_remove();
        }
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Content-Length: ' . filesize($secondryFileName));
        flush();
        readfile($secondryFileName);
        if (file_exists($secondryFileName)) {
            unlink($secondryFileName);
        }
        flush();

    }

    public static function validate_dir_name($val, $removeDot = true)
    {
        $val = str_replace("-", " ", $val);
        $val = str_replace(["~","^","(",")","<",">","[","]","|","/",",","&","{","}","$","@","=","+","*","#", "'", ";","\\","%","?",":","!","`","’"], ' ', $val);
        $val = str_replace(["'", "\""], "", $val);
        if ($removeDot) {
            $val = str_replace(".", "", $val);
        }

        return $val;
    }

    public static function validate_doc_name($docName)
    {
        // Replace one or more underscores with a single space
        return preg_replace('/_+/', ' ', $docName);
    }

    public static function getManualDocUrl($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $encryptedid = base64_encode($attorney->attorney_id);
        $encryptedClientId = base64_encode($client_id);
        $linkinput['link'] = route('questionnaire')."?token=".$encryptedid;
        $linkinput['manual_link'] = route('manual_upload')."?token=".$encryptedid."&clientToken=".$encryptedClientId;
        $linkinput['attorney_id'] = $attorney->attorney_id;
        $linkinput['link_for'] = 'manual';

        return \App\Models\ShortLink::getSetLink($linkinput, $attorney->attorney_id) ?? 'Javascript:void(0)';
    }

    public static function generatePDFFile($fileName, $secondryFileName)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Type: application/force-download");
        header('Content-Disposition: attachment; filename=' . $fileName);
        // header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($secondryFileName));
        if (ob_get_level() > 0) {
            ob_clean();
        }
        //flush();
        readfile($secondryFileName);
        if (file_exists($secondryFileName)) {
            unlink($secondryFileName);
        }
    }



    public static function s3toTemp($client_id, $document_file)
    {
        $clientDir = public_path().'/documents/'.$client_id;
        $temDir = $clientDir.'/'.'tempDir';
        if (!file_exists($temDir)) {
            if (!file_exists($clientDir)) {
                File::makeDirectory($clientDir, 0777, true, true);
            }
            File::makeDirectory($temDir, 0777, true, true);
        }
        $filebase = basename($document_file);

        try {
            $fileContent = Storage::disk('s3')->get($document_file);
        } catch (\Exception $e) {
            return null;
        }

        $temDir = $temDir.'/'.$filebase;

        try {
            file_put_contents($temDir, $fileContent);
        } catch (\Exception $e) {
            return null;
        }

        return $temDir;
    }


    public static function flushS3Temp($client_id)
    {
        $temDir = public_path().'/documents/'.$client_id.'/'.'tempDir';
        if (File::exists($temDir)) {
            File::deleteDirectory($temDir);
        }
    }

    public static function getClientDebtorResidentDocumentList($clientProperty, $forApi = false, $addNumer = false, $forFileName = false)
    {

        if (!empty($clientProperty)) {
            $clientDocumentList = [];
            $notOwnedDocs = [];
            $mortgageUpdatedNames = [];
            $addno = '';
            $i = 1;

            foreach ($clientProperty as $property) {

                $ownRent = Helper::validate_key_value('currently_lived', $property, 'radio'); // 1
                $isPrimaryProperty = Helper::validate_key_value('not_primary_address', $property, 'radio'); // 0

                $primary_text = (($ownRent == 1 && $isPrimaryProperty == 0) || ($ownRent == 0)) ? 'Primary Residence ' : 'Non-Primary Residence ';

                if (isset($property->loan_own_type_property) && $property->loan_own_type_property == 1) {

                    $clientDocumentList[] = 'Current_Mortgage_Statement_1_' . $i;
                    $loan1 = json_decode($property->home_car_loan, true);
                    if ($addNumer) {
                        $addno = ' 1st ';
                    }
                    if ($forApi) {
                        $mortgageUpdatedNames['Current_Mortgage_Statement_1_' . $i] = $primary_text .$addno. Helper::validate_key_value('creditor_name', $loan1);
                    } else {
                        $mortgageUpdatedNames['Current_Mortgage_Statement_1_' . $i] = $primary_text .$addno. "<span class='text-dark f-w-600'>" . Helper::validate_key_value('creditor_name', $loan1) . "</span>";
                    }


                    if (isset($property->home_car_loan2) && !empty($property->home_car_loan2)) {
                        $loan2 = json_decode($property->home_car_loan2, true);
                        if (!empty($loan2) && Helper::validate_key_value('additional_loan1', $loan2, 'radio') == 1) {
                            $clientDocumentList[] = 'Current_Mortgage_Statement_2_' . $i;
                            if ($addNumer) {
                                $addno = ' 2nd ';
                            }
                            if ($forApi) {
                                $mortgageUpdatedNames['Current_Mortgage_Statement_2_' . $i] = $primary_text . $addno. Helper::validate_key_value('creditor_name', $loan2);
                            } else {
                                $mortgageUpdatedNames['Current_Mortgage_Statement_2_' . $i] = $primary_text.$addno. "<span class='text-dark f-w-600'>". Helper::validate_key_value('creditor_name', $loan2). "</span>";
                            }

                            if (isset($property->home_car_loan3) && !empty($property->home_car_loan3)) {
                                $loan3 = json_decode($property->home_car_loan3, true);
                                if (!empty($loan3) && Helper::validate_key_value('additional_loan2', $loan3, 'radio') == 1) {
                                    $clientDocumentList[] = 'Current_Mortgage_Statement_3_' . $i;
                                    if ($addNumer) {
                                        $addno = ' 3rd ';
                                    }
                                    if ($forApi) {
                                        $mortgageUpdatedNames['Current_Mortgage_Statement_3_' . $i] = $primary_text .$addno. Helper::validate_key_value('creditor_name', $loan3);
                                    } else {
                                        $mortgageUpdatedNames['Current_Mortgage_Statement_3_' . $i] = $primary_text .$addno. "<span class='text-dark f-w-600'>". Helper::validate_key_value('creditor_name', $loan3). "</span>";
                                    }

                                }
                            }

                        }

                    }

                }
                $i++;
            }

            return [
                'clientDocumentList' => $clientDocumentList,
                'notOwnedDocs' => $notOwnedDocs,
                'mortgageUpdatedNames' => $mortgageUpdatedNames,
            ];

        }

        return [];
    }

    public static function getClientDebtorResidentDocumentListWithHeading($clientProperty, $forApi = false, $addNumer = false, $client_id)
    {
        if (empty($clientProperty)) {
            return [];
        }
        $clientDocumentList = [];
        $notOwnedDocs = [];
        $mortgageGroupedByProperty = [];
        $propertyData = [];
        $i = 1;
        foreach ($clientProperty as $property) {
            $ownRent = Helper::validate_key_value('currently_lived', $property, 'radio'); // 1
            $isPrimaryProperty = Helper::validate_key_value('not_primary_address', $property, 'radio'); // 0
            $propertyHeading = (($ownRent == 1 && $isPrimaryProperty == 0) || ($ownRent == 0)) ? 'Primary Residence' : 'Non-Primary Residence';
            $loansForProperty = [];
            $propertyTypeName = $propertyHeading;
            $propertyHeading = Helper::validate_doc_type($propertyHeading.'_'.Helper::validate_key_value('id', $property, 'radio'));


            if (isset($property->loan_own_type_property) && $property->loan_own_type_property == 1) {
                $loan1 = json_decode($property->home_car_loan, true);
                $loanPrefix = 'Current_Mortgage_Statement_1_' . $i;
                $clientDocumentList[] = $loanPrefix;
                $label = Helper::validate_key_value('creditor_name', $loan1);
                $loanLabel = ($addNumer ? '1st ' : '') . $label;
                $loansForProperty[$loanPrefix] = self::getFormatedLabelForResidence($forApi, $propertyTypeName, $loanLabel);
                // Loan 2
                if (!empty($property->home_car_loan2)) {
                    $loan2 = json_decode($property->home_car_loan2, true);
                    if (!empty($loan2) && Helper::validate_key_value('additional_loan1', $loan2, 'radio') == 1) {
                        $loanPrefix = 'Current_Mortgage_Statement_2_' . $i;
                        $clientDocumentList[] = $loanPrefix;
                        $label = Helper::validate_key_value('creditor_name', $loan2);
                        $loanLabel = ($addNumer ? '2nd ' : '') . $label;
                        $loansForProperty[$loanPrefix] = self::getFormatedLabelForResidence($forApi, $propertyTypeName, $loanLabel);

                        // Loan 3
                        if (!empty($property->home_car_loan3)) {
                            $loan3 = json_decode($property->home_car_loan3, true);
                            if (!empty($loan3) && Helper::validate_key_value('additional_loan2', $loan3, 'radio') == 1) {
                                $loanPrefix = 'Current_Mortgage_Statement_3_' . $i;
                                $clientDocumentList[] = $loanPrefix;
                                $label = Helper::validate_key_value('creditor_name', $loan3);
                                $loanLabel = ($addNumer ? '3rd ' : '') . $label;
                                $loansForProperty[$loanPrefix] = self::getFormatedLabelForResidence($forApi, $propertyTypeName, $loanLabel);
                            }
                        }
                    }
                }
            }
            //if (!empty($loansForProperty)) {
            $propertyLabelString = self::getResidencePropertyLabelString($property, $client_id);
            $pVName = "Property Value For: " . $propertyLabelString;

            $propertyValueKey = Helper::validate_doc_type('Mortgage_property_value_'.Helper::validate_key_value('id', $property, 'radio'));
            $propertyData[$propertyHeading][$propertyValueKey] = $pVName;

            if (str_starts_with($propertyHeading, 'Primary_Residence')) {
                $mortgageGroupedByProperty[$propertyHeading] = 'Primary Residence: '.$propertyLabelString;
            } elseif (str_starts_with($propertyHeading, 'Non_Primary_Residence')) {
                $mortgageGroupedByProperty[$propertyHeading] = 'Non-Primary Residence: '.$propertyLabelString;
            }

            $mortgageGroupedByProperty[$propertyValueKey] = $pVName;
            $mortgageGroupedByProperty += $loansForProperty;

            if (!isset($propertyData[$propertyHeading])) {
                $propertyData[$propertyHeading] = [];
            }

            $propertyData[$propertyHeading] += $loansForProperty;
            //}
            $i++;
        }
        $propertyData = self::sortPropertyData($propertyData);

        return [
            'propertyData' => $propertyData,
            'clientDocumentList' => $clientDocumentList,
            'notOwnedDocs' => $notOwnedDocs,
            'mortgageUpdatedNames' => $mortgageGroupedByProperty,
        ];
    }

    public static function getFormatedLabelForResidence($forApi, $propertyTypeName, $loanLabel)
    {
        $label = '';
        if ($forApi) {
            $label = $propertyTypeName. ' ' .$loanLabel;
        } else {
            $label = $propertyTypeName. " <span class='text-dark f-w-600'>" . $loanLabel . "</span>";
        }

        return $label;
    }

    public static function getResidencePropertyLabelString($property, $client_id)
    {
        $string = '';
        $not_primary_address = Helper::validate_key_value('not_primary_address', $property, 'radio');
        if ($not_primary_address == 0) {
            $string .= AddressHelper::getClientBasicAddress($client_id);
        }
        if ($not_primary_address == 1) {
            $mortgageAddress = Helper::validate_key_value('mortgage_address', $property);
            $mortgageCity = Helper::validate_key_value('mortgage_city', $property);
            $mortgageState = Helper::validate_key_value('mortgage_state', $property);
            $mortgageZip = Helper::validate_key_value('mortgage_zip', $property);

            $string .= $mortgageAddress;
            $string .= !empty($mortgageCity) ? ', '.$mortgageCity : '';
            $string .= !empty($mortgageState) ? ', '.$mortgageState : '';
            $string .= !empty($mortgageZip) ? ', '.$mortgageZip : '';
        }

        return $string;
    }

    public static function sortPropertyData($propertyData)
    {
        uksort($propertyData, function ($keyA, $keyB) {
            $isPrimaryA = strpos($keyA, 'Primary_Residence') === 0;
            $isPrimaryB = strpos($keyB, 'Primary_Residence') === 0;
            if ($isPrimaryA === $isPrimaryB) {
                return strcmp($keyA, $keyB);
            }

            return $isPrimaryA ? -1 : 1;
        });

        return $propertyData;
    }

    public static function getClientDebtorVehiclesDocumentList($client_id, $forApi = false)
    {
        $vehicles = self::CODEBTOR_VEHICLEARRAY;
        $vehicles = array_merge($vehicles, self::OTHERLOANARRAY);

        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $clientPropertyData, 'array');
        $propertyvehicleR = $propertyvehicle;

        $totalVehicleRecord = !empty($propertyvehicle) ? $propertyvehicle->where('property_type', 1) : [];
        $i = 1;
        $vehiclesDocumentList = [];
        $notOwnedDocs = [];
        $vehicleUpdatedNames = [];
        foreach ($totalVehicleRecord as $item) {
            if ($item->loan_own_type_property == 1) {
                $vehicleLoan = json_decode($item->vehicle_car_loan, true);
                foreach ($vehicles as $document) {
                    if ($document == 'Current_Auto_Loan_Statement_' . $i) {
                        $vehiclesDocumentList[] = $document;
                        if ($forApi) {
                            $vehicleUpdatedNames[$document] = Helper::validate_key_value('creditor_name', $vehicleLoan) . " Auto Loan statement";
                        } else {
                            $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600'>" . Helper::validate_key_value('creditor_name', $vehicleLoan) . "</span> Auto Loan statement";
                        }
                    }
                }
            }
            $i++;
        }
        $i = 1;
        //Recreational Vehicle

        $totalVehicleRecord = !empty($propertyvehicleR) ? $propertyvehicleR->where('property_type', 6) : [];
        foreach ($totalVehicleRecord as $item) {
            if ($item->loan_own_type_property == 1) {
                $recreationalLoan = json_decode($item->vehicle_car_loan, true);
                foreach ($vehicles as $document) {
                    if ($document == 'Other_Loan_Statement_' . $i) {
                        $vehiclesDocumentList[] = $document;
                        if ($forApi) {
                            $vehicleUpdatedNames[$document] = Helper::validate_key_value('creditor_name', $recreationalLoan) . " Auto Loan statement";
                        } else {
                            $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600'>" . Helper::validate_key_value('creditor_name', $recreationalLoan) . "</span> Auto Loan statement";
                        }
                    }
                }
            }
            $i++;
        }

        return [
            'vehiclesDocumentList' => $vehiclesDocumentList,
            'notOwnedDocs' => $notOwnedDocs,
            'vehicleUpdatedNames' => $vehicleUpdatedNames
        ];

    }

    public static function getClientDebtorVehiclesDocumentListWithHeading($client_id, $forApi = false, $addVehicleTitleDocs = false, $addVehicleRegistrationDocs = false)
    {
        $vehicles = self::CODEBTOR_VEHICLEARRAY;
        $vehicles = array_merge($vehicles, self::OTHERLOANARRAY);

        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $clientPropertyData, 'array');
        $propertyvehicleR = $propertyvehicle;

        $totalVehicleRecord = !empty($propertyvehicle) ? $propertyvehicle->where('property_type', 1) : [];

        $i = 1;
        $vehicleData = [];
        $vehiclesDocumentList = [];
        $notOwnedDocs = [];
        $vehicleUpdatedNames = [];
        // Vehicle 1: 1992 GMC Yukon Vin# 1GKEK18K8NJ707221
        foreach ($totalVehicleRecord as $item) {
            $vehicleLoan = json_decode($item->vehicle_car_loan, true);
            $vehicleUpdatedNames['vehicle_statement_'.$i] = "Vehicle "
                . $i
                .": "
                . Helper::validate_key_value('property_year', $item)
                ." "
                . Helper::validate_key_value('property_make', $item)
                ." "
                . Helper::validate_key_value('property_model', $item)
                ." Vin# "
                . Helper::validate_key_value('vin_number', $item) ;
            foreach ($vehicles as $document) {
                if ($document == 'Current_Auto_Loan_Statement_' . $i) {
                    $pVVehicleName = "Property Value For: "
                            . Helper::validate_key_value('property_year', $item) . " "
                            . Helper::validate_key_value('property_make', $item) . " "
                            . Helper::validate_key_value('property_model', $item);
                    $vehicleData['vehicle_statement_'.$i]['Autoloan_property_value_'.Helper::validate_key_value('id', $item, 'radio')] = $pVVehicleName;
                    $vehicleUpdatedNames['Autoloan_property_value_'.Helper::validate_key_value('id', $item, 'radio')] = $pVVehicleName;
                    if ($item->loan_own_type_property == 1) {
                        $vehicleData['vehicle_statement_'.$i][$document] = $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600 me-1'>" . Helper::validate_key_value('creditor_name', $vehicleLoan) . "</span> Auto Loan statement";
                        $vehiclesDocumentList[] = $document;
                        if ($forApi) {
                            $vehicleUpdatedNames[$document] = Helper::validate_key_value('creditor_name', $vehicleLoan) . " Auto Loan statement";
                        } else {
                            $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600 me-1'>" . Helper::validate_key_value('creditor_name', $vehicleLoan) . "</span> Auto Loan statement";
                        }
                    } else {
                        $ownAnyProperty = Helper::validate_key_value('own_any_property', $item, 'radio');
                        $hasAnyLoan = Helper::validate_key_value('loan_own_type_property', $item, 'radio');
                        if (isset($ownAnyProperty) && $ownAnyProperty == 1 && isset($hasAnyLoan) && $hasAnyLoan == 0 && $addVehicleTitleDocs) {
                            $carYear = Helper::validate_key_value('property_year', $item);
                            $carMake = Helper::validate_key_value('property_make', $item);
                            $carModel = Helper::validate_key_value('property_model', $item);
                            $carStyle = Helper::validate_key_value('property_other_info', $item);
                            $documentTitle = $carYear.' '.$carMake.' '.$carModel.' '.$carStyle;
                            $documentType = Helper::validate_doc_type($documentTitle);
                            $documentTitle = "Title For ".$documentTitle;
                            $vehicleData['vehicle_statement_'.$i][$documentType] = $documentTitle;
                            $vehicleUpdatedNames[$documentType] = $documentTitle;
                            $vehiclesDocumentList[] = $documentType;
                        }
                    }
                    if ($addVehicleRegistrationDocs) {
                        $vehicleName = "Registration For: "
                            . Helper::validate_key_value('property_year', $item) . " "
                            . Helper::validate_key_value('property_make', $item) . " "
                            . Helper::validate_key_value('property_model', $item);
                        $regKey = Helper::validate_doc_type('Vehicle_Registration_'.Helper::validate_key_value('id', $item, 'radio'));
                        $vehicleData['vehicle_statement_'.$i][$regKey] = $vehicleName;
                        $vehicleUpdatedNames[$regKey] = $vehicleName;
                        $vehiclesDocumentList[] = $regKey;
                    }
                }
            }
            $i++;
        }
        $i = 1;
        //Recreational Vehicle
        $totalVehicleRecord = !empty($propertyvehicleR) ? $propertyvehicleR->where('property_type', 6) : [];
        foreach ($totalVehicleRecord as $item) {
            $recreationalLoan = json_decode($item->vehicle_car_loan, true);
            $vehicleUpdatedNames['recreational_statement_'.$i] =
                "Recreational "
                . $i
                .": "
                . Helper::validate_key_value('property_year', $item)
                ." "
                . Helper::validate_key_value('property_make', $item)
                ." "
                . Helper::validate_key_value('property_model', $item)
                ." Vin# "
                . Helper::validate_key_value('vin_number', $item) ;
            foreach ($vehicles as $document) {
                if ($document == 'Other_Loan_Statement_' . $i) {
                    $pVVehicleName = "Property Value For: "
                        . Helper::validate_key_value('property_year', $item) . " "
                        . Helper::validate_key_value('property_make', $item) . " "
                        . Helper::validate_key_value('property_model', $item);
                    $vehicleData['recreational_statement_'.$i]['Autoloan_property_value_'.Helper::validate_key_value('id', $item, 'radio')] = $pVVehicleName;
                    $vehicleUpdatedNames['Autoloan_property_value_'.Helper::validate_key_value('id', $item, 'radio')] = $pVVehicleName;
                    if ($item->loan_own_type_property == 1) {
                        $vehicleData['recreational_statement_'.$i][$document] = $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600 me-1'>" . Helper::validate_key_value('creditor_name', $recreationalLoan) . "</span> Auto Loan statement";
                        $vehiclesDocumentList[] = $document;
                        if ($forApi) {
                            $vehicleUpdatedNames[$document] = Helper::validate_key_value('creditor_name', $recreationalLoan) . " Auto Loan statement";
                        } else {
                            $vehicleUpdatedNames[$document] = "<span class='text-dark f-w-600 me-1'>" . Helper::validate_key_value('creditor_name', $recreationalLoan) . "</span> Auto Loan statement";
                        }
                    } else {
                        $ownAnyProperty = Helper::validate_key_value('own_any_property', $item, 'radio');
                        $hasAnyLoan = Helper::validate_key_value('loan_own_type_property', $item, 'radio');
                        if (isset($ownAnyProperty) && $ownAnyProperty == 1 && isset($hasAnyLoan) && $hasAnyLoan == 0 && $addVehicleTitleDocs) {
                            $carYear = Helper::validate_key_value('property_year', $item);
                            $carMake = Helper::validate_key_value('property_make', $item);
                            $carModel = Helper::validate_key_value('property_model', $item);
                            $carStyle = Helper::validate_key_value('property_other_info', $item);
                            $documentTitle = $carYear.' '.$carMake.' '.$carModel.' '.$carStyle;
                            $documentType = Helper::validate_doc_type($documentTitle);
                            $documentTitle = "Title For ".$documentTitle;
                            $vehicleData['recreational_statement_'.$i][$documentType] = $documentTitle;
                            $vehicleUpdatedNames[$documentType] = $documentTitle;
                            $vehiclesDocumentList[] = $documentType;
                        }
                    }
                    if ($addVehicleRegistrationDocs) {
                        $vehicleName = "Registration For: "
                            . Helper::validate_key_value('property_year', $item) . " "
                            . Helper::validate_key_value('property_make', $item) . " "
                            . Helper::validate_key_value('property_model', $item);
                        $regKey = Helper::validate_doc_type('Vehicle_Registration_'.Helper::validate_key_value('id', $item, 'radio'));
                        $vehicleData['recreational_statement_'.$i][$regKey] = $vehicleName;
                        $vehicleUpdatedNames[$regKey] = $vehicleName;
                        $vehiclesDocumentList[] = $regKey;
                    }
                }

            }
            $i++;
        }

        return [
            'vehicleData' => $vehicleData,
            'vehiclesDocumentList' => $vehiclesDocumentList,
            'notOwnedDocs' => $notOwnedDocs,
            'vehicleUpdatedNames' => $vehicleUpdatedNames
        ];
    }

    public static function sanitizePdfFilename($filename)
    {
        // Remove non-ASCII characters
        $sanitized = preg_replace('/[^\x20-\x7E]/', '', $filename);

        // Replace spaces with underscores (optional, for readability)
        $sanitized = str_replace(' ', '_', $sanitized);

        // Remove any remaining invalid characters (e.g., slashes, backslashes, colons)
        $sanitized = preg_replace('/[^a-zA-Z0-9._-]/', '', $sanitized);

        return $sanitized;
    }
    public static function hasExtension($name)
    {
        // Check if the string contains a dot
        if (strpos($name, '.') !== false) {
            // Extract the part after the last dot
            $extension = pathinfo($name, PATHINFO_EXTENSION);

            // Return true if the extension is not empty
            return !empty($extension);
        }

        return false;
    }
    public static function getMoveDocumentToOptions($allDocuments, $docType, $client_id)
    {
        $arrayGroup = [ 'bank_statements','type_venmo_paypal_cash','type_brokerage_account','requested_documents','Debtor_Taxes','misc_attorney_docs'];
        $list = [];

        $getBothEmployerList = \App\Models\ClientDocuments::getBothEmployerList($client_id);
        $debtorEmployerList = !empty(Helper::validate_key_value('debtorEmployerList', $getBothEmployerList)) ? Helper::validate_key_value('debtorEmployerList', $getBothEmployerList) : [];
        $codebtorEmployerList = !empty(Helper::validate_key_value('codebtorEmployerList', $getBothEmployerList)) ? Helper::validate_key_value('codebtorEmployerList', $getBothEmployerList) : [];

        $debtorOtherIncomeTypeAdded = false;
        $codebtorOtherIncomeTypeAdded = false;
        $debtorPaystubTypeAdded = false;
        $codebtorPaystubTypeAdded = false;
        foreach ($allDocuments as $document) {
            if ($document['document_type'] == $docType && !in_array($docType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                continue;
            }
            if ($document['document_type'] == 'Drivers_License') {
                $list[] = '<optgroup label="Debtor DL/SSN Docs:"></optgroup>';
            }
            if ($document['document_type'] == 'Co_Debtor_Drivers_License') {
                $list[] = '<optgroup label="Co-Debtor DL/SSN Docs:"></optgroup>';
            }
            if ($document['document_type'] == 'Unsecured_Debts') {
                $list[] = '<optgroup label="Supplemental Asset Debt Docs:"></optgroup>';
                $list[] = "<option value='Mortgage_property_value'>Mortgage Property Value(s)</option>";
                $list[] = "<option value='Autoloan_property_value'>Vehicle Value(s)</option>";
                $list[] = '<optgroup label="Debts:"></optgroup>';
                continue;
            }
            if ($document['document_type'] == 'Current_Mortgage_Statement') {
                $list[] = '<optgroup label="Current Mortgage Statements:"></optgroup>';
                continue;
            }
            if ($document['document_type'] == 'Current_Auto_Loan_Statement') {
                $list[] = '<optgroup label="Current Auto Loan Statements:"></optgroup>';
                continue;
            }
            if ($document['document_type'] == 'Income_Docs_For_Debtor') {
                // $list[] = '<optgroup label="Debtor Income Docs:"></optgroup>';
                continue;
            }
            if ($document['document_type'] == 'Debtor_Pay_Stubs' && !$debtorPaystubTypeAdded) {
                $list[] = '<optgroup label="Debtor Income Docs:"></optgroup>';
                foreach ($debtorEmployerList as $empData) {
                    $list[] = "<option value='".$document['document_type']."' data-empid='".Helper::validate_key_value('id', $empData, 'radio')."'>".Helper::validate_key_value('employer_name', $empData)."</option>";
                }
                $debtorPaystubTypeAdded = true;
                continue;
            }
            if ($document['document_type'] == 'Co_Debtor_Pay_Stubs' && !$codebtorPaystubTypeAdded) {
                $list[] = '<optgroup label="Co-Debtor Income Docs:"></optgroup>';
                foreach ($codebtorEmployerList as $empData) {
                    $list[] = "<option value='".$document['document_type']."' data-empid='".Helper::validate_key_value('id', $empData, 'radio')."'>".Helper::validate_key_value('employer_name', $empData)."</option>";
                }
                $codebtorPaystubTypeAdded = true;
                continue;
            }
            if ($document['document_type'] == 'other_income') {
                continue;
            }

            if (in_array($document['document_type'], ['debtor_Social_Security_Annual_Award_Letter','debtor_VA_Benefit_Award_Letter','debtor_Unemployment_Payment_History_Last_7_Months']) && !$debtorOtherIncomeTypeAdded) {
                $list[] = '<optgroup label="Debtor Other Income Type:"></optgroup>';
                $debtorOtherIncomeTypeAdded = true;
            }

            if (in_array($document['document_type'], ['codebtor_Social_Security_Annual_Award_Letter','codebtor_VA_Benefit_Award_Letter','codebtor_Unemployment_Payment_History_Last_7_Months']) && !$codebtorOtherIncomeTypeAdded) {
                $list[] = '<optgroup label="Co-Debtor Other Income Type:"></optgroup>';
                $codebtorOtherIncomeTypeAdded = true;
            }

            // $docName = $document['document_name'];
            // $docName = str_replace('_', ' ', $docName);
            // if(in_array($document['document_type'],$arrayGroup)){
            //     $list[] = '<optgroup label="'.$docName.'"></optgroup>';
            // }else{
            //     $list[] = "<option value='".$document['document_type']."'>".$docName."</option>";
            // }
        }
        $list = self::rearrangeOptions($list);

        return $list;
    }

    private static function rearrangeOptions($options)
    {
        $order = [
            "Debtor DL/SSN Docs:",
            "Co-Debtor DL/SSN Docs:",
            "Current Mortgage Statements:",
            "Current Auto Loan Statements:",
            "Supplemental Asset Debt Docs:",
            "Debts:",
            "Debtor Income Docs:",
            "Debtor Other Income Type:",
            "Co-Debtor Income Docs:",
            "Co-Debtor Other Income Type:",
            "Debtor(s) Taxes:",
            "Additional or Unlisted/Attorney Documents",
            "Bank Statements",
            "PayPal, Cash App, Venmo Account Statements",
            "Brokerage Account Statements",
            "Requested Documents"
        ];

        $groupedOptions = [];
        $currentGroup = null;

        foreach ($options as $option) {
            if (strpos($option, '<optgroup') !== false) {
                preg_match('/label="([^"]+)"/', $option, $matches);
                if (!empty($matches[1])) {
                    $currentGroup = $matches[1];
                    $groupedOptions[$currentGroup] = [$option]; // Store the optgroup tag
                }
            } elseif ($currentGroup) {
                $groupedOptions[$currentGroup][] = $option;
            }
        }

        // Sort groups based on predefined order
        $sortedOptions = [];
        foreach ($order as $group) {
            if (isset($groupedOptions[$group])) {
                $sortedOptions = array_merge($sortedOptions, $groupedOptions[$group]);
            }
        }

        return $sortedOptions;
    }

    public static function validateFile($file, $maxSize = 268435456) // 500MB default
    {
        @ini_set('upload_max_size', '500M');
        $errors = [];

        $size = $file->getSize();

        if ($size == 0) {
            $errors[] = "Uploaded document size is 0 bytes, please check and upload again.";

            return $errors;
        }

        if ($size > $maxSize) {
            $errors[] = "File size exceeds maximum allowed size of " . ($maxSize / 1048576) . "MB";
        }

        $allowedTypes = ArrayHelper::getAllowedFileExtensionArray();

        $extension = self::getExtensionFromFile($file, $allowedTypes);

        if (!in_array($extension, $allowedTypes)) {
            $errors[] = "File type (." . $extension . ") not allowed. Allowed types: " . implode(', ', $allowedTypes);
        }
        \Log::info(json_encode($errors));
        /*
        if (self::containsMaliciousContent($file)) {
            $errors[] = "File appears to contain malicious content";
        }
        */

        return $errors;
    }


    public static function getExtensionFromFile($file, $allowedTypes)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (!$extension) {
            $extension = self::getExtensionFromMimeType($file->getMimeType());
        }

        // Map known MIME extensions to allowed extensions
        $mimeToExt = ArrayHelper::getExtFromMime();

        // If extension is not allowed, try to map from MIME extension
        if (!in_array($extension, $allowedTypes)) {
            if (isset($mimeToExt[$extension]) && in_array($mimeToExt[$extension], $allowedTypes)) {
                $extension = $mimeToExt[$extension];
            }
        }

        return $extension;
    }


    private static function containsMaliciousContent($file)
    {
        $content = @file_get_contents($file->getRealPath());
        if ($content === false) {
            return false;
        }
        $suspiciousPatterns = [
            '<?php', '<script', 'javascript:', 'eval(', 'base64_decode('
        ];
        foreach ($suspiciousPatterns as $pattern) {
            if (stripos($content, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }

    public static function getExtensionFromMimeType($mime_type)
    {
        $parts = explode('/', $mime_type);

        return (count($parts) === 2) ? strtolower($parts[1]) : '';
    }

    public static function validatePath($path, $maxLength = 260)
    {
        $errors = [];

        // Check path length
        if (strlen($path) > $maxLength) {
            $errors[] = "Path length exceeds maximum allowed length of {$maxLength} characters";
        }

        // Check for invalid characters
        $invalidChars = ['<', '>', ':', '"', '\\', '|', '?', '*'];
        foreach ($invalidChars as $char) {
            if (strpos($path, $char) !== false) {
                $errors[] = "Path contains invalid character: {$char}";
            }
        }

        return $errors;
    }

    public static function sanitizeDirectoryName($address)
    {
        // Trim spaces
        $address = trim($address);

        // Replace spaces with underscore (or dash if you prefer)
        $address = str_replace(' ', '_', $address);

        // Remove special characters that are not allowed in directory names
        $address = preg_replace('/[^A-Za-z0-9_\-]/', '', $address);

        // Convert to lowercase for consistency
        $address = strtolower($address);

        // Limit length to 100 chars (optional, for safety)
        return substr($address, 0, 100);
    }

}
