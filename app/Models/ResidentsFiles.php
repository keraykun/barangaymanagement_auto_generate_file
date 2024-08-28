<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentsFiles extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = true;

    public function resident(){
        return $this->belongsTo(Residents::class);
    }

    public function staff(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function belongsToFile(){
        return $this->belongsTo(Files::class,'file_id', 'id');
    }

    public function file(){
        return $this->belongsTo(Files::class,'file_id', 'id');
    }

}
