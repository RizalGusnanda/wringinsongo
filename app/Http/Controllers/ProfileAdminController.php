<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileAdminController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return view('profile-admin.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id . '|regex:/@gmail\.com$/i',
            'password_current' => 'sometimes|required_with:password_new',
            'password_new' => 'nullable|min:8|confirmed',
            'password_new_confirmation' => 'nullable|min:8',
        ]);

        if ($request->filled('password_current')) {
            $request->validate([
                'password_new' => 'required|min:8',
                'password_new_confirmation' => 'required|min:8',
            ]);
        }

        if ($request->filled('password_current')) {
            if (!Hash::check($request->password_current, $user->password)) {
                return back()->withErrors(['password_current' => 'The current password does not match with password current.']);
            }

            if ($request->filled('password_new')) {
                $request->validate([
                    'password_new_confirmation' => 'required|min:8',
                ]);

                if ($request->password_new !== $request->password_new_confirmation) {
                    return back()->withErrors(['password_new_confirmation' => 'Confirmation of new password is incorrect.']);
                }

                $user->password = Hash::make($request->password_new);
            } else {

                if ($request->filled('password_new_confirmation')) {
                    return back()->withErrors(['password_new' => 'The new password must be filled in if the new password confirmation is filled in.']);
                }
            }
        }

        $isDataChanged = $user->name !== $request->username || $user->email !== $request->email || $request->filled('password_new');

        if (!$isDataChanged) {
            return back()->with('danger', 'Profil gagal diperbarui karena tidak ada perubahan data.');
        }

        $user->name = $request->username;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
