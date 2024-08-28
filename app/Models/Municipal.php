<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Barangays(){
        return $this->hasMany(Barangays::class);
    }

    public function Province(){
        return $this->belongsTo(Province::class);
    }
}
