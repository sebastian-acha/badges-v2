<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;

    // Opción 1: Definir qué campos SÍ se pueden llenar (Recomendado)
    protected $fillable = ['api_key', 'name', 'active'];

    // Opción 2: Definir que NO hay campos protegidos (Más rápido, menos seguro)
    // protected $guarded = []; 
}