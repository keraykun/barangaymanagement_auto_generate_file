<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officials extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function positions(){
        return $this->belongsToMany(Positions::class)->withTimestamps();
    }

    public function position(){
        return $this->belongsTo(Positions::class);
    }

    public function barangay(){
        return $this->belongsTo(Barangays::class, 'barangay_id', 'id');
    }

    public function projects(){
        return $this->belongsToMany(Projects::class);
    }

    public function hasResidentsFile(){
        return $this->barangay->flatMap->hasResidents->flatMap->allfiles;
    }
}
