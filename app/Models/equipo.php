<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function problema()
    {
        return $this->belongsTo('App\Models\ejercicio6', 'idEjercicio6', 'id');
    }
}
