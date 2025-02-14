<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use App\Models\MemberQuestion;
use Illuminate\Http\Request;

class MemberQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_questions = MemberQuestion::with('question')
            ->where('member_id', session('user_login')['id'])->get();

        // Cek kalkulasi
        $total_soal = 0;
        $jumlah_jawaban_benar = 0;
        $jumlah_jawab = 0;
        foreach (MemberQuestion::where('member_id', session('user_login')['id'])->get() as $key => $value) {
            if ($value->is_valid) {
                $jumlah_jawaban_benar += 1;
            }

            if($value->member_answer != '') {
                $jumlah_jawab += 1;
            }

            $total_soal = $key + 1;
        }

        $data['total_nilai'] = ($jumlah_jawaban_benar / $total_soal) * 100;
        $data['status'] = $data['total_nilai'] >= 80 ? 'lulus' : 'tidak lulus';
        $data['jumlah_jawab'] = $jumlah_jawab;

        return view('member.question', [
            'list_questions' => $list_questions,
            'data' => $data
        ]);
    }

    
    public function answer(Request $request) {
        $list_questions = MemberQuestion::with('question')
            ->where('member_id', session('user_login')['id'])->get();

        foreach ($list_questions as $key => $question) {
            if (strtolower($question->question->answer) == strtolower($request->answer[$key])) {
                MemberQuestion::where('id', $question->id)->update([
                    'member_answer' => $request->answer[$key],
                    'is_valid'      => true
                ]);
            } else {
                MemberQuestion::where('id', $question->id)->update([
                    'member_answer' => $request->answer[$key],
                ]);
            }
        }

        // Cek kalkulasi
        $total_soal = 0;
        $jumlah_jawaban_benar = 0;
        $jumlah_jawab = 0;
        foreach (MemberQuestion::where('member_id', session('user_login')['id'])->get() as $key => $value) {
            if ($value->is_valid) {
                $jumlah_jawaban_benar += 1;
            }

            if($value->member_answer != '') {
                $jumlah_jawab += 1;
            }

            $total_soal = $key + 1;
        }

        $total_nilai = ($jumlah_jawaban_benar / $total_soal) * 100;

        Leaderboard::where('member_id', session('user_login')['id'])->delete();
        Leaderboard::create([
            'member_id' => session('user_login')['id'],
            'score'     => $total_nilai
        ]);

        return redirect()->route('member.question.index');
    }
}
