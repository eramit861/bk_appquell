<div class="card common_detailed_items_popup common_detailed_items_popup_{{ $type }}   ;">

    <div class="card-header sticky-top p-2">  
        <div class="selected-items mx-3">            
            <h5 class="w-100 text-center mb-2 text-c-blue">Select all {{$title}} you have then select Save</h5>
            <div class="max-height-65 overflow-scroll"><strong>Selected items: </strong><span id="selected-items-list">None</span></div>
        </div>                
    </div>
    @php $web_view = Session::get('web_view'); @endphp
    <div class="card-body py-3">
        <div class="row" id="item-list">
            @foreach ($items as $itemObject => $object)
                <div class="col-md-12 my-2">
                    <span class="{{ empty($object) ? 'item-heading' : 'sec-heading-font2' }}">{{ $itemObject }}:</span>
                </div>
                @foreach ($object as $key => $label)
                    <div class="col-sm-6 col-md-3 col-lg-3 col-md-4 custom-item">
                        <div class="card item-card" onclick="handleCardClick(event)" data-label="{{ $label['key'] }}">
                            <div class="card-body p-0">
                                <h6 class="card-title mb-0 w-100 {{ @$web_view ? 'pl-2 pr-2 pb-1 pt-1' : 'p-2' }}"><span>{{ $label['key'] }}</span>&nbsp;<span onclick="handleCardClick(event)">{{ $label['hint'] }}</span></h6>
                                <div class="d-flex">
                                    <div class="p-2 pt-0 w-100">
                                        <small>Quantity:</small>
                                        <select class="form-control-custom-select" onclick="event.stopPropagation();" onchange="handleQuantityChange(event)">
                                            @for ($i = 0; $i <= 30; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="p-2 pt-0">
                                        <small>Total&nbsp;Value&nbsp;of&nbsp;Item(s):</small>
                                        <input type="text"  onclick="event.stopPropagation();" class="form-control-custom-input price-field w-price-size" value="0.00" oninput="handlePriceChange(event)" onblur="handlePriceOnBlur(event)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

            <!-- Additional section for custom items -->
            <div class="col-md-12 add-more-item-card hide-data my-2">
                <span class="sec-heading-font2 mb-2">Additional:</span>
            </div>
            <div class="col-md-12 bottom-empty-div hide-data my-2"></div>
        </div>
    </div>

    <div class="card-footer py-0 px-3">
        <p class="text-c-blue w-100 d-block pb-0 mb-0 footer-label-p">To add any items not listed above, enter the name, set quantity, set item value and select Add:</p>
        <div class="sticky-bottom">
            <div class="bottom-custom-div p-2 w-100 input-div">
                <div class="name-quantity-div">
                    <div class="item-name-div">
                        <div class="">
                            <small class="text-c-black">&nbsp; </small>
                            <img src="{{ asset('assets/img/streaming/28.png') }}" alt="Add More">
                        </div>
                        <div class="px-3 w-100">
                            <small class="text-c-black">Item name:</small>
                            <input type="text" class="form-control " id="custom-item" placeholder="Enter custom item" oninput="customItemInput()">
                        </div>
                    </div>
                    <div class="quantity-value-div">
                        <div class="quantity-div">
                            <small class="text-c-black">Quantity:</small>
                            <select class="form-control mr-3 w-auto a" id="custom-item-quantity">
                                @for ($i = 0; $i <= 30; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="">
                            <small class="text-c-black">Total Value of Item(s):</small>
                            <input type="text" class="form-control price-field" id="custom-item-price" value="0.00" onblur="handlePriceOnBlur(event)"/>
                        </div>
                    </div>
                </div>
                <div class="button-action-div">
                    <div class="">
                        <button type="button" id="add-custom-item" class="btn btn-primary mb-0 py-1" onclick="handleAddCustomItem()">Add</button>
                    </div>
                    <div class="">
                        <a href="javascript:void(0)" class="done btn btn-primary mb-0 py-1 mr-3 save-property-button" onclick="handleSaveClick(event, '{{ $type }}', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }})">Save Selected Property</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@if (!isset($attorney_edit) || $attorney_edit != true)
    @push('tab_styles')
        <link rel="stylesheet" href="{{ asset('assets/css/client/common_utility_popup.css') }}">
    @endpush
@endif

@if (isset($attorney_edit) && $attorney_edit == true)
    @push('tab_styles')
        <link rel="stylesheet" href="{{ asset('assets/css/client/common_utility_popup_attorney.css') }}">
    @endpush
@endif