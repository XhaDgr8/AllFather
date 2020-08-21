<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
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
        'country_of_origin',
        'facility_name',
        'buying_unit',
        'price_per_unit',
        'production_unit',
        'production_price',
        'quantity',
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
}
