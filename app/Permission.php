<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }


    public static function orderedPerm()
    {
        $permissions = (new static)->all();
        $permissions_order = [];
        $cur_name_permission = "";

        foreach ($permissions as $permissions_item) {
            if ($cur_name_permission != $permissions_item['main_name']) {
                $cur_name_permission = $permissions_item['main_name'];
            }
            $permissions_order[$cur_name_permission][] = $permissions_item;
        }
        return $permissions_order;
    }
}
