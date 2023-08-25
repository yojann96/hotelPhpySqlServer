<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitacionesPorHotel extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdHabitacionesPorHotel';
    protected $fillable = ['IdHabitacionesPorHotel', 'IdHotel', 'IdHabitaciones'];
}
