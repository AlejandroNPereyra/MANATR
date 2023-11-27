<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    use HasFactory;

    protected $fillable = [

        'date',
        'celebrated_at',
        'winner_id',
        'loser_id',
        'winner_mana_raised',
        'loser_mana_raised',  

    ];

}
