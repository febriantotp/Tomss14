<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_id',
        'name',
        'slug',
        'thumbnail',
        'summary',
        'description',
        'screenshots',
        'developer',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'requirement',
        'howtoinstall',
        'game_size',
        'link1',
        'link2',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }

    // Accessor untuk genre_names
    public function getGenreNamesAttribute()
    {
        return $this->genres->pluck('name')->join(', ');
    }

}
