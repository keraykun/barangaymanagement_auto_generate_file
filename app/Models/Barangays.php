<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangays extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function Municipal(){
        return $this->belongsTo(Municipal::class);
    }

    public function Admins(){
        return $this->hasMany(User::class,'barangay_id');
    }

    public function hasResidents(){
        return $this->hasMany(Residents::class,'id', 'barangay_id');
    }

}
