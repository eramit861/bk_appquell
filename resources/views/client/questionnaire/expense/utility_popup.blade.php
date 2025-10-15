<div class="card utility_popup utility_popup_{{ $type }}">

    <div class="card-header sticky-top p-2 py-3 ">

        <div class="selected-utilities mx-3 w-100">


            <h5 class="w-100 text-center mb-2 text-c-blue"> Select all items you have then select Save</h5>
            <strong>Selected Utilities: </strong><span id="selected-utilities-list">None</span>
        </div>

    </div>
    <div class="card-body py-3">
        <!-- <p class="card-text">Select below utilities to add.</p> -->
        <div class="row" id="utility-list">
            @foreach ($utilities as $name => $label)
                @php
                    $imgUrl = asset('assets/img/streaming/' . $name . '.png');
                @endphp
                <div class="col-md-3 utility-item">
                    <div class="card utility-card" data-label="{{ $label }}">
                        <div class="card-body d-flex align-items-center p-2">
                            <img class="mr-3" src="{{ $imgUrl }}" alt="{{ $label }}">
                            <h6 class="card-title mb-0">{{ $label }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Add More section -->
            <div class="col-md-12 add-more-utility-card">
            </div>
        </div>
    </div>

    <div class="card-footer py-2 px-3">
        <p class="text-c-blue w-100 d-block pb-0 mb-0 fs-16px footer-label-p">To add any items not listed above enter
            the name and then select Add:</p>
        <div class="sticky-bottom">
            <div class="bottom-custom-div w-100 input-div">
                <div class="bottom-custom-input-div p-2 w-100">
                    <img class="mr-3" src="{{ asset('assets/img/streaming/28.png') }}" alt="Add More">
                    <input type="text" class="form-control" id="custom-utility" placeholder="Enter custom utility">
                </div>
                <div class="bottom-custom-action-div p-2">
                    <button type="button" id="add-custom-utility" class="btn btn-primary mb-0 py-1">Add</button>
                    <a href="#" class="done btn btn-primary mb-0 py-1 mr-0 save-utility-button">Save Selected
                        Utility</a>
                </div>
            </div>
        </div>
    </div>
</div>