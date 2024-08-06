<?php

namespace App\Response;

use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiResponseBuilder
 * @package App\Response
 */
class ApiResponseBuilder
{
    /**
     * @param mixed $data
     * @return ApiResponse
     */
    public function data(mixed $data, ?string $message = null): ApiResponse
    {
        if ($data instanceof JsonSerializable) {
            $data = $data->jsonSerialize();
        }

        return (new ApiResponse(
            $data,
            200,
            $message,
            Response::HTTP_OK
        ));
    }

    /**
     * @param array $data
     * @param int $code
     * @param string $message
     * @param int $httpStatus
     * @return ApiResponse
     */
    public function error(array $data, int $code, string $message, int $httpStatus): ApiResponse
    {
        return new ApiResponse($data, $code, $message, $httpStatus);
    }

    public function success(string $message = 'OK'): ApiResponse
    {
        return new ApiResponse(null, 200, $message, Response::HTTP_OK);
    }
}
