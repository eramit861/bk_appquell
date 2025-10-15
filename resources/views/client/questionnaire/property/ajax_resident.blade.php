@php
$i = 0;
$resident = [];
$bottomSec = "hide-data";

if (!empty($propertyresident) && count($propertyresident) > 0) {
    foreach ($propertyresident as $resident) {
        $bottomSec = "";
@endphp
    <div class="row">
        @include("client.questionnaire.property.common.resident",$resident)
    </div>
@php
                $i++;
    }
} else {
@endphp
    <div class="row">
        @include("client.questionnaire.property.common.resident",$resident)
    </div>
@php 
}
@endphp