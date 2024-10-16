<?php

namespace App\Http\Requests\ActivityLog;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityLogRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization based on your application's requirements
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'activity_type' => 'required|string|max:255',
            'description' => 'required|string',
            'log_time' => 'required|date'
        ];
    }
}
