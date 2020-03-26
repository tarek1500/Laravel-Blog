@extends('layout.app')

@section('content')
	<form method="POST" action="{{ route('posts.update', $post->id) }}">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="3">{{ $post->description }}</textarea>
		</div>
		<div class="form-group">
			<select class="custom-select" name="user">
				@foreach ($users as $user)
					@if ($post->user == $user)
						<option value="{{ $user->id }}" selected>{{ $user->name }}</option>
					@else
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endif
					
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection