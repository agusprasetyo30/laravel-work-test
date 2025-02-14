<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberQuestion extends Model
{
    protected $fillable = [
        'member_id', 'question_id', 'member_answer', 'is_valid'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
