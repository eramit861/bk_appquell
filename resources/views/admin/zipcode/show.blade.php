@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			<div class="card-header">
				

			<div class="search-list">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-10 pl-0">
                        <h4>Search Zip Codes By Districts & Divisions</h4>
                     </div>
                     <div class="col-md-2">
						<div class=" float_right">
							<a href="{{route('admin_zipcode_create')}}" class="m-l-30 btn font-weight-bold border-blue f-12">
								<i class="feather icon-plus"></i> 
								<span class="card-title-text">Add</span>
							</a>
						</div>
                     </div>
                  </div>
               </div>
            </div>
			</div>
			<div class="card-block px-0 py-0">
                
				<div class="row">
					<!--[ Recent Users ] start-->
					<div class="col-xl-12 col-md-12">
						<div class="card listing-card">
							<div class="card-block">
								<form action="{{route('admin_zipcode_store')}}" method="post">
									@csrf
									<div class="container">
				
										<div class="form-group">
											<label>District Name</label>
											<select class="form-control" id="district_name">
												<option value=""> Select District Name </option>
												@foreach ($district_names as $district_name)
												<option value="{{$district_name->id}}">{{$district_name->district_name}}</option>
												@endforeach
											</select>
										</div>
				
										<div class="form-group">
											<label>Division Name</label>
											<select class="form-control" id="division_name">
												
											</select>
										</div>
				
										
				
										<div class="form-group"  id="zip_code_div">
										
										</div>
										<div id="div_btn">
										
										</div>
										<br><br>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--[ Recent Users ] end-->
				</div>
				
				
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->

</div>


<!-- [ Main Content ] end -->
@endsection