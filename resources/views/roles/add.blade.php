@extends('layouts.dashboard')

@section('title') Create New Role @endsection
@section('page_pre_title')  @endsection
@section('page_title') Create New Role @endsection

@section('content')
<div class="col-md-8">
	<div class="card">
		<div class="card-body">
			{!! Form::open(['url' => route('cms.roles.add')]) !!}
				<div class="form-group ">
					{!! Form::label('name', 'Role Name', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
						<small class="form-hint">You have to specify the role name like manager or lead etc..</small>
					</div>
					@if ($errors->has('name'))
                        <div class="text-danger">
                            <p>{{ $errors->first('name') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-group mt-2">
					{!! Form::label('description', 'Role Description', ['class' => 'form-label']) !!}
					<div>
						{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
						<small class="form-hint">Maximum character length of 250..</small>
					</div>
					@if ($errors->has('description'))
                        <div class="text-danger">
                            <p>{{ $errors->first('description') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-group mt-2">
					{!! Form::label('slug', 'Role Slug', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::text('slug', null, ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('slug'))
                        <div class="text-danger">
                            <p>{{ $errors->first('slug') }}</p>
                        </div>
                    @endif
				</div>

				<div>
					<label class="form-check col-4">
						<input type="checkbox" id="select-all" class="form-check-input select-all"> Check All / Reset All
					</label>
				</div>
				
				<div class="form-group mt-2">
					{!! Form::label('permissions', 'Permissions', ['class' => 'form-label']) !!}
					<ul class="tree" id="tree">
						<input type="checkbox" id="select-all" class="form-check-input select-all"> Check All / Reset All
						<div class="row mt-2 v-scroll">
							@foreach($permissions as $key => $valueDatas)
								<li class="li-text-bold">
									<input type="checkbox" class="form-check-input"> {{ $key }}
									<ul class="ul-remove-bullets">
										<li class="li-text-name">
											@foreach($valueDatas as $permission)
												<label class="form-check mt-2 li-label-horizontal-align">
													<input type="checkbox" name="permissions[]" class="form-check-input" value="{{ $permission['id'] }}" />
													<span type="checkbox" class="form-check-label">{{ $permission['name'] }}</span>
													<span type="checkbox" class="form-check-description">{{ $permission['description'] }}</span>
												</label>
											@endforeach
										</li>
									</ul><hr>
								</li>
							@endforeach
						</div>
					</ul>
				</div>

				<div class="form-footer">
					<a class="btn btn-light" href="{{ route('cms.roles.list') }}">Cancel</a> 
					{!! Form::submit('Save', ['class' => 'btn btn-warning']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection