<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberQuestion;
use App\Models\Question;
use Illuminate\Http\Request;

class MasterQuizController extends Controller
{
    public function index() {
        return view('admin.master-quiz.index');
    }

    /**
     * Summary of distributeQuestions
     * @return mixed|string|\Illuminate\Http\JsonResponse
     */
    public function distributeQuestions()
    {
        // Ambil semua member dan pertanyaan
        $members = Member::all();
        $questions = Question::all();

        // Pastikan ada member dan pertanyaan
        if ($members->isEmpty() || $questions->isEmpty()) {
            return "There are no members or questions available.";
        }

        $shuffledQuestions = $questions->shuffle();

        // Menghapus pertanyaan
        MemberQuestion::truncate();

        // Loop melalui setiap member
        foreach ($members as $member) {
            // Tentukan jumlah pertanyaan untuk member ini (acak antara 1 dan jumlah pertanyaan tersedia)
            $numberOfQuestions = rand(1, $shuffledQuestions->count());

            // Ambil pertanyaan yang belum dialokasikan ke member ini
            $availableQuestions = $shuffledQuestions->diff($member->questions);

            // Jika pertanyaan tersedia kurang dari yang dibutuhkan, ambil semua yang tersedia
            if ($availableQuestions->count() < $numberOfQuestions) {
                $numberOfQuestions = $availableQuestions->count();
            }

            // Ambil pertanyaan secara acak dari yang tersedia
            $questionsForMember = $availableQuestions->random($numberOfQuestions);

            // Attach pertanyaan ke member
            $member->questions()->attach($questionsForMember->pluck('id'));
        }

        return $this->success([], "The question was successfully allocated to the member");
    }

    
    /**
     * Summary of assignedQuestionDatatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignedQuestionDatatables() {
        $data = MemberQuestion::with('member', 'question');

        return datatables($data)
            ->addColumn('member_name', function ($data) {
                return $data->member->name;
            })
            ->addColumn('question_description', function ($data) {
                return $data->question->description;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
