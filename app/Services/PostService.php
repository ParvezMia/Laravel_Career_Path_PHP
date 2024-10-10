<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function storePost($validateData)
    {
        $data = [
            'uuid_post' => Str::uuid()->toString(),
            'user_post_description' => $validateData['barta'],
            'user_post_user_uuid' => Auth::user()->uuid
        ];

        return DB::table('user_posts')->insert($data);
    }

}
