<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\StoreprofilesRequest;
use App\Http\Requests\UpdateProfilesRequest;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $user = Auth::id();
        $users = DB::table('users')->select('id', 'name', 'email')->where('id', $user)->first();
        $profile = DB::table('profiles')->join('users', 'profiles.user_id', 'users.id')
            ->select(
                'profiles.user_id',
                'profiles.profile_image',
                'profiles.phone_number',
                'profiles.gender',
                'profiles.address',
                'users.name',
                'users.email'
            )->where('profiles.user_id', $user)
            ->first();

        return view('layout-users.profileUser', ['profile' => $profile, 'users' => $users]);
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
        $user = Auth::user();
        $originalUser = $user->getOriginal();
        $isChanged = false;

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
            $isChanged = true;
        }

        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        $profile->address = $request->filled('address') ? $request->input('address') : $profile->address;
        $profile->phone_number = $request->filled('phone_number') ? $request->input('phone_number') : $profile->phone_number;
        $profile->gender = $request->filled('gender') ? $request->input('gender') : $profile->gender;

        if ($profile->isDirty()) {
            $isChanged = true;
        }

        $user->name = $request->input('username') != $user->name ? $request->input('username') : $user->name;
        $user->email = $request->input('email') != $user->email ? $request->input('email') : $user->email;

        if ($user->isDirty()) {
            $isChanged = true;
        }

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $filename = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $imagePath = $request->file('profile_image')->storeAs('profile_images', $filename, 'public');
            $profile->profile_image = $imagePath;
            $isChanged = true;
        }

        if (!$isChanged) {
            return redirect()->back()->with('error', 'Profile gagal diperbarui karena tidak ada perubahan data.');
        }

        $user->save();
        $profile->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
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
