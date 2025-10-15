<div class="light-gray-div questionnaire" id="financial-affairs">        
    <h2 >Statement of Financial Affairs</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'sofa', 'forLabel' => 'Financial Affairs' ])
    <div class="row gx-3">									
        <div class="col-12">
            <div class="financial-affairs-sec mt-3">
                @include("attorney.form_elements.financial_affairs",$financialaffairs_info)
            </div>
        </div>
    </div>
</div>