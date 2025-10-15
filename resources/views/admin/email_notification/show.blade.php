@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
    <div class="col-12 pl-0 ml-0 pr-0 mr-0">
        <div class="accordion" id="accordionExample">
            <div class="card pb-0 mb-0">
                <div class="card-header" id="headingNew">
                    <a href="javascript:void(0)" class="collapsed text-c-blue accordian-btn pl-0 ml-0" data-bs-toggle="collapse"
                        data-bs-target="#collapseNew" aria-expanded="false" aria-controls="collapseNew">+ New Email
                        Notication</a>
                </div>
                <div id="collapseNew" class="collapse" aria-labelledby="headingNew" data-parent="#accordionExample">
                    <div class="card-body py-0">
                        <form id="new_email_form" action="{{route('admin_email_notification_create')}}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 pl-0 ml-0">
                                        <div class="form-group">
                                            <label class="input-heading">Choose Attorney:</label>
                                            <select required class="required hide-data" id="selected_attorney"
                                                name="selected_attorney" multiple>
                                                <?php foreach ($attorneys as $key => $value) {
                                                    $attorney_id = Helper::validate_key_value('attorney_id', $value);
                                                    $name = Helper::validate_key_value('name', $value);
                                                    $email = Helper::validate_key_value('email', $value);
                                                    $dataToShow = $name;
                                                    $dataToShow = !empty($email) ? $dataToShow . ' (' . $email . ')' : $dataToShow;
                                                    ?>
                                                    <option value="<?php echo $attorney_id ?>"><?php echo $dataToShow; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label class="error selected_attorney_error hide-data">This field is required.</label>
                                    </div>
                                    <div class="col-6 pl-0 ml-0">
                                        <div class="form-group">
                                            <label class="input-heading">Subject:</label>
                                            <input type="text" placeholder="Enter email subject here.." required
                                                class="form-control required {{ $errors->has('subject') ? 'btn-outline-danger' : '' }}"
                                                name="subject" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 pl-0 ml-0">
                                        <div class="form-group">
                                            <label class="input-heading">Message:</label>
                                            <textarea rows="3" placeholder="Enter your message here.." required
                                                class="form-control required {{ $errors->has('message') ? 'btn-outline-danger' : '' }}"
                                                name="message"></textarea>
                                        </div>
                                    </div>

                                    <!-- File Upload -->
                                    <div class="col-6 pl-0 ml-0">
                                        <div class="form-group">
                                            <label class="input-heading">Attach Files:</label>
                                            <input type="file" name="attachments[]" multiple class="form-control" accept="image/*">

                                        </div>
                                    </div>

                                    <div class="col-12 pl-0 ml-0">
                                        <button onclick="checkSelectedAttorneys(event)" type="submit" class="btn btn-primary">Send Notification</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-block px-0 py-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sent to Attorneys</th>
                            <th>Notification Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notifications->total())) { ?>
                            <?php foreach ($notifications as $val) {
                                $list = $val->attorney_detail;
                                $list = json_decode($list);
                                $formattedDate = DateTimeHelper::dbDateToDisplay($val->created_at, true); ?>
                                <tr class="unread state-<?php echo $val->id; ?>">
                                    <td>
                                        <ul class="mb-0">
                                            <?php foreach ($list as $value) {
                                                echo "<li>" . $value . "</li>";
                                            } ?>
                                        </ul>
                                    </td>
                                    <td><?php echo $formattedDate; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="viewMessage('<?php echo $val->id; ?>')"
                                            class="label theme-bg text-white f-12">Preview</a>
                                    </td>
                                </tr>
                            <?php }
                            } else { ?>
                            <tr>
                                <td colspan="4" class="text-center">No record found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination px-2">
                <?php if (!empty($notifications->total())) { ?>
                    {{ $notifications->appends(['q' => $keyword])->links() }}
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<style>
    label.error {
        color: red;
        font-style: italic;
    }



    #facebox .content.fbminwidth {
        min-width: 550px;
        min-height: 400px;
    }

    .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
    }

    .input-heading {
        font-weight: 600;
    }

    .input-heading span {
        font-weight: 500;
    }

    .accordian-btn {
        display: block;
        width: 100%;
        font-weight: 600;
        font-size: 15px;
        color: #414141;
        padding: .375rem .75rem;
    }

    .accordian-btn.collapsed:after {
        content: "";
        display: inline-block;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0.4em 0.4em 0 0.4em;
        border-color: #999 transparent transparent transparent;
        margin-left: 0.4em;
        vertical-align: 0.1em;
        right: 22px;
        transform: translateY(-50%) !important;
        top: 50% !important;
        position: absolute;
    }

    .accordian-btn:after {
        content: "";
        display: inline-block;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 0.4em 0.4em 0.4em;
        border-color: transparent transparent #999 transparent;
        margin-left: 0.4em;
        vertical-align: 0.1em;
        right: 22px;
        transform: translateY(-50%) !important;
        top: 50% !important;
        position: absolute;
    }

    .pcoded-content {
        padding-top: 0px;
    }
</style>
<script>
    checkSelectedAttorneys = function(event) {
        var selectedOptions = $('#selected_attorney option:checked');
        if (selectedOptions.length == 0) {
            event.preventDefault();
            $('.selected_attorney_error').removeClass('hide-data');
            return false; // Prevent form submission
        } else {
            $('.selected_attorney_error').addClass('hide-data');
        }
        return true; // Allow form submission
    }
    $(document).ready(function() {

        $('#selected_attorney').multiSelect({
            noneText: 'Choose Attorney',
            presets: [{
                    name: 'Select All Attorneys',
                    all: true
                },
                {
                    name: 'Remove Selected',
                    options: ['']
                }
            ]
        });
    });

    viewMessage = function(table_id) {
        ajaxurl = "<?php echo route('admin_email_notification_popup'); ?>";
        laws.ajax(ajaxurl, {
            table_id: table_id
        }, function(response) {
            laws.updateFaceboxContent(response, 'large-fb-width');
        });
    }
</script>

<script>
    $(document).ready(function() {

        $("#new_email_form").validate({
            errorPlacement: function(error, element) {
                if ($(element).parents(".form-group").next('label').hasClass('error')) {
                    $(element).parents(".form-group").next('label').remove();
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                } else {
                    $(element).parents(".form-group").after($(error)[0].outerHTML);
                }
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                $(element).parents(".form-group").next('label').remove();
            },
        });
    });
</script>

@endsection