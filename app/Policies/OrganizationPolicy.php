<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;


    public function index(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        if($user->role_id==2 || $user->role_id==3)
            return true;
        return false;

    }
    public function statistic(User $user)
    {
        if($user->role_id==3)
            return true;
        return false;
    }

    public function update(User $user, Organization $model)
    {
        if($user->role_id==3 || $model->creator_id==$user->id)
            return true;
        else
            return false;
    }

    public function delete(User $user, Organization $model)
    {
        if($user->role_id==3 || $model->creator_id==$user->id)
            return true;
        else
            return false;
    }


}
