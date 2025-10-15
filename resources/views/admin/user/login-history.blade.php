@extends("layouts.admin")
@section('content')
@include("layouts.flash")
<div class="row">
	<!--[ Recent Users ] start-->
	<div class="col-xl-12 col-md-12">
		<div class="card listing-card">
            <div class="card-header border-bottom-none">
            <div class="row align-items-center">
    <div class="col-xl-8 col-md-8">
        <h4><span class="border-bottom-light-blue pb-1">Login History</span></h4>
    </div>
    
    <div class="col-xl-4 col-md-4 pl-0">
        <form method="GET" action="{{ route('userLoginHistory') }}">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Search by client name" value="">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>


		<div class="card-block px-0 py-0 paystb">
			<div class="table-responsive px-2 mt-2">
				

				
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                    <th>Login Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userLoginHistory as $index => $history)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $history->user->name }}</td>
                        <td>{{ $history->user->role==\App\Models\USER::CLIENT ? 'Client' : 'Attorney'; }}</td>
                        <td>{{ $history->user->email }}</td>
                        <td>{{ $history->ip_address }}</td>
                        <td>{{ $history->user_agent }}</td>
                        <td>{{ $history->logged_in_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
			</div>
			<div class="pagination px-2">
            {{ $userLoginHistory->links() }}
			</div>
		</div>
	</div>
</div>
</div>
</div>

@endsection
