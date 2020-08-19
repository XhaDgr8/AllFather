<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @param array $middleware
     */
    public function pro_profile()
    {
        $profile = [
            'van_no' => Helper::authProfile('vat_no', 'Vat No'),
            'tel' => Helper::authProfile('tel', 'Tel'),
            'company_number' => Helper::authProfile('company_number', 'Company Number'),
            'user_name' => Helper::authProfile('user_name', 'User Name'),
            'address' => Helper::authProfile('address', 'Address'),
            'website' => Helper::authProfile('website', 'Website'),
        ];
        return $profile;
    }
    public function pView ()
    {
        $profile = $this->pro_profile();
        return view('pages.profile.index', compact('profile'));
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

        $pro_profile = $this->pro_profile();
        return view('pages.customers.edit', compact('profile', 'pro_profile'));
    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $profile)
    {
        $user = User::findOrFail($profile);
        $profile = $user->profile;
        $profile->update($request->validated());

        $request->session()->flash('customers.id', $profile->id);

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Profile $profile)
    {
        $profile->delete();

        return redirect()->route('customers.index');
    }


    public function imageUpload(Request $request, $customer)
    {
        $data = request()->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $profile = Profile::findOrFail($customer);

        $profile_pic_path = $data['file']->store('users/'. $profile->user->id, 'public');
        $profile_picture_array = ['avatar' => $profile_pic_path];

        $profile->update(array_merge(
            $profile_picture_array ?? []
        ));

        return back();
    }
}
