<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'description', 'answer'
    ];

    public function memberQuestions()
    {
        return $this->belongsToMany(Member::class, 'member_questions')
            ->withPivot('member_answer', 'is_valid');
    }
}
