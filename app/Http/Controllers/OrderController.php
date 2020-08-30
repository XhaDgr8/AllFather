<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Order;
use App\Product;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('v_order');
        $orders = Order::paginate(30);

        return view('pages.order.index', compact('orders'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('c_order');
        $products = [];
        if (session()->has('product.id')){
            if (count(session('product.id')) > 0 ){
                $sessions = session('product.id');
                foreach ($sessions as $session){
                    $product = Product::findOrFail($session);
                    array_push($products, $product);
                }
            } else {
                return redirect('/home');
            }
        } else {
            return back();
        }
        $customers = Role::where('name', 'customer')->first()->users;
        return view('pages.order.create', compact( 'products','customers'));
    }

    /**
     * @param \App\Http\Requests\OrderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $this->authorize('c_order_self');

        $order = Order::create($request->validated());

        $productArray = Arr::except($request->all(),['description', '_token', 'shipping_address', 'created_by', 'status']);

        foreach ($productArray as $key => $arr){
            $product = Product::findOrFail($key);
            $quantity = intval($arr);
            $product->attachedToOrder($order->id);
            $product->addOrderQuantity($order->id, $quantity);
        }

        session()->flush();
        return redirect('/order');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        return view('pages.order.show', compact('order'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Order $order)
    {
        return view('pages.order.edit', compact('order'));
    }

    /**
     * @param \App\Http\Requests\OrderUpdateRequest $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        $request->session()->flash('pages.order.id', $order->id);

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        return redirect()->route('pages.order.index');
    }
}
