<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'filename',
        'peticions_id'
    ];

    public function peticion(){
        return $this->belongsTo(Peticion::class);
    }
}
