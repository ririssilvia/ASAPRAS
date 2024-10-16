<?php

namespace App\Services;

use App\Models\Trafo;

class TrafoService
{
    public function store($request)
    {
        return Trafo::create($request->all());
    }

    public function update(Trafo $trafo, $request)
    {
        $trafo->update($request->all());
    }

    public function delete(Trafo $trafo)
    {
        $trafo->delete();
    }

    public function get($relation = [], $condition = [])
    {
        $trafo = Trafo::query();
        if ($relation) {
            $trafo = $trafo->with($relation);
        }
        if ($condition) {
            $trafo = $trafo->where($condition);
        }

        return $trafo;
    }

    public function all($relation = [], $condition = [])
    {
        $trafo = $this->get($relation, $condition);
        return $trafo->get();
    }

    public function find($id)
    {
        $trafo = Trafo::findOrFail($id);
        return $trafo->load('garduInduk.ultg');
    }
}
