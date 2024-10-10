<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\PostRequestValidation;
use Illuminate\Http\Request;

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

    public function edit(Request $request, $id){

        $post = $this->postService->getPostById($id);

        return view('post-edit', compact('post'));
    }

    public function update(PostRequestValidation $request, $id) {

        $post = $this->postService->getPostById($id);

        if (!$post) {
            notify()->error('Post not found!');
            return redirect()->route('home');
        }

        $this->postService->updatePost($request->validated(), $id);

        if ($request) {
            notify()->success('Post has been updated successfully!');
        } else {
            notify()->error('Something went wrong! Could not update the post');
        }
        return redirect()->route('home');

    }

    public function delete(Request $request, $id){
        $post = $this->postService->getPostById($id);
        if (!$post) {
            notify()->error('Post not found!');
            return redirect()->route('home');
        }

        $this->postService->deletePost($id);

        notify()->success('Post has been deleted successfully!');

        return redirect()->route('home');
    }

}
