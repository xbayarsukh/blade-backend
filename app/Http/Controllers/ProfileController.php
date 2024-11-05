<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\CustomClass\FireBasePushNotification;

class ProfileController extends Controller
{
    private $fcmService;

    public function __construct()
    {
        $this->fcmService = new FireBasePushNotification();
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // $deviceToken = "da74DItsS-SyXyxvNmD7NS:APA91bEqMEwHpqGXQXJKLhxZdUJoSpUJKtIZpxVNxBRf5AjJB42fBDPcx09RJTUXcKNs4gCIZLx3_2RVwb60tZJd1cTMLfjwJWnB3FHVPLOzPr0k-n3u5ywPHJ9tQ4fgF2hdXjr8Gn2U";
        // $title = "Эрх сунгалт";
        // $body = "1 сараар сунгагдлаа.";

        // $response = $this->fcmService->to($deviceToken, $body, $title);
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
}
