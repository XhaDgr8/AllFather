<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pView () {
        $profile = [
            'first_name' => Helper::authProfile('first_name', 'First Name'),
            'last_name' => Helper::authProfile('last_name', 'Last Name'),
            'user_name' => Helper::authProfile('user_name', 'User Name'),
            'website' => Helper::authProfile('website', 'Website'),
        ];
        return view('profile.index', compact('profile'));
    }

    public function index(Request $request)
    {
        $profiles = Profile::all();

        return view('profile.index', compact('profiles'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('profile.create');
    }

    /**
     * @param \App\Http\Requests\ProfileStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStoreRequest $request)
    {
        $profile = Profile::create($request->validated());

        $request->session()->flash('profile.id', $profile->id);

        return redirect()->route('profile.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Profile $profile)
    {
        return view('profile.show', compact('profile'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Profile $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, Profile $profile)
    {
        $profile->update($request->validated());

        $request->session()->flash('profile.id', $profile->id);

        return redirect()->route('profile.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profile.index');
    }


    public function imageUpload(Request $request, Profile $profile)
    {
        $data = request()->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $profile_pic_path = $data['file']->store('users/'.auth()->user()->id, 'public');
        $profile_picture_array = ['avatar' => $profile_pic_path];

        $profile->update(array_merge(
            $profile_picture_array ?? []
        ));

        return back();
    }
}
