@extends("layouts.admin")
@section('content')
@include("layouts.flash")

<div class="row">
	<div class="col-12">
		<div class="card listing-card ">
            <div class="card-header">
                <div class="search-list">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pl-">
                                <h4>Manage Notifications</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form name="admin_manage_notification_save" id="admin_manage_notification_save" action="{{ route('admin_manage_notification_save') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="w-100">Name</th>
                                    <th class="w-auto">Sent&nbsp;To</th>
                                    <th class="w-auto">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $notification_status = isset($attorneySettings) ? $attorneySettings->notification_status : "";
                                $notification_status = !empty($notification_status) ? json_decode($notification_status, true) : [];

                                $notificationLabelArray = ArrayHelper::getManageNotificationAdminArray();
                                $i = 1;
                                foreach ($notificationLabelArray as $key => $label) {
                                    $isChecked = (Helper::validate_key_value($key, $notification_status, 'radio') == 1) ? 'checked' : '';
                                    if (empty($notification_status)) {
                                        $isChecked = 'checked';
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $label; ?></td>
                                        <td><?php echo ArrayHelper::getManageNotificationForArray($key); ?></td>
                                        <td>
                                            <div class="toggle-switch">
                                                <div class="d-flex">
                                                    <input type="checkbox" id="<?php echo $key; ?>" name="notification_status[<?php echo $key; ?>]" value="1" <?php echo $isChecked;?>>
                                                    <label for="<?php echo $key; ?>" class="mb-0 mx-auto"></label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                            $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-3">
                        <label for="">
                            <span class="text-bold">The Above Settings does not include: </span>
                            <span>Attorney Welcome aboard email, Attorney welcome email, Simple text message email, Client final submission email to Admin, Client final submission email to Attorney.</span>
                        </label>
                    </div>
                </div>
                <div class="card-header justify-content-start" style="border-top: 1px solid #f1f1f1;">
                    <div class="text-right">
                        <button type="submit" class="btn font-weight-bold border-blue-big">
                            <span class="border-bottom-light-blue">Save Settings</span>
                        </button>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>
@endsection