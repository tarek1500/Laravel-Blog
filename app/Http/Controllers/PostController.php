<?php

namespace App\Http\Controllers;

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

	public function store()
	{
		$request = request();

		Post::create([
			'title' => $request->title,
			'description' => $request->description,
			'user_id' => $request->user
		]);

		return redirect()->route('posts.index');
	}

	public function show()
	{
		$request = request();
		$id = $request->post;
		$post = Post::findOrFail($id);

		return view('posts.show', [
			'post' => $post
		]);
	}

	public function edit()
	{
		$request = request();
		$id = $request->post;
		$post = Post::findOrFail($id);
		$users = User::all();

		return view('posts.edit', [
			'post' => $post,
			'users' => $users
		]);
	}

	public function update()
	{
		$request = request();
		$id = $request->post;
		$post = Post::find($id);

		$post->title = $request->title;
		$post->description = $request->description;
		$post->user_id = $request->user;
		$post->save();

		return redirect()->route('posts.index');
	}

	public function destroy()
	{
		$request = request();
		$id = $request->post;
		$post = Post::find($id);

		$post->delete();

		return redirect()->route('posts.index');
	}
}