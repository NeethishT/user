@extends('layouts.dashboard')

@section('title') CMS Permissions @endsection
@section('page_pre_title') Overview @endsection
@section('page_title') CMS Permissions @endsection

@section('header_actions')
<div class="col-12 col-md-auto ms-auto d-print-none">
	<div class="btn-list">
		{!! Form::open(['url' => route('cms.permissions.search')]) !!}
			<div class="row"> 
				<div class="col input-group input-icon product-search-fields">
		            {!! Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'placeholder' => 'Enter name to search...']) !!}
		            <button class="btn" type="submit"><i class="ti ti-search icon"></i></button>
		        </div>
		    </div>
	    {!! Form::close() !!}
		@php $rolePermission = getPermissions(); @endphp
		@if(in_array('cms.permissions.migrate',$rolePermission))
			<div class="col-4">
				<a href="{{ route('cms.permissions.migrate') }}" class="btn btn-warning d-none d-sm-inline-block">
					<i class="ti ti-settings icon"></i> Migrate Permissions 
				</a>
			</div>
		@endif
	</div>
</div>
@endsection

@section('content')
<div class="col-12">
	@if($permissions->count() > 0)
		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter card-table table-striped">
					<thead>
						<tr>
							<th>S.no</th>
							<th>ID</th>
							<th>Name</th>
							<th style="width:25%">Description</th>
							<th>Status</th>
							<th>Slug</th>
							<th>Created On</th>
							<th>Updated On</th>
							<th class="w-1">Action</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($permissions as $key=>$permission)
							<tr>
								<td>{{$permissions->firstItem() + $key}} </td>
								<td>{{ $permission->id }}</td>
								<td class="text-muted">{{ $permission->name }}</td>
								<td class="text-muted">{{ $permission->description }}</td>
								<td class="text-muted">
									@if($permission->is_active)
										<span class="badge bg-teal">Active</span>
									@else
										<span class="badge bg-red">In-active</span>
									@endif
								</td>
								<td class="text-muted">
									{{ $permission->slug }}
								</td>
								<td>{{ $permission->created_at->format('Y-m-d h:i:s') }}</td>
								<td>{{ $permission->updated_at->format('Y-m-d h:i:s') }}</td>
								<td> 
									<div class="btn-list flex-nowrap">
										<div class="dropdown">
											<button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"> 
												<i class="ti ti-settings icon"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end"> 
												@if($permission->is_active)
													<a href="{{ route('cms.permissions.status', ['slug' => $permission->slug, 'type' => 'inactive']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-x icon"></i> In-Active
													</a>
												@else
													<a href="{{ route('cms.permissions.status', ['slug' => $permission->slug, 'type' => 'active']) }}" class="dropdown-item confirmation-link">
														<i class="ti ti-check icon"></i> Active
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
			<div class="card-footer">				
				{!! $permissions->links() !!}	
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
							<h4 class="alert-title">You haven't added permissions yet.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection