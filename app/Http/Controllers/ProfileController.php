<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        // Tambahkan validasi mimes agar lebih aman dan size max disesuaikan (5120 = 5MB)
        $request->validate([
            'photo_profile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ]);

        $user = $request->user();

        // Cek jika user sudah punya foto sebelumnya
        if ($user->photo_profile && Storage::disk('public')->exists($user->photo_profile)) {
            // Hapus foto lama untuk menghemat penyimpanan
            Storage::disk('public')->delete($user->photo_profile);
        }

        // Simpan foto baru ke dalam disk 'public' folder 'photos'
        $path = $request->file('photo_profile')->store('photos', 'public');

        // Update database
        $user->forceFill([
            'photo_profile' => $path,
        ])->save();

        return Redirect::route('profile.edit')->with('status', 'photo-updated');
    }
}