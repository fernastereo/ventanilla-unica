<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtipopeticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'activo',
        'visible',
        'campos',
        'tipopeticion_id'
    ];

    public function tipopeticion()
    {
        return $this->belongsTo(Tipopeticion::class);
    }
}
