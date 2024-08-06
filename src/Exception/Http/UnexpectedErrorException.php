<?php

declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class UnexpectedErrorException
 */
class UnexpectedErrorException extends GenericException
{
    public const DEFAULT_MESSAGE = 'Unexpected error';

    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $message = self::DEFAULT_MESSAGE, ?Throwable $previous = null)
    {
        parent::__construct(Response::HTTP_INTERNAL_SERVER_ERROR, $message, $previous);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
