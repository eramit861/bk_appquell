<div class="modal fade" id="historyLogsModal" tabindex="-1" aria-labelledby="historyLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-div ">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="historyLogsModalLabel">
                    {{ $dataFor ? App\Helpers\ArrayHelper::getSectionLogLabel($dataFor) . ' - ' : '' }}Logs
                </h5>
                <button type="button" class="btn-close white-btn pt-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light-gray ">
                <div class="row gx-3 ">
                    <div class="col-12 col-md-12 data-div scrollable-div">
                        <div class="table-container">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-100" scope="col"><i class="bi bi-arrow-left-right me-1"></i> Field
                                            Changes</th>
                                        <th class="pr-4" scope="col"><i class="bi bi-clock me-1"></i> Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $list = $historyLog;
                                        $count = 0;
                                    @endphp
                                    
                                    @if (!empty($list))
                                        @php
                                            $count = count($list);
                                        @endphp
                                        
                                        @foreach ($list as $val)
                                            @php
                                                $updatedAt = Helper::validate_key_value('updated_at', $val);
                                                $addedBy = \App\Models\User::getUserNameById(Helper::validate_key_value('added_by', $val, 'radio'));
                                                $updatedAt = \Carbon\Carbon::parse($updatedAt);
                                                $sectionName = Helper::validate_key_value('section_name', $val);
                                                $newJson = Helper::validate_key_value('new_json', $val);
                                                $oldJson = Helper::validate_key_value('old_json', $val);
                                                $differences = Helper::getJsonDifferences($oldJson, $newJson, $sectionName);
                                                $differences = array_filter($differences, function ($diff) {
                                                    $old = $diff['old'] ?? null;
                                                    $new = $diff['new'] ?? null;

                                                    return !(
                                                        ($old === '' || $old === null) &&
                                                        ($new === '' || $new === null)
                                                    );
                                                });
                                            @endphp
                                            
                                            @if (!empty($differences))
                                                @php
                                                    $hasDataToShow = 'hide-data';
                                                    foreach ($differences as $field => $diff) {
                                                        if ($diff['old'] != $diff['new']) {
                                                            $hasDataToShow = '';
                                                        }
                                                    }
                                                @endphp
                                                
                                                <tr class="unread {{ $hasDataToShow }}">
                                                    <td class="w-100">
                                                        @foreach ($differences as $field => $diff)
                                                            @if ($diff['old'] != $diff['new'])
                                                                @php
                                                                    $fieldType = App\Helpers\ArrayHelper::getIntakeFormKeyType($field);
                                                                @endphp
                                                                
                                                                <div class="field-change">
                                                                    <span class="field-name w-40">
                                                                        <span class="badge-field">
                                                                            {!! App\Helpers\ArrayHelper::getIntakeFormKeyLabel($field, $dataFor) !!}
                                                                        </span>
                                                                    </span>
                                                                    <div class="change-indicator">
                                                                        <span class="field-value old-value">
                                                                            {!! Helper::getLogFieldValue($fieldType, 'old', $diff) !!}
                                                                        </span>
                                                                        <i class="bi bi-arrow-right arrow-icon"></i>
                                                                        <span class="field-value new-value">
                                                                            {!! Helper::getLogFieldValue($fieldType, 'new', $diff) !!}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="datetime pr-4 text-center">
                                                        <div>
                                                            <div>{{ $updatedAt->format('m/d/Y') }}</div>
                                                            <div>{{ $updatedAt->format('H:i:s') }}</div>
                                                            <div>{{ $addedBy }}</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr class="unread text-center">
                                            <td colspan="2">{{ __('No Record Found.') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>