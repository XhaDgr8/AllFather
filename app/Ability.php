<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
    ];

    public function roles ()
    {
        return $this->belongsToMany(\App\Role::class)->withTimestamps();
    }
}
