<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends BaseApiController
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => Note::paginate(20)
        ]);
    }

    public function store(Request $request)
    {
        $note = Note::create($request->all());
        return response()->json([
            'data' => $note
        ]);
    }
}
