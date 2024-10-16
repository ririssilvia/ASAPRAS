<?php

namespace App\Http\Requests\DamageReport;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDamageReportRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Sesuaikan logika otorisasi Anda
    }

    public function rules()
    {
        return [
            'facility_id' => 'required|integer',
            'reported_by' => 'required|integer',
            'description' => 'required|string',
            'status' => 'nullable|string', // Mengubah status menjadi nullable
            'image_url' => 'nullable|file|image|max:2048', // Asumsi untuk unggah gambar
        ];
    }
}
