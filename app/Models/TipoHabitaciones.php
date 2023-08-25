<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHabitaciones extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdTipoHabitaciones';
    protected $fillable = ['IdTipoHabitaciones', 'TipoHabitaciones'];
}
