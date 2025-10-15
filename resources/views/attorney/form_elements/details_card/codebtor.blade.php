<div class="debtor-card">
    <div class="row px-3">
        @if ($isCoDebtorEdited)
            <div class="col-12">
                <x-attorney.attorneyEditReviewed :reviewedData="$isCoDebtorEdited" extraClass="float_right mt-2" />
            </div>
        @endif
        <div class="col-12">
            <div class="debtor-name debtor-name-main d-flex">
                <div class="pr-3 profile-pic-div">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="pt-2 w-100 debtor_name_info">
                    <span class="debtor-name icon_name_with">{{ $spouseName }}
                    </span>
                    <label class="font-weight-bold fs-14px d-block">Other names used in the last 8 years:
                        <span class="font-weight-normal fs-14px d-unset">
                            @if (empty(Helper::validate_key_value('spouse_any_other_name', $BasicInfoPartB)))
                                <span class="fs-11px font-weight-normal">No other names used.</span>
                            @else
                                @foreach ($spotherNames as $key => $value)
                                    @if (isset($value['Name']))
                                        @php
                                            $prefix = Helper::validate_key_value('Suffix', $value);
                                            $fName = Helper::validate_key_value('Name', $value);
                                            $mName = Helper::validate_key_value('Middle Name', $value);
                                            $lName = Helper::validate_key_value('Last Name', $value);
                                            $oName = '';
                                            $oName = !empty($fName) ? trim($oName . ' ' . $fName) : $oName;
                                            $oName = !empty($mName) ? trim($oName . ' ' . $mName) : $oName;
                                            $oName = !empty($lName) ? trim($oName . ' ' . $lName) : $oName;
                                            $oName = !empty($prefix) ? trim($oName . ' ' . $prefix) : $oName;
                                        @endphp
                                        <span class='font-weight-normal mb-0 fs-11px'>{{ $numbers[$key] }} AKA:
                                            {{ $oName }}</span>
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </label>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-end">
                        <x-attorney.attorneyEditButton :route="route('basic_info_step2_modal')" :isEdited="$isCoDebtorEdited" extraClass="d-ruby text-bold"
                            anchorClass="d-block" />
                    </div>
                    @if (isset($uploadedDocuments['Co_Debtor_Drivers_License']))
                        @php $dldata = $uploadedDocuments['Co_Debtor_Drivers_License']; @endphp
                        <div
                            class="font-weight-normal drivers-lic-download bradly-heading fs-18px d-flex align-items-center">
                            <span class="fs-18px bb-1px-black">Drivers&nbsp;Lic.&nbsp;Uploaded:</span> 
                            <a href="{{ route('client_doc_download', ['id' => $dldata['id']]) }}" class="ml-2"
                                title="Download {{ $dldata['updated_name'] }}">
                                <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf"
                                    aria-hidden="true"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row basic-info">
                <div class="col-10">
                    @php
                        $lived_address_from_180 = Helper::key_display('lived_address_from_180', $BasicInfoPartB);
                        $lived_address_from_180_detail = '';
                        if ($lived_address_from_180 == 'Yes') {
                            $lived_address_from_180_detail = ' (Lived at this address for at least 180 days.)';
                        }
                        if ($lived_address_from_180 == 'No') {
                            $lived_address_from_180_detail = ' (Not lived at this address for at least 180 days.)';
                        }
                    @endphp
                    <span class="debtor-address my-2">
                        <span class="font-weight-normal fs-11px">
                            @if (Helper::validate_key_value('spouse_different_address', $BasicInfoPartB) == 1)
                                {!! $address !!}
                                <br /><span class="ml-2 fs-11px">{{ $lived_address_from_180_detail }}</span>
                            @endif
                            @if (empty(Helper::validate_key_value('spouse_different_address', $BasicInfoPartB)))
                                {!! $debtoraddress !!}
                                <br /><span class="ml-2 fs-11px">{{ $lived_address_from_180_detail }}</span>
                            @endif
                        </span>
                    </span>
    
                </div>
                <div class="col-10">
                    <label class="font-weight-bold fs-14px ">Cell:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ Helper::validate_key_value('part2_phone', $BasicInfoPartB) }}
                        </span>
                    </label>
                </div>
                @php $spouseEmail = Helper::validate_key_value('email', $BasicInfoPartB); @endphp
                @if (!empty($spouseEmail))
                    <div class="col-6">
                        <label class="font-weight-bold fs-14px ">Email:
                            <span class="font-weight-normal fs-14px d-unset">
                                {{ $spouseEmail }}
                            </span>
                        </label>
                    </div>
                @endif
                <div class="col-{{ empty($spouseEmail) ? '10' : '6' }}">
                    <label class="font-weight-bold fs-14px ">LIC. ID:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ Helper::validate_key_value('part2_driving_license', $BasicInfoPartB) }}
                        </span>
                    </label>
                </div>
                <div class="col-6">
                    <label class="font-weight-bold fs-14px ">DOB:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ Helper::validate_key_value('date_of_birth', $BasicInfo_AnyOtherName) }}
                        </span>
                    </label>
                </div>
                <div class="col-6">    
                    <label class="font-weight-bold fs-14px ">
                        @php
                            if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) != '1') {
                                $noValue = Helper::ssnFormt(
                                    Helper::validate_key_value('social_security_number', $BasicInfoPartB),
                                );
                                $labelText = 'SSN: ';
                            } else {
                                $noValue = Helper::ssnFormt(Helper::validate_key_value('itin', $BasicInfoPartB));
                                $labelText = 'ITIN: ';
                            }
                        @endphp
                        {{ $labelText }}
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ $noValue }}
                        </span>
                    </label>
    
                </div>
                @if (isset($uploadedDocuments['Social_Security_Card']))
                    @php $dldata = $uploadedDocuments['Social_Security_Card']; @endphp
                    <div class="col-12 d-flex justify-content-end mb-2">
                        <span class="font-weight-normal display-inline bradly-heading fs-18px d-flex align-items-center">
                            <label class="fs-18px bb-1px-black ml-auto">SSN&nbsp;Uploaded:</label>
                            <a href="{{ route('client_doc_download', ['id' => $dldata['id']]) }}" class="ml-2 "
                                title="Download {{ $dldata['updated_name'] }}">
                                <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
