<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeService
{
    public function getPosts()
    {
        return Post::with(['user'])
            ->orderBy('user_posts.created_at', 'desc')
            ->get();
    }

    public function searchPosts($search)
    {
        return Post::with('user')
        ->whereHas('user', function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->get();



    }
}
