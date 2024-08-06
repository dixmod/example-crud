<?php

declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class FormValidationException
 */
class FormValidationException extends GenericException
{
    public const DEFAULT_MESSAGE = 'Validation error';
    private const PATTERN_PARSING = '/(.*):\n?\W*(.*)/';

    /**
     * @var array<string, string>
     */
    private array $errors;

    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, self::DEFAULT_MESSAGE, $previous);

        $this->errors = $this->parsingMessage($message);
    }

    /**
     * @param string $message
     * @return array<string, string>
     */
    private function parsingMessage(string $message): array
    {
        preg_match_all(self::PATTERN_PARSING, $message, $match);

        return array_combine($match[1], $match[2]);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    /**
     * @return array<mixed>|null
     */
    public function getData(): ?array
    {
        return [
            'fields' => $this->errors,
        ];
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
