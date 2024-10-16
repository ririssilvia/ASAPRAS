<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityLog\StoreActivityLogRequest;
use App\Http\Requests\ActivityLog\UpdateActivityLogRequest;
use App\Services\ActivityLogService;

class ActivityLogController extends Controller
{
    private $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    public function index()
    {
        $activityLogs = $this->activityLogService->all();
        return view('activityLog.index', compact('activityLogs'));
    }

    public function create()
    {
        return view('activityLog.form', [
            'mode' => 'Add',
            'action' => route('activityLog.store')
        ]);
    }

    public function store(StoreActivityLogRequest $request)
    {
        $validated = $request->validated();
        $activityLog = $this->activityLogService->create($validated);
        return redirect()->route('activityLog.index')->with('success', 'Activity Log created successfully.');
    }

    public function show($id)
    {
        $activityLog = $this->activityLogService->find($id);
        return view('activityLog.show', compact('activityLog'));
    }

    public function edit($id)
    {
        $activityLog = $this->activityLogService->find($id);
        return view('activityLog.form', [
            'mode' => 'Edit',
            'action' => route('activityLog.update', $id),
            'activityLog' => $activityLog
        ]);
    }

    public function update(UpdateActivityLogRequest $request, $id)
    {
        $validated = $request->validated();
        $activityLog = $this->activityLogService->update($validated, $id);
        return redirect()->route('activityLog.index')->with('success', 'Activity Log updated successfully.');
    }

    public function destroy($id)
    {
        $this->activityLogService->delete($id);
        return redirect()->route('activityLog.index')->with('success', 'Activity Log deleted successfully.');
    }
}
