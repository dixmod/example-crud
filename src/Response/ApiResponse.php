<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiResponse
 */
class ApiResponse extends JsonResponse
{
    /**
     * @param $data
     * @param int $code
     * @param string|null $message
     * @param int $httpStatus
     */
    public function __construct(
        protected $data,
        protected int $code,
        protected ?string $message = null,
        protected int $httpStatus = Response::HTTP_OK
    ) {
        parent::__construct(
            [
                'code' => $code,
                'data' => $data,
                'message' => $message,
            ],
            $httpStatus
        );
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
