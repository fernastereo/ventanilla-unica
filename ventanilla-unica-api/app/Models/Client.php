<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'status',
        'is_active',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function peticions()
    {
        return $this->hasMany(Peticion::class);
    }
}
