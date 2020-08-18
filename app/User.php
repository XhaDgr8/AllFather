<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'provider_id', 'provider_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Creat a new user's customers when the new user gets created
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($user) {
            $user->profile()->create();
            if ($user->id == 1) {
                $user->assignRole('admin');
            } else {
                $user->assignRole('customer');
            }
        });

    }

    public function profile ()
    {
        return $this->hasOne(\App\Profile::class);
    }

    public function roles ()
    {
        return $this->belongsToMany(\App\Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = \App\Role::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role, false);
    }

    public function detachRole($role)
    {
        if (is_string($role)) {
            $role = \App\Role::whereName($role)->firstOrFail();
        }
        $this->roles()->detach($role, false);
    }

    public function abilities() {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

}
