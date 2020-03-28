@extends('layouts.app')

@section('content')
	<div class="card" style="width: 18rem;">
		<img src="{{ $user->getAvatar() }}" class="card-img-top" alt="logo">
		<div class="card-body">
			<h5 class="card-title">GitHub User Info</h5>
			<p class="card-text"><strong>Name: </strong>{{ $user->getName() }}</p>
			<p class="card-text"><strong>Nickname: </strong>{{ $user->getNickname() }}</p>
			<p class="card-text"><strong>Email: </strong>{{ $user->getEmail() }}</p>
		</div>
	</div>
@endsection