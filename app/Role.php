<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    public function abilities ()
    {
        return $this->belongsToMany(\App\Ability::class)->withTimestamps();
    }

    public function allowTo($ability)
    {
        if (is_string($ability)) {
            $ability = \App\Ability::whereName($ability)->get();
        }
        $this->abilities()->sync($ability, false);
    }

    public function restrictTo($ability)
    {
        if (is_string($ability)) {
            $ability = \App\Ability::whereName($ability)->get();
        }
        $this->abilities()->detach($ability, false);
    }

    public function users() {
        return $this->belongsToMany(\App\User::class)->withTimestamps();
    }
}
