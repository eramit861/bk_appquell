@extends("layouts.admin")
@section('content')
@include("layouts.flash")

<?php
$trusteePopupRoute = route('list_trustee');
$divisionPopupRoute = route('list_divisions');
?>

<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card mb-0">
			<div class="card-header">
				<div class="search-list">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 pl-0">
								<h4>Property Api Requests</h4>
							</div>
							<div class="col-md-6">
								<div class="d-flex float_right">
									<div class="search-form">
										<form action="{{route('admin_property_request_index')}}" method="GET">
											<div class="input-group mb-0">
												<input type="text" name="q" value="{{@$keyword}}" class="form-control" placeholder="Search . . .">
												<button type="submit" class="nmp">
													<span class="input-group-append search-btn btn font-weight-bold border-blue">Search</span>
												</button>
											</div>
										</form>
									</div>
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
							<th>#</th>
							<th>Client ID</th>
							<th>Type</th>
							<th>Parameters</th>
							<th>Request Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@forelse($api_requests as $val)
						<?php
                        $parameter = $val['parameter'];
$parameterText = '';

if (!empty($parameter)) {
    $parameter = json_decode($parameter, true);
    if (is_array($parameter)) {
        $paramParts = [];
        foreach ($parameter as $key => $value) {
            $paramParts[] = ucfirst($key) . ': "' . $value . '"';
        }
        $parameterText = implode(', ', $paramParts);
    }
}

?>
						<tr>
							<td>{{ $loop->iteration + ($api_requests->currentPage() - 1) * $api_requests->perPage() }}</td>
							<td>{{ $val['client_id'] }}</td>
							<td>
								@if($val['type'] == 1)
								Residence
								@elseif($val['type'] == 2)
								Vehicle
								@else
								Unknown
								@endif
							</td>
							<td>
								{{ $parameterText ?? '' }}
							</td>
							<td>{{ $val['created_at'] }}</td>
							<td class="json-data" data-json="{{ $val['response'] ?? '' }}">
								<a href="#" class="label theme-bg text-white f-12 download-icon"><i class="bi bi-download" style="cursor: pointer;"></i> Download response</a>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="6" class="text-center">No Requests Found</td>
						</tr>
						@endforelse

					</tbody>
				</table>
			</div>
			<div class="pagination px-2">
				<?php if (!empty($api_requests)) { ?>
					{{ $api_requests->appends(['q' => $keyword])->links() }}
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	document.querySelectorAll('.download-icon').forEach(icon => {
		icon.addEventListener('click', function() {
			// Get the JSON from the data-json attribute of the parent td
			const jsonData = this.closest('.json-data').dataset.json;

			try {
				// Parse the JSON (this also validates it)
				const parsedJson = JSON.parse(jsonData);
				const formattedJson = JSON.stringify(parsedJson, null, 2); // Pretty-print

				// Create a Blob (file-like object)
				const blob = new Blob([formattedJson], {
					type: 'text/plain'
				});

				// Create a temporary download link
				const url = URL.createObjectURL(blob);
				const a = document.createElement('a');
				a.href = url;
				a.download = 'response.txt'; // File name

				// Trigger download
				document.body.appendChild(a);
				a.click();

				// Clean up
				document.body.removeChild(a);
				URL.revokeObjectURL(url);
			} catch (e) {
				console.error('Invalid JSON:', e);
				alert('Error: Invalid JSON data');
			}
		});
	});
</script>
<!--[ Recent Users ] end-->
@endsection