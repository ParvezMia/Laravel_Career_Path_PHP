<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\PostRequestValidation;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostRequestValidation $request){
        $this->postService->storePost($request->validated());
        if ($request) {
            notify()->success('Post has been created successfully!');
        } else {
            notify()->error('Something went wrong! Could not create the post');
        }
        return redirect()->route('home');
    }
}
