<div class="light-gray-div list_all_financial_accounts list_all_financial_accounts_{{ $i }} mt-2" id="list_all_financial_accounts-form-{{$i}}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Closed Account Details
		</h2>

		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_all_financial_accounts', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_all_financial_accounts', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-lg-3 col-md-4 col-sm-6 col-12">
				<label class="font-weight-bold">
					Name of Institution:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('institution_name', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-3 col-md-8 col-sm-6 col-12">
				<label class="font-weight-bold">
					Address:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('street_number', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<label class="font-weight-bold">
					City:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('city', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<label class="font-weight-bold">
					State:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('state', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<label class="font-weight-bold">
					Zip code:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('zip', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-3 col-md-5  col-12">
				<label class="font-weight-bold">
					Acc#:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('account_number', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-5 col-md-7 col-12">
				<label class="font-weight-bold">
					Date account was closed, sold, moved or transferred:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('date_account_closed', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-lg-4 col-md-5">
				<label class="font-weight-bold">
					Last balance before closing or transfer:
					<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('last_balance', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('last_balance', $finacial_affairs, $i) : 0.00) }}</span>
				</label>
			</div>
			<div class="col-12">
				<label class="font-weight-bold">
					Type of Account or Instrument:
					<span class="font-weight-normal">
                        {{ Helper::validate_key_loop_value('type_of_account', $finacial_affairs, $i) == 1 ? 'Checking' : '' }}
                        {{ Helper::validate_key_loop_value('type_of_account', $finacial_affairs, $i) == 2 ? 'Savings' : '' }}
                        {{ Helper::validate_key_loop_value('type_of_account', $finacial_affairs, $i) == 3 ? 'Money Market' : '' }}
                        {{ Helper::validate_key_loop_value('type_of_account', $finacial_affairs, $i) == 4 ? 'Brokerage' : '' }}
                        {{ Helper::validate_key_loop_value('type_of_account', $finacial_affairs, $i) == 5 ? 'Other' : '' }}
					</span>
				</label>
			</div>

		</div>
		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-lg-3 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Name of Institution</label>
						<input type="text" name="list_all_financial_accounts_data[institution_name][{{$i}}]" class="input_capitalize form-control required institution_name" placeholder="Name of Institution" value="{{ Helper::validate_key_loop_value('institution_name', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-8 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group ">
						<label>Address</label>
						<input type="text" name="list_all_financial_accounts_data[street_number][{{$i}}]" class="input_capitalize form-control  street_number required" placeholder="Address" value="{{ Helper::validate_key_loop_value('street_number', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control city required" name="list_all_financial_accounts_data[city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('city', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>State </label>
						<select class="form-control required state" name="list_all_financial_accounts_data[state][{{$i}}]">
							<option value="">State</option>
							{!! AddressHelper::getStatesList(Helper::validate_key_loop_value('state', $finacial_affairs, $i)) !!}
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Zip code</label>
						<input type="number" class="form-control zip allow-5digit required" name="list_all_financial_accounts_data[zip][{{$i}}]" placeholder="Zip code" value="{{ Helper::validate_key_loop_value('zip', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-6 col-md-6 col-12">
    <div class="label-div">
        <div class="form-group">
            <label> Last 4 Digits of Acct# </label>
            <div class="form-group">
								<input type="number" class="form-control required account_number allow-4digit"
									   name="list_all_financial_accounts_data[account_number][{{ $i }}]"
									   value="{{ Helper::validate_key_loop_value('account_number', $finacial_affairs, $i) }}">
            </div>
        </div>
    </div>
</div>
@php
	$dateValue = Helper::validate_key_loop_value('date_account_closed', $finacial_affairs, $i);
@endphp
<div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="label-div">
        <div class="form-group">
            <label>Date account was closed, sold, moved or transferred</label>
            <div class="form-group">
                <input placeholder="MM/YYYY" type="text"
                       class="form-control date_month_year_custom required date_account_closed"
                       name="list_all_financial_accounts_data[date_account_closed][{{ $i }}]"
                       value="{{
                           preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dateValue)
                               ? substr($dateValue, 0, 3) . substr($dateValue, 6)
                               : $dateValue
                       }}">
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="label-div">
        <div class="form-group">
            <label> Last balance before closing or transfer</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control required price-field last_balance"
                       name="list_all_financial_accounts_data[last_balance][{{ $i }}]"
                       value="{{ Helper::validate_key_loop_value('last_balance', $finacial_affairs, $i) }}">
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-lg-6 col-md-6 col-12">
    <div class="label-div question-area border-0">
        <label class="fs-13px">Type of Account or Instrument</label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group multi-input-radio-group btn-small">
            <input type="radio" id="type-of-account_checking_{{ $i }}" 
                   class="d-none type_of_account" 
                   name="list_all_financial_accounts_data[type_of_account][{{ $i }}]" 
                   required 
                   {{ Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs, 1, $i) }} 
                   value="1">
            <label for="type-of-account_checking_{{ $i }}" 
                   class="btn-toggle small prop_type_radio {{ Helper::validate_key_loop_toggle_active('type_of_account', $finacial_affairs, 1, $i) }}">
                   Checking
            </label>

            <input type="radio" id="type-of-account_savings_{{ $i }}" 
                   class="d-none type_of_account" 
                   name="list_all_financial_accounts_data[type_of_account][{{ $i }}]" 
                   required 
                   {{ Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs, 2, $i) }} 
                   value="2">
            <label for="type-of-account_savings_{{ $i }}" 
                   class="btn-toggle small prop_type_radio {{ Helper::validate_key_loop_toggle_active('type_of_account', $finacial_affairs, 2, $i) }}">
                   Savings
            </label>

            <input type="radio" id="type-of-account-money-market-{{ $i }}" 
                   class="d-none type_of_account" 
                   name="list_all_financial_accounts_data[type_of_account][{{ $i }}]" 
                   required 
                   {{ Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs, 3, $i) }} 
                   value="3">
            <label for="type-of-account-money-market-{{ $i }}" 
                   class="btn-toggle small prop_type_radio {{ Helper::validate_key_loop_toggle_active('type_of_account', $finacial_affairs, 3, $i) }}">
                   Money Market
            </label>

            <input type="radio" id="type-of-account-brokerage-{{ $i }}" 
                   class="d-none type_of_account" 
                   name="list_all_financial_accounts_data[type_of_account][{{ $i }}]" 
                   required 
                   {{ Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs, 4, $i) }} 
                   value="4">
            <label for="type-of-account-brokerage-{{ $i }}" 
                   class="btn-toggle small prop_type_radio {{ Helper::validate_key_loop_toggle_active('type_of_account', $finacial_affairs, 4, $i) }}">
                   Brokerage
            </label>

            <input type="radio" id="type-of-account-other-{{ $i }}" 
                   class="d-none type_of_account" 
                   name="list_all_financial_accounts_data[type_of_account][{{ $i }}]" 
                   required 
                   {{ Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs, 5, $i) }} 
                   value="5">
            <label for="type-of-account-other-{{ $i }}" 
                   class="btn-toggle small prop_type_radio {{ Helper::validate_key_loop_toggle_active('type_of_account', $finacial_affairs, 5, $i) }}">
                   Other
            </label>
        </div>
    </div>
</div>


			<div class="col-12 text-right my-2">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_all_financial_accounts','list_all_financial_accounts', 'list_all_financial_accounts-data', 'parent_list_all_financial_accounts', {{ $i }})">Save</a>
			</div>
		</div>
	</div>
</div>