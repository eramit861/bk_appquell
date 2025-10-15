<div class="col-md-12">
    <div class="row mt-2">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <label class="font-weight-bold "><span class="font-weight-normal">{{ $i + 1 }}.</span>
                        {{ $nameLabel }}:
                        <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value('name', @$finacialAffairst, $i) }}</span>
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <x-financialAddress :finacial_affairst="$finacialAffairst" :i="$i"></x-financialAddress>
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="font-weight-bold">Describe the contents: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value('contents', @$finacialAffairst, $i) }}</span></label>
                </div>
                <div class="col-md-4">
                    <label class="font-weight-bold ">Do you still have it: <span
                            class="font-weight-normal">{{ $depositeAmount }}</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <label class="font-weight-bold">Did anyone else have access to the box or depository:
                        <span class="font-weight-normal">
                            @php
                                $class = '';
                                $value = Helper::validate_key_loop_value('have_access_of_box', @$finacialAffairst, $i);
                                $class = $value == 1 ? '' : 'hide-data';
                                $noneTypeVar = $noneType ?? 0;
                                if ($noneTypeVar == 0) {
                                    echo ArrayHelper::getYesNoArray($value);
                                }
                                if ($noneTypeVar == 1) {
                                    echo ArrayHelper::getYesNoArrayNoneType($value);
                                }
                            @endphp
                        </span>
                    </label>
                </div>
                <div class="col-md-12 {{ $class }}">
                    <label class="font-weight-bold">Name: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value($nameKey, @$finacialAffairst, $i) }}</span></label>
                </div>
                <div class="col-md-12 {{ $class }}">
                    <label class="font-weight-bold ">Street Address: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value($streetKey, @$finacialAffairst, $i) }}</span></label>
                </div>
                <div class="col-md-4 {{ $class }}">
                    <label class="font-weight-bold ">City: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value($cityKey, @$finacialAffairst, $i) }}</span></label>
                </div>
                <div class="col-md-2 {{ $class }}">
                    <label class="font-weight-bold ">state: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value($stateKey, @$finacialAffairst, $i) }}</span></label>
                </div>
                <div class="col-md-6 {{ $class }}">
                    <label class="font-weight-bold ">Zip: <span
                            class="font-weight-normal">{{ Helper::validate_key_loop_value($zipKey, @$finacialAffairst, $i) }}</span></label>
                </div>

            </div>
        </div>

    </div>
</div>
