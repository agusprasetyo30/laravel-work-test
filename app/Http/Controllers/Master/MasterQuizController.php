<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterQuizController extends Controller
{
    public function index() {
        return view('admin.master-quiz.index');
    }
}
