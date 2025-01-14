<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function officials(){
        return $this->belongsToMany(Officials::class)->withTimestamps();
    }


}
