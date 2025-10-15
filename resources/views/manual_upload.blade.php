<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @php 
        $metaService = new \App\Services\MetaTagsService();
        $meta = $metaService->getTitleAndDescription(); 
    @endphp
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <!-- main.css -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="{{asset('assets/css/facebox.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/new/style.css') }}?v=22.07" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/system_messages.css')}}">
    @php $language = Config::get('app.locale'); @endphp

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js' )}}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js' )}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.css')}}">
    <script src="{{ asset('assets/plugins/bootstrap/js/popover.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/questionarrie.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js' )}}"></script>
    <script src="{{ asset('assets/js/autocomplete.js')}}"></script>
    <script src="{{ asset('assets/js/facebox.js' )}}"></script>
    <script src="{{ asset('assets/js/custom.js')}}?v=11"></script>
    @stack('tab_styles')

    @push('tab_styles')
        <link rel="stylesheet" href="{{ asset('assets/css/client/upload_doc_form.css') }}">
    @endpush
</head>

@php $url_document_type = $_GET['document_type'] ?? ''; @endphp
<body class="{{Route::currentRouteName()}}">


@include("layouts.flash",['auto_close' => false])
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>
    <div class="text-center m-4">
        @php $client_type = $user->client_type; @endphp
        @if (empty($url_document_type))
        <div class="row">
            <div class="col text-left">
                <h3 class="mb-3 text-c-blue">Welcome, {{@$client_name}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="mb-0 text-center bradly-heading">Please upload the below documents into the system
                </h3>
                <p class="pt-3 text-secondary text-center">
                    Most if not ALL of the documents needed for your bankruptcy case will be sent over to the Court. So its
                    important they are very clear and legible<br>
                    If you don't have a professional scanner you can download one of our free apps to scan in all of your
                    documents.<br>
                    Simply go to your app store and type in: BK Questionnaire
                </p>
                <div class="questionnaire-logo text-center">
                    <a target="_blank" href="{{ Helper::IOS_APP_URL }}">
                        <img width="150" src="{{ url('assets/img/app-store.png')}}" alt="App Store">
                    </a>
                    <a target="_blank" href="{{ Helper::ANDROID_APP_URL }}">
                        <img width="150" src="{{ url('assets/img/play-store.png')}}" alt="Play Store">
                    </a>
                </div>


            </div>
        </div>
        @endif

        <div class="row">
        <div class="col-12">
        <p class="text-center mt-3">The documents you haven't uploaded will start out as:
                    <span class="font-weight-bold text-c-light-blue">LIGHT BLUE</span>, when you upload a document it will turn
                    <span class="font-weight-bold color-yellow">DARK BLUE</span>, when the document is accepted by the law firm it will turn
                    <span class="font-weight-bold color-green">GREEN</span>, if its rejected by the law firm it will turn
                    <span class="font-weight-bold color-red">RED.</span>
                </p>
        </div>
        </div>

    @include('client.common_client_upload_view',['user' => $user, 'docsUploadInfo' => $docsUploadInfo, 'isManualPage' => true, 'url_document_type' => $url_document_type])

    <!-- Modal -->
    <div class="modal fade" id="video_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">{!! '&times;' !!}</span></button>
        <div class="modal-content">
            <div class="container absolute-swich-btn">
                <div class="text-center btn-cstm-toggle">
                <span class="text-gray">English</span>
                <label class="switch">
                <input type="checkbox" name="graduate">
                <span class="slider round"></span>
                </label>
                <span class="text-primary">Spanish</span>
                </div>
                <div class="col-md-12 ug mt-5 english">
                <div class="card popup-video bg-light">
                    <div class="card-body text-center">
                        <iframe class="embed-responsive-item" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
                </div>
                <div class="col-md-12 mt-5 phd spanish " style="display: none" >
                <div class="card bg-primaryp popup-video spanish-desktop-video">
                    <div class="card-body text-center">
                        <iframe id="player1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div class="card bg-primaryp popup-video spanish-mobile-video">
                    <div class="card-body text-center">
                        <iframe class="rumble" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</div>

@include('client.uploaddoc_mode',['route' => route('manual_client_document_uploads'), 'max_size' => 200, 'isManual' => true])

<style>
.small, small {
    font-size: 80%;
    font-weight: 400;
}
.text-dark {
    color: #343a40 !important;
}
button.close {
  padding: 0;
  background-color: transparent;
  border: 0;
  -webkit-appearance: none;
  float: right;
}
button.close span{
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
}
.box-lapel-flex label {
    margin-bottom: 0;
    text-align: start;
    width: 100%;
}
.f-w-600{
    font-weight: 600 !important;
}
@font-face {
  font-family:'BradleyHTC';
  src:  url("/assets/css/fonts/bhitc.ttf") format("truetype");
}

.text-c-light-blue{
    color: #00b0f0;
}

.bradly-heading {
    font-family: 'BradleyHTC';
}

.color-red a{
    color: #f44236;
}
.color-dark-gray{
	color: #00b0f0;
}
.color-dark-gray a{
	color: #00b0f0;
}
span.color-red{ color: #f44236;}
span.color-green{color:rgb(16, 138, 0);border:none;}
span.color-yellow{color:#012cae;}
.color-yellow a{
    color: #012cae;
}
.color-yellow-decline a{
	color: #FFA600 ;
}
.color-green {border: 1px solid rgb(16, 138, 0);}
.color-green a {
    color: rgb(16, 138, 0);
}
.color-green{
	border:1px solid rgb(16, 138, 0);
}
.text-gray a ,.text-gray .status-message{
    color: #00b0f0;
}
@keyframes blink-border {
    0% {
        border-color: #f44236;
    }
    50% {
        border-color: transparent;
    }
    100% {
        border-color: #f44236;
    }
}

.text-gray {
    border: 2px solid #f44236;
    animation: blink-border 1s infinite;
}

.text-red a , .text-red .status-message{
    color: #f44236;
}
.text-red  {
    border: 2px solid #f44236;
}
.text-yellow  {
    border: 1px solid #012cae;
}
.text-yellow a , .text-yellow .status-message{
    color: #012cae;
}
.text-yellow-decline a {
	color: #000 ;
}
.text-yellow-decline{
	border:1px solid #000;
}
.text-green {border:1px solid rgb(16, 138, 0);}
.text-green a, .text-green .status-message{
    color: rgb(16, 138, 0);
}
.btn_border{border:2px solid #000;font-weight:bold;}
.doc-card {
    align-items: center;
    display: flex;
}
.b-none {
    border: none;
}

.card-header{
	background-color:#fff !important;
	border:2px solid #000 !important;

}
ul{list-style: none;padding:0px;}
.debtor-docs, .codebtor-docs, .attorney-docs{
	margin-bottom: 0;
}
.debtor-docs li, .codebtor-docs li, .attorney-docs li{
	padding: 10px 15px;
    margin: 10px 0;
	font-size: 14px;
	border-radius: 0.35rem;
}
.debtor-docs li .doc-card, .codebtor-docs li .doc-card, .attorney-docs li .doc-card{
    margin-left: 0.75rem;
	position: relative;
    width: 100%;
}
.nav-linkf .doc-card .font-weight-bold {
    font-size: 9px;
    position: absolute;
    bottom: 0px;
    left: 0;
    min-width: 100%;
    text-align: right;
}
/* .debtor-docs li .d-status img, .codebtor-docs li .d-status img, .attorney-docs li .d-status img{

} */
.status-message{
	padding-top: 2px;
}
.doc-icon {
	width: 35px;
	fill: blue;
	text-align: center;
}
.navbar-toggler{display:none;}
/* .d-status svg{
	fill: #ffffff !important;
} */
.card .card-header h5 {
  margin-bottom: 0;
  color: #000;
  font-size: 20px;
  font-weight: 600;
  display: inline-block;
  margin-right: 10px;
  line-height: 1.1;
  position: relative;
}
.text-c-blue {
  color: #012cae !important;
}
.card {
  border-radius: 0;
  box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
  border: none;
  margin-bottom: 30px;
  transition: all 0.5s ease-in-out;
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
}
.text-right{text-align:right!important;}
.text-c-green{color:green;}
    .doc-name-sec .sec-border{
        border: 1px solid #dddddd;
    border-radius: 0.5rem;
    padding: 5px 10px;
    text-align: left;
    }
    .float-r {
        float: right;
    }
    .bg_grey{
        background : #f4f6fa;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    .input-group-text {
        padding:0.375rem 0.85rem;
    }
    .ml-input-label{
        margin-left: 2.5rem !important;
    }

    .text-c-blue{color:#012cae;}
    .system_message,
    .alert.alert--positioned {
        position: fixed;
        width: auto;
        margin: 0;

        z-index: 9999;
        right: 20px;
        top: 50px;
        color: white;
    }
.font-weight-bold{font-weight:700;}
    .alert--success,
    .alert_success {
        background: url(../images/icon--success.svg) no-repeat 15px 14px #012cae;
        background-size: 30px;
        padding: 20px 40px 20px 60px !important;
    }
.text-left{text-align:left;}
    .alert--danger,
    .alert_danger,
    .kyc-reject-alert {
        background: url(../images/icon--attention.svg) no-repeat 15px 14px #f35f5f;
        background-size: 30px;
        padding: 20px 40px 20px 60px !important;
    }

    .alert--process,
    .alert_process {
        background: rgba(0, 0, 0, 0.9);
        padding: 20px 40px 20px 60px !important;
    }

    @media(max-width:767px) {

        .system_message,
        .alert.alert--positioned {
            left: 10px;
            right: 10px;
            top: 10px;
        }
        .float-r {
            float: none;
        }
    }

    .form-group {
        display: block !important;
    }

    .text-c-red {
        color: red;
    }

    .hide-data {
        display: none !important
    }
    input.largerCheckbox {
            transform : scale(1.3);
        }
    select {
        appearance: auto !important;
        padding: 0.525rem 0.75rem !important;
    }

    p {
        margin-bottom: 1%;
        color: black
    }

    .custom_corner_span {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .custom_corner_input {
        border-top-left-radius: 0rem !important;
        border-bottom-left-radius: 0rem !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .text-bold {
        font-weight: bold;
    }

    .br-0 {
        border-right: 0px;
    }

    .bb-2 {
        border-bottom: 2px solid #989898;
        padding: 9px;
    }
    .ml-1{
        margin-left: 0.25rem !important;
    }
    .ml-2 {
        margin-left: 0.5rem !important;
    }
    .text-c-white{color: #fff !important;}

    .mr-1{
        margin-right: 0.25rem !important;
    }
    .mr-2{
        margin-right: 0.5rem !important;
    }
    .mr-3 {
        margin-right: 0.75rem !important;
    }
    .mr-4 {
        margin-right: 1.5rem !important;
    }
    .pr-0{
        padding-right: 0rem !important;
    }
    label.error {
        color: red;
        font-size: 10px;
        font-weight: bold;
    }

    .drop_file_name,
.dropmutiple_file_name {
    display: none;
    top: 75px;
color: #012cae;
font-size: 10px;
font-weight: 700;
}


/* Upload Area */

.upload-area {
    width: 100%;
    box-shadow: 0 3px 10px 0 rgb(0 0 0 / 5%);
    border: 2px solid #012cae;
    border-radius: 24px;
    padding: 20px 22px;
    text-align: center;
}


/* Header */


/* Drop Zoon */

.upload-area__drop-zoon {
    position: relative;
    border: 4px dashed #012cae;
    border-radius: 15px;
    margin-top: 2.1875rem;
    cursor: pointer;
    transition: border-color 300ms ease-in-out;
}
input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }
.drop-zoon__icon {
    font-size: 3.75rem;
    color: #012cae;
    transition: opacity 300ms ease-in-out;
    padding-bottom: 40px;
    display: block;
}
.form-group.c_paystub + .error{
    position: absolute;
    z-index: 1;
    top: 50px;
}
.doc-upload .doc-edit {
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

#form-image {
    height: 100%;
}

.doc-upload input {
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.doc-upload label {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 10px;
    z-index: -1;
}

.doc-preview {
    padding: 30px 0;
}

.doc-preview img {
    max-width: 130px;
}

.doc-preview .pdf-img {
    max-width: 60px;
}

.edit-img {
    position: absolute;
}

.edit-img i {
    font-size: 21px;
    color: #012cae;
    cursor: pointer;
}

.hide_img_preview {
    display: none;
}

.progress-percentage {
    position: absolute;
    right: 40px;
}

    .form-group {
        display: -ms-flexbox;
        display: flex;
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 0
    }
    iframe{border: none;}
    .pl-0 {
        padding-left: 0px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
    .ml-0 {
        margin-left: 0px;
    }

    .w-auto {
        width: auto !important;
        display: inline;
    }

    .ml-3 {
        margin-left: 0.75rem !important;
    }

    .ml-4 {
        margin-left: 1.5rem !important;
    }
    .ml-5 {
        margin-left: 2rem !important;
    }

    .d-block {
        display: block !important
    }

    .contact_btn a.theme_btn {
        min-width: auto !important;
        line-height: 45px;
        font-size: 14px;
        letter-spacing: 3px;
        font-weight: 700;
        text-transform: uppercase;
        background: transparent;
        color: #fff;
        border: 2px solid #ffffff;
        padding: 0 10px;
    }

    .contact_btn ul {
        list-style: none;
    }

    a.contact_us_btn p {
        margin-bottom: 0;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
    }

    a.contact_us_btn span {
        font-size: 15px;
        color: #fff;
        font-weight: 500;
        opacity: .7;
    }
    .h-41px{
        height: 41px !important;
    }
    .h-44px{
        height: 44px !important;
    }
    .h-64px{
        height: 64px !important;
    }
    .h-88px{
        height: 88px !important;
    }
    .h-110px{
        height: 110px !important;
    }
    .text-blue{
        color: #012cae;
    }
    .pcoded-content input, .pcoded-content textarea, .pcoded-content input[type='checkbox'], .pcoded-content select {
        background: #fff;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .form-control:focus{
        color:#212529;
        background-color:#fff;
        border-color:#86b7fe;
        outline:0;
        box-shadow:0 0 0 .25rem rgba(13,110,253,.25);
    }

    .form-floating > input::placeholder {
        opacity: 0 ;
        color: blue;
    }

    .form-floating > label {
        position: absolute;
        top: 0px ;
        left: 15px !important;
        padding: .59rem .0rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .1s ease-in-out,transform .1s ease-in-out;
    }
    .form-floating > .form-control:focus ~ label, .form-floating > .form-control:not(:placeholder-shown) ~ label, .form-floating > .form-select ~ label {
        opacity: 1 !important;
        transform: scale(1) translateY(-.5rem) translateX(.15rem) !important;
        color: #012cae;
        font-size: 13.5px;
        width: auto;
        height: 20.8px;
        padding: 0px 8px 0px 8px;
        margin: 0px 8px 0px 8px;
        background: white;
        transition: 0.2s ease-in-out;
        top: -3px !important;
        left: 18px;
    }
    .form-floating > .form-control, .form-floating > .form-select {
        height: 44px;
    }
    .form-floating > .form-control {
        padding: 9px 12px !important;
    }
    .form-floating > .form-textarea {
        height: unset !important;
        resize: none;
        /* overflow: hidden; */
        min-height: 44px;
        line-height: 1.5;
    }
    input::placeholder {
    font-size: .75rem;
    }
    .radio_btn{
        padding: 9px 12px !important;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        height: 44px;
    }
    .mt-4-rs-based {
        margin-top: 1.5rem;
    }
    .custom-label-on-mobile{
        display: none;
    }
    .custom-label-on-desktop{
        display: block;
    }
    .desktop-ml-2{
        margin-left: 0.5rem;
    }
    .d-inherit{display: inherit;}
    @media screen and (max-width:992px) {

        .mt-4-rs-based {
            margin-top: 0rem;
        }
        /* .form-floating > label.hide-on-mobile{
            left: -2px !important;
            font-size:10px;
            top: -26px !important;
        }
        .form-floating > .form-control:not(:placeholder-shown) ~ label.hide-on-mobile,.form-floating > .form-control:focus ~ label.hide-on-mobile{
            font-size:8.5px;
        } */
        .custom-label-on-mobile{
            display: block;
        }
        .custom-label-on-desktop{
            display: none;
        }
    }

    .custom-input-label-on-mobile{
        display: none;
    }
    .custom-input-label-on-desktop{
        display: block;
    }
    .mt-4-mobile-off{
        margin-top: 1.5rem;
    }
    .t-minus-3{
        top: -3px !important;
    }
    @media screen and (max-width:768px) {
        .custom-input-label-on-mobile{
            display: block;
        }
        .custom-input-label-on-desktop{
            display: none;
        }
        .mt-4-mobile-off{
            margin-top: 0rem;
        }
    }
    @media screen and (max-width:630px) {
        .mt-4-630{
            margin-top: 1.5rem;
        }
    }
    @media screen and (max-width:576px) {

        .radio_btn{
            padding: 9px 12px !important;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: 88px;
        }
        .h-44px{
            height: 44px !important;
        }
        .h-66px{
            height: 66px !important;
        }
        .h-77px{
            height: 77px !important;
        }
        .pt-4-mobile{
            padding-top: 1.5rem !important;
        }
    }
    .custom_add_liens_height{height: auto;}
    @media screen and (max-width: 1024px) and (min-width: 768px) {
        .custom_add_liens_height{height: 88px;}
    }

.input-with-image {
    position: relative;
}

.input-with-image input[type='text'] {
    /* padding-left: 40px;
      padding-right: 40px; */
    padding: 5px 30px;
}

.input-with-image .icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 15px;
    height: auto;
}

.input-with-image .doc-icon {
    left: 10px;
}

.input-with-image .cancel-icon {
    right: 5px;
    color: #f44236;
}

h3 {
  font-size: 26px;
}
h4 {
  font-size: 20px;
}

p {
  font-size: 14px;
}

.manual-padding{
padding: 0rem 1rem;
}
.btn-primary {
  color: #fff;
  background-color: #012cae;
  border-color: #012cae;
}
.btn {
  padding: 8px 15px;
  border-radius: 0.25rem;
  font-size: 14px;
  margin-bottom: 5px;
  margin-right: 10px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

</style>
<style>
    .nav-linkf{text-transform: capitalize;}
    .box-lapel-flex  label {
        /* display: flex;
        align-items: center; */
        /* gap: 10px; */
        margin-bottom: 0;
        text-align: start;
    }
    .box-lapel-flex {
        margin-bottom: 10px;
    }
    .fs-12px {
        font-size: 12px !important;
    }
    .bottom-list{
        line-height: 12px;
    }
    .bottom-list-without-month{
        line-height: 6px;
    }
    .webkit_fill{
        width: 100%;
        width: -moz-available;          /* WebKit-based browsers will ignore this. */
        width: -webkit-fill-available;  /* Mozilla-based browsers will ignore this. */
        width: fill-available;
    }
    .blink {
    animation: blink 1.5s infinite;
    font-size: 14px;
    font-weight: bold;
    padding: 0 10px 0 0;
}
    @keyframes blink {
    0% { color: #f44236; }
    50% { color: transparent; }
    100% { color: #f44236; }
}
    #both_document_upload_modal{
        max-height:90%;
    }
</style>
<script>
    $(document).ready(function(){
        $('.btn-secondary').click(function(){
            $('#both_document_upload_modal').modal('hide');
        });

        run_tutorial_videos = function(obj,element){
            var video_src=$(obj).attr('data-video');
            var video_src2=$(obj).attr('data-video2');
            $("#video").attr('src',video_src);
            $("#player1").attr('src',video_src2);
            $(element).modal('show');
        }
    });
</script>
@stack('tab_scripts')
</body>

</html>
