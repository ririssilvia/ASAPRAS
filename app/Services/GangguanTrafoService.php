<?php

namespace App\Services;

use App\Models\GangguanTrafo;

class GangguanTrafoService
{
    public function all()
    {
        return GangguanTrafo::all();
    }

    public function find($id)
    {
        return GangguanTrafo::findOrFail($id);
    }

    public function create(array $data)
    {
        return GangguanTrafo::create($data);
    }

    public function update(array $data, $id)
    {
        $gangguanTrafo = GangguanTrafo::findOrFail($id);
        $gangguanTrafo->update($data);

        return $gangguanTrafo;
    }

    public function delete($id)
    {
        $gangguanTrafo = GangguanTrafo::findOrFail($id);
        $gangguanTrafo->delete();

        return $gangguanTrafo;
    }
}
