<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $schools = School::with("user")->get();
    //     $users = User::doesntHave("school")->get();
    //     return response()->json(['schools' => $schools, 'users' => $users]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $credentials = $request->validate([
                "course_id" => ["required"],
                "plan" => ["required"],
                "description" => ["required"],
                "benefits" => ["required"],
            ]);
        } else {
            $credentials = $request->validate([
                "course_id" => ["required"],
                "plan" => ["required"],
                "description" => ["required"],
                "benefits" => ["required"],
            ]);
        }

        $plan = Plan::updateOrInsert(["id" => $request->id], $credentials);

        return response()->json(['plan' => $plan, 'message' => 'Plan save successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return response()->json(['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $credentials = $request->validate([
            "course_id" => ["required"],
            "plan" => ["required"],
            "description" => ["required"],
            "benefits" => ["required"],
        ]);

        $plan->update($credentials);

        return response()->json(['plan' => $plan, 'message' => 'Plan updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully.']);
    }
}
