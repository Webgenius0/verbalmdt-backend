<?php

namespace App\Http\Controllers\Web\BeAHost;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(10);
        return view('backend.layouts.beAHost.questions.list', compact('questions'));
    }

    public function create()
    {
        return view('backend.layouts.beAHost.questions.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required|string',
        ]);

        Question::create([
            'title' => $request->title,
            'questions' => $request->questions,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question set created successfully!');
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('backend.questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('backend.layouts.beAHost.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'title' => $request->title,
            'questions' => $request->questions,
        ]);

        return redirect()->route('questions.index')->with('success', 'Question set updated successfully!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question set deleted successfully!');
    }
}
