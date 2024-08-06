<?php

namespace App\Support\Logger;

use App\Support\Logger\RequestGenerator\RequestGeneratorInterface;
use Psr\Log\LoggerInterface;
use Stringable;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Log\Logger;

/**
 * Class DcLogger
 * @package App\Support\Logger
 */
class DcLogger extends Logger implements LoggerInterface
{
    private const REQUEST_TEMPLATE = '[requestId: %s] %s';

    private string $requestId;

    /**
     * @param RequestGeneratorInterface $requestIdGenerator
     * @param RequestStack|null $requestStack
     */
    public function __construct(
        private readonly RequestGeneratorInterface $requestIdGenerator,
        private readonly string $requestIdHeader,
        ?RequestStack $requestStack = null
    ) {
        $requestId = $this->initRequstId($requestStack);

        $this->setRequestId($requestId);

        parent::__construct(null, null, null, $requestStack);
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @param string|Stringable $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = []): void
    {
        $message = sprintf(self::REQUEST_TEMPLATE, $this->getRequestId(), $message);
        parent::debug($message, $context);
    }

    /**
     * @param string|Stringable $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = []): void
    {
        $message = sprintf(self::REQUEST_TEMPLATE, $this->getRequestId(), $message);
        parent::info($message, $context);
    }

    /**
     * @param string|Stringable $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = []): void
    {
        $message = sprintf(self::REQUEST_TEMPLATE, $this->getRequestId(), $message);
        parent::notice($message, $context);
    }

    /**
     * @param string|Stringable $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = []): void
    {
        $message = sprintf(self::REQUEST_TEMPLATE, $this->getRequestId(), $message);
        parent::error($message, $context);
    }

    /**
     * @param RequestStack|null $requestStack
     * @return string|null
     */
    public function initRequstId(?RequestStack $requestStack): ?string
    {
        if ($this->isHeaderInRequest($requestStack)) {
            $requestId = $requestStack->getCurrentRequest()->headers->get($this->requestIdHeader);
        } else {
            $requestId = $this->requestIdGenerator->generate();
        }
        return $requestId;
    }

    /**
     * @param RequestStack|null $requestStack
     * @return bool
     */
    public function isHeaderInRequest(?RequestStack $requestStack): bool
    {
        return $requestStack !== null &&
            $requestStack->getCurrentRequest() !== null &&
            $requestStack->getCurrentRequest()->headers !== null &&
            $requestStack->getCurrentRequest()->headers->has($this->requestIdHeader);
    }
}
