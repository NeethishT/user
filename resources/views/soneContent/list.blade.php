@extends('layouts.dashboard')

@section('title') Shriram-One Content @endsection
@section('page_pre_title') Shriram-One Content @endsection
@section('page_title') Shriram-One Content @endsection
@section('header_actions')
<div class="col-12 col-md-auto ms-auto d-print-none">
	<div class="btn-list">
		{!! Form::open(['url' => route('cms.sone.content.list'),'method'=>'get']) !!}
			<div class="row"> 
				<div class="col input-group input-icon product-search-fields">
		            {!! Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'placeholder' => 'Enter name to search...']) !!}
		            <button class="btn" type="submit"><i class="ti ti-search icon"></i></button>
		        </div>
		    </div>
	    {!! Form::close() !!}
	    @php $rolePermission = getPermissions(); @endphp
        @if(in_array('cms.sone.content.add',$rolePermission))
			<a href="{{ route('cms.sone.content.add') }}" class="btn btn-warning d-none d-sm-inline-block">
				<i class="ti ti-plus icon"></i> Create Shriram-One Content
			</a>
			<a href="{{ route('cms.sone.content.add') }}" class="btn btn-warning d-sm-none btn-icon"  aria-label="Create Shriram-One Content">
				<i class="ti ti-plus icon"></i>
		    </a>
		@endif
	</div>
</div>
@endsection

@section('content')
<div class="col-12">
	@if($list->count() > 0)
		<div class="card">
			<div class="table-responsive">
				<table class="table card-table table-vcenter table-striped">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Slug</th>
							<th>Content</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Updated At</th>
							<th>Auction</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($list as $key=>$row)
							<tr>
								<td>{{$list->firstItem() + $key}} </td>
								<td class="text-muted">{{ empty($row->slug) === false ? $row->slug : 'NULL' }}</td>
								<?php $content = empty($row->content) === false ? $row->content : ''; ?>
								<td class="expand-row-json" data-bs-toggle="modal" data-bs-target="#getViewDataModel">
									<?php echo mb_strimwidth(htmlspecialchars($content),0,20,"..");?>
									<span class="expand_content hide"><pre><?php echo $content; ?></pre></span></a></td>
								<td class="text-muted">
									@if($row->is_active)
										<span class="badge bg-teal">Active</span>
									@else
										<span class="badge bg-red">In-active</span>
									@endif
								</td>
								<td>{{ $row->created_at->format('Y-m-d h:i:s') }}</td>
								<td>{{ $row->updated_at->format('Y-m-d h:i:s') }}</td>
								<td> 
									<div class="btn-list flex-nowrap">
										<div class="dropdown">
											<button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"> 
												<i class="ti ti-settings icon"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end">
												@if(in_array('cms.sone.content.edit',$rolePermission))
												<a class="dropdown-item" href="/sone-content/edit/{{$row->_id}}">
													<i class="ti ti-edit icon"></i> Edit
												</a>
												@endif
												@if(in_array('cms.sone.content.status',$rolePermission))
													@if($row->is_active)
														<a href="{{ route('cms.sone.content.status', ['id' => $row->id, 'type' => 'inactive']) }}" class="dropdown-item confirmation-link">
															<i class="ti ti-x icon"></i> In-Active
														</a>
													@else
														<a href="{{ route('cms.sone.content.status', ['id' => $row->id, 'type' => 'active']) }}" class="dropdown-item confirmation-link">
															<i class="ti ti-check icon"></i> Active
														</a>
													@endif
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
			{{ $list->appends(['users'=>$list])->links() }}
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
							<h4 class="alert-title">You haven't added Shriram-One Content yet.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	<div class="modal fade view_permission" id="getViewDataModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <pre id ="modal-popup-content">Modal body text goes here.</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
