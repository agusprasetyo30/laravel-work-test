<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberQuestion extends Model
{
    protected $fillable = [
        'member_id', 'question_id', 'member_answer', 'is_valid'
    ];
}
