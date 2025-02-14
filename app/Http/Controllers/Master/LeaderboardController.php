<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index() {
        return view('admin.leaderboard.index');
    }

    /**
     * Digunakan untuk menampilkan data leaderboard
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatables() {
        $get_leaderboards = Leaderboard::with('member')->orderBy('score', 'desc');

        return datatables($get_leaderboards)
            ->addColumn('member_name', function($leaderboard) {
                return $leaderboard->member->name;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }
}
