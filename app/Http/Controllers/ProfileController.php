<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $history = $user->ecoTracks()->latest()->get();
        $totalPoints = $user->total_points ?? 0;
        
        $badge = 'Newcomer';
        $badgeColor = 'bg-gray-100 text-gray-600 border-gray-200';
        if ($totalPoints >= 50000) {
            $badge = 'Gold Eco-Warrior';
            $badgeColor = 'bg-yellow-100 text-yellow-700 border-yellow-300';
        } elseif ($totalPoints >= 10000) {
            $badge = 'Silver Recycler';
            $badgeColor = 'bg-gray-200 text-gray-700 border-gray-300';
        } elseif ($totalPoints > 0) {
            $badge = 'Bronze Saver';
            $badgeColor = 'bg-orange-100 text-orange-700 border-orange-200';
        }

        return view('profile.edit', [
            'user' => $user,
            'history' => $history,
            'totalPoints' => $totalPoints,
            'badge' => $badge,
            'badgeColor' => $badgeColor,
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
     * Update the user's profile and background photos.
     */
    public function updatePhotos(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'background_photo' => ['nullable', 'image', 'max:5120'],
        ]);

        $user = $request->user();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        if ($request->hasFile('background_photo')) {
            $path = $request->file('background_photo')->store('background-photos', 'public');
            $user->background_photo_path = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'photos-updated');
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
