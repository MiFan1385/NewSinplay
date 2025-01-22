<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        
        $comment = auth()->user()->comments()->create([
            'post_id' => $validated['post_id'],
            'content' => $validated['content']
        ]);

        return back()->with('success', '评论发表成功！');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();
        
        return back()->with('success', '评论已删除');
    }
} 