<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class LogRequestListener
 * @package App\EventListener
 */
class LogRequestListener implements EventSubscriberInterface
{
    private const MAX_EVENT_ORDER = 100;
    private const MIN_EVENT_ORDER = -99;
    private const ON_REQUEST_EVENT_NAME = 'onRequest';
    private const ON_RESPONSE_EVENT_NAME = 'onResponse';
    private const REQUEST_PLACE_HOLDER = '[Request]';
    private const RESPONSE_PLACE_HOLDER = '[Response]';

    /**
     * @param LoggerInterface $logger
     * @param string[] $includeUrls
     * @param string[] $excludeUrls
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly array $includeUrls,
        private readonly array $excludeUrls,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [self::ON_REQUEST_EVENT_NAME, self::MAX_EVENT_ORDER],
            KernelEvents::RESPONSE => [self::ON_RESPONSE_EVENT_NAME, self::MIN_EVENT_ORDER],
        ];
    }

    /**
     * @param RequestEvent $event
     */
    public function onRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $message = $this->getFormattedRequestMessage($request->getUri(), $request->getContent());
        if (!$this->isUrlMath($request->getPathInfo())) {
            $this->logger->debug($message);
            return;
        }
        $this->logger->info($message);
    }

    /**
     * @param ResponseEvent $event
     */
    public function onResponse(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $message = $this->getFormattedResponseMessage($response->getContent());
        if (!$this->isUrlMath($request->getPathInfo())) {
            $this->logger->debug($message);
            return;
        }

        if ($response->getStatusCode() >= Response::HTTP_INTERNAL_SERVER_ERROR) {
            $this->logger->error($message);
        } elseif ($response->getStatusCode() >= Response::HTTP_BAD_REQUEST) {
            $this->logger->notice($message);
        } else {
            $this->logger->info($message);
        }
    }

    /**
     * @param string $url
     * @param string $message
     * @return string
     */
    private function getFormattedRequestMessage(string $url, string $message): string
    {
        return sprintf(
            '%s url: %s body: %s',
            self::REQUEST_PLACE_HOLDER,
            $url,
            preg_replace('/\r\n/', '', $message)
        );
    }

    /**
     * @param string $message
     * @return string
     */
    private function getFormattedResponseMessage(string $message): string
    {
        return sprintf(
            '%s %s',
            self::RESPONSE_PLACE_HOLDER,
            preg_replace('/\r\n/', '', $message)
        );
    }

    private function isUrlMath(string $pathInfo): bool
    {
        foreach ($this->excludeUrls as $urlPrefix) {
            if (str_starts_with($pathInfo, $urlPrefix)) {
                return false;
            }
        }
        foreach ($this->includeUrls as $urlPrefix) {
            if (str_starts_with($pathInfo, $urlPrefix)) {
                return true;
            }
        }
        return false;
    }
}
