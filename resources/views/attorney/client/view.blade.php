@extends("layouts.attorney")
@section('content')
@include("layouts.flash")
<div class="row">
	<?php
    $val = $User;
	?>
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
			@include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type])
			</div>
			<div class="card-block px-0 py-0">
				<div class="container ">
					
				</div>					
			</div>
		</div>

	<!--[ Recent Users ] end-->
</div>
<!-- [ Main Content ] end -->
@endsection