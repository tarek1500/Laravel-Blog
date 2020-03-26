@extends('layout.app')

@section('content')
	<div class="card mb-3">
		<div class="card-body">
			<h5 class="card-title">Post Info</h5>
			<p class="card-text"><strong>Title: </strong>{{ $post->title }}</p>
			<p class="card-text"><strong>Description: </strong>{{ $post->description }}</p>
			<p class="card-text"><strong>Created at: </strong>{{ \Carbon\Carbon::instance($post->created_at)->format('l jS \\of F Y h:i:s A') }}</p>
			<p class="card-text">{{ $post->human_readable_date }}</p>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Post Creator Info</h5>
			<p class="card-text"><strong>Name: </strong>{{ $post->user->name }}</p>
			<p class="card-text"><strong>Email: </strong>{{ $post->user->email }}</p>
		</div>
	</div>
@endsection