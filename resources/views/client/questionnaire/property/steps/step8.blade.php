

<div class="light-gray-div mt-2">
    <h2>Property - Miscellaneous</h2>
    <form name="client_property_step7" id="client_property_step7" action="{{route('client_property_step7')}}" method="post" novalidate style="width: 100%">
        @csrf
        <div class="row gx-3">
            <div class="col-12">
                DATA HERE
            </div>
        </div>
    </form>
</div>


    @php
        $miscellan_final = [];
        if (!empty($miscellaneous)) {
            foreach ($miscellaneous as $miscellan) {
                $ml_type_data = json_decode($miscellan['type_data'], 1);
                if (!empty($ml_type_data)) {
                    $miscellan['description'] = (!empty($ml_type_data['description'])) ? $ml_type_data['description'] : "";
                    $miscellan['property_value'] = (!empty($ml_type_data['property_value'])) ? $ml_type_data['property_value'] : "";
                    $miscellan['owned_by'] = (!empty($ml_type_data['owned_by'])) ? $ml_type_data['owned_by'] : "";
                }
                unset($miscellan['type_data']);
                $miscellan_final[$miscellan['type']] = $miscellan;
            }
        }
        // echo "<pre>";print_r($miscellan_final);echo"</pre>";
        $miscellaneous = (!empty($miscellan_final['miscellaneous'])) ? $miscellan_final['miscellaneous'] : [];
    @endphp
    <form name="client_property_step7" id="client_property_step7" action="{{route('client_property_step7')}}" method="post" novalidate>
        @csrf
        <div class="row mt-3">
            <input type="hidden" name="miscellaneous[id]" value="{{ !empty($miscellaneous['id']) ? $miscellaneous['id'] : '' }}">
            <input type="hidden" name="miscellaneous[type]" value="miscellaneous">
            <div class="form-main mt-3 w-100">
                <div class="col-md-12">
                    <div class="form-group">
                        <h5>Type of Property</h5>
                        <label class="d-block">All other property of any kind
                            not previously listed
                        </label>
                        <div class="d-inline radio-primary">
                            <input type="radio" {{ (isset($miscellaneous['type_value']) && $miscellaneous['type_value'] == 1) ? 'checked' : '' }} id="previously_listed_yes"
                                name="miscellaneous[type_value]"
                                onchange="getPreviouslylistedItems('yes');" value="1" required>
                            <label for="previously_listed_yes" class="cr">Yes</label>
                        </div>
                        <div class="d-inline radio-primary">
                            <input type="radio" {{ (isset($miscellaneous['type_value']) && $miscellaneous['type_value'] == 0) ? 'checked' : '' }} id="previously_listed_no"
                                name="miscellaneous[type_value]"
                                onchange="getPreviouslylistedItems('no');" value="0" required>
                            <label for="previously_listed_no" class="cr">No</label>
                        </div>
                    </div>
                </div>
                <!-- Condition data -->
                <div class="col-md-12 {{ (isset($miscellaneous['type_value']) && $miscellaneous['type_value'] == 1) ? '' : 'hide-data' }}" id="previously_listed_data">
                    <div class="row">
                        @php
                            $i = 0;
                        @endphp
                        
                        @if(!empty($miscellaneous['description']) && is_array($miscellaneous['description']))
                            @for($i = 0; $i < count($miscellaneous['description']); $i++)
                                @include("client.questionnaire.property.miscellaneous.miscellaneous",['miscellaneous'=>$miscellaneous,$i])
                            @endfor
                        @else
                            @include("client.questionnaire.property.miscellaneous.miscellaneous")
                        @endif

                        @if(!empty($miscellaneous['description']) && is_array($miscellaneous['description']) && count($miscellaneous['description']) < 4)
                            <div class="col-md-12 add-more-btn">
                                <button class="btn btn-primary shadow-2 rounded-0"
                                    id="add-more-residence-form"
                                    onclick="common_financial_addmore_with_limit('miscellaneous',3); return false;"><i
                                        class="feather icon-plus mr-0"></i> Add
                                    More </button>
                                <i class="fas fa-trash fa-lg mb-2 mt-2 remove-alimony-child-support-mutisec" name="" style="position: absolute;right: 40px;"
                                    onclick="removeButton('.miscellaneous_mutisec', '.remove-alimony-child-support-mutisec');"></i>
                            </div>
                        @else
                            <div class="col-md-12 add-more-btn">
                                <button class="btn btn-primary shadow-2 rounded-0"
                                    onclick="common_financial_addmore_with_limit('miscellaneous',3); return false;"><i
                                        class="feather icon-plus mr-0"></i> Add
                                    More </button>
                                <i class="fas fa-trash fa-lg mb-2 mt-2 remove-alimony-child-support-mutisec" name="" style="position: absolute;right: 40px;"
                                    onclick="removeButton('.miscellaneous_mutisec', '.remove-alimony-child-support-mutisec');"></i>
                            </div>
                        @endif
                    </div>













                </div>
                <!-- Condition data End-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="next-part-btn text-right">

                    @if(!empty($miscellaneous) && count($miscellaneous) > 0)
                        @php
                            $back = '';
                            if (request()->routeIs('client_property_step7')) {
                                $back = route('client_property_step6');
                            }
                            if (request()->routeIs('client_property_step6')) {
                                $back = route('client_property_step5');
                            }
                            if (request()->routeIs('client_property_step5')) {
                                $back = route('client_property_step4');
                            }
                            if (request()->routeIs('client_property_step4')) {
                                $back = route('client_property_step4_continue');
                            }
                            if (request()->routeIs('client_property_step4_continue')) {
                                $back = route('client_property_step4');
                            }
                        @endphp
                        <a href="{{$back}}" class="btn btn-primary shadow-2 mb-4">Back</a>
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                class="feather icon-chevron-right mr-0"></i></button>
                    @else
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                class="feather icon-chevron-right mr-0"></i></button>
                    @endif

                </div>
            </div>
        </div>
    </form>
