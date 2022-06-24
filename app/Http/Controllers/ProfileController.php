<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function showProfile() {
        $dataToSend = [
            'title' => 'Profile',
            'userData' => auth()->user()
        ];

        return view('layout.profile', $dataToSend);
    }

    public function updateUserProfile( Request $request ) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()]
        ]);

        try {
            $user = User::findOrFail( auth()->user()->id );
            $user->updateUserProfile( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t update user profile: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Your profile info is changed successfully.');

        return redirect('profile');
    }
}
