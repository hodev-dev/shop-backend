<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['game_id', 'currency_id', 'price', 'discount_percent', 'final_price'];
    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'id', 'currency_id');
    }
}
