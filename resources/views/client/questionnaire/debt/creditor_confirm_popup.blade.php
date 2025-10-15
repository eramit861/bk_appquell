<div class="modal fade creditor-confirm-modal" id="creditorPopup" tabindex="-1" aria-labelledby="creditorPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded-2 shadow">

            <!-- Header -->
            <div class="modal-header bg-info-subtle border-0 ">
                <h5 class="modal-title fw-bold text-info-emphasis d-flex-ai-start d-flex align-items-start w-100" id="creditorPopupLabel">
                    <i class="bi bi-people-fill"></i>&nbsp;Creditors List
                    <span class="ms-auto d-inline-flex">
                        <button type="button" class=" btn btn-primary-green shadow-2 ml-2 m-0" onclick="confirmAllAIPendingToInclude('all')">Import All Creditors</button>
                        <button type="button" class="btn btn-primary-green-light shadow-2 ml-2 m-0" onclick="confirmAllAIPendingToInclude('balanced')">Import All Creditors with Balances Only</button>
                    </span>
                </h5>
                <!-- <a class="float-right btn btn-primary-green shadow-2" onclick="confirmAllAIPendingToInclsude()" href="javascript:void(0)">Confirm & Import Debts to Questionnaire</a> -->

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Desktop Table -->
                <div class="d-none d-md-block">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Creditor</th>
                                <th>Account #</th>
                                <th>Address</th>
                                <th>Ownership</th>
                                <th>Date Issue</th>
                                <th>Credit Type</th>
                                <th>Amount Due</th>
                                <th>Do you want to include these?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $list = $creditorsApprovedPending; @endphp
                            @if(!empty($list))
                                @foreach($list as $val)
                                    @php
                                    $creditorAddress = '';
                                    $creditorAddress = !empty(Helper::validate_key_value('address', $val)) ? Helper::validate_key_value('address', $val) : '';
                                    $creditorCSZ = '';
                                    $creditorCSZ = !empty(Helper::validate_key_value('city', $val)) ? Helper::validate_key_value('city', $val) : '';
                                    $creditorCSZ .= !empty(Helper::validate_key_value('state', $val)) ? ', ' . Helper::validate_key_value('state', $val) : '';
                                    $creditorCSZ .= !empty(Helper::validate_key_value('zip', $val)) ? ', ' . Helper::validate_key_value('zip', $val) : '';
                                    @endphp
                                    <tr class="unread row-{{ $val['id'] }} {{ ($val['is_imported'] == 1) ? 'drop-green' : 'drop-red' }}">
                                        <td>{{ Helper::validate_key_value('fullName', $val) }}</td>
                                        <td>{{ substr(Helper::validate_key_value('creditLiabilityAccountIdentifier', $val), -4) }}</td>
                                        <td>{{ !empty($creditorAddress) ? $creditorAddress : '' }}<br>{{ !empty($creditorCSZ) ? $creditorCSZ : '' }}</td>
                                        <td>{{ Helper::validate_key_value('creditLiabilityAccountOwnershipType', $val) }}</td>
                                        <td>{{ Helper::validate_key_value('date_incurred', $val) }}</td>
                                        <td>{{ in_array($val['creditLoanType'], array_keys(AddressHelper::getDebtSelection())) ? AddressHelper::getDebtSelection($val['creditLoanType']) : $val['creditLoanType'] }}</td>
                                        <td class="{{ $val['creditLiabilityPastDueAmount'] <= 0 ? 'text-danger' : '' }}">{{ Helper::formatPrice(Helper::validate_key_value('creditLiabilityPastDueAmount', $val)) }}</td>
                                        <td>
                                            <span class="accept_label_{{$val['id']}} {{ $val['client_confirm'] != 1 ? 'hide-data' : '' }} text-success">Yes, I want to include this.</span>
                                            <span class="decline_label_{{$val['id']}} {{ $val['client_confirm'] != 2 ? 'hide-data' : '' }} text-danger">No, I don't want to include this.</span>

                                            @if($val['client_confirm'] == 0)
                                                <div class="form-group custom_radioss " id="display_cr_desktop{{$val['id']}}">
                                                    <div class="d-inline radio-primary">
                                                        <input type="radio" onclick="confirmCreditor('{{ $val['id'] }}',1)" id="confirm_yes_{{$val['id']}}" name="client_confirm[]" required value="1" {{ Helper::validate_key_toggle('client_confirm', $val, 1) }}>
                                                        <label for="confirm_yes_{{$val['id']}}" class="cr radio-box yes mb-0"> Yes</label>
                                                    </div>
                                                    <div class="d-inline radio-primary">
                                                        <input type="radio" id="confirm_decline_{{$val['id']}}" onclick="confirmCreditor('{{ $val['id'] }}',2)" name="client_confirm[]" required value="2" {{ Helper::validate_key_toggle('client_confirm', $val, 2) }}>
                                                        <label for="confirm_decline_{{$val['id']}}" class="cr radio-box no mb-0"> No</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="unread text-center">
                                    <td colspan="8">No Record Found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card Layout -->
                <div class="d-md-none">
                    <!-- Use vertical scroll if needed on mobile -->
                    <div style="max-height: 70vh; overflow-y: auto;">
                        @php $list = $creditorsApprovedPending; @endphp
                        @if(!empty($list))
                            @foreach($list as $val)
                                @php
                                $creditorAddress = '';
                                $creditorAddress = !empty(Helper::validate_key_value('address', $val)) ? Helper::validate_key_value('address', $val) : '';
                                $creditorCSZ = '';
                                $creditorCSZ = !empty(Helper::validate_key_value('city', $val)) ? Helper::validate_key_value('city', $val) : '';
                                $creditorCSZ .= !empty(Helper::validate_key_value('state', $val)) ? ', ' . Helper::validate_key_value('state', $val) : '';
                                $creditorCSZ .= !empty(Helper::validate_key_value('zip', $val)) ? ', ' . Helper::validate_key_value('zip', $val) : '';
                                @endphp
                                <div class="border rounded p-3 mb-3 shadow-sm unread row-{{ $val['id'] }} {{ ($val['is_imported'] == 1) ? 'drop-green' : 'drop-red' }}">
                                    <p class="mb-2"><strong>Creditor: </strong>{{ Helper::validate_key_value('fullName', $val) }}</p>
                                    <p class="mb-2"><strong>Account #: </strong>{{ substr(Helper::validate_key_value('creditLiabilityAccountIdentifier', $val), -4) }}</p>
                                    <p class="mb-2"><strong>Address: </strong>{{ !empty($creditorAddress) ? $creditorAddress : '' }}<br>{{ !empty($creditorCSZ) ? $creditorCSZ : '' }}</p>
                                    <p class="mb-2"><strong>Ownership: </strong>{{ Helper::validate_key_value('creditLiabilityAccountOwnershipType', $val) }}</p>
                                    <p class="mb-2"><strong>Date Issue: </strong>{{ Helper::validate_key_value('date_incurred', $val) }}</p>
                                    <p class="mb-2"><strong>Credit Type: </strong>{{ in_array($val['creditLoanType'], array_keys(AddressHelper::getDebtSelection())) ? AddressHelper::getDebtSelection($val['creditLoanType']) : $val['creditLoanType'] }}</p>
                                    <p class="mb-2"><strong>Amount Due: </strong> $0.00</p>                                    
                                    <p class="mb-2 mobile-radio-label-{{$val['id']}}"><strong>Do you want to include these?</strong></p>
                                    <p class="mb-0 text-bold"><span class="accept_label_{{$val['id']}} {{ $val['client_confirm'] != 1 ? 'hide-data' : '' }} text-success">Yes, I want to include this.</span></p>
                                    <p class="mb-0 text-bold"><span class="decline_label_{{$val['id']}} {{ $val['client_confirm'] != 2 ? 'hide-data' : '' }} text-danger">No, I don't want to include this.</span></p>
                                    @if($val['client_confirm'] == 0)
                                        <div class="form-group custom_radioss mb-0" id="display_cr_mobile{{$val['id']}}">
                                            <div class="d-inline radio-primary">
                                                <input type="radio" onclick="confirmCreditor('{{ $val['id'] }}',1)" id="confirm_yes_{{$val['id']}}" name="client_confirm[]" required value="1" {{ Helper::validate_key_toggle('client_confirm', $val, 1) }}>
                                                <label for="confirm_yes_{{$val['id']}}" class="cr radio-box yes mb-0"> Yes</label>
                                            </div>
                                            <div class="d-inline radio-primary">
                                                <input type="radio" id="confirm_decline_{{$val['id']}}" onclick="confirmCreditor('{{ $val['id'] }}',2)" name="client_confirm[]" required value="2" {{ Helper::validate_key_toggle('client_confirm', $val, 2) }}>
                                                <label for="confirm_decline_{{$val['id']}}" class="cr radio-box no mb-0"> No</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="border rounded p-3 mb-3 shadow-sm">
                                <p class="m-0">No Record Found.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/creditor_confirm_popup.css') }}">
@endpush