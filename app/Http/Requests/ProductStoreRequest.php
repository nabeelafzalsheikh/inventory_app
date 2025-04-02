<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     */
    public function rules()
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'category_id' => ['required', 'integer', 'gt:0', 'exists:categories,id'],
        'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
        'price' => ['required', 'numeric', 'between:0,999999.99', 'regex:/^\d+(\.\d{1,2})?$/'],
        'brand_id' => ['required', 'integer', 'gt:0', 'exists:brands,id'],
        'pieces' => ['required', 'integer', 'min:0', 'max:999999'],
        'description' => ['nullable', 'string', 'max:1000'],
        'status' => ['required', 'in:instock,outofstock,discontinued'],
    ];
}

public function messages()
{
    return [
        'category_id.exists' => 'The selected category is invalid.',
        'brand_id.exists' => 'The selected brand is invalid.',
        'price.regex' => 'Price must have up to 2 decimal places.',
        'sku.unique' => 'This SKU already exists in our system.',
    ];
}

}
