<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
        if($request->id) {
            $credentials = $request->validate([
                "course_id" => ["required"],
                "subject" => ["required"],
                "color" => ["required"],
            ]);
        } else {
            $credentials = $request->validate([
                "course_id" => ["required"],
                "subject" => ["required"],
                "color" => ["required"],
            ]);
        }

        $subject = Subject::updateOrInsert(["id" => $request->id], $credentials);

        return response()->json(['subject' => $subject, 'message' => 'Subject save successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return response()->json(['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Subject  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $credentials = $request->validate([
            "school_id" => ["required"],
            "subject" => ["required"],
            "name" => ["required"],
        ]);

        $subject->update($credentials);

        return response()->json(['subject' => $subject, 'message' => 'Subject updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully.']);
    }
}
