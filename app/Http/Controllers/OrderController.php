<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use App\Models\Vacancy;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }
    //Просмотр заявленных работников по каждой созданной вакансии
    public function index()
    {
        $user = Auth::guard()->user();
        if($user->role_id==3)
            $order = Vacancy::with('order')->get();

        else {
            $order = Vacancy::where('creator_id', $user->id)->with('order')->get();
        }
        return response()->json(['success' => $order]);
    }
    //Просмотр заявленных работников по всем вакансиям организации
    /*-----------------------------------------------------*/
    public function indexAllVacancy()
    {
        $user= Auth::guard()->user();
        if($user->role_id==3)
            $order=Organization::with('vacancy')->get();

        else
            $order=Organization::where('creator_id',$user->id)->with('vacancy.order')->get();
        return response()->json(['success'=>$order]);
    }

    public function store(Request $request)
    {
        //
        $vacancy= new Order($request->all());

        $users =Order::where('vacancy_id',$request->vacancy_id)->get()->count();
        $amount = $vacancy->vacancy->amount_workers;
        if($users >= $amount){
           $vacancy = $vacancy->vacancy;
            $vacancy->status = 1;
            $vacancy->save();
        }
        if($vacancy->status == 1){
            return response()->json(['success' => false]);

        }
        return response()->json($vacancy->save(), 201);
    }

    public function show(Order $order)
    {
        //
    }

//    public function update(Request $request, Order $order)
//    {
//        //
//    }


    public function destroy(Order $order)
    {
        $users =Order::where('vacancy_id',$order->id)->get()->count();
        $amount = $order->vacancy->amount_workers;
        if($users < $amount){
            $vacancy = $order->vacancy;
            $vacancy->status = 0;
            $vacancy->save();
        }
        return response()->json(['success' => $order->delete()], 200);

    }
}
