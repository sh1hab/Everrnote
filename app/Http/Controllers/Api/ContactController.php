<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ContactResource;
use App\Http\Resources\SurveyResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
        return ContactResource::collection(Contact::orderBy('uuid', 'desc')->paginate($request->paginate ?? 20));
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $contact = new Contact();

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

        return $this->sendResponse(new SurveyResource($contact));
    }

    /**
     * @return JsonResponse
     */
    public function update(Contact $contact)
    {
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
