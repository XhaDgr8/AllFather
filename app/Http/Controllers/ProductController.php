<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\SubProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate(25);

        return view('pages.product.index', compact('products'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.product.create');
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        $request->session()->flash('product.created', $product->name. " Created Successfully");

        return redirect('/product');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $subProducts = $product->subProducts;
        return view('pages.product.show', compact('product', 'subProducts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        $subProducts = SubProduct::all();

        return view('pages.product.edit', compact('product', 'subProducts'));
    }

    /**
     * @param \App\Http\Requests\ProductUpdateRequest $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        $request->session()->flash('product.updated', $product->name. " Updated Successfully");

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }

    public function attachToProduct(Product $product,SubProduct $subProduct)
    {
        $product->attachedToProduct($subProduct->id);
        return $subProduct->name. ' Added to '. $product->name;
    }

    public function detachFromProduct(Product $product,SubProduct $subProduct)
    {
        $product->detachedFromProduct($subProduct->id);
        return $subProduct->name. ' Removed From '. $product->name;
    }

    public function productsSubProducts(Product $product)
    {
        return $product->subProducts;
    }

    public function getQuantity(Product $product,SubProduct $subProduct)
    {
        return $product->subProducts()
            ->where('sub_product_id', $subProduct->id)
            ->firstOrFail()->pivot->quantity;
    }

    public function changeQuantity(Product $product,SubProduct $subProduct, $quantity)
    {
        $product->subProducts()
            ->where('sub_product_id', $subProduct->id)
            ->firstOrFail()->pivot->update(["quantity" => $quantity]);
        $neg = $quantity * $product->stock_quantity;
        $nqty = $subProduct->stock_quantity - $neg;
        $subProduct->update(['stock_quantity' => $nqty]);
        return $product->qtty($subProduct->id);
    }
}
