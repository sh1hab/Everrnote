<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class AccountController extends BaseApiController
{
    private \Illuminate\Contracts\Auth\Authenticatable|null|\App\Models\User $user;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return AccountResource::collection(Account::where('user_id', $this->user->id)
            ->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSurveyRequest $request
     * @return AccountResource
     * @throws Exception
     */
    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();

        $account = Account::create($data);

        return new AccountResource($account);
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return JsonResponse
     */
    public function show(Account $account)
    {
        if ($this->user->id !== $account->user_id) {
            abort(403, __('global.unauthorised_action'));
        }

        $account->load(['upload']);

        return $this->sendResponse(new AccountResource($account));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSurveyRequest $request
     * @param Account $account
     * @return AccountResource
     * @throws Exception
     */
    public function update(UpdateSurveyRequest $request, Account $account)
    {
        $data = $request->validated();

        $account->update($data);

        return new AccountResource($account);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return JsonResponse
     */
    public function destroy(Account $account)
    {
        if ($this->user->id !== $account->user_id) {
            abort(403, __('global.request'));
        }

        $account->delete();
        return $this->sendResponse([], false, 204);
    }
}
