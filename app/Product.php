<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'updated_by',
        'cat_number',
        'name',
        'description',
        'stock_quantity',
        'price_for_customer',
        'price_for_admin',
        'other_costs',
        'image',
        'image_alt',
        'category',
        'key_words',
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

    public function createdBy()
    {
        return $this->hasOne(\App\User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(\App\User::class, 'id', 'updated_by');
    }

    public function subProducts ()
    {
        return $this->belongsToMany(
            SubProduct::class, 'products_sub_products', 'product_id', 'sub_product_id'
        )->withPivot('quantity');
    }

    public function orders ()
    {
        return $this->belongsToMany(
            Order::class, 'order_product', 'product_id', 'order_id'
        )->withPivot('quantity');
    }

    public function attachedToOrder($order_id)
    {
        $this->orders()->sync($order_id, false);
    }

    public function orderQuantity($order_id)
    {
        return $this->orders()
            ->where('order_id', $order_id)
            ->firstOrFail()->pivot->quantity;
    }

    public function addOrderQuantity($order_id, $quantity)
    {
        return $this->orders()
            ->where('order_id', $order_id)
            ->firstOrFail()->pivot->update(['quantity' => $quantity]);
    }

//    public function price_per_unit()
//    {
//        return 'null';
//    }

    public function qtty($subProductId)
    {
        return $this->subProducts()
            ->where('sub_product_id', $subProductId)
            ->firstOrFail()->pivot->quantity;
    }

    public function attachedToProduct($sub_product_id)
    {
        $this->subProducts()->sync($sub_product_id, false);
    }

    public function detachedFromProduct($sub_product_id)
    {
        $this->subProducts()->detach($sub_product_id);
    }

    public function perUnit()
    {
        $subProducts = $this->subProducts;
        $qtty = 0;
        foreach ($subProducts as $subProduct){
            $qtty = $qtty + $this->qtty($subProduct->id) * $subProduct->price_per_unit;
        }
        return $qtty;
    }

}
