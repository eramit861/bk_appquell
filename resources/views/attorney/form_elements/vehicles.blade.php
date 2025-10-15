@php $propertyvehicle = $property_info['propertyvehicle']->toArray(); @endphp
<div class="part-a mt-3">
	<span class="mb-1 text-bold">Do you own or possess any Cars, Vans, Trucks, Tractors, SUVs, Motorcycles, RVs, Watercraft, Aircraft, Motor Homes, ATVs and/or Other Vehicles?</span>
    @php
        if (!empty($propertyvehicle)) {
            $vehi = 0;
            $rerc = 0;
            usort($propertyvehicle, function ($a, $b) {
                return intval($a['property_type'] ?? 0) - intval($b['property_type'] ?? 0);
            });
            $incs = 0;
        }
    @endphp
    @if (!empty($propertyvehicle))
        @foreach ($propertyvehicle as $key => $vehicle)
            @php
                if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                    $rerc++;
                } else {
                    $vehi = $vehi + 1;
                }

                $vehicle_name = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
                if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                    $vehicle_name = $vehicle_name . ' ' . $rerc;
                } else {
                    $vehicle_name = $vehicle_name . ' ' . $vehi;
                }
            @endphp
			<div class="row mt-3 outline-gray-border-area">
				<span class="{{ ($vehicle['own_any_property'] == 0) ? 'text-danger text-bold' : 'hide-data' }}">
					{{ ($vehicle['own_any_property'] == 0) ? 'None' : '' }}
				</span>
				<div class="">
					<div class="light-gray-div">
						<div class="light-gray-box-form-area">
							<h2>
								<div class="circle-number-div">{{ $key + 1 }}</div>{{ $vehicle_name }}
							</h2>
							<div class="row">
								@include("attorney.form_elements.vehicle_listing", ['hide_docs' => false])
							</div>
						</div>
					</div>
				</div>
			</div>
        @endforeach
        @php $incs++; @endphp
    @endif
</div>