<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipopeticions_id',
        'nombre',
        'email',
        'telefono',
        'mensaje',
        'fecha_peticion',
        'vigencia',
        'radicado',
        'user_id',
        'client_id',
    ];

    public function tipopeticion() {
        return $this->belongsTo(Tipopeticion::class, 'tipopeticions_id');
    }

    public function adjuntos(){
        return $this->hasMany(Adjunto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
