<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|max:1000'
        ]);

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