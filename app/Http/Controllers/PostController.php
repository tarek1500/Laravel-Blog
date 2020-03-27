<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\User;

class PostController extends Controller
{
	public function index()
	{
		$posts = Post::all();

		return view('posts.index', [
			'posts' => $posts
		]);
	}

	public function create()
	{
		$users = User::all();

		return view('posts.create', [
			'users' => $users
		]);
	}

	public function store(StorePostRequest $request)
	{
		$data = $request->only(['title', 'description', 'user_id']);

		Post::create($data);

		return redirect()->route('posts.index');
	}

	public function show(Post $post)
	{
		return view('posts.show', [
			'post' => $post
		]);
	}

	public function edit(Post $post)
	{
		$users = User::all();

		return view('posts.edit', [
			'post' => $post,
			'users' => $users
		]);
	}

	public function update(UpdatePostRequest $request, Post $post)
	{
		$data = $request->only(['title', 'description', 'user_id']);

		$post->update($data);

		return redirect()->route('posts.index');
	}

	public function destroy(Post $post)
	{
		$post->delete();

		return redirect()->route('posts.index');
	}
}