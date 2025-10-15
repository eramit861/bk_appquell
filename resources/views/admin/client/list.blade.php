@extends('layouts.admin')
@section('content')
    @php
        use App\Helpers\Helper;
    @endphp
    @include('layouts.flash')
    <div class="row">
        <!--[ Recent Users ] start-->
        <div class="col-xl-12 col-md-12">
            <div class="card listing-card">
                <div class="card-header">

                    <div class="search-list">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 pl-0">
                                    <h4>Client Management</h4>
                                    <a href="{{ route('admin_client_list') }}"
                                        class="{{ ($type != 'archived' && $type != 'removed') ? 'is_active' : '' }} btn font-weight-bold tab-new f-12">
                                        <span class="card-title-text">Active</span>
                                    </a>
                                    <a href="{{ route('admin_client_list', ['type' => 'archived']) }}"
                                        class="{{ $type == 'archived' ? 'is_active' : '' }} btn font-weight-bold tab-new f-12">
                                        <span class="card-title-text">Archived</span>
                                    </a>
                                    <a href="{{ route('admin_client_list', ['type' => 'removed']) }}"
                                        class="{{ $type == 'removed' ? 'is_active' : '' }} btn font-weight-bold tab-new f-12">
                                        <span class="card-title-text">Deleted</span>
                                    </a>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="d-flex float_right">
                                        <div class="search-form">
                                            <form action="{{ route('admin_client_list', ['type' => $type]) }}"
                                                method="GET">
                                                <div class="input-group mb-0">
                                                    <input type="hidden" name="type" value="{{ @$type }}">
                                                    <input type="text" name="q" class="form-control"
                                                        value="{{ @$keyword }}" placeholder="Search . . .">
                                                    <button type="submit" class="nmp">
                                                        <span
                                                            class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="">
                                            <a href="#" class="m-l-30 btn font-weight-bold border-blue f-12"
                                                data-bs-toggle="modal" data-bs-target="#add_attorney">
                                                <i class="feather icon-plus"></i>
                                                <span class="card-title-text">Add</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-block px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Client Id
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Subscription
                                    </th>
                                    <th>
                                        Attorney
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($client))
                                    @foreach ($client as $val)
                                        <tr class="unread client-{{ $val['id'] }}">
                                    <td><span>

                                            <strong><a
                                                    href="{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}">{{ $val['id'] }}</a></strong>

                                        </span></td>
                                    <td><span>{{ $val['name'] }}</span></td>
                                    <td><span>{{ $val['email'] }}</span></td>
                                    <td><span>{{ $val['phone_no'] }}</span></td>
                                    @php
                                        $classColor = '';
                                        switch ($val->client_subscription) {
                                            case \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION:
                                                $classColor = 'color-standard';
                                                break;
                                            case \App\Models\AttorneySubscription::PREMIUM_SUBSCRIPTION:
                                                $classColor = 'color-premium';
                                                break;
                                            case \App\Models\AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION:
                                                $classColor = 'color-premium-plus';
                                                break;
                                            case \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION:
                                                $classColor = 'color-black-label';
                                                break;
                                            case \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION:
                                                $classColor = 'color-ultimate';
                                                break;
                                        }
                                    @endphp
                                    <td><span class="{{ $classColor }}"><strong>{{ $val->client_subscription > 0 ? \App\Models\AttorneySubscription::packageNameForClient($val->client_subscription) : '' }}</strong></span>
                                    </td>
                                    <td>
                                        <span>{{ $val->attorney_name }}</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="label theme-bg2 text-white f-12"
                                            onclick="clientPasswordReset({{ $val['id'] }})">Password Reset</a>
                                        @if ($val['paralegal_id'] > 0)
                                            <a href="javascript:void(0)" class="label theme-bg2 text-white f-12"
                                                onclick="sendParalegalInfoToClient({{ $val['id'] }}, {{ $val['paralegal_id'] }}, '{{ route('send_paralegal_info_to_client_popup_by_admin') }}')">Send
                                                Paralegal Info</a>
                                        @endif
                                        <a href="{{ route('ocrlisting', ['id' => $val['id']]) }}"
                                            class="label theme-bg2 text-white f-12">OCR Data</a>
                                        <a href="{{ route('admin_client_edit', ['id' => $val['id']]) }}"
                                            class="label theme-bg text-white f-12">Edit</a>
                                        @php
                                            $msg = "Click here to activate";
                                        @endphp
                                        @if ($val['user_status'] == 0)
                                            <a href="javascript:void(0)" title="{{ $msg }}"
                                                onclick="clientChangeStatus({{ $val['id'] }}, {{ $val['user_status'] }},'{{ route('admin_client_status') }}', true)"
                                                class="label theme-bg text-white f-12"> Activate</a>
                                        @endif
                                        @if ($val['user_status'] == 1)
                                            @php
                                                $msg = "Click here to de-activate";
                                            @endphp
                                            <a href="javascript:void(0)" title="{{ $msg }}"
                                                onclick="clientChangeStatus({{ $val['id'] }}, {{ $val['user_status'] }},'{{ route('admin_client_status') }}', true)"
                                                class="label theme-bg text-white f-12"> Archive</a>
                                        @endif
                                        @if (empty($val['date_marked_delete']) && $val['user_status'] != Helper::REMOVED)
                                            <a href="javascript:void(0)" data-id="{{ route('admin_client_delete') }}"
                                                onclick='deleteClient("{{ route('admin_client_delete') }}",{{ $val['id'] }},"{{ $val['name'] }}")'
                                                class="label theme-bg text-white f-12">Delete</a>
                                        @endif

                                        @if ($type == 'removed' && !empty($val['date_marked_delete']) && $val['user_status'] == Helper::REMOVED)
                                            <a href="javascript:void(0)" data-id="{{ route('admin_client_restore') }}"
                                                onclick='restoreClient("{{ route('admin_client_restore') }}",{{ $val['id'] }},"{{ $val['name'] }}")'
                                                class="label theme-bg text-white f-12">Restore</a>
                                            <a href="javascript:void(0)"
                                                data-id="{{ route('admin_client_delete_permanent') }}"
                                                onclick='deleteClientPermanently("{{ route('admin_client_delete_permanent') }}",{{ $val['id'] }},"{{ $val['name'] }}")'
                                                class="label theme-bg text-white f-12">Delete</a>
                                        @endif

                                        {!! '&nbsp;&nbsp;&nbsp;' !!}<a class="green link-unerline" href="{{ route('admin_client_login', ['id' => $val['id']]) }}">Login
                                            as
                                            client <i class="fas fa-sign-in-alt fa-lg"
                                                title="Login into your client dashboard"></i></a>

                                        @if ($type == 'removed' && !empty($val['date_marked_delete']))
                                            <div class="mt-2">
                                                @php
                                                    $markedDate = \Carbon\Carbon::parse($val['date_marked_delete']);
                                                    $deleteAfter = $markedDate->copy()->addDays(60);
                                                    $daysLeft = now()->diffInDays($deleteAfter, false); // false => can be negative if past
                                                @endphp
                                                @if ($daysLeft > 0)
                                                    <span class="removed-timestamp text-danger mt-2">
                                                        <span class="text-bold">{{ $daysLeft }}</span> days left until
                                                        permanent
                                                        deletion (on {{ $deleteAfter->format('M d, Y') }})
                                                    </span>
                                                @else
                                                    <span class="removed-timestamp text-danger mt-2">
                                                        Eligible for permanent deletion since {{ $deleteAfter->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                    </td>
                                </tr>
                                    @endforeach
                                @endif
                                @if (empty($client->toArray()['data']))
                                    <tr>
                                        <td style="text-align:center;" colspan="7">No records found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination px-2">
                        @if (!empty($client))
                            {{ $client->appends(['q' => $keyword, 'type' => $type])->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--[ Recent Users ] end-->

    </div>
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $("#add_attorney").modal('show');
            });
        </script>
    @endif
    <!-- Modal -->
    <div id="add_attorney" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form id="client_management_form" action="{{ route('admin_client_add') }}" method="post" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input required type="text"
                                        class="form-control mb-4 {{ $errors->has('name') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Name " name="name" value="{{ old('name') }}">
                                </div>
                                @if ($errors->has('name'))
                                    <p class="help-block text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input required type="text"
                                        class="form-control mb-4 {{ $errors->has('email') ? 'btn-outline-danger' : '' }}"
                                        placeholder="Email " name="email" value="{{ old('email') }}">
                                </div>
                                @if ($errors->has('email'))
                                    <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <div class="search-form">
                                    <div class="choose-file">
                                        <div class="form-group">
                                            <select required class="form-control" id="client_attorney"
                                                name="client_attorney">
                                                <option value="">Choose Attorney</option>
                                                @if (!empty($attorney))
                                                    @foreach ($attorney as $val)
                                                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('client_attorney'))
                                    <p class="help-block text-danger">{{ $errors->first('client_attorney') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme-black">Submit</button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <style>
                label.error {
                    color: red;
                    font-style: italic;
                }

                a.green {
                    color: green;
                    font-weight: bold;
                    background-color: #fff;
                    border: 1px solid green;
                }

                .tab-new {
                    border: 2px solid #012cae;
                    color: #012cae;
                    background-color: #c9d1f2;
                }

                .is_active.tab-new {
                    border: 2px solid #012cae;
                }
            </style>
            <script>
                $(document).ready(function() {

                    $("#client_management_form").validate({

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

                sendParalegalInfoToClient = function(id, paralegal_id, ajaxUrl) {
                    laws.ajax(ajaxUrl, {
                        client_id: id,
                        paralegal_id: paralegal_id
                    }, function(response) {
                        laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
                    });
                }

                clientPasswordReset = function(client_id) {
                    ajaxurl = "{{ route('client_password_reset_popup_by_admin') }}";
                    laws.ajax(ajaxurl, {
                        client_id: client_id
                    }, function(response) {
                        laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
                    });
                }
            </script>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
