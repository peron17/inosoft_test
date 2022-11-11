<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalesReportRequest extends FormRequest
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
            'jenis_kendaraan' => 'string|in:mobil,motor|nullable',
            'start_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'end_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'sort_by' => [
                'nullable',
                'in:tgl_transaksi,nama_pelanggan,total_harga',
            ],
            'sort' => [
                'nullable',
                'in:asc,desc',
            ],
        ];
    }
}
