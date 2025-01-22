<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load(['posts' => function ($query) {
            $query->latest();
        }]);

        return view('users.profile', compact('user'));
    }

    public function follow(User $user)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->id === $user->id) {
            return response()->json(['error' => '不能关注自己'], 400);
        }

        if ($currentUser->isFollowing($user)) {
            $currentUser->following()->detach($user->id);
            return response()->json(['following' => false]);
        }

        $currentUser->following()->attach($user->id);
        return response()->json(['following' => true]);
    }
} 