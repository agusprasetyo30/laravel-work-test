<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'email', 'name'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'member_questions')
            ->withPivot('member_answer', 'is_valid');
    }
}
