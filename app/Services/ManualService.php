<?php

namespace App\Services;

use App\Models\Manual;

class ManualService
{
    public function getAll()
    {
        return Manual::all();
    }

    public function findById($id)
    {
        return Manual::findOrFail($id);
    }

    public function create($request)
    {
        $data = $request->safe()->only(['nama']);
        $data['file'] = 'temp';
        $manual =  Manual::create($data);
        
        if ($request->hasFile('file')) {
            $destination_path = 'public/documents/manual';
            $img = $request->file('file');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'manual_' . $manual->id_manual . '.' .$extension;
            $path = $img->storeAs($destination_path, $img_name);
            $manual->update(['file' => $path]);
        }
        return $manual;
    }

    public function update($request, $id)
    {
        $manual = Manual::findOrFail($id);
        $data = $request->safe()->only(['nama']);
        
        if ($request->hasFile('file')) {
            $destination_path = 'public/documents/manual';
            $img = $request->file('file');
            $extension = $img->getClientOriginalExtension();
            $img_name = 'manual_' . $manual->id_manual . '.' .$extension;
            $path = $img->storeAs($destination_path, $img_name);
            $data['file'] = $path;
        }
        
        $manual->update($data);
        return $manual;
    }

    public function delete($id)
    {
        $manual = Manual::findOrFail($id);
        $manual->delete();
    }
}
