<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return true;
        };
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'type_id' => ['numeric', 'integer', 'min:1', 'max:4' ],
            'authors' => ['string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'translations.*.purpose' => ['string', 'nullable', 'max:180'],
            'translations.*.description' => ['string', 'max:2000'],
            'technologies' => ['array'],
            'technologies.*' => ['integer'],
            'url' => ['nullable', 'url', 'max:2048'],
            'img' => ['file', 'image', 'max:25000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'translations.*.purpose' => 'scopo',
            'translations.*.description' => 'descrizione',
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     dd($validator->errors()->toArray());
    // }
}