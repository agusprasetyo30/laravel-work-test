<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $fillable = [
        'member_id', 'score'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
