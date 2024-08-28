<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backgrounds extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barangay(){
        return $this->belongsTo(Barangays::class);
    }
}
