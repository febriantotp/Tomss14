<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    public function games() {
        return $this->hasMany(Game::class);
    }

    public function genres() {
        return $this->hasMany(Genre::class);
    }
}
