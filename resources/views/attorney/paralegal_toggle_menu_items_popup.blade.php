<div class="modal-content modal-content-div">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" id="invitemodalLabel">
            Enable Paralegal Menu {{ !empty($name) ? '- ' . $name : '' }}
        </h5>
    </div>
    <div class="modal-body p-0">
        <div class="card-body b-0-i">
            <form action="{{route('toggle_menu_items_popup_save',['id'=>$paralegal_id])}}" id="edit_attorny_form" method="post" novalidate>
                @csrf
                <div class="light-gray-div mt-3">
                    <h2>Enable Paralegal Menu </h2>
                    <div class="row gx-3 w-100 m-0">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="w-100">Name</th>
                                            <th class="w-auto">Allow Access</th>
                                        </tr>

                                        @php $i = 1; @endphp
                                        @foreach ($sidebarItems as $key => $data)
                                            @php
                                                $label = Helper::validate_key_value('name', $data);
                                                $route = Helper::validate_key_value('route', $data);
                                                $isChecked = Helper::validate_key_value($route, $enabled_menu_items, 'radio');
                                            @endphp
                                            @if (!in_array($route, ['attorney_dashboard', 'attorney_client_management']))
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $label }}</td>
                                                <td>
                                                    <div class="label-div question-area m-0">
                                                        <!-- Radio Buttons -->
                                                        <div class="custom-radio-group form-group m-0">
                                                            <input type="radio" id="{{ $route }}_no" class="d-none" name="enabled_menu_items[{{ $route }}]" {{ $isChecked != 1 ? 'checked' : '' }} value="0">
                                                            <label for="{{ $route }}_no" class="btn-toggle btn-red {{ $isChecked != 1 ? 'active' : '' }}">No</label>

                                                            <input type="radio" id="{{ $route }}_yes" class="d-none" name="enabled_menu_items[{{ $route }}]" {{ $isChecked == 1 ? 'checked' : '' }} value="1">
                                                            <label for="{{ $route }}_yes" class="btn-toggle btn-green {{ $isChecked == 1 ? 'active' : '' }}">Yes</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endif
                                        @endforeach
                                            @php $attorney_client_management_invited_checked = Helper::validate_key_value('attorney_client_management_invited', $enabled_menu_items, 'radio'); @endphp
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>Client Management (Invited)</td>
                                                <td>
                                                    <div class="label-div question-area m-0">
                                                        <div class="custom-radio-group form-group m-0">
                                                            <input type="radio" id="attorney_client_management_invited_no" class="d-none" name="enabled_menu_items[attorney_client_management_invited]" {{ $attorney_client_management_invited_checked != 1 ? 'checked' : '' }} value="0">
                                                            <label for="attorney_client_management_invited_no" class="btn-toggle btn-red {{ $attorney_client_management_invited_checked != 1 ? 'active' : '' }}">No</label>

                                                            <input type="radio" id="attorney_client_management_invited_yes" class="d-none" name="enabled_menu_items[attorney_client_management_invited]" {{ $attorney_client_management_invited_checked == 1 ? 'checked' : '' }} value="1">
                                                            <label for="attorney_client_management_invited_yes" class="btn-toggle btn-green {{ $attorney_client_management_invited_checked == 1 ? 'active' : '' }}">Yes</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $attorney_client_management_case_filed_checked = Helper::validate_key_value('attorney_client_management_case_filed', $enabled_menu_items, 'radio'); @endphp
                                            <tr>
                                                <th scope="row">{{ $i + 1 }}</th>
                                                <td>Client Management (Filed Cases)</td>
                                                <td>
                                                    <div class="label-div question-area m-0">
                                                        <div class="custom-radio-group form-group m-0">
                                                            <input type="radio" id="attorney_client_management_case_filed_no" class="d-none" name="enabled_menu_items[attorney_client_management_case_filed]" {{ $attorney_client_management_case_filed_checked != 1 ? 'checked' : '' }} value="0">
                                                            <label for="attorney_client_management_case_filed_no" class="btn-toggle btn-red {{ $attorney_client_management_case_filed_checked != 1 ? 'active' : '' }}">No</label>

                                                            <input type="radio" id="attorney_client_management_case_filed_yes" class="d-none" name="enabled_menu_items[attorney_client_management_case_filed]" {{ $attorney_client_management_case_filed_checked == 1 ? 'checked' : '' }} value="1">
                                                            <label for="attorney_client_management_case_filed_yes" class="btn-toggle btn-green {{ $attorney_client_management_case_filed_checked == 1 ? 'active' : '' }}">Yes</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="bottom-btn-div">
                    <button type="submit" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green" >Save</button>
                </div>
            </form>
        </div>
    </div>
</div>