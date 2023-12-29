@extends('layouts.dashboard')

@section('title') CMS Roles @endsection
@section('page_pre_title') Overview @endsection
@section('page_title') CMS Roles @endsection

@section('header_actions')
<div class="col-12 col-md-auto ms-auto d-print-none">
	<div class="btn-list">
		{!! Form::open(['url' => route('cms.roles.search')]) !!}
			<div class="row"> 
				<div class="col input-group input-icon product-search-fields">
		            {!! Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'placeholder' => 'Enter name to search...']) !!}
		            <button class="btn" type="submit"><i class="ti ti-search icon"></i></button>
		        </div>
		    </div>
	    {!! Form::close() !!}
	    @php $rolePermission = getPermissions(); @endphp
			<a href="{{ route('cms.roles.add') }}" class="btn btn-warning d-none d-sm-inline-block">
				<i class="ti ti-plus icon"></i> Create New Role 
			</a>
			<a href="{{ route('cms.roles.add') }}" class="btn btn-warning d-sm-none btn-icon"  aria-label="Create new product">
				<i class="ti ti-plus icon"></i>
		    </a>
	</div>
</div>
@endsection

@section('content')
<div class="col-12">
	@if($roles->count() > 0)
		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter card-table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th style="width:25%">Description</th>
							<th>Status</th>
							<th>Slug</th>
							<th style="width:25%">Permissions</th>
							<th>Created On</th>
							<th>Updated On</th>
							<th class="w-1">Action</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($roles as $role)
							<tr>
								<td>{{ $role->id }}</td>
								<td class="text-muted">{{ $role->name }}</td>
								<td class="text-muted">{{ $role->description }}</td>
								<td class="text-muted">
									@if($role->is_active)
										<span class="badge bg-teal">Active</span>
									@else
										<span class="badge bg-red">In-active</span>
									@endif
								</td>
								<td class="text-muted">
									{{ $role->slug }}
								</td>
								<td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewPermission{{$role->id}}">View Permissions</button>
								</td>
								
								<td>{{ $role->created_at->format('Y-m-d h:i:s') }}</td>
								<td>{{ $role->updated_at->format('Y-m-d h:i:s') }}</td>
								<td> 
									<div class="btn-list flex-nowrap">
										<div class="dropdown">
											<button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"> 
												<i class="ti ti-settings icon"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end"> 
												@if(in_array('cms.roles.status',$rolePermission))
												@if($role->is_active)
													<a href="{{ route('cms.roles.status', ['slug' => $role->slug, 'type' => 'inactive']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-x icon"></i> In-Active
													</a>
												@else
													<a href="{{ route('cms.roles.status', ['slug' => $role->slug, 'type' => 'active']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-check icon"></i> Active
													</a>
												@endif
												@endif

												
												<a href="{{ route('cms.roles.edit', ['slug' => $role->slug]) }}" class="dropdown-item">
													<i class="ti ti-edit icon"></i> Edit
												</a>

												@if(in_array('cms.roles.delete',$rolePermission))
												<a href="{{ route('cms.roles.delete', ['slug' => $role->slug]) }}" class="dropdown-item confirmation-link">
													<i class="ti ti-trash icon"></i> Delete
												</a>
												@endif
									        </div>
										</div>
									</div>
								</td>
							</tr>
							<!-- Modal -->
							<div class="modal fade view_permission" id="viewPermission{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog modal-lg">
							        <div class="modal-content">
							            <div class="modal-header">
							                <h5 class="modal-title" id="exampleModalLabel">Permissions</h5>
							                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							            </div>
							            <div class="modal-body">
								            @if(empty($role->permissions) === false)
												<ul>
													@foreach($role->permissions as $permission)
														<li>
															{{{ $permission->name }}}
														</li>
													@endforeach
												</ul>
											@endif
										</div>
							        </div>
							    </div>
							</div>
						@endforeach						
					</tbody>
				</table>
			</div>	
			<div class="card-footer">				
				{!! $roles->links() !!}	
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
							<h4 class="alert-title">You haven't added roles yet.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection