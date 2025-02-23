<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function games() {
        return $this->belongstoMany(Game::class, 'game_genre');
    }

    public function platforms() {
        return $this->hasMany(Platform::class);
    }
}
