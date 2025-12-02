<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assertion extends Model
{
    protected $guarded = []; // Permite asignación masiva

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
