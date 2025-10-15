@extends('layouts.attorney', ['welcome_page' => true, 'video' => $video])
@section('content')
@include("layouts.flash")

<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-3 stretch-card grid-margin dashboard-profile">
                <div class="card-img-holder">
                    <div class="p-0 py-2">
                        <a href="{{ route('attorney_profile') }}" class="nav-profile">
                            <div class="nav-profile-image">
                                @php
                                    $authUser = Auth::user();
                                    $userLogo = \App\Models\AttorneyCompany::getLoggedInAttorneyLogo($authUser->id);
                                    $designation = ($authUser->role == 2 && !empty($authUser->parent_attorney_id)) ? 'Paralegal' : 'Attorney';
                                    if (!empty($authUser->paralegal_law_firm_id)) {
                                        $designation = 'Law Firm';
                                    }
                                @endphp
                                <img src="{{ asset($userLogo) }}" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ $authUser->name }}</span>
                                <span class="text-secondary text-small">{{ $designation }}</span>
                            </div>
                        </a>		
                    </div>
                </div>
            </div>

            <!-- Total Clients Card -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card card-img-holder text-dark blue_bg bx-shdo">
                    <div class="card-body bg-unset">
                        <h6 class="font-weight-normal mb-2">Total Clients 
                            <i class="bi bi-people-fill float-end" style="font-size:24px"></i>
                        </h6>
                        <h2 class="mb-0">{{ $client_count ?? "0" }}</h2>				
                    </div>
                </div>
            </div>
            
            <!-- Questionnaire Package Counts Logic -->
            @php
                $subArray = [
                    \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION,
                    \App\Models\AttorneySubscription::PREMIUM_SUBSCRIPTION,
                    \App\Models\AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION,
                    \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION,
                    \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION,
                ];
                
                $otherArray = [
                    \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION,
                    \App\Models\AttorneySubscription::JOINT_DEBTOR_ADDITIONAL,
                    \App\Models\AttorneySubscription::JOINT_DEBTOR_ULTIMATE_ADDITIONAL,
                    \App\Models\AttorneySubscription::STANDARD_CONCIERGE_SERVICE_PACKAGE,
                ];

                $allPackages = \App\Models\AttorneySubscription::allPackageNameWithParamArray();
                $availablePackages = [];

                // Process subscription packages
                foreach ($usedSubscriptions as $key => $val) {
                    if (in_array($key, $subArray) || in_array($key, $otherArray)) {
                        $itemPurchased = $packages[$key] ?? 0;
                        $available = $itemPurchased - $val;
                        if ($available > 0) {
                            $availablePackages[$key] = [
                                'id' => $key,
                                'name' => $allPackages[$key] ?? '',
                                'available' => $available
                            ];
                        }
                    }
                }

                $packageCounts = [
                    100 => 0,
                    121 => 0,
                    135 => 0
                ];

                // Count occurrences of each package ID in $availablePackages
                foreach ($availablePackages as $package) {
                    $packageId = $package['id'];
                    if (array_key_exists($packageId, $packageCounts)) {
                        $packageCounts[$packageId] += $package['available'];
                    }
                }
            @endphp

            <!-- Questionnaire Cards -->
            <div class="col-md-6 px-70">
                <div class="card card-img-holder text-dark bg_gry bx-shdo px-0">
                    <div class="row align-items-center px-3">
                        <div class="col-md-3 card-body lb70 bg-transparent bs-none">
                            <h6 class="font-weight-normal mb-2">Questionnaire</h6>
                            <h2 class="mb-0">{{ ($packageCounts[100] ?? 0) + ($packageCounts[121] ?? 0) + ($packageCounts[135] ?? 0) }}</h2>					
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="text-center card-body my-2 bg_gry">
                                <h4 class="mb-2 font-weight-bold">{{ $packageCounts[100] ?? 0 }}</h4>
                                <h6 class="font-weight-normal mb-0">Standard</h6>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="text-center card-body my-2 bg_white">
                                <h4 class="mb-2 font-weight-bold">{{ $packageCounts[121] ?? 0 }}</h4>
                                <h6 class="font-weight-normal mb-0">Premium Plus</h6>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="text-center card-body my-2 blue-dark">
                                <h4 class="mb-2 font-weight-bold">{{ $packageCounts[135] ?? 0 }}</h4>
                                <h6 class="font-weight-normal mb-0">Ultimate</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Clients Section Header -->
    <div class="col-12">
        <div class="mcard">
            <div class="mcard-body">
                <h4 class="card-title">
                    <i class="bi bi-person-plus-fill"></i> My Clients
                </h4>
                <div class="short_div">
                    <!-- Pagination Form -->
                    <div class="show d-flex align-items-center">
                        <form action="{{ route('attorney_dashboard') }}" method="GET" id="paginationForm" class="d-flex align-items-center">
                            <label for="per_page" class="mb-0 per_page">Show:</label>
                            <select name="per_page" id="per_page" class="per_page form-select form-control" onchange="document.getElementById('paginationForm').submit();">
                                @foreach([10, 25, 50, 100] as $perPage)
                                    <option value="{{ $perPage }}" {{ request('per_page') == $perPage ? 'selected' : '' }}>{{ $perPage }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    
                    <!-- Search Field -->
                    <div class="search-field">
                        <form class="d-flex align-items-center h-100 sr" id="searchForm" action="{{ route('attorney_dashboard') }}" method="GET">
                            <span>Search</span>
                            <div class="input-group mb-0">
                                <div class="input-group-prepend bg-transparent" onclick="document.getElementById('searchForm').submit();">
                                    <i class="bi bi-search input-group-text border-0"></i>
                                </div>
                                <input type="text" name="q" class="form-control bg-transparent border-0" placeholder="Search" value="{{ $searchQuery }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Clients Table -->
    <div class="col-12">
        <div class="card mt-2 bg-transparent b-0-i">
            <div class="card-body card-body-padding">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>
                                    <a href="{{ route('attorney_dashboard', [
                                        'sort_by' => 'id',
                                        'sort_order' => ($sort_by == 'id' && $sort_order == 'asc') ? 'desc' : 'asc',
                                        'q' => request('q'),
                                        'per_page' => request('per_page')
                                    ]) }}">
                                        Id
                                        @if ($sort_order == 'asc' && $sort_by == 'id')
                                            <i class="bi bi-caret-down-fill"></i>
                                        @else
                                            <i class="bi bi-caret-up-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('attorney_dashboard', [
                                        'sort_by' => 'name',
                                        'sort_order' => ($sort_by == 'name' && $sort_order == 'asc') ? 'desc' : 'asc',
                                        'q' => request('q'),
                                        'per_page' => request('per_page')
                                    ]) }}">
                                        Client Name
                                        @if ($sort_order == 'asc' && $sort_by == 'name')
                                            <i class="bi bi-caret-down-fill"></i>
                                        @else
                                            <i class="bi bi-caret-up-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('attorney_dashboard', [
                                        'sort_by' => 'created_at',
                                        'sort_order' => ($sort_by == 'created_at' && $sort_order == 'asc') ? 'desc' : 'asc',
                                        'q' => request('q'),
                                        'per_page' => request('per_page')
                                    ]) }}">
                                        Date
                                        @if ($sort_order == 'asc' && $sort_by == 'created_at')
                                            <i class="bi bi-caret-down-fill"></i>
                                        @else
                                            <i class="bi bi-caret-up-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('attorney_dashboard', [
                                        'sort_by' => 'client_type',
                                        'sort_order' => ($sort_by == 'client_type' && $sort_order == 'asc') ? 'desc' : 'asc',
                                        'q' => request('q'),
                                        'per_page' => request('per_page')
                                    ]) }}">
                                        Client Type
                                        @if ($sort_order == 'asc' && $sort_by == 'client_type')
                                            <i class="bi bi-caret-down-fill"></i>
                                        @else
                                            <i class="bi bi-caret-up-fill"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse($client as $val)
                                <tr>
                                    <td>
                                        <a href="{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}">
                                            {{ $val['id'] }}
                                        </a>
                                    </td>
                                    <td>{{ ucfirst($val['name']) }}</td>
                                    <td>
                                        <span>
                                            @php
                                                $date = date_create($val['created_at']);
                                                $formated_DATETIME = date_format($date, 'M dS, Y');
                                            @endphp
                                            {{ $formated_DATETIME }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $val['client_type'] > 0 ? \App\Helpers\ArrayHelper::getClientTypeLabelArray($val['client_type']) : '' }}
                                        </span>
                                    </td>
                                    <td>
                                        <label class="badge btn-inverse-success">Active</label>
                                    </td>
                                    <td>
                                        <a href="{{ route('attorney_form_submission_view', ['id' => $val['id']]) }}" class="view_client_btn">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="unread">
                                    <td colspan="7">{{ __('No Record Found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination Section -->
                    <div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
                        @if ($client->count())
                            <div class="shoing">
                                Showing {{ $client->firstItem() }} to {{ $client->lastItem() }} of {{ $client->total() }} entries
                            </div>
                            <div>
                                {{ $client->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection
