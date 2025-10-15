<div class="light-gray-div form-main losses_from_fire_data losses_from_fire_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Property Details
		</h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('losses_from_fire_data', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('losses_from_fire_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('losses_from_fire_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">
            <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Describe the property you lost and how the loss occured:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('loss_description', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Description and value of any property transferred:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('transferred_description', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
					
			<div class="col-xxl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
					Date of loss:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('loss_date_payment', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xxl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Property Value:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('loss_amount_payment', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('loss_amount_payment', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @if(isset($isEmpty) && $isEmpty) @else hide-data @endif">
			<div class="col-lg-6 col-md-12">
				<div class="label-div">
					<div class="form-group">
						<label>Describe the property you lost and how the loss occured:</label>
						<textarea class="input_capitalize form-control required loss_description h-unset" rows="2" name="losses_from_fire_data[loss_description][{{$i}}]" placeholder="Describe the property you lost and how the loss occured">{{ Helper::validate_key_loop_value('loss_description', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="label-div">
					<div class="form-group">
						<label>Description and value of any property transferred:</label>
						<textarea class="input_capitalize form-control required transferred_description h-unset" rows="2" name="losses_from_fire_data[transferred_description][{{$i}}]" placeholder="Description and value of any property transferred">{{ Helper::validate_key_loop_value('transferred_description', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Date of loss</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed  required loss_date_payment" name="losses_from_fire_data[loss_date_payment][{{$i}}]" value="{{ Helper::validate_key_loop_value('loss_date_payment', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Value of Property</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" placeholder="Value of Property" class="form-control loss_amount_payment required" name="losses_from_fire_data[loss_amount_payment][{{$i}}]" value="{{ Helper::validate_key_loop_value('loss_amount_payment', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('losses_from_fire','losses_from_fire_data', 'losses_from_fire-data', 'parent_losses_from_fire', {{ $i }})">Save</a>
            </div>

		</div>
	</div>
</div>