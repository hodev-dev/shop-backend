<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;

    public function games()
    {
        return $this->belongsToMany(Game::class)->orderBy('created_at', 'desc');
    }
}
