<?php

namespace App\Services;

use App\Models\Trigger;

class TriggerService
{
    private $notifService;
    private $columns = [
        'tmp_oil_ind' => 'Oil Temperature Indicator',
        'tmp_hv_ind' => 'HV Winding Temperature Indicator',
        'tmp_lv_ind' => 'LV Winding Temperature Indicator',
        'position_tap' => 'Position Tap Changer',
        'trans_cool' => 'Transformator Cooling',
        'trans_fan' => 'Transformator Fan',
        'trans_mcb' => 'Transformator MCB TRIP',
        'local' => 'Local',
        'pressure' => 'Pressure Relief Trip',
        'oil_tmp_alaram' => 'Oil Temperature Alarm',
        'oil_tmp_trip' => 'Oil Temperature Trip',
        'oil_tmp_min' => 'Oil Temperature Min',
        'oil_tmp_max' => 'Oil Temperature Max',
        'hv_tmp' => 'HV Winding Temperature Alarm',
        'lv_tmp' => 'LV Winding Temperature Alarm',
        'buch_alarm' => 'Bucholz Alarm',
        'sudden_presure' => 'Sudden Pressure Alarm',
        'fire_detection' => 'Fire Detection & Protection',
        'jasen_Trip' => 'Jansen Trip'
    ];

    public function __construct(NotificationService $notifService)
    {
        $this->notifService = $notifService;
    }
    
    public function create($request)
    {
        $data = $request->safe()->only([
            'nama_kolom',
            'label',
            'parameter',
            'operator',
            'id_trigger_parent'
        ]);
        
        $trigger = Trigger::create($data);
        return $trigger;
    }

    public function update($request, $id)
    {
        $trigger = Trigger::findOrFail($id);

        $data = $request->safe()->only([
            'nama_kolom',
            'label',
            'parameter',
            'operator',
            'id_trigger_parent'
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
        return Trigger::findOrFail($id);
    }

    public function get($relation = [], $condition = [])
    {
        $trigger = Trigger::query();
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
        $trigger = Trigger::findOrFail($id);
        $trigger->delete();
    }

    public function evaluateEsp($esp)
    {
        $triggers = $this->all();
        $firstCheckTriggers = $triggers->whereNull('id_trigger_parent');

        foreach ($firstCheckTriggers as $firstCheckTrigger) {
            $this->check($triggers, $firstCheckTrigger, $esp);
        }
    }

    public function check($triggers, $trigger, $esp)
    {
        // Set notif desc
        $notifDesc = $this->columns[$trigger->nama_kolom] . ' pada Trafo ' . $esp->trafo->nama_trafo;
        if (in_array($trigger->nama_kolom, ['tmp_oil_ind', 'tmp_hv_ind', 'tmp_lv_ind'])) {
            $notifDesc = $notifDesc . ' mencapai ' . $esp[$trigger->nama_kolom] . '!';
        } else if ($trigger->nama_kolom == 'position_tap') {
            $notifDesc = $notifDesc . ' bernilai ' . $esp[$trigger->nama_kolom] . '!';
        } else {
            $notifDesc = $notifDesc . ' dalam keadaan ' . ($esp[$trigger->nama_kolom] ? 'ON!' : 'OFF!' );
        }

        $notified = false;
        if ($trigger->operator == '==') {
            if ($esp[$trigger->nama_kolom] == $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        } else if ($trigger->operator == '!=') {
            if ($esp[$trigger->nama_kolom] != $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        } else if ($trigger->operator == '>') {
            if ($esp[$trigger->nama_kolom] > $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        } else if ($trigger->operator == '<') {
            if ($esp[$trigger->nama_kolom] < $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        } else if ($trigger->operator == '>=') {
            if ($esp[$trigger->nama_kolom] >= $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        } else if ($trigger->operator == '<=') {
            if ($esp[$trigger->nama_kolom] <= $trigger->parameter) {
                $this->notifService->create([
                    'title' => $trigger->label . ' Failure',
                    'description' => $notifDesc,
                    'id_logdataesp' => $esp->id_logdataesp
                ]);
                $notified = true;
            }
        }

        // Recursive if another trigger hooked
        if ($notified) {
            $triggerChilds = $triggers->where('id_trigger_parent', $trigger->id);
            if ($triggerChilds->count() > 0) {
                foreach ($triggerChilds as $triggerChild) {
                    $this->check($triggers, $triggerChild, $esp);
                }
            }
        }
    }
}
