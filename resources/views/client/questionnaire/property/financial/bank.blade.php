<div class="light-gray-div bank_accounts bank_accounts_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Account Details
		</h2>

		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('bank_accounts', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('bank_accounts', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-md-3 col-sm-6 col-12">
				<label class="font-weight-bold">
					What type of account:
					<span class="font-weight-normal">{{ ArrayHelper::getAccountKeyValue(Helper::validate_key_loop_value('account_type', $bank, $i)) }}</span>
				</label>
			</div>
			<div class="col-md-3 col-sm-6 col-12">
				<label class="font-weight-bold">
					Name of institution:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $bank, $i) }}</span>
				</label>
			</div>

			@if (isset($businessNames) && !empty($businessNames) && Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 2)
				<div class="col-md-3 col-sm-6 col-12">
					<label class="font-weight-bold">
						Business name:
						<span class="font-weight-normal">{{ Helper::validate_key_loop_value('business_name', $bank, $account_type_count) }}</span>
					</label>
				</div>
				@php $account_type_count++; @endphp
			@endif
			<div class="col-md-3 col-sm-12 col-12">
				<label class="font-weight-bold">
					Acct# <small><i>(last 4 digits)</i></small>:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('last_4_digits', $bank, $i) }}</span>
				</label>
			</div>
			<div class="col-md-3 col-sm-6 col-12">
				<label class="font-weight-bold">
					Account:
					<span class="font-weight-normal">
						{{ (Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 1) ? 'Personal Account' : '' }}
						{{ (Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 2) ? 'Business Account' : '' }}
					</span>
				</label>
			</div>
			<div class="col-md-3 col-sm-6 col-12">
				<label class="font-weight-bold">
					Property value:
					<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $bank, $i)) ? Helper::validate_key_loop_value('property_value', $bank, $i) : 0.00) }}</span>
				</label>
			</div>
			@if (isset($transaction_pdf_enabled) && $transaction_pdf_enabled == 1)
				@php
                $transaction = Helper::validate_key_value('transaction', $bank);
                $transaction_data = Helper::validate_key_loop_value('transaction_data', $bank, $i);
                @endphp
				<div class="col-12">
					<label class="font-weight-bold">
						Withdrawn more than $600 in cash or transferred funds over $600 using platforms like Zelle, Venmo, or Cash App in the last 3 months:
						<span class="font-weight-normal">
							{{ (Helper::validate_key_value($i, $transaction, 'radio') == 1) ? 'Yes' : '' }}
							{{ (Helper::validate_key_value($i, $transaction, 'radio') == 0) ? 'No' : '' }}
						</span>
					</label>
				</div>
				@if (!empty($transaction_data) && Helper::validate_key_value($i, $transaction, 'radio') == 1)
					@foreach ($transaction_data as $transaction_index => $data)
						<div class="col-12">
							<div class="row gx-3">
								@if ($transaction_index == 0)
									<div class="col-md-6">
										<label class="font-weight-bold">
											Description:
										</label>
									</div>
									<div class="col-md-3">
										<label class="font-weight-bold">
											Transaction Amount:
										</label>
									</div>
									<div class="col-md-3">
										<label class="font-weight-bold">
											Date of Transaction:
										</label>
									</div>
								@endif

								<div class="col-md-6">
									<label class="font-weight-bold">
										<span class="font-weight-normal">{{ Helper::validate_key_value('description', $data) }}</span>
									</label>
								</div>
								<div class="col-md-3">
									<label class="font-weight-bold">
										<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_value('value', $data)) ? Helper::validate_key_value('value', $data) : 0.00) }}</span>
									</label>
								</div>
								<div class="col-md-3">
									<label class="font-weight-bold">
										<span class="font-weight-normal">{{ Helper::validate_key_value('sample', $data) }}</span>
									</label>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			@endif
		</div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">

			<div class="col-md-4 col-lg-4 col-xl-2 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> What type of account:</label>
						<select data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="form-control bank_property_account bank-acc-input required" name="bank[data][account_type][{{ $i }}]">
							<option value="">Select Account Type</option>
							{!! ArrayHelper::getAccountArray(Helper::validate_key_loop_value('account_type', $bank, $i)) !!}
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-lg-4 col-xl-2 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Bank or institution name:</label>
						<input type="text" name="bank[data][description][{{ $i }}]" data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="input_capitalize bank-acc-input form-control required bank_description alphanumericInput"
							placeholder="Enter bank or institution name" value="{{ Helper::validate_key_loop_value('description', $bank, $i) }}">
					</div>
				</div>
			</div>
			@if ((isset($businessNames) && !empty($businessNames)))
				<div class="col-md-4 col-lg-4 col-xl-2 col-sm-6 col-12">
					<div class="label-div">
						<div class="form-group">
							<label>Personal/business account:</label>
							<select data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="form-control bank_personal_business_account bank-acc-input required" name="bank[data][personal_business_account][{{ $i }}]"
								onchange="showHideBusinessNameDiv(this, '{{$i}}')">
								<option value="">Select Account Type</option>
								<option value="1" {{ Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 1 ? 'selected' : '' }}>Personal Account</option>
								<option value="2" {{ Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 2 ? 'selected' : '' }}>Business Account</option>
							</select>
						</div>
					</div>
				</div>
			@else
				<input type='hidden' class="bank_personal_business_account bank-acc-input" name="bank[data][personal_business_account][{{ $i }}]" value='1'>
			@endif

			<div class="col-md-4 col-lg-4 col-xl-2 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group mb-0">
						<label class="l-h-12px mb-0"><small>Acct. ending in: <br /><i class="text-c-blue">(Last 4 digits of Acct #)</i></small></label>
						<input type="text" name="bank[data][last_4_digits][{{ $i }}]" data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="form-control bank-acc-input allow-4digit required last_4_digits"
							placeholder="Enter last 4 digits of Acct #" value="{{ Helper::validate_key_loop_value('last_4_digits', $bank, $i) }}">

					</div>
				</div>
			</div>

			@if (isset($businessNames) && !empty($businessNames))
				<div class="col-md-4 col-lg-4 col-xl-2 col-sm-6 col-12 bank_business_name_div bank_business_name_div_{{ $i }} {{ (Helper::validate_key_loop_value('personal_business_account', $bank, $i) == 1) ? 'hide-data' : '' }}">
					<div class="label-div">
						<div class="form-group">
							<label>Business name:</label>
							<select class="form-control bank_business_name required bank-acc-input" name="bank[data][business_name][{{ $i }}]" data-transaction-enabled='{{ $transaction_pdf_enabled }}'>
								<option value="">Select Business Name</option>
								@foreach ($businessNames as $businessName)
									<option value="{{ $businessName }}" {{ Helper::validate_key_loop_value('business_name', $bank, $i) == $businessName ? 'selected' : '' }}>{{ $businessName }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			@endif

			<div class="col-md-5 col-lg-4 col-xl-2 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Average balance of account:</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" name="bank[data][property_value][{{ $i }}]" data-transaction-enabled='{{ $transaction_pdf_enabled }}' class="price-field form-control bank-acc-input required bank_property_value"
								placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $bank, $i) }}">
						</div>
					</div>
				</div>
			</div>

            @if (isset($transaction_pdf_enabled) && $transaction_pdf_enabled == 1)              
			@php
				$transaction = Helper::validate_key_value('transaction', $bank);
                $transaction_data = Helper::validate_key_loop_value('transaction_data', $bank, $i);
            @endphp

				<div class="col-12 light-gray-div b-0-i py-0 mb-0">
					<div class="label-div question-area border-0">
						<label>
							In the last 3 months, have you either withdrawn more than $600 in cash or transferred funds over $600 using platforms like Zelle, Venmo, or Cash App?
						</label>
						<!-- Radio Buttons -->
						<div class="custom-radio-group form-group">
							<input type="radio" id="transaction_{{ $i }}_yes" class="d-none bank-acc-input transaction-radio-yes transaction-radio" name="bank[data][transaction][{{ $i }}]" required {{ Helper::validate_key_value($i, $transaction, 'radio') == 1 ? 'checked' : '' }} value="1" data-transaction-enabled='{{ $transaction_pdf_enabled }}'>
							<label for="transaction_{{ $i }}_yes" class="btn-toggle {{ Helper::validate_key_value($i, $transaction, 'radio') == 1 ? 'active' : '' }}" onclick="showHideTransactionSection( 1, {{ $i }} );{{ ($transaction_pdf_enabled) ? 'setTimeout(() => checkBankAccInputs(), 10)' : '' }}">Yes</label>

							<input type="radio" id="transaction_{{ $i }}_no" class="d-none bank-acc-input transaction-radio-no transaction-radio" name="bank[data][transaction][{{ $i }}]" required {{ Helper::validate_key_value($i, $transaction, 'radio') == 0 ? 'checked' : '' }} value="0" data-transaction-enabled='{{ $transaction_pdf_enabled }}'>
							<label for="transaction_{{ $i }}_no" class="btn-toggle {{ Helper::validate_key_value($i, $transaction, 'radio') == 0 ? 'active' : '' }}" onclick="showHideTransactionSection( 0, {{ $i }} );{{ ($transaction_pdf_enabled) ? 'setTimeout(() => checkBankAccInputs(), 10)' : '' }}">No</label>
						</div>
					</div>
				</div>

				<div class="col-12 ">
					<div class="outline-gray-border-area"></div>
					@if (!empty($transaction_data))
						@php $k = 0; @endphp
						@foreach ($transaction_data as $transaction_index => $data)
							@include('client.questionnaire.property.financial.bank_transaction')
							@php $k++; @endphp
						@endforeach
					@else
						@php
							$k = 0;
							$data = [];
						@endphp
						@include('client.questionnaire.property.financial.bank_transaction')
					@endif
					<div class="add-more-div-bottom add-more-transaction-btn {{ Helper::validate_key_value($i, $transaction, 'radio') == 1 ? '' : 'hide-data' }} add-more-transaction-btn-{{ $i }}">
						<button type="button" class="btn-new-ui-default py-1 px-2 transaction-add" onclick="addMoreBankTransaction( {{ $i }} , {{ $transaction_pdf_enabled }}); return false;">
							<i class="bi bi-plus-lg"></i>
							Add Additional Transactions(s)
						</button>
					</div>
				</div>
			@endif
            <div class="col-12 col-md-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('bank','bank_accounts', 'checking_account_items_data', 'parent_bank', {{ $i }})">Save Account</a>
            </div>
		</div>
	</div>
</div>