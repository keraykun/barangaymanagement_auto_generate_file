<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Barangay(){
        return $this->belongsTo(Barangays::class);
    }

    public function Residents(){
        return $this->hasMany(Residents::class,'district_id','id');
    }
    public function Resident(){
        return $this->hasOne(Residents::class,'district_id','id');
    }

    // public function scopeAgeRange($query, $minAge, $maxAge)
    // {
    //     $minDate = now()->subYears($maxAge)->format('Y-m-d');
    //     $maxDate = now()->subYears($minAge + 50)->format('Y-m-d');

    //     return $query->whereHas('residents', function ($subQuery) use ($minDate, $maxDate) {
    //         $subQuery->whereBetween('birthdate', [$maxDate, $minDate]);
    //     });
    // }
}
