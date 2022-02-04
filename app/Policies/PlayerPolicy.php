<?php

namespace App\Policies;

use App\User;
use App\Player;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->player == null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_player;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Player  $player
     * @return mixed
     */
    public function delete(User $user, Player $player = null)
    {
        return $user->is_player;
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function adminIndex(User $user)
    {
        return $user->hasPermission('admin-players');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->hasPermission('admin-player-add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Player  $player
     * @return mixed
     */
    public function adminUpdate(User $user, Player $player)
    {
        return $user->hasPermission('admin-player-edit');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Player  $player
     * @return mixed
     */
    public function adminDelete(User $user, Player $player)
    {
        return $user->hasPermission('admin-player-delete');
    }
}
