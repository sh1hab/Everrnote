<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ContactController extends BaseApiController
{
    /**
     * Contacts list with pagination
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws InvalidArgumentException
     */
    public function index(Request $request)
    {
        $cached_contacts = Cache::get('contacts_'.Auth::id());

        if (empty($cached_contacts)){
            $cached_contacts = Auth::user()->contacts()->orderBy('uuid', 'desc')->get();

            Cache::set('contacts_'.Auth::id(), $cached_contacts, 1000);
        }

        $page = $request->input('page', 1);

        $perPage = $request->input('per_page', 10);

        $data = new LengthAwarePaginator(
            $cached_contacts->forPage($page, $perPage), $cached_contacts->count(), $perPage, $page
        );

        return ContactResource::collection($data);
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
