<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class HomeController extends Controller
{
    private $profileService;
    protected $homeService;

    public function __construct(ProfileService $profileService, \App\Services\HomeService $homeService)
    {
        $this->profileService = $profileService;
        $this->homeService = $homeService;
    }

    public function index() {
        $posts = $this->homeService->getPosts();
        return view('index', compact('posts'));
    }

    public function search(Request $request) {
        $search = true;
        $posts = $this->homeService->searchPosts($request->search);
        return view('index', compact('posts', 'search'));
    }

    public function profile() {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function edit() {
        $user = Auth::user();
        return view('pages.edit-profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $imagePath = null;

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('users', $fileName, 'public');
        }

        $request = $this->profileService->updateProfile($request->validated(), Auth::user()->email, $imagePath);
        if ($request) {
            notify()->success('Profile updated successfully!');
        } else {
            notify()->error('Something went wrong! Could not update the profile');
        }
        return redirect()->route('profile.edit');
    }

}
