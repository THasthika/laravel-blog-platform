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

        // Form validation
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:'.$max_file_size
        ]);

        // Get current user
        $user = User::findOrFail(Auth::user()->id);

        // Get image file
        $image = $request->file('profile_image');
        
        // Make a image name based on user name and current timestamp
        $name = Str::slug($user->username).'_'.time();

        // Define folder path
        $folder = '/uploads/images/';
        
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        
        // Upload image
        $this->uploadOne($image, $folder, 'public', $name);
        
        // Set user profile image path in database to filePath
        $user->profile_image = $filePath;

        // Persist user record to database
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
