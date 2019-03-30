<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vacancy::class);
    }
    public function index()
    {
        $this->authorize('index', Vacancy::class);
        return response()->json(['success' =>  Vacancy::where('status',0)->get()]);
    }


    public function store(Request $request)
    {

        $vacancy= Vacancy::create($request->all());
        return response()->json($vacancy, 201);
    }
    public function statistic()
    {
        $this->authorize('statistic', Vacancy::class);
        $count_active = Vacancy::where('status', 0)->count();
        $count_inactive = Vacancy::where('status', 1)->count();
        $count_all = DB::table('vacancies')->count();
        return response()->json(['count active vacancies' => $count_active, 'count inactive vacancies' => $count_inactive,
                'count_all' => $count_all], 200);
    }

    public function show(Vacancy $vacancy)
    {

        return response()->json($vacancy, 200);
    }


//only owner and admin
    public function update(Request $request, Vacancy $vacancy)
    {
        $vacancy->update($request->all());
        return response()->json($vacancy);
    }


    public function destroy(Vacancy $vacancy)
    {

        return response()->json(['success' => $vacancy->delete()], 200);
    }
}
