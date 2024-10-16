<?php

namespace App\Http\Requests\ActivityLog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityLogRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization based on your application's requirements
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'activity_type' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'log_time' => 'sometimes|required|date'
        ];
    }
}
