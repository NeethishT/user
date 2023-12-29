@extends('layouts.dashboard')

@section('title') Edit CMS User @endsection
@section('page_pre_title')  @endsection
@section('page_title') Edit CMS User @endsection

@section('content')
<div class="col-md-8">
	<div class="card">
		<div class="card-body">
			{!! Form::open(['url' => route('cms.users.edit', ['token' => $user->token])]) !!}
				<div class="form-group ">
					{!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('name'))
                        <div class="text-danger">
                            <p>{{ $errors->first('name') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-group mt-2">
					{!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
					<div>
						{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('email'))
                        <div class="text-danger">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif
                    {!! Form::hidden('id', $user->id) !!}
				</div>

				<div class="form-group mt-2">
					{!! Form::label('username', 'Username', ['class' => 'form-label']) !!}
					<div>
						{!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('username'))
                        <div class="text-danger">
                            <p>{{ $errors->first('username') }}</p>
                        </div>
                    @endif
                    {!! Form::hidden('id', $user->id) !!}
				</div>


				<div class="form-group mt-2">
					{!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::password('password', ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('password'))
                        <div class="text-danger">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-group mt-2">
					{!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
					</div>
					@if ($errors->has('password_confirmation'))
                        <div class="text-danger">
                            <p>{{ $errors->first('password_confirmation') }}</p>
                        </div>
                    @endif
				</div>
				<div class="form-group mt-2">
					{!! Form::label('roles', 'Roles', ['class' => 'form-label']) !!}
					<div class="row mt-2 v-scroll">
						@if(empty($roles) == false && $roles->count() > 0)
							@foreach($roles as $role)
								<label class="form-check col-4">
		                            <input type="checkbox" name="roles[]" @if(in_array($role->id, $selectedRoles)) checked @endif class="form-check-input" value="{{ $role->id }}" />
		                            <span class="form-check-label">{{ $role->name }}</span>
		                            <span class="form-check-description">{{ $role->description }}</span>
		                        </label>
		                    @endforeach
	                    @endif						
					</div>
                    @if ($errors->has('roles'))
                        <div class="text-danger">
                            <p>{{ $errors->first('roles') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-footer">
					<a class="btn btn-light" href="{{ route('cms.users.list') }}">Cancel</a> 
					{!! Form::submit('Save', ['class' => 'btn btn-warning']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection