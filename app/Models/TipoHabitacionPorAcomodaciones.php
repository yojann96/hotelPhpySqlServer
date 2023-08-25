<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHabitacionPorAcomodaciones extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdTipoHabitacionPorAcomodaciones';
    protected $fillable = ['IdTipoHabitacionPorAcomodaciones', 'IdTipoHabitaciones','IdTipoAcomodaciones'];
}
