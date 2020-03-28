<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Post;

class PostController extends Controller
{
	public function index()
	{
		return PostResource::collection(Post::with('user')->paginate(5));
	}

	public function store(StorePostRequest $request)
	{
		$data = $request->only(['title', 'description', 'user_id']);

		Post::create($data);

		return response('', 201);
	}

	public function show(Post $post)
	{
		return new PostResource($post);
	}
}