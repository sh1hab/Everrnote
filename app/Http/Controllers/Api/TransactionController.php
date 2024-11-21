<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class TransactionController extends BaseApiController
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
        $cachedTransactions = Cache::get('transactions' . Auth::id());

        if (empty($cachedTransactions)) {
            $this->setCache();
        }

        $total = $cachedTransactions->pluck('amount')->sum();

        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $data = new LengthAwarePaginator(
            $cachedTransactions->forPage($page, $perPage),
            $cachedTransactions->count(),
            $perPage,
            $page
        );

        // $data['total'] = $total;

        return TransactionResource::collection($data);
    }

    /**
     * @param StoreTransactionRequest $request
     * @return JsonResponse
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();

        $transaction = Transaction::create($data);

        $this->setCache();

        return $this->sendResponse(new TransactionResource($transaction));
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function show(Transaction $transaction)
    {
        return $this->sendResponse(new TransactionResource($transaction));
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->input();

        $transaction->update($data);

        $this->setCache();

        return $this->sendResponse(new TransactionResource($transaction));
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return $this->sendResponse();
    }

    public function setCache()
    {
        $cachedTransactions = Auth::user()->transactions()->orderBy('created_at', 'desc')->get();

        Cache::set('transactions_'.Auth::id(), $cachedTransactions, 1000);
    }
}
