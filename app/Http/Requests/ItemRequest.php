<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        if ($this->method() == "POST") {
            return [
            'propertyno'   => 'required|string|max:255|unique:items,propertyno',
            'item'         => 'required|string|max:255',
            'unit'         => 'nullable|string|max:100',
            'descrip'      => 'nullable|string',

            'classid'      => 'nullable|integer',
            'yrlife'       => 'nullable|integer',

            'reorderpt'    => 'nullable|integer',
            'reorderqty'   => 'nullable|integer',

            'edate'        => 'nullable|date',

            'itemtypeid'   => 'nullable|integer',
            'status'       => 'nullable|string|max:50',

            'criticalqty'  => 'nullable|integer',
            'allow'        => 'boolean',

            'propertycard' => 'nullable|string|max:255',
            ];
        }
    }
}
