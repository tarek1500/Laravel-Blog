@extends('layouts.app')

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('posts.store') }}">
		@csrf
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
		</div>
		<div class="form-group">
			<select class="custom-select" name="user_id">
				@foreach ($users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-success">Submit</button>
	</form>
@endsection