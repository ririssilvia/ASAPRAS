<?php

namespace App\Services;

use App\Models\Facility;

class FacilityService
{
    public function all()
    {
        return Facility::all();
    }

    public function find($id)
    {
        return Facility::findOrFail($id);
    }

    public function create($data) // Accepts $data array
    {
        // No need to call safe() here, since $data is already validated in the controller
        return Facility::create($data);
    }

    public function update($data, $id) // Accepts $data array
    {
        $facility = Facility::findOrFail($id);
        $facility->update($data);

        return $facility;
    }

    public function delete($id)
    {
        $facility = $this->find($id);
        $facility->delete();

        return $facility;
    }
}
