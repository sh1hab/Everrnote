<?php

// declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Utils\TransactionUtils;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Log;
use Closure;

abstract class BaseApiController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return success response
     *
     * @param mixed $result Data to be sent as response
     * @param bool $wrapped States whether or not $result should be wrapped in a 'data' field
     *                        If false it will be merged into the main object
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result = [], $wrapped = true)
    {
        if ($wrapped) {
            $response = (object)[
                'success' => true, 'data' => (object)$result
            ];
        } else {
            if (!is_array($result)) {
                if (
                    $result instanceof JsonResource
                    || $result instanceof ResourceCollection
                ) {
                    $result = $result->toArray(request());
                } else if (method_exists($result, 'toArray')) {
                    $result = $result->toArray();
                } else {
                    $result = (array)$result;
                }
            }

            $response = (object)array_merge(
                [
                    'success' => true
                ],
                $result
            );
        }
        return response()->json($response, 200);
    }

    /**
     * Return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorMessages = [], $code = 400)
    {
        $response = (object)[
            'success' => false,
            'errors' => $errorMessages
        ];

        return response()->json($response, $code);
    }

    protected function execute(Closure $closure, $transactional = false)
    {
        if ($transactional) {
            return TransactionUtils::executeInTransaction(function () use ($closure) {
                return $closure();
            });
        }
        return $closure();
    }
}
