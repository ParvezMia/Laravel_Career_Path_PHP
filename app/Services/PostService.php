<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getPostById($id)
    {
        return DB::table('user_posts')->where('uuid_post', $id)->first();
    }
    public function storePost($validateData)
    {
        $data = [
            'uuid_post' => Str::uuid()->toString(),
            'user_post_description' => $validateData['barta'],
            'user_post_user_uuid' => Auth::user()->uuid
        ];

        return DB::table('user_posts')->insert($data);
    }

    public function updatePost($validateData, $id)
    {
        $data = [
            'user_post_description' => $validateData['barta']
        ];

        return DB::table('user_posts')->where('uuid_post', $id)->update($data);
    }

}
