@extends("layouts.admin") @section('content') @include("layouts.flash") <?php


?> <div class="row">
  <!--[ Recent Users ] start-->
  <div class="col-xl-12 col-md-12">
    <div class="card attorney-listing">
      <div class="card-header">
        <div class="search-list">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8 pl-0">
                <h4>Atty Quest. Reports</h4>
              </div>
              <div class="col-md-4 d-flex"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-block px-0 py-0">
        <form action="{{route('admin_reports')}}" id="settings_form" method="GET" novalidate>
          <div class="row mb-3">
            <div class="col-sm-2">
              <div class="form-group mb-0">
                <div class=" form-floating ">
                  <input type="date" name="fromDate" class="form-control bg-white w-auto" value="<?php echo $fromDate;?>">
                  <label for="fromDate">From:</label>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group mb-0">
                <div class=" form-floating ">
                  <input type="date" name="toDate" class="form-control bg-white w-auto" value="<?php echo $toDate;?>">
                  <label for="toDate">To:</label>
                </div>
              </div>
            </div> <?php if (!empty($all_attorney) && count($all_attorney) > 0) { ?> 
              <div class="col-md-3">
              <div class="form-group mb-0">
                <div class=" form-floating ">
                  <select class="form-control bg-white w-100" onchange="this.form.submit()" name="allAttorney"> <?php foreach ($all_attorney as $key => $data) { ?> <option value="
													<?php echo $key; ?>" <?php if (!empty($selectedAttorney) && $selectedAttorney == $key) {
													    echo 'selected';
													}?>> <?php echo $data; ?> </option> <?php  } ?> </select>
                  <label for="allAttorney">Choose Attorney:</label>
                </div>
              </div>
            </div> <?php  } ?> 
            <div class="col-md-2">
              <button type="submit" class="btn btn-theme-black">Submit</button>
            </div>
        </form>
	  <div class="col-md-3">
		<form action="{{route('admin_reports')}}" id="settings_form" method="POST" novalidate>
			@csrf
			<input type="hidden" name="export" value="1" />
			<input type="hidden" name="fromDate" value="{{$fromDate}}" />
			<input type="hidden" name="toDate" value="{{$toDate}}" />
			<input type="hidden" name="allAttorney" value="{{$selectedAttorney}}" />
			<button type="submit" class="btn btn-theme-black">Export report</button>
		</form>
	  </div>
  
      </div>
     
      <div class="card-block px-0 py-0">
        <div class="row">
          
          <div class="col-md-2 mt-4"><h4 class="fs-16px font-weight-bold text-c-light-blue">Total Questionnaire: {{@array_sum(array_column($listdata['summary']['grouped_packages'],'count'))??0}}</h4></div>
          <div class="col-md-2 mt-4"><h4 class="fs-16px font-weight-bold text-c-gray">Standard Questionnaire: {{@$listdata['summary']['grouped_packages'][\App\Models\AttorneySubscription::BASIC_SUBSCRIPTION]['count']??0}}</h4></div>
          <div class="col-md-3 mt-4"><h4 class="fs-16px font-weight-bold text-c-blue">Premium Plus Questionnaire: {{@$listdata['summary']['grouped_packages'][\App\Models\AttorneySubscription::PREMIUM_PLUS_SUBSCRIPTION]['count']??0}}</h4></div>
          <div class="col-md-2 mt-4"><h4 class="fs-16px font-weight-bold text-c-black">Ultimate Questionnaire: {{@$listdata['summary']['grouped_packages'][\App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION]['count']??0}}</h4></div>
          <div class="col-md-3 mt-4"><h4 class="fs-16px font-weight-bold text-c-green">Total Revenue For Time Period: ${{@$listdata['summary']['total_price']}}</h4></div>
        </div>
    </div>
      <div class="card-block px-0 py-0">
        <div class="table-responsive max-table">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Attorney</th>
                <th>{{ __('Questionnaire type/add-on') }}</th>
                <th class="text-left">Transaction Details</th>
                <th># Units</th>
                <th>Payment Details</th>
              </tr>
            </thead>
            <tbody>
     
			@if(!empty($listdata['transactions']))
			@foreach($listdata['transactions'] as $transaction)

      @php
            $class = "text-c-black";
            $class = $transaction['package_id'] ==100 ? "text-c-gray font-weight-bold" : $class;
            $class = $transaction['package_id'] ==121 ? "text-c-blue font-weight-bold" : $class;
            $class = $transaction['package_id'] ==135 ? "text-c-black font-weight-bold" : $class;
        @endphp
    <tr>
        <td>{{ $transaction['attorney'] }}</td>
        <td class="{{@$class}}">{{ $transaction['questionnaire_type'] }}</td>
        <td>
            <a href="{{ route('attorney_form_submission_view', ['id' => $transaction['transaction_details']['client_id']]) }}">
                {{ $transaction['transaction_details']['client_name'] }} (Client ID: {{ $transaction['transaction_details']['client_id'] }})
            </a>
            <br>Status: <span class="text-c-green">{{ $transaction['transaction_details']['status'] }}</span>
            <br>Transaction Time: <strong>{{ $transaction['transaction_details']['transaction_time'] }}</strong>
        </td>
        <td>{{ $transaction['units'] }}</td>
        <td>
            Total Amount: ${{ $transaction['payment_details']['total_amount'] }}
            <br>Discount: ${{ $transaction['payment_details']['discount'] }}
            <br>Amount Paid: <strong>${{ $transaction['payment_details']['amount_paid'] }}</strong>
        </td>
    </tr>
@endforeach
@endif

@if(empty($listdata['transactions']))
<tr><td class="text-center" colspan='5'>No record found</td></tr>

@endif
@if(!empty($listdata['transactions']))
		<tr class="summary-row">
			<td colspan="3"><h4>Summary</h4></td>
      
			<td>Total Units: {{ $listdata['summary']['total_units'] }}</td>
			<td>Total Price: ${{ $listdata['summary']['total_price'] }}</td>
		</tr>
		@endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--[ Recent Users ] end-->
</div>
<script>
  $(document).ready(function() {
    $("#report_form").validate({
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
<style>
  label.error {
    color: red;
  }

  .max-table {
    max-height: 980px
  }

  .summary-row {
    background-color: #012cae;
  }

  .summary-row:hover {
    background-color: #012cae !important;
  }

  .summary-row td,.summary-row h4 {
    color: #fff !important;
    font-weight: bold;
  }

  .summary-row li {
    color: #fff;
    list-style: none;
    margin: 0px;
    padding: 0px
  }

  .summary-row ul {
    padding: 0px;
  }
</style>
<!-- [ Main Content ] end --> @endsection