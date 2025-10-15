<form name="attorney_setting_frm" id="attorney_setting_frm" action="{{ route('attorney_setting_save',['type'=>3]) }}" method="post" enctype="multipart/form-data" novalidate>
@csrf
    <div class="light-gray-div mt-3 ">
        <h2 class="">Manage Notifications</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="table-responsive">
					<table class="table overflow-scroll">
						<tbody>
                            <tr>
                                <th scope="col">#</th>
                                <th class="w-100">Name</th>
                                <th class="w-auto">Sent&nbsp;To</th>
                                <th class="w-auto align-center">Status</th>
                            </tr>
                            @php
                                $notification_status = isset($attorneySettings) ? $attorneySettings->notification_status : '';
                                $notification_status = !empty($notification_status) ? json_decode($notification_status, true) : [];
                                $notificationLabelArray = ArrayHelper::getManageNotificationArray();
                                $i = 1;
                            @endphp
                            @foreach ($notificationLabelArray as $key => $label)
                                @php
                                    $isChecked = Helper::validate_key_value($key, $notification_status, 'radio') == 1 ? 'checked' : '';
                                    if (empty($notification_status)) {
                                        $isChecked = 'checked';
                                    }
                                @endphp
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $label }}</td>
                                    <td>{{ ArrayHelper::getManageNotificationForArray($key) }}</td>
                                    <td>
                                        <div class="toggle-switch">
                                            <div class="d-flex">
                                                <input type="checkbox" id="{{ $key }}" name="notification_status[{{ $key }}]" value="1" {{ $isChecked }}>
                                                <label for="{{ $key }}" class="mb-0 mx-auto"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save Settings</span></button>
    </div>
</form>

