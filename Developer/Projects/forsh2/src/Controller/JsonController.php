<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @author Michael Strucken <michael@strucken.it>
 */
abstract class JsonController extends AbstractController
{
    #[AsEventListener(priority: 1)]
    public function onKernelException(ExceptionEvent $event): void
    {
        if (!str_starts_with($event->getRequest()->getRequestUri(), "/json/")) {
            return;
        }

        $event->allowCustomResponseCode();

        if ($event->getThrowable() instanceof BadRequestHttpException) {
            $event->setResponse(
                new JsonResponse(
                    ["error" => $event->getThrowable()->getMessage()],
                    Response::HTTP_BAD_REQUEST
                )
            );
        } else {
            $event->setResponse(
                new JsonResponse(
                    ["error" => $event->getThrowable()->getMessage()],
                    Response::HTTP_OK
                )
            );
        }
    }
}
