<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    //    protected $append = ['all_permissions'];
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


    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    private function allPermissions()
    {
        $permmissions = [];
        $groups = $this->groups;
        foreach ($groups as $group) {
            $permmissions = array_merge($permmissions, $group->permissions->pluck('key')->toArray());
        }
        $permmissions = array_merge($permmissions, $this->permissions->pluck('key')->toArray());
        return array_unique($permmissions);
    }

    public function hasPermission($permission_key = "")
    {
        if ($this->id === 1) return true;
        return in_array($permission_key, $this->allPermissions());
    }

    public function getHasAdminLinkAttribute()
    {
        if (count($this->allPermissions()) > 0 || $this->id === 1) return true;
        return false;
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }
    public function  getIsPlayerAttribute()
    {
        if (is_null($this->player) or $this->player->status == 0) {
            return false;
        }
        return true;
    }
}
