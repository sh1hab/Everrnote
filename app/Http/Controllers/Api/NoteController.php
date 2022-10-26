<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TransactionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends BaseApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(Note::paginate($request->paginate ?? 20));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $note = Note::create($request->all());

        return $this->sendResponse($note);
    }

    /**
     * Display the specified resource.
     *
     * @param Note $note
     * @return JsonResponse
     */
    public function show(Note $note)
    {
        return $this->sendResponse(new TransactionResource($note));
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->input();

        $note->update($data);

        return $this->sendResponse(new TransactionResource($note));
    }
}
