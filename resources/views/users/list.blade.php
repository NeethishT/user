@extends('layouts.dashboard')

@section('title') CMS Users @endsection
@section('page_pre_title') Overview @endsection
@section('page_title') CMS Users @endsection
@section('header_actions')
<div class="col-12 col-md-auto ms-auto d-print-none">
	<div class="btn-list">
		{!! Form::open(['url' => route('cms.users.search')]) !!}
			<div class="row"> 
				<div class="col input-group input-icon product-search-fields">
		            {!! Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'placeholder' => 'Enter name to search...']) !!}
		            <button class="btn" type="submit"><i class="ti ti-search icon"></i></button>
		        </div>
		    </div>
	    {!! Form::close() !!}
	    @php $rolePermission = getPermissions(); @endphp
        @if(in_array('cms.users.add',$rolePermission))
			<a href="{{ route('cms.users.add') }}" class="btn btn-warning d-none d-sm-inline-block">
				<i class="ti ti-plus icon"></i> Create New User 
			</a>
			<a href="{{ route('cms.users.add') }}" class="btn btn-warning d-sm-none btn-icon"  aria-label="Create new product">
				<i class="ti ti-plus icon"></i>
		    </a>
		@endif
	</div>
</div>
@endsection

@section('content')
<div class="col-12">
	@if($users->count() > 0)
		<div class="card">
			<div class="table-responsive">
				<table class="table card-table table-vcenter table-striped">
					<thead>
						<tr>
							<th>S.No</th>
							<th>ID</th>
							<th>Name</th>
							<th>E-Mail</th>
							<th>Status</th>
							<th>Roles</th>
							<th>Last Login</th>
							<th>Created On</th>
							<th>Updated On</th>
							<th class="w-1">Action</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($users as $key=>$user)
							<tr>
								<td>{{$users->firstItem() + $key}} </td>
								<td>{{ $user->id }}</td>
								<td class="text-muted">{{ $user->name }}</td>
								<td class="text-muted">{{ $user->email }}</td>
								<td class="text-muted">
									@if($user->is_active)
										<span class="badge bg-teal">Active</span>
									@else
										<span class="badge bg-red">In-active</span>
									@endif
								</td>
								<td class="text-muted">
									@if(empty($user->roles) === false)
										<ul class="list-unstyled">
											@foreach($user->roles as $role)
												<li class="badge badge-secondary">{{{ $role->name }}}</li>
											@endforeach
										</ul>
									@endif
								</td>
								<td class="text-muted">
									@if(empty($user->last_login) == false)
										{{ $user->last_login->format('Y-m-d H:i:s') }}
									@endif
								</td>
								<td>{{ $user->created_at->format('Y-m-d h:i:s') }}</td>
								<td>{{ $user->updated_at->format('Y-m-d h:i:s') }}</td>
								<td> 
									<div class="btn-list flex-nowrap">
										<div class="dropdown">
											<button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"> 
												<i class="ti ti-settings icon"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end">
												@if(in_array('cms.users.edit',$rolePermission))
												<a class="dropdown-item" href="{{ route('cms.users.edit', ['token' => $user->token]) }}">
													<i class="ti ti-edit icon"></i> Edit
												</a>
												@endif
												
												@if(in_array('cms.users.status',$rolePermission))
												@if($user->is_active)
													<a href="{{ route('cms.users.status', ['token' => $user->token, 'type' => 'inactive']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-x icon"></i> In-Active
													</a>
												@else
													<a href="{{ route('cms.users.status', ['token' => $user->token, 'type' => 'active']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-check icon"></i> Active
													</a>
												@endif
												@endif

												@if(in_array('cms.users.logins',$rolePermission))
												<a class="dropdown-item" href="{{ route('cms.users.logins', ['token' => $user->token]) }}">
													<i class="ti ti-notes icon"></i> Login Audit Logs
												</a>
												@endif
									        </div>
										</div>
									</div>
								</td>
							</tr>
						@endforeach						
					</tbody>
				</table>
			</div>	
		<div class="card-footer d-flex align-items-center">
			{{ $users->appends(['users'=>$users])->links() }}
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
							<h4 class="alert-title">You haven't added users yet.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection