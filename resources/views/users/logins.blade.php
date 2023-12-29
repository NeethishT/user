@extends('layouts.dashboard')

@section('title') CMS User - {{ $user->name }} Login History @endsection
@section('page_pre_title') Overview @endsection
@section('page_title') CMS User - {{ $user->name }} Login History @endsection

@section('header_actions')
<div class="col-12 col-md-auto ms-auto d-print-none">
	<div class="btn-list">
	    @role('super-admin')
			<a href="{{ route('cms.users.list') }}" class="btn btn-warning d-none d-sm-inline-block">
				<i class="ti ti-arrow-left icon"></i> Back 
			</a>
			<a href="{{ route('cms.users.list') }}" class="btn btn-warning d-sm-none btn-icon"  aria-label="Create new product">
				<i class="ti ti-arrow-left icon"></i>
		    </a>
		@endrole
	</div>
</div>
@endsection

@section('content')
<div class="col-12">
	@if($userLogins->count() > 0)
		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter card-table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>IP</th>
							<th>Browser</th>
							<th>Device</th>
							<th>Platform</th>
							<th>version</th>
							<th>Created On</th>
							<th>Updated On</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($userLogins as $login)
							<tr>
								<td>{{ $login->id }}</td>
								<td class="text-muted">{{ $login->ip }}</td>
								<td class="text-muted">{{ $login->browser }}</td>
								<td class="text-muted">{{ $login->device }}</td>
								<td class="text-muted">{{ $login->platform }}</td>
								<td class="text-muted">{{ $login->version }}</td>
								<td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
								<td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>		
							</tr>
						@endforeach						
					</tbody>
				</table>
			</div>	
			<div class="card-footer">				
				{!! $userLogins->links() !!}	
			</div>
		</div>
	@else
		<div class="card">		
			<div class="card-body">				
				<div class="alert alert-warning alert-dismissible" role="alert">
					<div class="d-flex">
						<div>
							<i class="ti ti-alert-triangle icon alert-icon"></i>
						</div>
						<div>
							<h4 class="alert-title">No login history found.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection