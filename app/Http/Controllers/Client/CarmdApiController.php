<?php

namespace App\Http\Controllers\Client;

use App\Helpers\ArrayHelper;
use App\Helpers\ClientHelper;
use App\Helpers\DocumentHelper;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use App\Jobs\GeneratePropertyScreenshot;
use App\Models\TblPropertyDetailApiRequest;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class CarmdApiController extends Controller
{
    public function fetch_vin_number(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $vinNumber = $input["vin_number"] ?? '';
            if (empty($vinNumber)) {
                return response()->json(Helper::renderApiError('VIN number required', ['data' => null]), 200);
            }
            $vinResponse = ClientHelper::vinFromCarmd($vinNumber);

            if (empty($vinResponse)) {
                return response()->json(Helper::renderApiError('Invalid VIN number', ['data' => null]), 200);
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $vinResponse]), 200);
        }
    }

    public function get_property_residence_details_by_graphql(Request $request)
    {

        $request->validate([
            'client_id' => 'required',
            'address' => 'required|string',
            'property_id' => 'nullable|string',
        ]);

        $client_id = $request->input('client_id', '');
        $address = $request->input('address', '');
        $property_id = $request->input('property_id', null);
        $form_type = $request->input('form_type', 'client_property');

        $endpoint = env('APPSYNC_ENDPOINT');
        $apiKey = env('APPSYNC_API_KEY');
        // Define GraphQL query and variables
        $query = <<<'GRAPHQL'
        query GetProperty($address: String!) {
          getProperty(address: $address) {
            url
            price
            beds
            baths
            sqft
            address
            keyDetails {
              label
              value
            }
            amenities {
              category
              items
            }
          }
        }
        GRAPHQL;

        $address_as_dir = DocumentHelper::sanitizeDirectoryName($address);
        if ($form_type == 'intake_form') {
            $s3storePath = 'intake_form_residence_value/'.$client_id.'/'.$address_as_dir;
        } else {
            $s3storePath = 'residence_value/'.$client_id.'/'.$address_as_dir;
        }
        if (!Storage::disk('s3')->exists($s3storePath . '/')) {
            Storage::disk('s3')->makeDirectory($s3storePath);
        }
        $variables = [
            'address' => $address,
            'valueDocumentPath' => $s3storePath,
        ];

        // Prepare Guzzle client
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => $apiKey
            ],
            'timeout' => 10 // seconds
        ]);

        try {
            $response = $client->post($endpoint, [
                'json' => [
                    'query' => $query,
                    'variables' => $variables
                ]
            ]);

            $payload = json_decode($response->getBody()->getContents(), true);

            if (isset($payload['errors'])) {
                // Handle GraphQL errors
                return response()->json(Helper::renderJsonError("Failed to fetch property details. Please try again later."))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            $data = $payload['data']['getProperty'] ?? null;

            $finalData = [
                'beds' => '',
                'baths' => '',
                'price' => '',
                'property_type' => '',
                'lot_size' => ''
            ];

            if (!empty($data)) {
                $finalData['beds'] = Helper::getLotSize(Helper::validate_key_value('beds', $data, 'array'));
                $finalData['baths'] = Helper::getBathSize(Helper::validate_key_value('baths', $data, 'array'));
                $finalData['price'] = Helper::getLotSize(Helper::validate_key_value('price', $data, 'array'));
                $finalData['home_sq_ft'] = Helper::getLotSize(Helper::validate_key_value('sqft', $data, 'array'));
                $keyDetails = Helper::validate_key_value('keyDetails', $data, 'array');
                if (!empty($keyDetails) && is_array($keyDetails)) {
                    foreach ($keyDetails as $keyDetailObject) {
                        if (!empty($keyDetailObject) && is_array($keyDetailObject)) {
                            if (
                                isset($keyDetailObject['label'], $keyDetailObject['value']) &&
                                $keyDetailObject['label'] === 'Property Type'
                            ) {
                                $finalData['property_type'] = ArrayHelper::getMortgagePropertyType($keyDetailObject['value']);
                            }
                            if (
                                isset($keyDetailObject['label'], $keyDetailObject['value']) &&
                                $keyDetailObject['label'] === 'Lot Size'
                            ) {
                                $finalData['lot_size'] = Helper::getLotSize($keyDetailObject['value']);
                            }
                        }
                    }
                }

                // Try multiple approaches to get property visual content
                $propertyUrl = Helper::validate_key_value('url', $data);
                if (!empty($propertyUrl)) {
                    // Dispatch screenshot generation to background queue
                    GeneratePropertyScreenshot::dispatch(
                        $propertyUrl,
                        $client_id,
                        $address,
                        $property_id
                    );
                }

            }

            TblPropertyDetailApiRequest::logRequest(
                $client_id,
                1,
                json_encode($variables),
                json_encode($payload)
            );

            return response()->json([
                'status' => 1,
                // 'data' => $data,
                'finalData' => $finalData,
                'extraData' => json_encode($payload),
            ], 200);
        } catch (RequestException $e) {
            // Network or HTTP error
            return response()->json(Helper::renderJsonError($e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }



    }

    public function get_property_vehicle_details_by_graphql(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'vin' => 'required|string',
            'mileage' => 'required',
        ]);

        $client_id = $request->input('client_id', '');
        $vin = $request->input('vin', '');
        $mileage = $request->input('mileage', '');

        $endpoint = env('APPSYNC_ENDPOINT');
        $apiKey = env('APPSYNC_API_KEY');

        // Define GraphQL query and variables
        $query = <<<'GRAPHQL'
        query DecodeVin($vin: String!, $mileage: Int!) {
            decodeVin(vin: $vin, mileage: $mileage) {
                decodedFields {
                    VariableId
                    VariableName
                    Value
                    ValueId
                }
                vehicleValue {
                    vin
                    success
                    id
                    vehicle
                    mean
                    stdev
                    count
                    mileage
                    certainty
                    period
                    prices {
                        average
                        below
                        above
                        distribution {
                            group {
                                min
                                max
                                count
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $variables = [
            'vin' => $vin,
            'mileage' => $mileage,
            // 'client_id' => 1014,
            // 'property_index' => 1
        ];

        // Prepare Guzzle client
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => $apiKey
            ],
            'timeout' => 10 // seconds
        ]);

        try {
            $response = $client->post($endpoint, [
                'json' => [
                    'query' => $query,
                    'variables' => $variables
                ]
            ]);

            $payload = json_decode($response->getBody()->getContents(), true);

            if (isset($payload['errors'])) {
                Log::error('GraphQL error in get_property_vehicle_details_by_graphql', [
                    'client_id' => $client_id,
                    'vin' => $vin,
                    'mileage' => $mileage,
                    'errors' => $payload['errors']
                ]);

                // Handle GraphQL errors
                return response()->json(Helper::renderJsonError("Failed to fetch vehicle details. Please try again later."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $data = $payload['data']['decodeVin']['vehicleValue'] ?? null;

            $finalData = [
                'year' => '',
                'make' => '',
                'model' => '',
                'style' => '',
                'mileage' => '',
                'price' => ''
            ];

            if (!empty($data)) {
                $finalData['mileage'] = Helper::getLotSize(Helper::validate_key_value('mileage', $data, 'array'));
                $finalData['price'] = Helper::getLotSize(Helper::validate_key_value('mean', $data, 'array'));
                $vehicle = Helper::validate_key_value('vehicle', $data);
                if (!empty($vehicle)) {
                    $parts = explode(" ", $vehicle);

                    $finalData['year'] = $parts[0]; // "2012"
                    $finalData['make'] = $parts[1]; // "Toyota"
                    $finalData['model'] = $parts[2]; // "Camry"
                    $finalData['style'] = implode(" ", array_slice($parts, 3)); //  Combine the rest as the style like "LE sport"
                }

            }

            TblPropertyDetailApiRequest::logRequest(
                $client_id,
                2,
                json_encode($variables),
                json_encode($payload)
            );

            // Log the raw decoded VIN data for troubleshooting or auditing
            Log::info('Decoded VIN response in get_property_vehicle_details_by_graphql', [
                'finalData' => $finalData,
            ]);

            return response()->json([
                'status' => 1,
                // 'data' => $data,
                'finalData' => $finalData,
                'extraData' => json_encode($payload),
            ], 200);
        } catch (RequestException $e) {
            // Network or HTTP error
            return response()->json(Helper::renderJsonError($e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

}
