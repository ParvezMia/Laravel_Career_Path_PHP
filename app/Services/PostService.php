<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getPostById($id)
    {
        return Post::with(['user'])
                ->where('uuid_post', $id)->first();
    }
    public function storePost($validateData)
    {
        $data = [
            'user_post_description' => $validateData['barta'],
            'user_post_user_uuid' => Auth::user()->uuid,
        ];

        return Post::create($data);;
    }

    public function updatePost($validateData, $id)
    {
        $data = [
            'user_post_description' => $validateData['barta'],
        ];

        return Post::where('uuid_post', $id)->update($data);
    }

    public function deletePost($id){
        return Post::where('uuid_post', $id)->delete();
    }

}
