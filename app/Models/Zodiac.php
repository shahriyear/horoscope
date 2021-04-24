<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zodiac extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'start_day',
        'end_day',
        'start_month',
        'end_month',
    ];
}