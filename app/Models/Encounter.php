<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function total_bulan()
    {
        return self::whereYear('encounter_date', now()->year)
            ->whereMonth('encounter_date', now()->month)
            ->count();
    }
    public static function total_hari()
    {
        return self::whereDate('encounter_date', now())
            ->count();
    }

}
