<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitacionesAcomodacTipo extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdHabitacionesAcomodTipo';
    protected $fillable = ['IdHabitacionesAcomodTipo', 'IdHabitaciones',
        'IdHotel','IdTipoHabitaciones','IdTipoAcomodaciones'];
}
