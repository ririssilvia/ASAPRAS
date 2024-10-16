<?php

namespace App\Services;

use App\Models\UmurTrafo;

class UmurTrafoService
{
    public function getAllUmurTrafo()
    {
        return UmurTrafo::with('trafo')->get();
    }

    public function create(array $data)
    {
        return UmurTrafo::create($data);
    }

    public function getUmurTrafoById($id)
    {
        return UmurTrafo::with('trafo')->findOrFail($id);
    }

    public function updateUmurTrafo($id, array $data)
    {
        $umurTrafo = UmurTrafo::findOrFail($id);
        $umurTrafo->update($data);
        return $umurTrafo;
    }

    public function deleteUmurTrafo($id)
    {
        $umurTrafo = UmurTrafo::findOrFail($id);
        $umurTrafo->delete();
        return $umurTrafo;
    }
}
