@extends('layouts.app')

@section('content')
	<a class="btn btn-success" href="{{ route('posts.create') }}" role="button">Create</a>
	<table class="table mt-2">
		<thead>
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Title</th>
				<th scope="col">Slug</th>
				<th scope="col">Posted by</th>
				<th scope="col">Created at</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posts as $post)
				<tr>
					<th scope="row">{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>{{ $post->slug }}</td>
					<td>{{ $post->user->name }}</td>
					<td>{{ \Carbon\Carbon::instance($post->created_at)->format('Y-m-d') }}</td>
					<td>
						<div class="btn-group" role="group">
							<a class="btn btn-info" href="{{ route('posts.show', $post->id) }}" role="button">View</a>
							<a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}" role="button">Edit</a>
							<a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#delete-modal-{{ $post->id }}">Delete</a>
						</div>
						<div class="modal fade" id="delete-modal-{{ $post->id }}" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="POST" action="{{ route('posts.destroy', $post->id) }}">
										@csrf
										@method('DELETE')
										<div class="modal-header">
											<h5 class="modal-title">Delete Post #{{ $post->id }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											Are you sure you want to delete this post? <br>
											<strong>{{ $post->title }}</strong>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-danger">Delete</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection