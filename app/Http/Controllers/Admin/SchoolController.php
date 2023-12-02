<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::with("user")->get();
        $users = User::doesntHave("school")->get();
        return response()->json(['schools' => $schools, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id) {
            $credentials = $request->validate([
                "user_id" => ["required", "unique:schools,user_id,". $request->id],
                "name" => ["required", "unique:schools,name," . $request->id],
                "code" => [],
                "principal" => [],
                "email" => ["required", "unique:schools,email," . $request->id],
                "phone_number" => ["required", "unique:schools,phone_number," . $request->id],
                "address" => ["required"],
                "description" => [],
                "logo" => [],
            ]);
        } else {
            $credentials = $request->validate([
                "user_id" => ["required", "unique:schools,user_id"],
                "name" => ["required", "unique:schools,name"],
                "code" => [],
                "principal" => [],
                "email" => ["required", "unique:schools,email"],
                "phone_number" => ["required", "unique:schools,phone_number"],
                "address" => ["required"],
                "description" => [],
                "logo" => ["required"],
            ]);
        }

        if($request->file('logo') != "") {
            $logoPath = $request->file('logo')->store('stores', 'uploads');
            $credentials["logo"] = $logoPath;
        }

        $school = School::updateOrInsert(["id" => $request->id], $credentials);

        return response()->json(['school' => $school, 'message' => 'School save successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return response()->json(['school' => $school]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $credentials = $request->validate([
            "user_id" => ["required", "unique:schools,user_id," . $school->id ],
            "name" => ["required", "unique:schools,name," . $school->id],
            "code" => [],
            "principal" => [],
            "email" => ["required", "unique:schools,email," . $school->id],
            "phone_number" => ["required", "unique:schools,phone_number," . $school->id],
            "address" => ["required"],
            "description" => [],
            "logo" => [],
        ]);

        $school->update($credentials);

        return response()->json(['school' => $school, 'message' => 'School updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return response()->json(['message' => 'School deleted successfully.']);
    }
}
