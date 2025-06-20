<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description'=> 'required',
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'category_id'=>'required|exists:categories,id',
        ];
    }
    // i make this function
    public function attributes(): array
    {
        return [
            'category_id'=>'Category',//when validation error occur the name of this field eill be Category
        ];
    }
}
