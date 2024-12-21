<?php

/**
 * Author: Soulaimane Yahya
 * Date: 2024-12-07
 */

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiResponser
{
    /**
     * Build success response
     * @param  null|string|array|Model|Collection $data
     * @param  int $code
     * @return JsonResponse
     */
    public function successResponse(
        null|string|array|Model|Collection $data,
        int $code = Response::HTTP_OK
    ): JsonResponse {
        return $this->jsonResponse(['data' => $data], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return JsonResponse
     */
    public function errorResponse(string|array $message, int $code): JsonResponse
    {
        return $this->jsonResponse(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build jon response
     * @param  null|string|array|Model|Collection $data
     * @param  int $code
     * @return JsonResponse
     */
    public function jsonResponse(
        null|string|array|Model|Collection $data,
        int $code = Response::HTTP_OK
    ): JsonResponse {
        return new JsonResponse($data, $code);
    }
}
