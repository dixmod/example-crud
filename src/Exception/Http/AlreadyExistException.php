<?php

declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class AlreadyExistException
 */
class AlreadyExistException extends GenericException
{
    public function __construct(string $message = 'Already exist', ?Throwable $previous = null)
    {
        parent::__construct($this->getStatusCode(), $message, $previous);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}
