<?php

declare(strict_types=1);

namespace App\Exception\Http;

use App\Response\ApiResponse;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class GenericException
 */
class GenericException extends Exception
{
    public function __construct(int $code, string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getResponse(): ApiResponse
    {
        return new ApiResponse($this->getData(), $this->code, $this->getMessage());
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_OK;
    }

    /**
     * @return array<mixed>|null
     */
    public function getData(): ?array
    {
        return null;
    }
}
