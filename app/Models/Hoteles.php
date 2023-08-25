<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoteles extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdHotel';
    protected $fillable = ['IdHotel', 'NombreHotel', 'DireccionHotel', 'IdCiudadHotel','NITHotel','NroHabsHotel'];
}
