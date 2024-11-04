<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequestValidation;
use Illuminate\Http\JsonResponse;

class PostApiController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostRequestValidation $request): JsonResponse{

        $imagePath = null;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('post_images', $fileName, 'public');
        }

        $this->postService->storePost($request->validated(), $imagePath);

        if ($request) {
            return response()->json(['message' => 'Post has been created successfully!'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong! Could not create the post'], 500);
        }
    }

    public function edit(Request $request, $id): JsonResponse
    {

        $post = $this->postService->getPostById($id);

        return response()->json($post, 200);
    }

    public function update(PostRequestValidation $request, $id): JsonResponse {

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
            return response()->json(['message' => 'Post has been updated successfully!'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong! Could not update the post'], 500);
        }

    }

    public function show(Request $request, $id): JsonResponse{
        $post = $this->postService->getPostById($id);
        if (!$post) {
            notify()->error('Post not found!');
            return redirect()->route('home');
        }

        return response()->json($post, 200);
    }

    public function delete(Request $request, $id): JsonResponse{
        $post = $this->postService->getPostById($id);
        if (!$post) {
            notify()->error('Post not found!');
            return redirect()->route('home');
        }

        $this->postService->deletePost($id);

        return response()->json(['message' => 'Post has been deleted successfully!'], 200);
    }

}
