<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubProductStoreRequest;
use App\Http\Requests\SubProductUpdateRequest;
use App\SubProduct;
use Illuminate\Http\Request;

class SubProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('v_sub_product');
        $subProducts = SubProduct::all();

        return view('pages.subProduct.index', compact('subProducts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('c_sub_product');
        return view('pages.subProduct.create');
    }

    /**
     * @param \App\Http\Requests\SubProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubProductStoreRequest $request)
    {
        $this->authorize('c_sub_product');
        $subProduct = SubProduct::create($request->validated());

        $request->session()->flash('subProduct.create', $subProduct->name .' create SuccessFully');

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\SubProduct $subProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SubProduct $subProduct)
    {
        $this->authorize('v_sub_product');
        return view('pages.subProduct.show', compact('subProduct'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\SubProduct $subProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SubProduct $subProduct)
    {
        $this->authorize('u_sub_product');
        return view('pages.subProduct.edit', compact('subProduct'));
    }

    /**
     * @param \App\Http\Requests\SubProductUpdateRequest $request
     * @param \App\SubProduct $subProduct
     * @return \Illuminate\Http\Response
     */
    public function update(SubProductUpdateRequest $request, SubProduct $subProduct)
    {
        $this->authorize('u_sub_product');
        $valid = array_filter($request->validated());
        $subProduct->update($valid);

        $request->session()->flash('subProduct.updated', $subProduct->name, ' Updated Successfully');

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\SubProduct $subProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubProduct $subProduct)
    {
        $this->authorize('d_sub_product');
        $subProduct->delete();

        return redirect()->route('sub-product.index');
    }
}
