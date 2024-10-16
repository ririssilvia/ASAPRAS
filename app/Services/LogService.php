<?php

namespace App\Services;

use App\Models\GarduWeather;
use App\Models\Logdataesp;
use App\Models\Trafo;
use Illuminate\Support\Facades\DB;

class LogService
{
    public function create($request)
    {
        $data = $request->safe()->only([
            'code_trafo',
            'tmp_oil_ind',
            'tmp_hv_ind',
            'tmp_lv_ind',
            'position_tap',
            'trans_cool',
            'trans_fan',
            'trans_mcb',
            'local',
            'pressure',
            'oil_tmp_alaram',
            'oil_tmp_trip',
            'oil_tmp_min',
            'oil_tmp_max',
            'hv_tmp',
            'lv_tmp',
            'buch_alarm',
            'sudden_presure',
            'fire_detection',
            'jasen_Trip',
        ]);
        
        $lastUpdateColumns = [
            'trans_cool_last_updated',
            'trans_fan_last_updated',
            'trans_mcb_last_updated',
            'local_last_updated',
            'pressure_last_updated',
            'oil_tmp_alaram_last_updated',
            'oil_tmp_trip_last_updated',
            'oil_tmp_min_last_updated',
            'oil_tmp_max_last_updated',
            'hv_tmp_last_updated',
            'lv_tmp_last_updated',
            'buch_alarm_last_updated',
            'sudden_presure_last_updated',
            'fire_detection_last_updated',
            'jasen_Trip_last_updated'
        ];

        $lastLog = Logdataesp::where("code_trafo", $data['code_trafo'])->orderBy('created_at', 'DESC')->first();
        $now = now();

        // it this first data
        if (!$lastLog) {
            foreach ($lastUpdateColumns as $lastUpdateColumn) {
                $data[$lastUpdateColumn] = $now;
            }
            $data['tmp_oil_ind'] = round($data['tmp_oil_ind'], 2);
            $data['tmp_hv_ind'] = round($data['tmp_hv_ind'], 2);
            $data['tmp_lv_ind'] = round($data['tmp_lv_ind'], 2);
            $data['tmp_oil_ind_average'] = $data['tmp_oil_ind'];
            $data['tmp_hv_ind_average'] = $data['tmp_hv_ind'];
            $data['tmp_lv_ind_average'] = $data['tmp_lv_ind'];
        // if theres previous data
        } else {
            foreach ($lastUpdateColumns as $lastUpdateColumn) {
                $column = str_replace('_last_updated', '', $lastUpdateColumn);
                $data[$lastUpdateColumn] = ($lastLog[$column] == $data[$column]) ? $lastLog[$lastUpdateColumn] : $now;
            }
            $data['tmp_oil_ind'] = round($data['tmp_oil_ind'], 2);
            $data['tmp_hv_ind'] = round($data['tmp_hv_ind'], 2);
            $data['tmp_lv_ind'] = round($data['tmp_lv_ind'], 2);
            $data['tmp_oil_ind_average'] = round(($data['tmp_oil_ind'] + $lastLog['tmp_oil_ind_average']) / 2, 2);
            $data['tmp_hv_ind_average'] = round(($data['tmp_hv_ind'] + $lastLog['tmp_hv_ind_average']) / 2, 2);
            $data['tmp_lv_ind_average'] = round(($data['tmp_lv_ind'] + $lastLog['tmp_lv_ind_average']) / 2, 2);
        }

        // get current temp
        $trafo = Trafo::with('garduInduk')->where('code_trafo', $data['code_trafo'])->first();
        $weather = GarduWeather::where('id_gi', $trafo->garduInduk->id_gi)->where('time', '>=', now()->format('Y-m-d H:00:00'))->first();
        $data['suhu_daerah'] = $weather ? $weather->temperature : 0;
        
        $esp = Logdataesp::create($data);
        return $esp;
    }

    public function all($relation = [], $condition = [])
    {
        $esp = $this->get($relation, $condition);
        return $esp->oldest()->get();
    }

    public function latest($relation = [], $condition = [], $take = 1)
    {
        $esp = $this->get($relation, $condition)->latest();
        return $esp->take($take)->get();
    }

    public function find($id)
    {
        $esp = Logdataesp::findOrFail($id);
        return $esp->load('trafo.garduInduk.ultg');
    }

    public function get($relation = [], $condition = [])
    {
        $esp = Logdataesp::query();
        if ($relation) {
            $esp = $esp->with($relation);
        }
        if ($condition) {
            $esp = $esp->where($condition);
        }

        return $esp;
    }

    public function paginate($perPage = 10, $relation = [], $condition = [])
    {
        $esp = $this->get($relation, $condition);
        return $esp->latest()->paginate($perPage);
    }

    public function getByTrafoCode($code)
    {
        return DB::table('logdataesp')->where('code_trafo', $code)->get();
    }
}
