@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")
<!-- [ Main Content ] start -->
 <div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
	<div class="card listing-card">
		<div class="card-header border-bottom-none">

			

				<div class="search-list">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8 pl-0">
							<h4>{{ __('Transactions') }}</h4>
						</div>
						<div class="col-md-4">
							<div class="search-form">
							<form action="{{route('notification_template_list')}}" method="GET">
								<div class="input-group">
									<input type="text" name="q" class="form-control" value="{{@$keyword}}" placeholder="{{ __('Search . . .') }}">
									<button type="submit" class="nmp">
									<span class="input-group-append search-btn btn font-weight-bold border-blue-big">{{ __('Search') }}</span>
									</button>
								</div>
							</form>
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
								<th>Template Name</th>
								<th>Subject</th> 
								<th>Body</th> 
								<th>Created On</th> 
							</tr>
						</thead>
						
						</tbody>
					</table>
				</div>
				<div class="pagination px-2">
					<?php if (!empty($attorney_transactions) && count($attorney_transactions) > 0) {?>
					{{ $attorney_transactions->links() }}
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<!--[ Recent Users ] end-->

</div>
@endsection
