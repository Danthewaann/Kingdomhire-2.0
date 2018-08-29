<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPUTRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserPUTRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPUTRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Session::flash('status', [
            'user' => 'Successfully created user \''. $user->name .'\'!'
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the user password.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword(User $user)
    {
        return view('admin.user.edit-password', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserPUTRequest $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserPUTRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Session::flash('status', [
            'user' => 'Successfully updated user \''. $user->name .'\'!'
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Update the user password.
     *
     * @param UserUpdatePasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserUpdatePasswordRequest $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        Session::flash('status', [
            'user' => 'Successfully updated password!'
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Auth::logout();

        try {
            $user->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('public.home');
    }
}
