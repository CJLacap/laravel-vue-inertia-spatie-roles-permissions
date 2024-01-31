<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
         $posts = Post::all();

         return Inertia::render('Admin/Posts/PostIndex', [
            'posts' => PostResource::collection($posts)
         ]);
    }


    public function create(): Response
    {
        return Inertia::render('Admin/Posts/Create');
    }


    public function store(StorePostRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return to_route('posts.index');
    }


    public function edit(Post $post): Response
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post)
        ]);
    }


    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        return to_route('posts.index');
    }

    public function destroy(Post $post, Request $request): RedirectResponse
    {

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $post->delete();

        return to_route('posts.index');
    }

}
