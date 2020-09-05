<?php

namespace App\Http\Controllers;

use App\Ability;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{

    public function welcome ()
    {
        session()->flush();
        return view('welcome');
    }

    public function index () {
        $this->middleware('auth');
        $users = User::all();
        $roles = Role::all();
        $abilities = Ability::all();
        return view('pages.admin.index', compact('users', 'roles', 'abilities'));
    }

    public function storeRole(Request $request)
    {
        $this->authorize('attach_role');
        $user = User::findOrFail(request()->user);
        $user->assignRole(request()->assign_role);
        if ($user->is_role('worker')){
            $user->detachRole('customer');
        }
        if ($user->is_role('customer')){
            $user->detachRole('worker');
        }
        return back();
    }

    public function detachRoleFromUser(Request $request)
    {
        $this->authorize('detach_role');
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
        $this->authorize('attach_ability');
        $role = Role::findOrFail(request()->role);
        $role->allowTo(request()->assign_ability);
        return back();
    }

    public function detachAbilityFromRole(Request $request)
    {
        $this->authorize('detach_ability');
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
        $this->authorize('attach_worker');
        $customer = User::findOrFail(request()->customer);
        $worker = User::findOrFail(request()->assign_worker);
        $customer->assignWorker($worker);
        return back();
    }

    public function unAssignWorker(Request $request)
    {
        $this->authorize('detach_worker');
        $customer = User::findOrFail(request()->customer);
        $worker = User::findOrFail(request()->unAssign_worker);
        $customer->unAssignWorker($worker);
        return back();
    }

    public function resetDefaults ()
    {
        $this->authorize('admin');
        $this->defaulter();

        $worker = Role::where('name', 'worker')->first();

        $forWorker = [
            'v_order', 'v_order_all', 'v_order_self', 'c_order_self','c_order', 'c_order_customers',
            'u_order_self', 'd_order_self', 'd_order_customers', 'u_order_customers',
            'v_user_all', 'v_user_customers', 'c_user', 'u_users',
            'v_sub_product', 'c_sub_product', 'u_sub_product', 'd_sub_product',
            'v_product', 'c_product', 'u_product', 'd_product',
        ];
        foreach ($forWorker as $abilities)
        {
            $worker->allowTo($abilities);
        }

        $customer = Role::where('name', 'customer')->first();

        $forCustomer = [
            'v_order', 'v_order_self', 'c_order_self','c_order',
            'v_sub_product','v_product',
        ];

        foreach ($forCustomer as $abilities)
        {
            $customer->allowTo($abilities);
        }


        return back();
    }

    public function defaulter()
    {

        //Abilities
        //--> Orders
        //--> Orders --> View
        Ability::firstOrCreate([
            'name' => 'v_order_all',
            'label' => 'View all Orders'
        ]);

        Ability::firstOrCreate([
            'name' => 'v_order',
            'label' => 'View single Order'
        ]);

        Ability::firstOrCreate([
            'name' => 'v_order_all',
            'label' => 'View all Orders'
        ]);

        Ability::firstOrCreate([
            'name' => 'v_order_self',
            'label' => 'View Orders by himself'
        ]);

        //--> Orders --> Create
        Ability::firstOrCreate([
            'name' => 'c_order',
            'label' => 'Create Order'
        ]);

        Ability::firstOrCreate([
            'name' => 'c_order_self',
            'label' => 'Create Orders for himself'
        ]);

        Ability::firstOrCreate([
            'name' => 'c_order_customers',
            'label' => 'Create Orders for customers'
        ]);

        //--> Orders --> Update
        Ability::firstOrCreate([
            'name' => 'u_order_self',
            'label' => 'Updated Orders for himself'
        ]);

        Ability::firstOrCreate([
            'name' => 'u_order_customers',
            'label' => 'Update Orders for customers'
        ]);

        //--> Orders --> Delete
        Ability::firstOrCreate([
            'name' => 'd_order_self',
            'label' => 'Delete Orders for himself'
        ]);

        Ability::firstOrCreate([
            'name' => 'd_order_customers',
            'label' => 'Delete Orders for customers'
        ]);



        //--> Users
        //--> Users --> View
        Ability::firstOrCreate([
            'name' => 'v_user_all',
            'label' => 'View all Users'
        ]);

        Ability::firstOrCreate([
            'name' => 'v_user_customers',
            'label' => 'View Customers'
        ]);

        Ability::firstOrCreate([
            'name' => 'v_user_workers',
            'label' => 'View Workers'
        ]);

        //--> Orders --> Create
        Ability::firstOrCreate([
            'name' => 'c_user',
            'label' => 'Create Users'
        ]);

        //--> Users --> Update
        Ability::firstOrCreate([
            'name' => 'u_users',
            'label' => 'Update Users'
        ]);

        //--> Users --> Delete
        Ability::firstOrCreate([
            'name' => 'd_users',
            'label' => 'Delete Users'
        ]);



        //--> Sub Products
        //--> Sub Products --> View
        Ability::firstOrCreate([
            'name' => 'v_sub_product',
            'label' => 'View Sub Products'
        ]);

        //--> Orders --> Create
        Ability::firstOrCreate([
            'name' => 'c_sub_product',
            'label' => 'Create Sub Products'
        ]);

        //--> Sub Products --> Update
        Ability::firstOrCreate([
            'name' => 'u_sub_product',
            'label' => 'Update Sub Products'
        ]);

        //--> Sub Products --> Delete
        Ability::firstOrCreate([
            'name' => 'd_sub_product',
            'label' => 'Delete Sub Products'
        ]);


        //--> Products
        //--> Products --> View
        Ability::firstOrCreate([
            'name' => 'v_product',
            'label' => 'View Products'
        ]);

        //--> Orders --> Create
        Ability::firstOrCreate([
            'name' => 'c_product',
            'label' => 'Create Products'
        ]);

        //--> Products --> Update
        Ability::firstOrCreate([
            'name' => 'u_product',
            'label' => 'Update Products'
        ]);

        //--> Products --> Delete
        Ability::firstOrCreate([
            'name' => 'd_product',
            'label' => 'Delete Products'
        ]);


        //--> Roles And Abilities
        Ability::firstOrCreate([
            'name' => 'attach_role',
            'label' => 'Assign Roles'
        ]);
        Ability::firstOrCreate([
            'name' => 'detach_role',
            'label' => 'Detach Roles'
        ]);
        Ability::firstOrCreate([
            'name' => 'attach_ability',
            'label' => 'Assign Ability'
        ]);
        Ability::firstOrCreate([
            'name' => 'detach_ability',
            'label' => 'Detach Ability'
        ]);

        //--> Worker Assigner and UnAssigner
        Ability::firstOrCreate([
            'name' => 'attach_worker',
            'label' => 'Assign Worker'
        ]);
        Ability::firstOrCreate([
            'name' => 'detach_worker',
            'label' => 'Detach Worker'
        ]);


        // Roles
        Role::firstOrCreate([
            'name' => 'admin',
            'label' => 'Admin'
        ]);

        Role::firstOrCreate([
            'name' => 'customer',
            'label' => 'Customer'
        ]);

        Role::firstOrCreate([
            'name' => 'worker',
            'label' => 'Worker'
        ]);
    }
}
