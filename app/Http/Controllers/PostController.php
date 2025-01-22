<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load(['author', 'comments.author', 'images']);
        
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        
        $post = auth()->user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $post->images()->create(['url' => $path]);
            }
        }

        return redirect()->route('posts.show', $post)
            ->with('success', '帖子发布成功！');
    }

    public function like(Post $post)
    {
        $user = auth()->user();
        
        if ($post->isLikedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
            return response()->json(['liked' => false]);
        }

        $post->likes()->create(['user_id' => $user->id]);
        return response()->json(['liked' => true]);
    }
} 