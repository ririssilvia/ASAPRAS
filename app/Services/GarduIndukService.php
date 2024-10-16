<?php

namespace App\Services;

use App\Models\GarduInduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GarduIndukService
{

    
    /**
     * Create a new GarduInduk record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\GarduInduk
     */
    public function create(Request $request)
    {
        // Ambil data dari request, kecuali 'gambar'
        $data = $request->safe()->only(['id_ultg', 'nama', 'deskripsi', 'lat', 'log']);
        $gardu = GarduInduk::create($data);

        // Handle file upload jika ada
        if ($request->hasFile('gambar')) {
            $destination_path = 'public/images/gardu';
            $img = $request->file('gambar');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'gardu' . $gardu->id_gi . '.' . $extension;
            $path = $img->storeAs($destination_path, $img_name);
            $gardu->update(['gambar' => $path]);
        }

        return $gardu;
    }

    /**
     * Get all GarduInduk records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return GarduInduk::all();
    }

    /**
     * Find a GarduInduk record by its ID.
     *
     * @param int $id
     * @return \App\Models\GarduInduk
     */
    public function find($id)
    {
        return GarduInduk::findOrFail($id);
    }

    /**
     * Get GarduInduk records with relations and conditions.
     *
     * @param array $relation
     * @param array $condition
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get(array $relation = [], array $condition = [])
    {
        $gardu = GarduInduk::query();

        if ($relation) {
            $gardu->with($relation);
        }

        if ($condition) {
            foreach ($condition as $key => $value) {
                $gardu->where($key, $value);
            }
        }

        return $gardu->get();
    }

    /**
     * Update an existing GarduInduk record.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Models\GarduInduk
     */
    public function update(Request $request, $id)
    {
        $gardu = GarduInduk::findOrFail($id);

        // Ambil data dari request, kecuali 'gambar'
        $data = $request->safe()->only(['id_ultg', 'nama', 'deskripsi', 'lat', 'log']);

        // Handle file upload jika ada
        if ($request->hasFile('gambar')) {
            $destination_path = 'public/images/gardu';
            $img = $request->file('gambar');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'gardu' . $gardu->id_gi . '.' . $extension;
            $path = $img->storeAs($destination_path, $img_name);
            $data['gambar'] = $path;
        }

        $gardu->update($data);
        return $gardu;
    }

    /**
     * Delete a GarduInduk record.
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $gardu = GarduInduk::findOrFail($id);

        // Delete the image file if it exists
        if ($gardu->gambar) {
            Storage::delete($gardu->gambar);
        }

        $gardu->delete();
    }
}
