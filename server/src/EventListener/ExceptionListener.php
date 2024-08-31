<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();

        // Customize your response object to display the exception details
        $response = new JsonResponse();
        $response->setData($this->regularError($exception->getMessage()));

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());

            // On validation exception
            if ($exception->getPrevious() instanceof ValidationFailedException) {
                $response->setData($this->validationError($exception->getPrevious()->getViolations()));
                $response->setStatusCode(400);
            }
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->headers->set('Content-Type', 'application/json');
        // sends the modified response object to the event
        $event->setResponse($response);
    }

    private function regularError(string $error)
    {
        return ['error' => $error];
    }

    private function validationError(ConstraintViolationListInterface $list)
    {
        $validationErrors = [];
        foreach ($list as $error) {
            $validationErrors[$error->getPropertyPath()] = $error->getMessage();
        }
        return ['validation' => $validationErrors];
    }
}
