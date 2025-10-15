@php 
$web_view = Session::get('web_view');
$authUser = Auth::user();
$client_id = $authUser->id;
$client_type = $authUser->client_type;

$progressbarcolor = [];
$progressbartextcolor = [];

foreach ($progress as $key => $value) {
    if ($value <= 25) {
        $progressbarcolor[$key] = '#f44236';
        $progressbartextcolor[$key] = '#fff';
    }
    if ($value >= 26 && $value <= 99) {
        $progressbarcolor[$key] = '#FEBF1E';
        $progressbartextcolor[$key] = '#111';
    }
    if ($value >= 100) {
        $progressbarcolor[$key] = '#4BA346';
        $progressbartextcolor[$key] = '#fff';
    }
}
$notUploadedDocsCount = 0;
if (isset($docsProgress) && !empty(Helper::validate_key_value('notUploadedDocs', $docsProgress))) {
    $notUploadedDocsCount = count(Helper::validate_key_value('notUploadedDocs', $docsProgress));
}

$progressactive = "";
$progressUrl = '';
$progressClass1 = '';
$tab1active = "";
$ico1Url = asset('assets/img/predashboard/section1.png');
$percentClass1 = '';
$tab2active = "";
$ico2Url = asset('assets/img/predashboard/section2.png');
$percentClass2 = '';
$tab3active = "";
$ico3Url = asset('assets/img/predashboard/section3.png');
$percentClass3 = '';
$tab4active = "";
$ico4Url = asset('assets/img/predashboard/section4.png');
$percentClass4 = '';
$tab5active = "";
$ico5Url = asset('assets/img/predashboard/section5.png');
$percentClass5 = '';
$tab6active = "";
$ico6Url = asset('assets/img/predashboard/section6.png');
$percentClass6 = '';
@endphp

<div class="row design-4">
   <div class="col-12">

      @if ($authUser->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUser->hide_questionnaire == 0)
          @php
          if (!empty($tab) && $tab == 'progress') {
              $progressactive = "active";
              $progressUrl = '';
              $progressClass1 = '';
          }
          if (!empty($tab) && $tab == 'tab1') {
              $tab1active = "active";
              $ico1Url = asset('assets/img/predashboard/section1white.png');
              $percentClass1 = 'active-percent';
          }
          if (!empty($tab) && $tab == 'tab2') {
              $tab2active = "active";
              $ico2Url = asset('assets/img/predashboard/section2white.png');
              $percentClass2 = 'active-percent';
          }
          if (!empty($tab) && $tab == 'tab3') {
              $tab3active = "active";
              $ico3Url = asset('assets/img/predashboard/section3white.png');
              $percentClass3 = 'active-percent';
          }
          if (!empty($tab) && $tab == 'tab4') {
              $tab4active = "active";
              $ico4Url = asset('assets/img/predashboard/section4white.png');
              $percentClass4 = 'active-percent';
          }
          if (!empty($tab) && $tab == 'tab5') {
              $tab5active = "active";
              $ico5Url = asset('assets/img/predashboard/section5white.png');
              $percentClass5 = 'active-percent';
          }
          if (!empty($tab) && $tab == 'tab6') {
              $tab6active = "active";
              $ico6Url = asset('assets/img/predashboard/section6white.png');
              $percentClass6 = 'active-percent';
          }

          $progress_percentage = $progress['all_percentage'];

          $progress_percentage = ($progress_percentage + (int) ($docsProgress['progress'] ?? 0)) / 2;
          $class = '';
          $textcolor = 'text-c-red';
          $emojiIcon = "";

          if ($progress_percentage == 0) {
              $class = "bg-danger";
          }
          if ($progress_percentage < 50) {
              $emojiIcon = "&#128563;";
          }
          if ($progress_percentage >= 50 && $progress_percentage <= 99) {
              $emojiIcon = "&#128556;";
          }
          if ($progress_percentage > 50 && $progress_percentage < 75) {
              $class = "bg-warning";
          }
          if ($progress_percentage > 75 && $progress_percentage < 90) {
              $class = "bg-info";
          }
          if ($progress_percentage == 100) {
              $class = "bg-success";
              $emojiIcon = '<img src="' . asset('assets/img/double_thumbs_up.png') . '" alt="overview" class="w-40px h-40px">';
              // &#128526;
          }

          $msg = $progress_percentage . '%';
          if ($progress_percentage == 100) {
              $msg = "100%";
              $textcolor = 'text-c-blue';
          }
          $width = $progress_percentage;
          if ($progress_percentage == 0) {
              $width = 100;
          }
          @endphp

         <!-- Case Progress Overview -->
         <div class="card progress-card border-0 {{ ArrayHelper::getPreDashboardMainProgressClass($progress_percentage) }}">
            <div class="card-body pt-2 border-0">
               <a href="{{route('client_progress')}}">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <h5 class="fw-bold mb-0">
                        <span style="margin-right: 10px;">&#x1F4CA;</span>
                        Case Progress Overview
                     </h5>
                     <span style="font-size: 20px;">{!! $emojiIcon !!}</span>
                  </div>
                  <div class="text-center mb-3">
                     <div class="display-5 fw-bold text-primary">{{ $msg }}</div>
                     <small class="text-muted">Overall Completion</small>
                  </div>
               </a>

               @if ($progress['eligible_for_final_submit'] == 1 && $msg == '100%')
                  <button class="btn btn-success btn-custom w-100 submit-for-review-btn" onclick="finalSubmitToAttorney()">
                     <span style="margin-right: 8px;">&#x1F4E4;</span>
                     Submit For Review of Your Case
                  </button>
               @else
                  <button class="btn btn-success btn-custom w-100 submit-for-review-btn disabled">
                     <span style="margin-right: 8px;">&#x1F4E4;</span>
                     Submit For Review of Your Case
                  </button>
               @endif
            </div>
         </div>
         <!-- Basic Information Section -->
         <div class="progress-section ">
            <div class="card progress-card border-0">
               <div class="card-body border-0 pt-3">
                  <a href="{{route('client_dashboard')}}">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 card-label">
                           <span style="margin-right: 8px;">&#x1F4CB;</span>
                           Basic Information
                        </h6>
                        <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab1_percentage'] }}; color:{{ $progressbartextcolor['tab1_percentage'] }} !important;">{{ ($progress['tab1_percentage'] == 100) ? '✓ Completed' : $progress['tab1_percentage'] . '% Complete' }}</span>
                     </div>
                     <div class="progress progress-bar-custom position-unset mb-3 w-100">
                        <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab1_percentage'] }}; width: {{ $progress['tab1_percentage'] }}%"></div>
                     </div>
                  </a>

                  <div class="section-grid">
                     <a href="{{route('client_dashboard')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab1_percentage_by_steps'], 1) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F468;</span>
                           </div>
                           <small class="fw-bold d-block">{{\App\Helpers\ArrayHelper::getClientName($client_id, "Debtor")}} Info</small>
                        </div>
                     </a>
                     @if ($client_type == 3)
                        <a href="{{route('client_basic_info_step1')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab1_percentage_by_steps'], 2) }}">
                           <div class="section-item">
                              <div class="icon-circle text-white">
                                 <span class="section-icon">&#x1F469;</span>
                              </div>
                              <small class="fw-bold d-block">{{\App\Helpers\ArrayHelper::getCoDebtorName($client_id, "Co-Debtor")}} Info</small>
                           </div>
                        </a>
                     @endif
                     <a href="{{route('client_basic_info_step2')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab1_percentage_by_steps'], 3) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4BC;</span>
                           </div>
                           <small class="fw-bold d-block">BK Cases/ Businesses</small>
                        </div>
                     </a>
                  </div>

                  <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
               </div>
            </div>
         </div>
         <!-- Property Section -->
         <div class="progress-section ">
            <div class="card progress-card border-0">
               <div class="card-body border-0 pt-3">
                  <a href="{{route('property_information')}}">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 card-label">
                           <span style="margin-right: 8px;">&#x1F3E0;</span>
                           Property
                        </h6>
                        <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab2_percentage'] }}; color:{{ $progressbartextcolor['tab2_percentage'] }} !important;">{{ ($progress['tab2_percentage'] == 100) ? '✓ Completed' : $progress['tab2_percentage'] . '% Complete' }}</span>
                     </div>
                     <div class="progress progress-bar-custom position-unset mb-3 w-100">
                        <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab2_percentage'] }}; width: {{ $progress['tab2_percentage'] }}%"></div>
                     </div>
                  </a>

                  <div class="section-grid">
                     <a href="{{route('property_information')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab2_percentage_by_steps'], 1) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F3E0;</span>
                           </div>
                           <small class="fw-bold d-block">Real Property</small>
                        </div>
                     </a>
                     <a href="{{route('client_property_step1')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab2_percentage_by_steps'], 2) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F697;</span>
                           </div>
                           <small class="fw-bold d-block">Vehicles</small>
                        </div>
                     </a>
                     <a href="{{route('client_property_step2')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab2_percentage_by_steps'], 3) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F6CB;&#xFE0F;</span>
                           </div>
                           <small class="fw-bold d-block">Personal/ Household Items</small>
                        </div>
                     </a>
                     <a href="{{route('client_property_step3')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab2_percentage_by_steps'], 4) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F3E6;</span>
                           </div>
                           <small class="fw-bold d-block">Financial Assets</small>
                        </div>
                     </a>
                     <a href="{{route('client_property_step4_continue')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab2_percentage_by_steps'], 5) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4BC;</span>
                           </div>
                           <small class="fw-bold d-block">Money or property owed to you</small>
                        </div>
                     </a>
                  </div>

                  <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
               </div>
            </div>
         </div>
         <!-- Debt Section -->
         <div class="progress-section ">
            <div class="card progress-card border-0">
               <div class="card-body border-0 pt-3">
                  <a href="{{route('client_debts_step2_unsecured')}}">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 card-label">
                           <span style="margin-right: 8px;">&#x1F4B3;</span>
                           Debts
                        </h6>
                        <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab3_percentage'] }}; color:{{ $progressbartextcolor['tab3_percentage'] }} !important;">{{ ($progress['tab3_percentage'] == 100) ? '✓ Completed' : $progress['tab3_percentage'] . '% Complete' }}</span>
                     </div>
                     <div class="progress progress-bar-custom position-unset mb-3 w-100">
                        <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab3_percentage'] }}; width: {{ $progress['tab3_percentage'] }}%"></div>
                     </div>
                  </a>

                  <div class="section-grid">
                     <a href="{{route('client_debts_step2_unsecured')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab3_percentage_by_steps'], 1) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4B8;</span>
                           </div>
                           <small class="fw-bold d-block">Unsecured Debts</small>
                        </div>
                     </a>
                     <a href="{{route('client_debts_step2_back_tax')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab3_percentage_by_steps'], 2) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4B6;</span>
                           </div>
                           <small class="fw-bold d-block">Priority Debts</small>
                        </div>
                     </a>
                     <a href="{{route('client_debts_step2_additional')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab3_percentage_by_steps'], 4) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F46A;</span>
                           </div>
                           <small class="fw-bold d-block">Additional Secured Debts</small>
                        </div>
                     </a>
                  </div>

                  <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
               </div>
            </div>
         </div>
      @endif
      <!-- Income Section -->
      <div class="progress-section ">
         <div class="card progress-card border-0">
            <div class="card-body border-0 pt-3">
               <a href="{{route('client_debts_step2_unsecured')}}">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                     <h6 class="fw-bold mb-0 card-label">
                        <span style="margin-right: 8px;">&#x1F4B5;</span>
                        Current Income
                     </h6>
                     <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab4_percentage'] }}; color:{{ $progressbartextcolor['tab4_percentage'] }} !important;">{{ ($progress['tab4_percentage'] == 100) ? '✓ Completed' : $progress['tab4_percentage'] . '% Complete' }}</span>
                  </div>
                  <div class="progress progress-bar-custom position-unset mb-3 w-100">
                     <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab4_percentage'] }}; width: {{ $progress['tab4_percentage'] }}%"></div>
                  </div>
               </a>

               <div class="section-grid">
                  <a href="{{route('client_income')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab4_percentage_by_steps'], 1) }}">
                     <div class="section-item">
                        <div class="icon-circle text-white">
                           <span class="section-icon">&#x1F464;</span>
                        </div>
                        <small class="fw-bold d-block">{{\App\Helpers\ArrayHelper::getClientName($client_id, "Debtor", true)}} Employer Info</small>
                     </div>
                  </a>
                  <a href="{{route('client_income_step2')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab4_percentage_by_steps'], 2) }}">
                     <div class="section-item">
                        <div class="icon-circle text-white">
                           <span class="section-icon">&#x1F4B0;</span>
                        </div>
                        <small class="fw-bold d-block">{{\App\Helpers\ArrayHelper::getClientName( $client_id, "Debtor", true)}} Income</small>
                     </div>
                  </a>
                  @php
                   if ($client_type == 2 || $client_type == 3) {
                       $spouseText = $client_type == 2 ?
                          \App\Helpers\ArrayHelper::getCoDebtorName($client_id, 'Non-Filing Spouse', true) :
                          \App\Helpers\ArrayHelper::getCoDebtorName($client_id, 'Co-Debtor', true);
                       @endphp
                     <a href="{{route('client_income_step1')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab4_percentage_by_steps'], 3) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F464;</span>
                           </div>
                           <small class="fw-bold d-block">{{ $spouseText }} Employer Info</small>
                        </div>
                     </a>
                     <a href="{{route('client_income_step3')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab4_percentage_by_steps'], 4) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4B0;</span>
                           </div>
                           <small class="fw-bold d-block">{{ $spouseText }} Income</small>
                        </div>
                     </a>
                  @php } @endphp
               </div>

               <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
            </div>
         </div>
      </div>
      @if ($authUser->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $authUser->hide_questionnaire == 0)
         <!-- Expense Section -->
         <div class="progress-section ">
            <div class="card progress-card border-0">
               <div class="card-body border-0 pt-3">
                  <a href="{{route('client_expenses')}}">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 card-label">
                           <span style="margin-right: 8px;">&#x1F3E0;</span>
                           Household Expenses
                        </h6>
                        <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab5_percentage'] }}; color:{{ $progressbartextcolor['tab5_percentage'] }} !important;">{{ ($progress['tab5_percentage'] == 100) ? '✓ Completed' : $progress['tab5_percentage'] . '% Complete' }}</span>
                     </div>
                     <div class="progress progress-bar-custom position-unset mb-3 w-100">
                        <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab5_percentage'] }}; width: {{ $progress['tab5_percentage'] }}%"></div>
                     </div>
                  </a>

                  <div class="section-grid">
                     <a href="{{route('client_expenses')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab5_percentage_by_steps'], 1) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F3D8;&#xFE0F;</span>
                           </div>
                           <small class="fw-bold d-block">Current Household Expenses</small>
                        </div>
                     </a>
                     @if ($showSpouseExpense)
                        <a href="{{route('client_spouse_expenses')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab5_percentage_by_steps'], 2) }}">
                           <div class="section-item">
                              <div class="icon-circle text-white">
                                 <span class="section-icon">&#x1F469;</span>
                              </div>
                              <small class="fw-bold d-block">{{ ($client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) ? "Non-Filing Spouse's Expenses Separate Household" : "Spousal Expenses Separate Household" }}</small>
                           </div>
                        </a>
                     @endif
                  </div>

                  <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
               </div>
            </div>
         </div>
         <!-- Financial Affairs Section -->
         <div class="progress-section ">
            <div class="card progress-card border-0">
               <div class="card-body border-0 pt-3">
                  <a href="{{route('client_financial_affairs')}}">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 card-label">
                           <span style="margin-right: 8px;">&#x1F4CA;</span>
                           Statement of Financial Affairs
                        </h6>
                        <span class="badge px-3 py-2 w-unset h-unset" style="background-color:{{ $progressbarcolor['tab6_percentage'] }}; color:{{ $progressbartextcolor['tab6_percentage'] }} !important;">{{ ($progress['tab6_percentage'] == 100) ? '✓ Completed' : $progress['tab6_percentage'] . '% Complete' }}</span>
                     </div>
                     <div class="progress progress-bar-custom position-unset mb-3 w-100">
                        <div class="progress-bar" style="background-color:{{ $progressbarcolor['tab6_percentage'] }}; width: {{ $progress['tab6_percentage'] }}%"></div>
                     </div>
                  </a>

                  <div class="section-grid">
                     <a href="{{route('client_financial_affairs')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab6_percentage_by_steps'], 1) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4C4;</span>
                           </div>
                           <small class="fw-bold d-block">Page 1</small>
                        </div>
                     </a>
                     <a href="{{route('client_financial_affairs2')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab6_percentage_by_steps'], 2) }}">
                        <div class="section-item">
                           <div class="icon-circle text-white">
                              <span class="section-icon">&#x1F4C4;</span>
                           </div>
                           <small class="fw-bold d-block">Page 2</small>
                        </div>
                     </a>
                     @if (\App\Models\ClientBasicInfoPartRest::hasAnyBussiness($client_id))
                        <a href="{{route('client_financial_affairs3')}}" class="sub-step {{ ArrayHelper::getPreDashboardSubStepProgressClass($progress['tab6_percentage_by_steps'], 3) }}">
                           <div class="section-item">
                              <div class="icon-circle text-white">
                                 <span class="section-icon">&#x1F4BC;</span>
                              </div>
                              <small class="fw-bold d-block">Business Info</small>
                           </div>
                        </a>
                     @endif
                  </div>

                  <small class="text-c-blue text-bold small-info-section">Tap to go to any section</small>
               </div>
            </div>
         </div>

      @endif

   </div>
</div>

@push('tab_scripts')
    <script>
        window.__leftNavigationRoutes = {
            clientFinalSubmit: "{{ route('client_final_submit', '_self') }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/left_navigation.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/left_navigation.css') }}">
@endpush