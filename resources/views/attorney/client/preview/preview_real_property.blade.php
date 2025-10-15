<div class="light-gray-div questionnaire">        
    <h2 >Real Property</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'property', 'forLabel' => 'Property' ])
    <div class="row gx-3 main-title real-property-sec" id="real-property">	
        <div class="col-12">
            <div class="outline-gray-border-area">
                <div class="section-title-div mt-3 pb-2">
                    <h3 class="">Real Property Details</h3>
                    <div class="section-edit-div">
                        <x-attorney.attorneyEditButton 
                            :route="route('property_step1_modal')" 
                            :isEdited="$isPropertyResidenceEdited"
                            extraClass="text-bold"
                        />
                        <x-attorney.attorneyEditReviewed 	
                            :reviewedData="$isPropertyResidenceEdited"
                            extraClass="ml-3"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" >
            <div class="property_section_area real-property-sec">
                @include("attorney.form_elements.property",$property_info)
            </div>
        </div>
    </div>
</div>