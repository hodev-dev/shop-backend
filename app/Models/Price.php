<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;
    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'id', 'currency_id');
    }
}
