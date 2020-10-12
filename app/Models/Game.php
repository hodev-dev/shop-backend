<?php

namespace App\Models;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['steam_id', 'name', 'header_url'];
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function collection()
    {
        return $this->belongsToMany(Collection::class)->orderBy('created_at');
    }
}
