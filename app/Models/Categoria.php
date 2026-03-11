<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function recetas(): HasMany
    {
        return $this->hasMany(Receta::class);
    }
}
