<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'remaining_balance' => 'required|numeric|min:0',
            'lot_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('purchases')->where(function ($query) {
                    return $query->where('product_id', $this->product_id);
                }),
            ],
            'expiry_date' => 'required|date',
            'notes' => 'nullable|string',
        ];
    }
}