<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepairActivity\StoreRepairActivityRequest;
use App\Http\Requests\RepairActivity\UpdateRepairActivityRequest;
use App\Services\RepairActivityService;
use App\Models\DamageReport; // Import model DamageReport
use App\Models\User; // Import model User

class RepairActivityController extends Controller
{
    private $repairActivityService;

    public function __construct(RepairActivityService $repairActivityService)
    {
        $this->repairActivityService = $repairActivityService;
    }

    public function index()
    {
        $repairActivities = $this->repairActivityService->all();
        return view('repairActivity.index', compact('repairActivities'));
    }

    public function create()
    {
        $damageReports = DamageReport::all(); // Ambil semua laporan kerusakan
        $users = User::all(); // Ambil semua pengguna

        return view('repairActivity.form', [
            'mode' => 'Add',
            'action' => route('repairActivity.store'),
            'damageReports' => $damageReports, // Kirim data laporan kerusakan ke view
            'users' => $users, // Kirim data pengguna ke view
        ]);
    }

    public function store(StoreRepairActivityRequest $request)
    {
        $validated = $request->validated();
        $repairActivity = $this->repairActivityService->create($validated);
        return redirect()->route('repairActivity.index')->with('success', 'Repair activity created successfully.');
    }

    public function show($id)
    {
        $repairActivity = $this->repairActivityService->find($id);
        return view('repairActivity.show', compact('repairActivity'));
    }

    public function edit($id)
    {
        $repairActivity = $this->repairActivityService->find($id);
        $damageReports = DamageReport::all(); // Ambil semua laporan kerusakan
        $users = User::all(); // Ambil semua pengguna

        return view('repairActivity.form', [
            'mode' => 'Edit',
            'action' => route('repairActivity.update', $id),
            'repairActivity' => $repairActivity,
            'damageReports' => $damageReports, // Kirim data laporan kerusakan ke view
            'users' => $users, // Kirim data pengguna ke view
        ]);
    }

    public function update(UpdateRepairActivityRequest $request, $id)
    {
        $validated = $request->validated();
        $repairActivity = $this->repairActivityService->update($validated, $id);
        return redirect()->route('repairActivity.index')->with('success', 'Repair activity updated successfully.');
    }

    public function destroy($id)
    {
        $this->repairActivityService->delete($id);
        return redirect()->route('repairActivity.index')->with('success', 'Repair activity deleted successfully.');
    }
}
