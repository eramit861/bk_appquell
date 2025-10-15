<div class="light-gray-div questionnaire">        
    <h2 >Client Property</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'property', 'forLabel' => 'Property' ])
    <div class="row gx-3 w-100 m-0">									
        <div class="col-12 p-0">
            <div class="personal_property_section_area personal-property-sec" id="personal-property">
                @php
                    $hide_docs = false;
                @endphp
                @include("attorney.form_elements.personal_property",$property_info)
            </div>
        </div>
    </div>
</div>