<?php

namespace App\Http\Requests\RepairActivity;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepairActivityRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Sesuaikan dengan logika otorisasi Anda
    }

    public function rules()
    {
        return [
            'report_id' => 'required|integer|exists:damage_reports,id',
            'assigned_to' => 'required|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'remarks' => 'nullable|string',
        ];
    }
}
