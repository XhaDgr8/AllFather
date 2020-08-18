<?php

namespace App\Http\Controllers;

use App\Ability;
use App\Http\Requests\AbilityStoreRequest;
use App\Http\Requests\AbilityUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AbilityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $abilities = Ability::all();

        return view('ability.index', compact('abilities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('ability.create');
    }

    /**
     * @param \App\Http\Requests\AbilityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbilityStoreRequest $request)
    {
        $ability = Ability::create($request->validated());

        if ($ability) {
            $msg = ['success', ''.$ability->label.' Created Successfully'];
        } else {
            $msg = ['danger', 'Failed to create ability'];
        }
        $request->session()->flash('ability.id', $msg);

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ability $ability)
    {
        return view('ability.show', compact('ability'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ability $ability)
    {
        return view('ability.edit', compact('ability'));
    }

    /**
     * @param \App\Http\Requests\AbilityUpdateRequest $request
     * @param \App\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function update(AbilityUpdateRequest $request, Ability $ability)
    {
        $ability->update($request->validated());

        $request->session()->flash('ability.updated', $ability->label. " Updated Successfully");

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ability $ability)
    {
        $ability->delete();
        session()->flash('ability.deleted', "ability deleted successful");
        return back();
    }
}
