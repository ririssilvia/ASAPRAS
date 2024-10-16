<?php

namespace App\Services;

use App\Models\DamageReport;

class DamageReportService
{
    public function all()
    {
        return DamageReport::all();
    }

    public function find($id)
    {
        return DamageReport::findOrFail($id);
    }

    public function create($request)
    {
        // Mengambil data dari request
        $data = $request->safe()->only(['facility_id', 'reported_by', 'description', 'status']);
        
        $damageReport = DamageReport::create($data);
        
        // Jika ada file gambar, simpan file tersebut
        if ($request->hasFile('image_url')) {
            $destination_path = 'public/images/damage_reports';
            $image = $request->file('image_url');
            $extension = $image->getClientOriginalExtension();
            $image_name = 'damage_report_' . $damageReport->id . '.' . $extension;
            $path = $image->storeAs($destination_path, $image_name);
            $damageReport->update(['image_url' => $path]);
        }

        return $damageReport;
    }

    public function update($request, $id)
    {
        $damageReport = DamageReport::findOrFail($id);
        
        // Mengambil data dari request
        $data = $request->safe()->only(['facility_id', 'reported_by', 'description', 'status']);
        
        // Jika ada file gambar, simpan file tersebut
        if ($request->hasFile('image_url')) {
            $destination_path = 'public/images/damage_reports';
            $image = $request->file('image_url');
            $extension = $image->getClientOriginalExtension();
            $image_name = 'damage_report_' . $damageReport->id . '.' . $extension;
            $path = $image->storeAs($destination_path, $image_name);
            $data['image_url'] = $path;
        }

        $damageReport->update($data);
        return $damageReport;
    }

    public function delete($id)
    {
        $damageReport = $this->find($id);
        $damageReport->delete();
        return $damageReport;
    }
}
