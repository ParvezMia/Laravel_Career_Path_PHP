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
}
