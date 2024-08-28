<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function residents(){
        return $this->hasMany(ResidentsFiles::class,'file_id');
    }
}
