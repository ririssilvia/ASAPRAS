<?php

namespace App\Services;

use App\Models\TriggerTolerance;

class TriggerToleranceService
{
    private $notifService;
    private $columns = [
        'tmp_oil_ind' => 'Oil Temperature Indicator',
        'tmp_oil_ind_average' => 'Oil Temperature Indicator Average',
        'tmp_hv_ind' => 'HV Winding Temperature Indicator',
        'tmp_hv_ind_average' => 'HV Winding Temperature Indicator Average',
        'tmp_lv_ind' => 'LV Winding Temperature Indicator',
        'tmp_lv_ind_average' => 'LV Winding Temperature Indicator Average',
        'suhu_daerah' => 'Environment Temperature'
    ];

    public function __construct(NotificationService $notifService)
    {
        $this->notifService = $notifService;
    }

    public function create($request)
    {
        $data = $request->safe()->only([
            'label',
            'nama_kolom',
            'nama_kolom_toleransi',
            'max_toleransi'
        ]);
        
        $trigger = TriggerTolerance::create($data);
        return $trigger;
    }

    public function update($request, $id)
    {
        $trigger = TriggerTolerance::findOrFail($id);

        $data = $request->safe()->only([
            'label',
            'nama_kolom',
            'nama_kolom_toleransi',
            'max_toleransi'
        ]);

        $trigger->update($data);
        return $trigger;
    }

    public function all($relation = [], $condition = [])
    {
        $trigger = $this->get($relation, $condition);
        return $trigger->get();
    }

    public function find($id)
    {
        return TriggerTolerance::findOrFail($id);
    }

    public function get($relation = [], $condition = [])
    {
        $trigger = TriggerTolerance::query();
        if ($relation) {
            $trigger = $trigger->with($relation);
        }
        if ($condition) {
            $trigger = $trigger->where($condition);
        }

        return $trigger;
    }

    public function delete($id)
    {
        $trigger = TriggerTolerance::findOrFail($id);
        $trigger->delete();
    }

    public function evaluateEsp($esp)
    {
        $triggers = $this->all();
        foreach ($triggers as $trigger) {
            $this->check($trigger, $esp);
        }
    }

    public function check($trigger, $esp)
    {
        if (abs($esp[$trigger->nama_kolom] - $esp[$trigger->nama_kolom_toleransi]) >= $trigger->max_toleransi) {
            $this->notifService->create([
                'title' => $trigger->label,
                'description' => $this->columns[$trigger->nama_kolom] . ' pada Trafo ' . $esp->trafo->nama_trafo . ' mencapai ' . $esp[$trigger->nama_kolom],
                'id_logdataesp' => $esp->id_logdataesp
            ]);
        }
    }
}
