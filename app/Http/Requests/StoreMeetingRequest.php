<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'school_id' => ['required', 'numeric', 'exists:schools,id'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'topic' => ['required', 'string'],
            'password' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'status' => ['nullable', 'in:Coming Soon,On Going,Finished'],
        ];
    }
}
