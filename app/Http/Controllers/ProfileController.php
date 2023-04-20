<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\UploadTrait;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use UploadTrait;


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateProfileImage(Request $request): RedirectResponse
    {

        $max_file_size = 1024*1024*5; // 5 MB
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:'.$max_file_size
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $image = $request->file('profile_image');
        $name = Str::slug($user->username).'_'.time();
        $folder = '/uploads/images/';
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $name);
        $user->profile_image = $filePath;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-image-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
