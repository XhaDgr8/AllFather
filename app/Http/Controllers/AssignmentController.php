<?php

namespace App\Http\Controllers;

use App\Ability;
use Illuminate\Http\Request;

use App\User;
use App\Role;

class AssignmentController extends Controller
{

    public function index () {
        $this->authorize('page_admin');
        $users = User::all();
        $roles = Role::all();
        $abilities = Ability::all();
        return view('pages.admin.index', compact('users', 'roles', 'abilities'));
    }

    public function storeRole(Request $request)
    {
        $user = User::findOrFail(request()->user);
        $user->assignRole(request()->assign_role);
        return back();
    }

    public function detachRoleFromUser(Request $request)
    {
        $user = User::findOrFail(request()->user);
        $user->detachRole(request()->detach_role);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAbility(Request $request)
    {
        $role = Role::findOrFail(request()->role);
        $role->allowTo(request()->assign_ability);
        return back();
    }

    public function detachAbilityFromRole(Request $request)
    {
        $role = Role::findOrFail(request()->role);
        $role->restrictTo(request()->detach_ability);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $customer
     * @return \Illuminate\Http\Response
     */
    public function assignWorker(Request $request)
    {
        $customer = User::findOrFail(request()->customer);
        $worker = User::findOrFail(request()->assign_worker);
        $customer->assignWorker($worker);
        return back();
    }

    public function unAssignWorker(Request $request)
    {
        $customer = User::findOrFail(request()->customer);
        $worker = User::findOrFail(request()->unAssign_worker);
        $customer->unAssignWorker($worker);
        return back();
    }
}
