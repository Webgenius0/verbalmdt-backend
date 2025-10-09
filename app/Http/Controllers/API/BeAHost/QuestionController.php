<?php

namespace App\Http\Controllers\API\BeAHost;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // GET /api/questions
    public function index()
    {
        $questions = Question::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $questions
        ]);
    }

    // GET /api/questions/{id}
    public function show($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $question
        ]);
    }
}
