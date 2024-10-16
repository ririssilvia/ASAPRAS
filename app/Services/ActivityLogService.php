<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    public function all()
    {
        return ActivityLog::all();
    }

    public function find($id)
    {
        return ActivityLog::findOrFail($id);
    }

    public function create($request)
    {
        $data = $request->safe()->only(['user_id', 'activity_type', 'description', 'log_time']);
        $activityLog = ActivityLog::create($data);

        return $activityLog;
    }

    public function update($request, $id)
    {
        $activityLog = ActivityLog::findOrFail($id);
        $data = $request->safe()->only(['user_id', 'activity_type', 'description', 'log_time']);
        $activityLog->update($data);

        return $activityLog; 
    }

    public function delete($id)
    {
        $activityLog = $this->find($id);
        $activityLog->delete();

        return $activityLog;
    }
}
