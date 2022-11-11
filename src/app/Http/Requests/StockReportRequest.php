<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StockReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_kendaraan' => 'nullable|string|in:mobil,motor',
            'nama_kendaraan' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (is_array($value)) {
                        $fail("The $attribute is invalid");
                    }
                }
            ]
        ];
    }
}
