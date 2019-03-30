<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;


class UserController extends Controller
{
//only admin

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    public function index()
    {
        $this->authorize('index', User::class);
        return response()->json(['success' => User::all()]);
    }

    public function statistic()
    {
        $this->authorize('statistic', User::class);
        $worker =User::where('role_id', 1)->get()->count();
        $employer=User::where('role_id', 2)->get()->count();
        return response()->json(['worker'=>$worker,'employer'=> $employer],200);
    }

    public function show(User $user)
    {

        return response()->json($user, 200);
    }
//only owner and admin
    public function update(Request $request, User $user)
    {

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        return response()->json(['success' => $user->delete()], 200);
    }


   /* public function delete_me(User $user)
    {
        $user =Auth::guard('api')->user();
        $me= User::where('id',$user->id)->first() ;
        return response()->json(['success' => $me->delete()], 200);
    }
    //----------------------------------------------------------------------
    public function update_me(User $user, Request $request)
    {
        $user =Auth::guard('api')->user();
        $me= User::where('id',$user->id)->first() ;
        $me->update($request->all());
        return response()->json($me);
    }*/
}
