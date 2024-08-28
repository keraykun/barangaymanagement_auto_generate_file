<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function officials(){
        return $this->belongsToMany(Officials::class);
    }

    public function barangay(){
        return $this->belongsTo(Barangays::class);
    }

    public function district(){
        return $this->belongsTo(Districts::class);
    }
}
