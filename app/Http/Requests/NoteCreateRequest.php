<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Mixed_;

/**
 * @property string $name
 * @property string $category_id
 */
class NoteCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:6'],
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'category_id'=>['required',Rule::exists('categories','id')]
        ];
    }
}
