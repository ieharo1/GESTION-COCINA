<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    protected $fillable = ['nombre', 'fecha'];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function recetas(): BelongsToMany
    {
        return $this->belongsToMany(Receta::class, 'menu_recetas')
            ->withPivot('dia_semana');
    }
}
