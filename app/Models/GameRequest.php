<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'platform_id'
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }
}
