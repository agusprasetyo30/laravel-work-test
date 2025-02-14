<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('csv_file');

        if (!$file) {
            return response()->json(['message' => 'File CSV tidak ditemukan!'], 400);
        }

        // Delete All data question
        Question::truncate();
        Leaderboard::truncate();

        // import data
        $question_data = $this->separateFileCSV($file);

        foreach ($question_data as $data) {
            Question::create([
                'description' => $data['description'],
                'answer'   => $data['answer']
            ]);
        }

        return $this->success([], 'Question imported successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

    /**
     * Summary of datatables
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatables(Request $request) {
        $get_questions = Question::query();

        return datatables($get_questions)
            ->escapeColumns([])
            ->addIndexColumn()
            ->make();
    }

    /**
     * Summary of separateFileCSV
     * @param mixed $file
     * @return array{answer: string, question: string[]}
     */
    private function separateFileCSV($file) {
        $data = array_map('str_getcsv', file($file));
        $questions = [];

        foreach ($data as $row) {
            $cleanedData = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
            $parts = explode(";", $cleanedData);

            // Store in an associative array
            if (count($parts) == 2) {
                $questions[] = [
                    'description' => trim($parts[0]),
                    'answer'   => trim($parts[1])
                ];
            }
        }

        return $questions;
    }

    
}
