<?php

namespace App\Services;

use App\Models\Peralatan;

class PeralatanService
{
    public function all()
    {
        return Peralatan::all();
    }

    public function find($id)
    {
        return Peralatan::findOrFail($id);
    }

    public function create($request)
    {
        $data = $request->safe()->only(['judul', 'fungsi', 'deskripsi']);
        $peralatan =  Peralatan::create($data);
        
        if ($request->hasFile('gambar')) {
            $destination_path = 'public/images/peralatan';
            $img = $request->file('gambar');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'peralatan_' . $peralatan->id_peralatan . '.' .$extension;
            $path = $img->storeAs($destination_path, $img_name);
            $peralatan->update(['gambar' => $path]);
        }
        return $peralatan;
    }

    public function update($request, $id)
    {
        $peralatan = Peralatan::findOrFail($id);
        $data = $request->safe()->only(['judul', 'fungsi', 'deskripsi']);
        
        if ($request->hasFile('gambar')) {
            $destination_path = 'public/images/peralatan';
            $img = $request->file('gambar');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'peralatan_' . $peralatan->id_peralatan . '.' .$extension;
            $path = $img->storeAs($destination_path, $img_name);
            $data['gambar'] = $path;
        }
        
        $peralatan->update($data);
        return $peralatan;
    }

    public function delete($id)
    {
        $peralatan = $this->find($id);
        $peralatan->delete();
        return $peralatan;
    }
}
