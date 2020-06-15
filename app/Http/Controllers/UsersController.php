<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (Auth::check()) {
            return view('admin.user.edit', [
                'user' => Auth::user()
            ]);
        }
    }

    /**
     * Show the form for editing the user password.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        if (Auth::check()) {
            return view('admin.user.edit-password', [
                'user' => Auth::user()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'receives_email' => $request->receives_email
            ]);

            Session::flash('status', [
                'user' => 'Successfully updated user \''. $user->name .'\'!'
            ]);

            return redirect()->route('admin.home');
        }
    }

    /**
     * Update the user password.
     *
     * @param UserUpdatePasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserUpdatePasswordRequest $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            Session::flash('status', [
                'user' => 'Successfully updated password!'
            ]);

            return redirect()->route('admin.home');
        }
    }
}
