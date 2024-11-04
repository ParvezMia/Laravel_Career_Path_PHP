<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Database\Eloquent\Casts\Json;

class HomeApiController extends Controller
{
    private $profileService;
    protected $homeService;

    public function __construct(ProfileService $profileService, \App\Services\HomeService $homeService)
    {
        $this->profileService = $profileService;
        $this->homeService = $homeService;
    }

    public function index():JsonResponse {
        $posts = $this->homeService->getPosts();
        return response()->json($posts, 200);
    }

    public function search(Request $request):JsonResponse {
        $search = true;
        $posts = $this->homeService->searchPosts($request->search);
        return response()->json(compact('posts', 'search'), 200);
    }

    public function profile():JsonResponse {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function edit():JsonResponse {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function update(UpdateProfileRequest $request):JsonResponse
    {
        $imagePath = null;
        
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('users', $fileName, 'public');
        }

        $updateStatus = $this->profileService->updateProfile($request->validated(), Auth::user()->email, $imagePath);
        if ($updateStatus) {
            return response()->json(['message' => 'Profile updated successfully!'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong! Could not update the profile'], 500);
        }
    }

}
