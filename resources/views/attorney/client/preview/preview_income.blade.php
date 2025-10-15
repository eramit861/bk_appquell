<div class="light-gray-div questionnaire">        
    <h2 >Current Income</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'income', 'forLabel' => 'Income' ])
    <div class="row gx-3">									
        <div class="col-12">
        
            <div class="current-income-sec outline-gray-border-area" id="current-income">
                <div class="section-title-div mt-3 mb-3 bb-0-i">
                    <h3 class=""> </h3>
                    <div class="section-edit-div fs-16px">
                        <div class="row">
                            <div class="col-12">
                                <span>Total Monthly Net Income: </span>
                                <span class="float_right ml-1 text-bold display_net_income_total"></span>
                            </div>
                            <!-- <span class="float_right text-bold text-c-blue"></span> -->
                            <div class="col-12">
                                <span>I Versus J:</span>
                                <span class="float_right ml-1 text-bold display_i_vs_j_income_total"></span>
                            </div>
                        </div>
                        <!-- <span class="float_right text-bold text-c-blue"></span> -->
                    </div>
                </div>
            </div>

            
            <div class="current-income-sec" style="float:left;">
                @include("attorney.form_elements.income",$income_info)
            </div>  
        </div>
    </div>
</div>