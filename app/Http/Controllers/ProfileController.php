<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
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
     * Handle upload file to Cloudinary.
     */
    public function upload(Request $request)
    {
        $path = 'laravel-cloudinary';
        $file = $request->file('photo')->getClientOriginalName();

        $fileName = pathinfo($file, PATHINFO_FILENAME);

        $publicId = date('Y-m-d_His') . '_' . $fileName;
        $upload = Cloudinary::upload($request->file('photo')->getRealPath(), [
            'folder' => $path,
            'public_id' => $publicId
        ]);

        return $upload->getSecurePath(); // Get the secure URL directly
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update basic profile information
        $user->fill([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $photoUrl = $this->upload($request); // Get the photo URL
            // Check if upload is successful
            if ($photoUrl) {
                $user->photo = $photoUrl;
            } else {
                // Handle upload error
                // You may want to log or display an error message
            }
        }

        // Uncomment this code to mark email as unverified if updated
        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        // Save changes
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
