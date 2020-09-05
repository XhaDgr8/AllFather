<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Profile;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use File;

class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @param array $middleware
     */

    public function pView ()
    {
        return view('pages.profile.index');
    }

    public function index(Request $request)
    {
        $profiles = Profile::all();

        return view('customers.index', compact('profiles'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('customers.create');
    }

    /**
     * @param \App\Http\Requests\ProfileStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStoreRequest $request)
    {
        $profile = Profile::create($request->validated());

        $request->session()->flash('customers.id', $profile->id);

        return redirect()->route('customers.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Profile $profile)
    {
        return view('customers.show', compact('profile'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($profile)
    {
        $user = User::findOrFail($profile);
        $profile = $user->profile;
        $roles = Role::all();

        $workers = Role::where('name', 'worker')->first()->users;
        return view('pages.customers.edit', compact('profile', 'roles', 'workers'));
    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $profile)
    {
        $this->authorize('u_users');

        $user = User::findOrFail($profile);
        $profile = $user->profile;
        $profile->update($request->validated());

        $request->session()->flash('customers.updated', $profile->user . " 's information Updated successfully");

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($profile)
    {
        dd($profile);
        $profile->delete();

        return redirect()->route('customers.index');
    }
}
