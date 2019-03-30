<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Organization::class);
    }

    public function index()
    {
        $this->authorize('index', Organization::class);
        return response()->json(['success' => Organization::all()]);
    }

    public function show(Organization $organization)
    {
        return response()->json($organization, 200);
    }
    public function statistic()
    {
        $this->authorize('statistic', Organization::class);
        $count_organization = DB::table('organizations')->count();
        return response()->json(['count organizations' => $count_organization], 200);
    }
    public function store(Request $request)
    {
        $organization= Organization::create($request->all());
        return response()->json($organization, 201);
    }

    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->all());
        return response()->json($organization);
    }

    public function destroy(Organization $organization)
    {
        return response()->json(['success' => $organization->delete()], 200);
    }

}
