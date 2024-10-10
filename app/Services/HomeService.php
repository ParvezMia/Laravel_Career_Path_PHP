<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeService
{
    public function getPosts()
    {
        return DB::table('user_posts')
                ->join('users', 'user_posts.user_post_user_uuid', '=', 'users.uuid')
                ->select('user_posts.*', 'users.first_name', 'users.last_name', 'users.username')
                ->orderBy('user_posts.created_at', 'desc')
                ->get();

    }
}
