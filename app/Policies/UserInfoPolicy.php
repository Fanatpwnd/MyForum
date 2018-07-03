<?php

namespace App\Policies;

use App\User;
use App\UserInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user info.
     *
     * @param  \App\User  $user
     * @param  \App\UserInfo  $userInfo
     * @return mixed
     */
    public function view(User $user, UserInfo $userInfo)
    {
        //
    }

    /**
     * Determine whether the user can create user infos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user info.
     *
     * @param  \App\User  $user
     * @param  \App\UserInfo  $userInfo
     * @return mixed
     */
    public function updateRole(User $user, UserInfo $userInfo)
    {
        return $user->isAdmin();
    }

    public function updateBio(User $user, UserInfo $userInfo)
    {
        return $user->isAdmin() || $userInfo['id'] == $user['id'];
    }

    /**
     * Determine whether the user can delete the user info.
     *
     * @param  \App\User  $user
     * @param  \App\UserInfo  $userInfo
     * @return mixed
     */
    public function delete(User $user, UserInfo $userInfo)
    {
        
    }
}
