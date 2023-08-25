<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAcomodaciones extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdTipoAcomodaciones';
    protected $fillable = ['IdTipoAcomodaciones', 'TipoAcomodaciones'];
}
