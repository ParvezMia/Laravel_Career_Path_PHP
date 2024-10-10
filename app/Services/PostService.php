<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostService
{
    public function getPostById($id)
    {
        return Post::with(['user'])
                ->where('uuid_post', $id)->first();
    }
    public function storePost($validateData, $imagePath)
    {
        $data = [
            'user_post_description' => $validateData['barta'],
            'user_post_user_uuid' => Auth::user()->uuid,
            'post_image' => $imagePath,
        ];

        return Post::create($data);;
    }

    public function updatePost($validateData, $id, $imagePath)
    {
        $data = [
            'user_post_description' => $validateData['barta'],
            'post_image' => $imagePath,
        ];

        return Post::where('uuid_post', $id)->update($data);
    }

    public function deletePost($id){
        return Post::where('uuid_post', $id)->delete();
    }

}
