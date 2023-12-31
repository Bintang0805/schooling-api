<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreAdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return auth()->check();

    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'parent_id' => ['required', 'numeric', 'exists:users,id'],
            'course_id' => ['required', 'numeric', 'exists:courses,id'],
            'previous_school_year' => ['nullable', 'string'],
            'physical_disabilities' => ['nullable', 'string'],
            'previous_school_name' => ['nullable', 'string'],
            'document' => ['required', 'file', 'mimes:png,jpg,jpeg,pdf'],
            'bank_name' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'note' => ['nullable', 'string'],
        ];
    }
}
