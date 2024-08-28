<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialsPositions extends Model
{
    use HasFactory;

    public function official(){
        return $this->belongsTo(Officials::class,'officials_id');
    }
    public function position(){
        return $this->belongsTo(Positions::class,'positions_id');
    }
}
