<?php

namespace App\Http\Controllers;

use App\Product;
use App\Profile;
use App\Role;
use App\SubProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Role::where('name', 'customer')->first()->users;

        $workers = Role::where('name', 'worker')->first()->users;
        $onlinePeople = Profile::where('status', 'online')->get();
        $countWorkers = 0;
        foreach ($onlinePeople as $profile){
            if ($profile->user->roles()->where('name', 'worker')->first() != null){
                $countWorkers = $countWorkers + 1;
            }
        }
        $products = Product::all();
        $subProducts = SubProduct::all();

        return view('home',
            compact('customers', 'workers',
                'countWorkers', 'products', 'subProducts'));

    }
}
