<?php

namespace App\Http\Controllers;

use App\Order;
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
        session()->put('products.id', []);
        $customers = Role::where('name', 'customer')->first()->users;

        $workers = Role::where('name', 'worker')->first()->users;
        $onlinePeople = Profile::where('status', 'online')->get();
        $countWorkers = 0;
        foreach ($onlinePeople as $profile){
            if ($profile->user->roles()->where('name', 'worker')->first() != null){
                $countWorkers = $countWorkers + 1;
            }
        }

        $orders = Order::all();
        $products = Product::all();
        $subProducts = SubProduct::all();

        return view('home',
            compact('customers', 'workers',
                'countWorkers', 'products', 'subProducts', 'orders'));

    }

    public function removeFromOrder ($id)
    {
        foreach (session("product.id") as $key => $ses){
            if ($ses == $id){
                session()->pull('product.id.'.$key);
            }
        }
        return back();
    }

    public function addToOrder ($id)
    {
        if (session()->has('product.id')){
            if ( in_array($id, session('product.id')) ){
                session()->flash('product.error', "The Product is already added to order");
            } else {
                session()->push('product.id', $id);
            };
        } else {
            session()->push('product.id', $id);
        }
        return back();
    }

}
