<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

        $imagePath = null;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('post_images', $fileName, 'public');
        }

        $this->postService->storePost($request->validated(), $imagePath);

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

        $imagePath = $post->post_image;

        if ($request->file('picture')) {
            $file = $request->file('picture');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('post_images', $fileName, 'public');
        }

        $this->postService->updatePost($request->validated(), $id, $imagePath);

        if ($request) {
            notify()->success('Post has been updated successfully!');
        } else {
            notify()->error('Something went wrong! Could not update the post');
        }
        return redirect()->route('home');

    }

    public function show(Request $request, $id){
        $post = $this->postService->getPostById($id);
        if (!$post) {
            notify()->error('Post not found!');
            return redirect()->route('home');
        }

        return view('post-show', compact('post'));
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
