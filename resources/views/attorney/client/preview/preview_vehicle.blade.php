<div class="light-gray-div questionnaire">        
    <h2 >Vehicles</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'property', 'forLabel' => 'Property' ])
    <div class="row gx-3">									
        <div class="col-12" >
            <div class="outline-gray-border-area">
                <div class="section-title-div mt-3 pb-2">
                    <h3 class="">Vehicles</h3>
                    <div class="section-edit-div">
                        <x-attorney.attorneyEditButton 
                            :route="route('property_step2_modal')" 
                            :isEdited="$isPropertyVehicleEdited"
                            extraClass="text-bold"
                        />
                        <x-attorney.attorneyEditReviewed 	
                            :reviewedData="$isPropertyVehicleEdited"
                            extraClass="ml-3"
                        />
                    </div>
                </div>
            </div>

            <div class="vehicle_property_section_area vehicles-sec" id="vehicles">
                @include("attorney.form_elements.vehicles",$property_info)
            </div>
        </div>
    </div>
</div>