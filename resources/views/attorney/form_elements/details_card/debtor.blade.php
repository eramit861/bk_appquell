<div class="debtor-card ">
    <div class="row px-3">
        @if ($isDebtorEdited)
            <div class="col-12">
                <x-attorney.attorneyEditReviewed :reviewedData="$isDebtorEdited" extraClass="float_right mt-2" />
            </div>
        @endif
        <div class="col-12">
            <div class="debtor-name debtor-name-main d-flex">
                <div class="pr-3 profile-pic-div">
                    <i class="bi bi-person-circle "></i>
                </div>
                <div class="pt-2 debtor_name_info w-100">
                    <span class="debtor-name icon_name_with">{{ $debtorName }}
                    </span>
                    <label class="font-weight-bold fs-14px d-block">Other names used in the last 8 years:
                        @if ($yes_no !== 'Yes')
                            <span class="fs-11px font-weight-normal">No other names used.</span>
                        @else
                            @foreach ($otherNames as $key => $value)
                                @php
                                    $prefix = Helper::validate_key_value('Suffix', $value);
                                    $fName = Helper::validate_key_value('Name', $value);
                                    $mName = Helper::validate_key_value('Middle Name', $value);
                                    $lName = Helper::validate_key_value('Last Name', $value);
                                    $oName = '';
                                    $oName = !empty($fName) ? $fName : $oName;
                                    $oName = !empty($mName) ? $oName . ' ' . $mName : $oName;
                                    $oName = !empty($lName) ? $oName . ' ' . $lName : $oName;
                                    $oName = !empty($prefix) ? $oName . ' ' . $prefix : $oName;
                                @endphp
                                <span class='font-weight-normal mb-0 fs-11px'>{{ $numbers[$key] }} AKA:
                                    {{ $oName }}</span>
                            @endforeach
                        @endif
                    </label>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-end">
                        <x-attorney.attorneyEditButton :route="route('basic_info_step1_modal')" :isEdited="$isDebtorEdited" anchorClass="d-block"
                            extraClass="d-ruby text-bold" />
                    </div>
                    @if (isset($uploadedDocuments['Drivers_License']))
                        @php $dldata = $uploadedDocuments['Drivers_License']; @endphp
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
            <span class="debtor-address my-2">
                <span class="font-weight-normal fs-11px">
                    {!! $debtoraddress !!}
                    <br>
                    <span class="ml-2 fs-11px">
                        @php
                            $lived_address_from_180 = Helper::key_display('lived_address_from_180', $BasicInfoPartA);
                            $list_every_address = Helper::key_display('list_every_address', $financialaffairs_info);
                        @endphp
                        @if ($lived_address_from_180 == 'Yes')
                            (Lived at this address for at least 180 days.)<br />
                        @endif
                        @if ($lived_address_from_180 == 'No')
                            (Not lived at this address for at least 180 days.)<br />
                        @endif
                        @if ($list_every_address == 'Yes')
                            (Debtor has lived at this address for the last 3 years: <span
                                class=' d-unset text-success fs-11px  '>{{ $list_every_address }}</span> See SOFA Tab)
                        @endif
                        @if ($list_every_address == 'No')
                            (Debtor has lived at this address for the last 3 years: <span
                                class=' d-unset text-danger fs-11px   '>{{ $list_every_address }}</span>)
                        @endif
                    </span>
                </span>
            </span>
        </div>
        <div class="col-12">
            <div class="row gx-3 basic-info">
                <div class="col-6">
                    <label class="font-weight-bold fs-14px ">Home:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ $home }}
                        </span>
                    </label>
                </div>
                <div class="col-6">
                    <label class="font-weight-bold fs-14px ">Cell:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ $cell }}
                        </span>
                    </label>
                </div>
                <div class="col-6">
                    <label class="font-weight-bold fs-14px ">Email:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ Helper::validate_key_value('email', $BasicInfo_AnyOtherName) }}
                        </span>
                    </label>
                </div>
                <div class="col-6">
                    <label class="font-weight-bold fs-14px ">LIC. ID:
                        <span class="font-weight-normal fs-14px d-unset">
                            {{ Helper::validate_key_value('work', $BasicInfo_AnyOtherName) }}
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
                    @php
                        if (Helper::validate_key_value('has_security_number', $BasicInfoPartA) != '1') {
                            $noValue = Helper::ssnFormt(Helper::validate_key_value('security_number', $BasicInfoPartA));
                            $labelText = 'SSN:';
                        } else {
                            $noValue = Helper::ssnFormt(Helper::validate_key_value('itin', $BasicInfoPartA));
                            $labelText = 'ITIN:';
                        }
                    @endphp
                    <label class="font-weight-bold fs-14px ">
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
                            <a href="{{ route('client_doc_download', ['id' => $dldata['id']]) }}" class="ml-2"
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
