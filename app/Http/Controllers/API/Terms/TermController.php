<?php

namespace App\Http\Controllers\API\Terms;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    // Get all terms
    public function index()
    {
        $terms = Term::all(); // fetch all terms

        return response()->json([
            'success' => true,
            'data' => $terms
        ]);
    }
}
