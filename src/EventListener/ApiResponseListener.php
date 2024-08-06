<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\Http\FormValidationException;
use App\Exception\Http\GenericException;
use App\Exception\Http\UnexpectedErrorException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

/**
 * Class ApiResponseListener
 */
class ApiResponseListener implements EventSubscriberInterface
{
    /**
     * @return array<string, array<int, string|int>>
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 100000],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $this->originalException($event->getThrowable());
        $exception = $this->transformException($exception);

        $event->setResponse($exception->getResponse()->setStatusCode($exception->getStatusCode()));
        $event->stopPropagation();
    }

    private function transformException(Throwable $exception): GenericException
    {
        if ($exception instanceof ValidationFailedException) {
            return new FormValidationException($exception->getMessage(), $exception);
        }

        if ($exception instanceof GenericException) {
            return $exception;
        }

        return new UnexpectedErrorException($exception->getMessage(), $exception);
    }

    private function originalException(Throwable $exception): Throwable
    {
        $previous = $exception->getPrevious();
        if ($previous === null) {
            return $exception;
        }

        return $this->originalException($previous);
    }
}
