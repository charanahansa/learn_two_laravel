<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ProductValidationTrait
{
    public function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity_in_stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:255',
        ]);
    }
}
