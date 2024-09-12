<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipopeticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public function peticions()
    {
        return $this->hasMany(Peticion::class);
    }

    public function subtipopeticions()
    {
        return $this->hasMany(Subtipopeticion::class);
    }
}
