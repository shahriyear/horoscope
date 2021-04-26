<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    use HasFactory;
    public $fillable = [
        'day',
        'month',
        'year',
        'score',
        'zodiac_id',
    ];

    public function zodiac()
    {
        return $this->belongsTo(Zodiac::class);
    }
}
