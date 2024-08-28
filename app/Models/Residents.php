<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residents extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district(){
        return $this->hasOne(Districts::class,'id','district_id');
    }


    public function allfiles(){
        return $this->hasMany(ResidentsFiles::class,'resident_id','id');
    }
}
