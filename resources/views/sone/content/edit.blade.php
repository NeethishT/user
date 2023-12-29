@extends('layouts.dashboard')

@section('title') Edit Shriram-One Content @endsection
@section('page_pre_title')  @endsection
@section('page_title') Edit Shriram-One Content @endsection

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			{!! Form::open(['url' => route('cms.sone.content.update',['id'=>$data->_id])]) !!}
				<div class="form-group ">
					{!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
					<div> 
						{!! Form::text('slug', $data->slug, ['class' => 'form-control', 'disabled'=>'true']) !!}
					</div>
					@if ($errors->has('slug'))
                        <div class="text-danger">
                            <p>{{ $errors->first('slug') }}</p>
                        </div>
                    @endif
				</div>

				<div class="form-group mt-2">
					{!! Form::label('content', 'Content', ['class' => 'form-label']) !!}
					<div>
						{!! Form::textarea('content', $content, ['class' => 'form-control', 'rows'=> '25']) !!}
					</div>
					@if ($errors->has('content'))
                        <div class="text-danger">
                            <p>{{ $errors->first('content') }}</p>
                        </div>
                    @endif
				</div>
                <div class="mb-3">
                    <div class="form-label"></div>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" @if($data->is_active === 1)  ? checked : "" @endif name="is_active">
                        <span class="form-check-label">Is Active</span>
                    </label>
                </div>
				<div class="form-footer">
					<a class="btn btn-light" href="{{ route('cms.sone.content.list') }}">Cancel</a> 
					{!! Form::submit('Save', ['class' => 'btn btn-warning']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection