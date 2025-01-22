<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        
        $query = Post::with(['author', 'images', 'topics'])
            ->withCount(['likes', 'comments']);

        switch ($filter) {
            case 'following':
                $query->whereIn('user_id', auth()->user()->following()->pluck('users.id'));
                break;
            case 'hot':
                $query->orderByDesc('likes_count')->orderByDesc('comments_count');
                break;
            default:
                $query->latest();
        }

        $posts = $query->paginate(10);
        
        $hotTopics = Topic::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(10)
            ->get();

        return view('timelines.index', compact('posts', 'hotTopics'));
    }
} 