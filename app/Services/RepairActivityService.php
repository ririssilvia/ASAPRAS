<?php

namespace App\Services;

use App\Models\RepairActivity;

class RepairActivityService
{
    public function all()
    {
        return RepairActivity::with(['damageReport', 'assignedUser'])->get();
    }

    public function find($id)
    {
        return RepairActivity::findOrFail($id);
    }

    public function create($data)
    {
        return RepairActivity::create($data);
    }

    public function update($data, $id)
    {
        $repairActivity = $this->find($id);
        $repairActivity->update($data);
        return $repairActivity;
    }

    public function delete($id)
    {
        $repairActivity = $this->find($id);
        $repairActivity->delete();
        return $repairActivity;
    }
}
