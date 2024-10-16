<?php

namespace App\Services;

use App\Models\Ultg;

class UltgService
{
    public function create($validated)
    {
        // Filter property apa saja yg boleh diinput (untuk menghindari jika ada banyak property yg tidak dibutuhkan) 
        $onlyColumnt = [
            'nama_ultg'
        ];
        $data = $validated->only($onlyColumnt);
    
        $ultg = Ultg::create($data);
        return $ultg;
    }

    public function all()
    {
        return Ultg::all();
    }

    public function find($id)
    {
        return Ultg::findOrFail($id);
    }

    public function get($relation = [], $condition = [])
    {
        $ultg = Ultg::query();
        if ($relation) {
            $ultg = $ultg->with($relation);
        }
        if ($condition) {
            $ultg = $ultg->where($condition);
        }

        $ultg = $ultg->get();
        return $ultg;
    }
    
    public function update($validated, $id)
    {
        $onlyColumnt = [
            'nama_ultg'
        ];
        $data = $validated->only($onlyColumnt);

        $ultg = Ultg::findOrFail($id);
        $ultg->update($data);
    }

    public function delete($id)
    {
        $ultg = Ultg::findOrFail($id);
        $ultg->delete();
    }
}