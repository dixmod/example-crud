<?php

declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class NotFoundException
 */
class NotFoundException extends GenericException
{
    public function __construct(string $message = 'Not found!', ?Throwable $previous = null)
    {
        parent::__construct(Response::HTTP_NOT_FOUND, $message, $previous);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
