<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Order $order)
    {
        //
    }


    public function create(User $user)
    {
        if($user->role_id==1 || $user->role_id==3)
            return true;
        return false;
    }


    public function update(User $user, Order $order)
    {

    }

    public function delete(User $user, Order $order)
    {
        if($user->role_id==3 || $order->user_id==$user->id)
            return true;

        if($user->id==$order->vacancy->creator_id)
            return true;
        else
            return false;
    }


}
