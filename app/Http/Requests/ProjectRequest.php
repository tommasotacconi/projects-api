<?php

namespace App\Http\Requests;

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
			'type_id' => ['required', 'numeric', 'integer', 'min:1', 'max:4' ],
			'authors' => ['string', 'max:255'],
			'arguments' => ['required', 'string'],
			'start_date' => ['date'],
			'end_date' => ['date'],
			'img_url' => ['file', 'image', 'max:25000'],
			'url' => ['nullable', 'url', 'max:2048']
		];
	}
}
