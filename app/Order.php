<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'shipping_address',
        'token',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class, 'order_product', 'order_id', 'product_id'
        )->withPivot('quantity');
    }

    public function orderQtty($productId)
    {
        return $this->products()
            ->where('product_id', $productId)
            ->firstOrFail()->pivot->quantity;
    }

    public function perTotal($price_per_unit, $quantity)
    {
        return $price_per_unit * $quantity;
    }

    public function orderTotal()
    {
        $products = $this->products;
        $total = 0;
        foreach ($products as $product){
            $total = $total + $this->perTotal( $product->perUnit(), $this->orderQtty($product->id) );
        }
        return $total;
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\User::class, 'created_by', 'id' );
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\User::class, 'updated_by', 'id');
    }
}
