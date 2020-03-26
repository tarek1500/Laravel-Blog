@extends('layout.app')

@section('content')
	<form method="POST" action="{{ route('posts.store') }}">
		@csrf
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="3"></textarea>
		</div>
		<div class="form-group">
			<select class="custom-select" name="user">
				@foreach ($users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-success">Submit</button>
	</form>
@endsection