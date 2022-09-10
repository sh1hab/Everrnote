<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactsController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(ContactResource::collection(Contact::paginate(100)));
    }
}
