<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function filmes(): HasMany
    {
        return $this->hasMany(Filme::class);
    }

    // Uso de hasOne "de muitos": o filme mais recente dessa categoria
    public function filmeDestaque(): HasOne
    {
        return $this->hasOne(Filme::class)->latestOfMany('ano');
    }
}
