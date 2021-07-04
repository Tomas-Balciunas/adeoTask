<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherCondition extends Model
{
    protected $fillable = ['condition'];

    public function products() {
        return $this->hasMany(Products::class, 'weather_condition_id')->select(array('name', 'price'));
    }
}
