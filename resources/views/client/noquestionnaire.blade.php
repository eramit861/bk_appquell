@extends('layouts.app')
@section('content')
    @include('layouts.flash')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=3.10">
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css') }}">
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>
    <div class="sign_up_bgs">
        <div class="container-fluid">
            <div class="row py-0 page-flex">
                <div class="col-md-12">
                    <div class="form_colm row px-md-5 py-4">
                        <div class="col-md-9 mb-3">
                            <div class="title-h mt-1 d-flex">
                                <h4><strong>Welcome, {{ auth()->user()->name }} to your Online Bankruptcy
                                        Questionnaire </strong></h4>
                            </div>
                        </div>

                        <div class="col-md-12 main-div">
                            <div class="row">
                                <div class="col-md-7">
                                    <h2 class="title-h">Please download our mobile apps to uploads your documents.</h2>
                                    <div class="align-left mt-3">
                                        <ul>
                                            <li>Our apps read your scanned documents and import the needed information from
                                                your documents into the questionnaire for you saving you a lot of time and
                                                effort.
                                            </li>
                                            <li>If you have any questions and/or concerns, just ask your attorney in the
                                                free secure chat, in either app or in the website.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 align-center" style="margin-top:40px;">
                                        <a target="_blank" href="{{ Helper::IOS_APP_URL }}"><img
                                                src="{{ asset('assets/img/app-store.png') }}" alt="App Store" /></a>
                                        <a target="_blank" href="{{ Helper::ANDROID_APP_URL }}"><img
                                                src="{{ asset('assets/img/play-store.png') }}" alt="Play Store" /></a>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="container-1140">
                                        <div class="upload-documents-wrapper">
                                            <div class="row">
                                                <div class="col-md-12 align-left mb-3">
                                                    <h4><strong>Requested Documents:</strong></h4>
                                                </div>
                                                <div class="col-md-12 pd-0">
                                                    <ul>
                                                        @php
                                                            $attorney = \App\Models\ClientsAttorney::where(
                                                                'client_id',
                                                                Auth::user()->id,
                                                            )->first();
                                                            $documentTypes = Helper::getDocuments(
                                                                Auth::user()->client_type,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                $attorney->attorney_id,
                                                            );
                                                        @endphp
                                                        @foreach ($documentTypes as $key => $document)
                                                            @if (
                                                                !in_array($key, ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs']) ||
                                                                    Auth::user()->client_payroll_assistant != Helper::PAYROLL_ASSISTANT_TYPE_BOTH)
                                                                @php
                                                                    $docData = Helper::getDocumentImage($key);
                                                                @endphp
                                                                <li>
                                                                    <div
                                                                        @if (in_array($key, ['Prior_Year_Tax_Returns', 'Last_Year_Tax_Returns', 'Vehicle_Information'])) class="d-flex h-30" @endif>
                                                                        <h5><strong>{{ $document }}</strong></h5>
                                                                        @if (in_array($key, ['Prior_Year_Tax_Returns', 'Last_Year_Tax_Returns']))
                                                                            <a class="landing-vi" href="javascript:void(0)"
                                                                                onclick="showTaxPayingPopup('{{ route('tax_paying_popup') }}')">
                                                                                <img src="{{ url('assets/img/quick-tip.jpg') }}"
                                                                                    alt="Quick Tip" width="28px" />
                                                                                <span>Need help getting a tax return?</span>
                                                                            </a>
                                                                        @endif
                                                                        @if (in_array($key, ['Vehicle_Information']))
                                                                            <a class="landing-vin" href="javascript:void(0)"
                                                                                onclick="showVehiclePopup('{{ route('show_vehicle_popup') }}')">
                                                                                <img src="{{ url('assets/img/vin.jpg') }}"
                                                                                    alt="VIN" width="38px" />
                                                                                <span>Need help getting VIN Number?</span>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('client.commonlanding')
@endsection
