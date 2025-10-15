@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<style>
    h3{
        font-size: 20px !important;
    }
</style>

<!-- [ Main Content ] start -->
<form action="{{route('admin_means_test_settings')}}" method="post" aria-label="{{ __('Upload') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
	<div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">Median Income <a href="#"  onclick="getData('median_income')" style="font-size: 15px;">View Detail</a> </h3>

				<div class="row">
					<div class="col-12">
						<h4 class="f-w-500 m-b-0">
							<input type="file" name="medianIncome" class="form-control">
                        </h4>
					</div>
				</div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="text" name="additional_person_amount" class="form-control" placeholder="Additional Amount Per Person">
                        </h4>
                    </div>
                </div>

			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">National Expense <a href="#" onclick="getData('national_expense')"  style="font-size: 15px;">View Detail</a> </h3>

                <div class="row">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="file" name="nationalExpense" class="form-control">
                        </h4>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="text" name="AdditionalPersonCost" class="form-control" placeholder="Additional National Expense Amount Per Person">
                        </h4>
                    </div>
                </div>


			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">National OOP HealthCare <a href="#"  onclick="getData('national_oop_healthcare')" style="font-size: 15px;">View Detail</a> </h3>

                <div class="row">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="text" name="under_65" class="form-control" value="" placeholder="Under 65">

                        </h4>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="text" name="65_and_older" class="form-control" placeholder="65 and Above">

                        </h4>
                    </div>
                </div>

			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">Housing UTILS Standards (FIPS) <a href="#"   onclick="getData('mortgage')" style="font-size: 15px;">View Mortgage</a>
                    | <a href="#"   onclick="getData('non_mortgage')"  style="font-size: 15px;">View Non Mortgage</a></h3>

                <div class="row">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="file" name="housingUtilsFips" class="form-control">
                        </h4>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">Schedule of Actual Admins Expenses <a href="#"   onclick="getData('schedule_of_actual_admins_expenses')"   style="font-size: 15px;">View Detail</a> </h3>

                <div class="row">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="file" name="actualAdminExpense" class="form-control">

                        </h4>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <div class="col-md-6 col-xl-4">
		<div class="card dashboard-cards">
			<div class="card-block position-relative">
				<h3 class="mb-4">Transportation Expense Standards <a href="#"  onclick="getData('transportation')"  style="font-size: 15px;">View Detail</a> </h3>

                <div class="row">
                    <div class="col-12">
                        <h4 class="f-w-500 m-b-0">
                            <input type="file" name="actualTransportationExpense" class="form-control">

                        </h4>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
    <div class="row">
        <div>
            <button type="submit" class="btn btn-theme-black">Submit</button>
        </div>
    </div>
</form>
<style>
    .modal-xl {
        max-width: 80% !important;
    }
    #facebox .content.large-fb-width{
        max-width: 1700px;

    }
  
</style>
<script>
    getData = function (test_type) {
        ajaxurl = "<?php echo route('admin_means_test_settings_ajax'); ?>";
		laws.ajax(ajaxurl, { test_type:test_type}, function (response) {
        laws.updateFaceboxContent(response,'large-fb-width');
        });
    }
  
</script>


@endsection