@php
$i = 0;
$vehicle = [];
if (isset($vininfo)) {
    $vins = [];
    $property = $propertyvehicle->toArray();
    if (empty($property)) {
        $propertyvehicle = [];
        foreach ($vininfo as $vin) {
            $propertyvehicle[] = ['own_any_property' => 1, 'vin_number' => $vin['document_file']];
        }
    }
}
$rerc = 0;
$vehi = 0;

$hideClass = 'hide-data';
$propertyvehicle = !is_array($propertyvehicle) ? $propertyvehicle->toArray() : $propertyvehicle;
if (!empty($propertyvehicle) && count($propertyvehicle) > 0) {
    if (isset($propertyvehicle[0]['own_any_property']) && $propertyvehicle[0]['own_any_property'] == 1) {
        $hideClass = '';
    }

    if (!empty($propertyvehicle)) {
        usort($propertyvehicle, function ($a, $b) {
            if (!empty($a['property_type']) && !empty($b['property_type'])) {
                return (float)$a['property_type'] - (float)$b['property_type'];
            }
        });
    }
    foreach ($propertyvehicle as $key => $vehicle) {
        if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
            $rerc++;
        } else {
            $vehi++;
        }
@endphp
@include("client.questionnaire.property.common.vehicle",[$vehicle])
@php 
        $i++;
    }
} else {
@endphp
    @include("client.questionnaire.property.common.vehicle",$vehicle)
@php 
} 
$i = $i + 1; 
@endphp
