<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\SurveyResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ContactController extends BaseApiController
{
    /**
     * Contacts list with pagination
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $contacts = Auth::user()->contacts()->orderBy('uuid', 'desc')->paginate($request->paginate ?? 20);


        return ContactResource::collection($contacts);
    }

    /**
     * @param StoreContactRequest $request
     * @return JsonResponse
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        $contact = Contact::create($data);

        return $this->sendResponse(new ContactResource($contact));
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return JsonResponse
     */
    public function show(Contact $contact)
    {
        return $this->sendResponse(new ContactResource($contact));
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->input();

        $contact->update($data);

        return $this->sendResponse(new ContactResource($contact));
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $this->sendResponse();
    }
}
