<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\StoreprofilesRequest;
use App\Http\Requests\UpdateProfilesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function profile()
    {
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        return view('layout-users.profileUser', ['profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreprofilesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(profile $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profile  $profiles
     * @return \Illuminate\Http\Response
     */
    public function show(profile $profiles)
    {
        return view('layout-users.profileUser');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprofilesRequest  $request
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateProfilesRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        if ($request->filled('password_current')) {
            if (!\Hash::check($request->input('password_current'), $user->password)) {
                return redirect()->back()->withErrors(['password_current' => 'Password saat ini salah.'])->withInput();
            }

            $request->validate([
                'password_new' => 'required|min:8',
                'password_confirm' => 'required|same:password_new',
            ], [
                'password_new.required' => 'Kata sandi baru diperlukan.',
                'password_new.min' => 'Kata sandi baru harus memiliki minimal 8 karakter.',
                'password_confirm.required' => 'Konfirmasi kata sandi baru diperlukan.',
                'password_confirm.same' => 'Konfirmasi kata sandi tidak sesuai dengan kata sandi baru.',
            ]);

            $user->password = bcrypt($request->input('password_new'));
        }

        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        $profile = Profile::updateOrCreate(
            ['user_id' => $userId],
            [
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
                'gender' => $request->input('gender')
            ]
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profiles)
    {
        //
    }
}
