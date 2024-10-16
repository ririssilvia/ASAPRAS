<?php

namespace App\Http\Controllers;


use App\Http\Requests\Facility\StoreFacilityRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Services\FacilityService;

class FacilityController extends Controller
{
    private $facilityService;

    public function __construct(FacilityService $facilityService)
    {
        $this->facilityService = $facilityService;
    }

    public function index()
    {
        $facilities = $this->facilityService->all();
        return view('facility.index', compact('facilities'));
    }

    public function create()
    {
        $categories = ['listrik', 'plumbing', 'AC', 'infrastruktur_lain'];
        $statuses = ['aktif', 'non_aktif'];
        return view('facility.form', [
            'mode' => 'Add',
            'action' => route('facility.store'),
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    public function store(StoreFacilityRequest $request)
    {
        $validated = $request->validated(); // This is an array
        $this->facilityService->create($validated);
        return redirect()->route('facility.index')->with('success', 'Facility created successfully.');
    }

    public function show($id)
    {
        $facility = $this->facilityService->find($id);
        return view('facility.show', compact('facility'));
    }

    public function edit($id)
    {
        $facility = $this->facilityService->find($id);
        $categories = ['listrik', 'plumbing', 'AC', 'infrastruktur_lain'];
        $statuses = ['aktif', 'non_aktif'];
        return view('facility.form', [
            'mode' => 'Edit',
            'action' => route('facility.update', $id),
            'facility' => $facility,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    public function update(UpdateFacilityRequest $request, $id)
    {
        $validated = $request->validated(); // This is an array
        $this->facilityService->update($validated, $id);
        return redirect()->route('facility.index')->with('success', 'Facility updated successfully.');
    }

    public function destroy($id)
    {
        $this->facilityService->delete($id);
        return redirect()->route('facility.index')->with('success', 'Facility deleted successfully.');
    }
}
