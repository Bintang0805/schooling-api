<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAdmissionRequest;
use App\Http\Requests\UpdateAdmissionRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admissions = Admission::get();

        $admissions->map(function ($admission, $key) {
            $admission->document = $admission->getDocumentLink();
        });

        return response()->json(['admissions' => $admissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmissionRequest $request)
    {
        $data = $request->validated();

        if ($data['user_id'] == $data['parent_id'])
            (
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'User and Parent ID is same',
                ]))
            );

        $data['document'] = $request->file('document')->store('admission/documents');

        Admission::create($data);

        return response()->json(['message' => 'Admission successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        return response()->json(['admission' => $admission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmissionRequest $request, Admission $admission)
    {

        $data = $request->validated();

        if ($data['user_id'] == $data['parent_id'])
            (
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'User and Parent ID is same',
                ]))
            );

        Storage::delete($admission->document);
        $data['document'] = $request->file('document')->store('admission/documents');

        $admission->update($data);

        return response()->json(['message' => 'Admission successfully created']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        $admission_document_link = $admission->document;

        $admission->delete();

        Storage::delete($admission_document_link);

        return response()->json(['message' => 'Admission deleted successfuly']);
    }

    public function changeStatus(Request $request, Admission $admission)
    {
        try {
            $data = $request->validate([
                'status' => ['required', 'string', 'in:Pending,Approved,Rejected'],
            ]);

        } catch (ValidationException $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->errors()
            ]));
        }

        if ($admission->status == $data['status']) {
            return response()->json(['message' => 'Meeting is not changing.']);
        }

        $admission->update(['status' => $data['status']]);

        return response()->json(['message' => "Meeting is {$data['status']}"]);
    }
}
